import { createEnv, type Env } from './env';
import { handleFetch, handleScheduled } from './index';

/**
 * EdgeOne Makers 云函数运行时。
 *
 * 所有 API 路由文件都是这一份实现的薄封装：EdgeOne 按文件名做文件路由，
 * 每个函数文件独立构建，所以构建时会把这里打包进每一个产物（见 scripts/build.mjs）。
 *
 * EdgeOne 没有 wrangler 那套 binding / cron trigger，运行时环境从 `context.env`
 * 读取，数据层由 `src/adapters` 用 Cloudflare D1 HTTP API 与 EdgeOne Blob 实现。
 */

interface EdgeOneContext {
  request: Request;
  env?: Record<string, string | undefined>;
  params?: Record<string, string>;
  clientIp?: string;
}

const CORS_HEADERS: Record<string, string> = {
  'Access-Control-Allow-Origin': '*',
  'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS',
  'Access-Control-Allow-Headers': 'Content-Type, Authorization, x-cron-secret',
};

function json(body: unknown, status = 200): Response {
  return new Response(JSON.stringify(body), {
    status,
    headers: { ...CORS_HEADERS, 'Content-Type': 'application/json' },
  });
}

/**
 * `POST /api/cron` —— 定时抓取任务入口。
 *
 * EdgeOne 没有 cron trigger，用外部调度器每分钟调一次即可复现原来
 * `crons: ["0 22 * * *", "* * * * *"]` 的行为。
 *
 * - `x-cron-secret` 头携带 `CRON_SECRET` 时校验（配置了才校验）
 * - `?source=<名称>` 只抓取指定视频源。云函数有 120s 墙钟上限，源多时可用它分片
 */
async function handleCron(request: Request, env: Env): Promise<Response> {
  if (request.method !== 'POST') {
    return json({ ok: false, error: 'Method Not Allowed，请用 POST 调用' }, 405);
  }

  if (env.CRON_SECRET) {
    const provided = request.headers.get('x-cron-secret') ?? '';
    if (provided !== env.CRON_SECRET) {
      return json({ ok: false, error: 'Unauthorized' }, 401);
    }
  }

  const onlySource = new URL(request.url).searchParams.get('source') ?? undefined;
  const startedAt = Date.now();

  try {
    await handleScheduled(env, onlySource);
    return json({ ok: true, source: onlySource ?? 'all', durationMs: Date.now() - startedAt });
  } catch (error) {
    const message = (error as Error).message;
    console.error('定时任务执行失败:', message, (error as Error).stack);
    return json({ ok: false, error: message, durationMs: Date.now() - startedAt }, 500);
  }
}

/** `GET /api/health` —— 连通性自检，确认部署与数据库配置是否正常。 */
async function handleHealth(env: Env): Promise<Response> {
  const checks: Record<string, unknown> = {
    runtime: `node ${process.version}`,
  };

  try {
    const result = await env.DB.prepare('SELECT COUNT(*) as total FROM articles').first();
    checks.database = 'ok';
    checks.articles = result?.total ?? 0;
  } catch (error) {
    checks.database = 'error';
    checks.databaseError = (error as Error).message;
  }

  const healthy = checks.database === 'ok';
  return json({ ok: healthy, checks }, healthy ? 200 : 503);
}

export async function onRequest(context: EdgeOneContext): Promise<Response> {
  const { request } = context;
  const env = createEnv(context.env);
  const path = new URL(request.url).pathname.replace(/\/+$/, '') || '/';

  try {
    if (path === '/api/cron') return await handleCron(request, env);
    if (path === '/api/health') return await handleHealth(env);
    return await handleFetch(request, env);
  } catch (error) {
    const message = (error as Error).message;
    console.error(`${request.method} ${path} 处理失败:`, message, (error as Error).stack);
    return json({ error: 'Internal Server Error', detail: message }, 500);
  }
}
