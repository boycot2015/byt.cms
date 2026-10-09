import { handleArticles } from './routes/articles';
import { handleCategories } from './routes/categories';
import { handleTags } from './routes/tags';
import { handleVideos } from './routes/videos';
import { handleComments } from './routes/comments';
import { handleUsers } from './routes/users';
import { handleSiteConfig } from './routes/siteConfig';
import { handleUpload } from './routes/upload';
import { handleVideoSources } from './routes/videoSources';
import { isTimeToFetch } from './services/videoSourceService';
import { fetchVideoRecommend, setVideoList } from './services/dbService';
import { handleDocs } from './routes/docs';
import type { Env } from './env';

/** 所有业务路由的调度入口，EdgeOne 与 Cloudflare 共用同一套分发逻辑。 */
export async function handleFetch(
  request: Request,
  env: Env,
  _ctx?: ExecutionContext
): Promise<Response> {
  const corsHeaders = {
    "Access-Control-Allow-Origin": "*",
    "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, OPTIONS",
    "Access-Control-Allow-Headers": "Content-Type, Authorization",
  };

  if (request.method === "OPTIONS") {
    return new Response(null, { headers: corsHeaders });
  }

  // 路由处理
  const routeHandlers = [
    handleDocs,
    handleArticles,
    handleCategories,
    handleTags,
    handleVideos,
    handleComments,
    handleUsers,
    handleSiteConfig,
    handleUpload,
    handleVideoSources
  ];

  for (const handler of routeHandlers) {
    const response = await handler(request, env, corsHeaders);
    if (response) {
      return response;
    }
  }

  // 404 响应
  return new Response(JSON.stringify({ error: "Not Found" }), {
    headers: { ...corsHeaders, "Content-Type": "application/json" },
    status: 404,
  });
}

/**
 * 定时抓取任务。
 *
 * 原本由 Cloudflare 的 cron trigger（`0 22 * * *` + `* * * * *`）驱动，
 * EdgeOne 没有对应的定时触发器，改由 `POST /api/cron` 端点触发，
 * 用外部 cron（EdgeOne 定时任务 / 腾讯云函数 / GitHub Actions 等）每分钟调一次。
 * - `onlySource` 只处理指定名称的视频源，用于绕开云函数 120s 墙钟上限分片执行
 */
export async function handleScheduled(env: Env, onlySource?: string): Promise<void> {
  console.log("定时调度任务执行:", new Date().toLocaleString(), onlySource ? `(源: ${onlySource})` : "");

  const sources: any = await env.DB.prepare("SELECT * FROM video_sources WHERE enabled = 1").all();

  if (sources.results.length === 0) {
    console.log("无启用的视频源配置");
  } else {
    for (const source of sources.results) {
      if (onlySource && source.name !== onlySource) {
        continue;
      }

      source.tags = JSON.parse(source.tags || "[]");

      if (!source.type || !source.path) {
        console.warn(`源[${source.name}] 配置未完成(type=${source.type}, path=${source.path})，跳过`);
        continue;
      }

      if (!isTimeToFetch(source)) {
        console.log(`源[${source.name}]未到抓取时间，跳过`);
        continue;
      }

      try {
        await setVideoList(source, env);
        console.log(`源[${source.name}]抓取完成`);
      } catch (error) {
        const e = error as Error;
        console.error(`源[${source.name}]抓取失败: ${e.message}`);
        if (e.stack) {
          console.error(e.stack);
        }
        continue;
      }
    }
  }

  // 分片执行时不重复刷新推荐位（它会请求一次外部接口）
  if (!onlySource) {
    await fetchVideoRecommend(env);
  }
}
