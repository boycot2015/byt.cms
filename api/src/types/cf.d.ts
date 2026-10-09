/**
 * 最小化的 D1 / R2 类型声明。
 *
 * 原本这些类型来自 `worker-configuration.d.ts`（wrangler types 生成，417KB）。
 * 迁移到 EdgeOne 后不再依赖 Cloudflare 的类型生成器，只保留代码实际用到的子集，
 * 由 `src/adapters/` 下的适配器在运行时提供真实实现。
 */

interface D1Meta {
  served_by?: string;
  duration?: number;
  changes?: number;
  last_row_id?: number;
  changed_db?: boolean;
  size_after?: number;
  rows_read?: number;
  rows_written?: number;
  [key: string]: unknown;
}

interface D1Result<T = Record<string, unknown>> {
  results: T[];
  success: boolean;
  meta: D1Meta;
}

interface D1PreparedStatement {
  bind(...values: unknown[]): D1PreparedStatement;
  first<T = Record<string, unknown>>(colName?: string): Promise<T | null>;
  all<T = Record<string, unknown>>(): Promise<D1Result<T>>;
  run<T = Record<string, unknown>>(): Promise<D1Result<T>>;
  raw<T = unknown[]>(): Promise<T[]>;
}

interface D1Database {
  prepare(sql: string): D1PreparedStatement;
}

/** 代码中只用到 put / get / delete / name，其余 R2 API 未使用。 */
interface R2PutOptions {
  httpMetadata?: { contentType?: string; contentLanguage?: string };
  customMetadata?: Record<string, string>;
}

interface R2Bucket {
  readonly name?: string;
  put(
    key: string,
    value: ArrayBuffer | ArrayBufferView | ReadableStream | string | null,
    options?: R2PutOptions
  ): Promise<{ key: string } | null>;
  get(key: string): Promise<R2ObjectBody | null>;
  delete(key: string): Promise<void>;
}

interface R2ObjectBody {
  key: string;
  size: number;
  httpMetadata?: { contentType?: string };
  arrayBuffer(): Promise<ArrayBuffer>;
  text(): Promise<string>;
  json<T>(): Promise<T>;
}

/** EdgeOne 没有 waitUntil 语义，这里只保留类型形状以便既有代码签名不变。 */
interface ExecutionContext {
  waitUntil(promise: Promise<unknown>): void;
  passThroughOnException(): void;
}

interface ScheduledEvent {
  cron: string;
  scheduledTime: number;
}

/**
 * `lib` 只开了 es2024，没引入 DOM lib，而 Node 类型里不含 `HeadersInit`
 * （原先由 worker-configuration.d.ts 提供）。按 DOM 标准定义补上。
 */
type HeadersInit = [string, string][] | Record<string, string> | Headers;
