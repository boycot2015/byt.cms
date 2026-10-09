import { apiDocs } from "./apiDocs";

/**
 * 渲染 Swagger UI 文档页。
 *
 * 抽成独立模块是因为这个页面有两个消费方：
 * 1. `/index.html` 路由（src/routes/docs.ts）—— 由云函数返回
 * 2. 构建时生成项目根目录的静态 index.html —— 见 scripts/build.mjs
 *
 * EdgeOne 的静态资源层会优先接管 `/`（不会转发给云函数），所以首页必须以
 * 静态文件形式存在，两边共用同一份模板以免内容漂移。
 */
export function renderDocsPage(): string {
  const specJson = JSON.stringify(apiDocs);

  return [
    "<!DOCTYPE html>",
    '<html lang="zh-CN">',
    "<head>",
    '  <meta charset="UTF-8">',
    '  <meta name="viewport" content="width=device-width, initial-scale=1.0">',
    "  <title>byt CMS API 文档</title>",
    '  <link rel="stylesheet" type="text/css" href="https://unpkg.com/swagger-ui-dist@4.15.5/swagger-ui.css" />',
    "  <style>",
    "    body {",
    "      margin: 0;",
    "      padding: 0;",
    "      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;",
    "    }",
    "    .swagger-ui .topbar {",
    "      background-color: #343a40;",
    "    }",
    "    .swagger-ui .topbar .topbar-wrapper .link {",
    "      color: #ffffff;",
    "    }",
    "  </style>",
    "</head>",
    "<body>",
    '  <div id="swagger-ui"></div>',
    '  <script src="https://unpkg.com/swagger-ui-dist@4.15.5/swagger-ui-bundle.js"></script>',
    '  <script src="https://unpkg.com/swagger-ui-dist@4.15.5/swagger-ui-standalone-preset.js"></script>',
    "  <script>",
    "    // API 文档配置",
    "    const apiDocs = " + specJson + ";",
    "",
    "    window.onload = function () {",
    "      SwaggerUIBundle({",
    "        spec: apiDocs,",
    "        dom_id: '#swagger-ui',",
    "        deepLinking: true,",
    "        presets: [SwaggerUIBundle.presets.apis, SwaggerUIStandalonePreset],",
    "        plugins: [SwaggerUIBundle.plugins.DownloadUrl],",
    '        layout: "StandaloneLayout"',
    "      });",
    "    };",
    "  </script>",
    "</body>",
    "</html>",
    "",
  ].join("\n");
}

/** `/api/docs` 端点返回的 Swagger 描述对象。 */
export function getApiDocs() {
  return apiDocs;
}
