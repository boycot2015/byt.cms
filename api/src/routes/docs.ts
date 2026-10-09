import { renderDocsPage, getApiDocs } from "../utils/docsPage";

interface Env {
  DB: D1Database;
}

export async function handleDocs(request: Request, env: Env, corsHeaders: Record<string, string>) {
  const url = new URL(request.url);
  const path = url.pathname;

  // API 文档页。
  // EdgeOne 的静态资源层会优先接管 `/`，不会转发给云函数，所以首页由构建时
  // 生成的静态 index.html 提供（内容出自同一个模板）；这里保留 `/index.html`
  // 作为函数侧的等价入口。
  if ((path === "/" || path === "/index.html") && request.method === "GET") {
    return new Response(renderDocsPage(), {
      headers: { ...corsHeaders, "Content-Type": "text/html;charset=utf-8" },
    });
  }

  // API 文档 JSON
  if (path === "/api/docs" && request.method === "GET") {
    return new Response(JSON.stringify(getApiDocs()), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  return null;
}
