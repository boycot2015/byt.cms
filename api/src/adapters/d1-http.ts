/**
 * D1 over Cloudflare HTTP API —— EdgeOne 迁移用的数据库适配器。
 *
 * EdgeOne Makers 平台不提供托管 SQL 数据库，而本项目有 81 处 D1 调用且大量使用
 * SQLite 方言（`INSERT OR IGNORE`、反引号列名、`COUNT(*)` 表达式列名、多表 JOIN）。
 * 与其把每条 SQL 改写成别的方言，这里保留 D1 的调用形状，把 `prepare/bind/all/
 * first/run` 映射到 Cloudflare 的 D1 REST 接口，这样业务代码零改动。
 *
 * 实际请求：
 *   POST https://api.cloudflare.com/client/v4/accounts/{accountId}/d1/database/{databaseId}/query
 *   { "sql": "...", "params": [...] }
 *
 * 响应中的 `result` 是数组，单条语句取 `result[0]`，其 `results` 字段即行数据。
 */

const DEFAULT_API_BASE = "https://api.cloudflare.com/client/v4";

export interface D1HttpConfig {
  accountId?: string;
  databaseId?: string;
  apiToken?: string;
  /** 仅用于测试或自建代理，默认走 Cloudflare 官方地址。 */
  apiBase?: string;
}

interface CloudflareApiError {
  code?: number;
  message?: string;
}

interface CloudflareQueryResponse {
  success?: boolean;
  errors?: CloudflareApiError[];
  messages?: unknown[];
  result?: Array<{
    results?: Array<Record<string, unknown>>;
    success?: boolean;
    meta?: D1Meta;
  }>;
}

export class D1HttpError extends Error {
  readonly sql: string;

  constructor(message: string, sql: string) {
    super(message);
    this.name = "D1HttpError";
    this.sql = sql;
  }
}

/**
 * SQLite 只接受 null / number / string / blob。HTTP 接口传的是 JSON，
 * 所以布尔与 undefined 需要先归一化，否则会被当成非法参数。
 */
function normalizeParam(value: unknown): unknown {
  if (typeof value === "boolean") return value ? 1 : 0;
  if (value === undefined) return null;
  return value;
}

class D1HttpStatement implements D1PreparedStatement {
  constructor(
    private readonly client: D1HttpClient,
    readonly sql: string,
    readonly params: unknown[]
  ) {}

  bind(...values: unknown[]): D1PreparedStatement {
    return new D1HttpStatement(this.client, this.sql, [
      ...this.params,
      ...values.map(normalizeParam),
    ]);
  }

  async all<T = Record<string, unknown>>(): Promise<D1Result<T>> {
    return this.client.execute<T>(this.sql, this.params);
  }

  async run<T = Record<string, unknown>>(): Promise<D1Result<T>> {
    return this.client.execute<T>(this.sql, this.params);
  }

  async first<T = Record<string, unknown>>(colName?: string): Promise<T | null> {
    const result = await this.client.execute<Record<string, unknown>>(
      this.sql,
      this.params
    );
    const row = result.results[0];
    if (!row) return null;
    if (colName) return (row[colName] as T) ?? null;
    return row as T;
  }

  async raw<T = unknown[]>(): Promise<T[]> {
    throw new Error(
      "D1 HTTP 适配器不支持 raw()：HTTP 接口不返回列顺序信息。本项目未使用该 API。"
    );
  }
}

class D1HttpClient implements D1Database {
  private readonly apiBase: string;

  constructor(private readonly config: D1HttpConfig) {
    this.apiBase = (config.apiBase || DEFAULT_API_BASE).replace(/\/+$/, "");
  }

  prepare(sql: string): D1PreparedStatement {
    return new D1HttpStatement(this, sql, []);
  }

  private assertConfigured(sql: string): void {
    const missing: string[] = [];
    if (!this.config.accountId) missing.push("CF_ACCOUNT_ID");
    if (!this.config.databaseId) missing.push("CF_D1_DATABASE_ID");
    if (!this.config.apiToken) missing.push("CF_API_TOKEN");
    if (missing.length > 0) {
      throw new D1HttpError(
        `数据库未配置，缺少环境变量：${missing.join(", ")}`,
        sql
      );
    }
  }

  /** 执行单条语句，返回与 workerd D1 一致的 D1Result 形状。 */
  async execute<T = Record<string, unknown>>(
    sql: string,
    params: unknown[]
  ): Promise<D1Result<T>> {
    this.assertConfigured(sql);

    const payload = await this.post<CloudflareQueryResponse>(
      payloadOf(sql, params),
      sql
    );
    const entry = payload.result?.[0];

    if (!entry) {
      return { results: [], success: true, meta: {} };
    }

    return {
      results: (entry.results ?? []) as T[],
      success: entry.success !== false,
      meta: entry.meta ?? {},
    };
  }

  private async post<T extends CloudflareQueryResponse>(
    body: Record<string, unknown>,
    sql: string
  ): Promise<T> {
    const url =
      `${this.apiBase}/accounts/${this.config.accountId}` +
      `/d1/database/${this.config.databaseId}/query`;

    let response: Response;
    try {
      response = await fetch(url, {
        method: "POST",
        headers: {
          Authorization: `Bearer ${this.config.apiToken}`,
          "Content-Type": "application/json",
        },
        body: JSON.stringify(body),
      });
    } catch (error) {
      throw new D1HttpError(
        `请求 Cloudflare D1 失败：${(error as Error).message}`,
        sql
      );
    }

    const text = await response.text();
    let json: CloudflareQueryResponse;
    try {
      json = text ? (JSON.parse(text) as CloudflareQueryResponse) : {};
    } catch {
      throw new D1HttpError(
        `Cloudflare D1 返回了非 JSON 响应（HTTP ${response.status}）：${text.slice(0, 200)}`,
        sql
      );
    }

    const apiErrors = json.errors ?? [];
    if (!response.ok || json.success === false || apiErrors.length > 0) {
      const detail =
        apiErrors
          .map((item) => `[${item.code ?? ""}] ${item.message ?? String(item)}`)
          .join("; ") || `HTTP ${response.status}`;
      throw new D1HttpError(`Cloudflare D1 查询失败：${detail}`, sql);
    }

    return json as T;
  }
}

function payloadOf(sql: string, params: unknown[]) {
  return { sql, params: params.map(normalizeParam) };
}

export function createD1HttpClient(config: D1HttpConfig): D1Database {
  return new D1HttpClient(config);
}
