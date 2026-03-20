import { apiDocs } from "../utils/apiDocs";
interface Env {
  DB: D1Database;
}
export async function handleDocs(request: Request, env: Env, corsHeaders: Record<string, string>) {
    const url = new URL(request.url);
    const path = url.pathname;
      // 首页 - API文档
      if (path === "/" && request.method === "GET") {
        return new Response(`
          <!DOCTYPE html>
          <html lang="zh-CN">
          <head>
            <meta charset="UTF-8">
            <title>Cloudflare Workers CMS API 文档</title>
            <link rel="stylesheet" type="text/css" href="https://unpkg.com/swagger-ui-dist@4.15.5/swagger-ui.css" />
            <style>
              body {
                margin: 0;
                padding: 0;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
              }
              .swagger-ui .topbar {
                background-color: #343a40;
              }
              .swagger-ui .topbar .topbar-wrapper .link {
                color: #ffffff;
              }
            </style>
          </head>
          <body>
            <div id="swagger-ui"></div>
            <script src="https://unpkg.com/swagger-ui-dist@4.15.5/swagger-ui-bundle.js"></script>
            <script src="https://unpkg.com/swagger-ui-dist@4.15.5/swagger-ui-standalone-preset.js"></script>
            <script>
              // API文档配置
              const apiDocs = ${JSON.stringify(apiDocs)};
              
              window.onload = function() {
                SwaggerUIBundle({
                  spec: apiDocs,
                  dom_id: '#swagger-ui',
                  deepLinking: true,
                  presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                  ],
                  plugins: [
                    SwaggerUIBundle.plugins.DownloadUrl
                  ],
                  layout: "StandaloneLayout"
                })
              }
            </script>
          </body>
          </html>
        `, {
          headers: { ...corsHeaders, "Content-Type": "text/html;charset=utf-8" },
        });
      }
  
      // API文档JSON
      if (path === "/api/docs" && request.method === "GET") {
        return new Response(JSON.stringify(apiDocs), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
        });
      }
}