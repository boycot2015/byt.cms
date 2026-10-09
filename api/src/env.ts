import { createD1HttpClient } from "./adapters/d1-http";
import { createBlobBucket } from "./adapters/blob-bucket";

/**
 * 运行时环境装配。
 *
 * Cloudflare Workers 里这些值由 wrangler 的 bindings / vars 注入（`env.xxx`）；
 * EdgeOne 云函数没有 binding 概念，改为从环境变量读取，再由 `src/adapters/`
 * 把 D1 与 R2 这两个 binding 形状的对象用适配器实现出来。
 *
 * 读取顺序：EdgeOne 的 `context.env`（控制台配置）优先，其次 `process.env`。
 */

export interface Env {
  DB: D1Database;
  UPLOAD_BUCKET: R2Bucket;
  QUARK_API_KEY: string;
  ALIYUN_REFRESH_TOKEN: string;
  ALIYUN_CLIENT_ID: string;
  ALIYUN_CLIENT_SECRET: string;
  JIANGUOYUN_USERNAME: string;
  JIANGUOYUN_APP_PASSWORD: string;
  FILE_URL: string;
  CRON_SECRET: string;
  /** 上传文件的 Blob 存储桶名，仅用于排查问题时定位数据。 */
  BLOB_STORE_NAME: string;
}

export type EnvSource = Record<string, string | undefined>;

/** 控制台变量优先，回落到 Node 进程环境变量。 */
export function resolveEnvSource(contextEnv?: EnvSource): EnvSource {
  return { ...process.env, ...(contextEnv ?? {}) };
}

export function createEnv(contextEnv?: EnvSource): Env {
  const source = resolveEnvSource(contextEnv);

  return {
    DB: createD1HttpClient({
      accountId: source.CF_ACCOUNT_ID,
      databaseId: source.CF_D1_DATABASE_ID,
      apiToken: source.CF_API_TOKEN,
      apiBase: source.CF_API_BASE,
    }),

    UPLOAD_BUCKET: createBlobBucket({
      storeName: source.BLOB_STORE_NAME || "byt-cms-uploads",
    }),
    BLOB_STORE_NAME: source.BLOB_STORE_NAME || "byt-cms-uploads",

    QUARK_API_KEY: source.QUARK_API_KEY ?? "",
    ALIYUN_REFRESH_TOKEN: source.ALIYUN_REFRESH_TOKEN ?? "",
    ALIYUN_CLIENT_ID: source.ALIYUN_CLIENT_ID ?? "",
    ALIYUN_CLIENT_SECRET: source.ALIYUN_CLIENT_SECRET ?? "",
    JIANGUOYUN_USERNAME: source.JIANGUOYUN_USERNAME ?? "",
    JIANGUOYUN_APP_PASSWORD: source.JIANGUOYUN_APP_PASSWORD ?? "",
    FILE_URL: source.FILE_URL ?? "https://file.boycot.dpdns.org",
    CRON_SECRET: source.CRON_SECRET ?? "",
  };
}
