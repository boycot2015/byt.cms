// import type { Request } from 'cloudflare-workers-types';
import { handleArticles } from './routes/articles';
import { handleCategories } from './routes/categories';
import { handleTags } from './routes/tags';
import { handleVideos } from './routes/videos';
import { handleComments } from './routes/comments';
import { handleUsers } from './routes/users';
import { handleSiteConfig } from './routes/siteConfig';
import { handleUpload } from './routes/upload';
import { handleVideoSources } from './routes/videoSources';
import { apiDocs } from './utils/apiDocs';
import { isTimeToFetch } from './services/videoSourceService';
import { fetchVideoRecommend, setVideoList } from './services/dbService';

export default {
  async fetch(
    request: Request,
    env: {
      DB: D1Database;
      UPLOAD_BUCKET: R2Bucket;
      QUARK_API_KEY: string;
      ALIYUN_REFRESH_TOKEN: string;
      ALIYUN_CLIENT_ID: string;
      ALIYUN_CLIENT_SECRET: string;
      JIANGUOYUN_USERNAME: string;
      JIANGUOYUN_APP_PASSWORD: string;
    },
    ctx: ExecutionContext
  ): Promise<Response> {
    const corsHeaders = {
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, OPTIONS",
      "Access-Control-Allow-Headers": "Content-Type, Authorization",
    };

    if (request.method === "OPTIONS") {
      return new Response(null, { headers: corsHeaders });
    }

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

    // 路由处理
    const routeHandlers = [
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
  },
  async scheduled(
    event: ScheduledEvent,
    env: {
      DB: D1Database; // 替换 KV 为 D1
      ALIYUN_REFRESH_TOKEN: string;
      ALIYUN_CLIENT_ID: string;
      ALIYUN_CLIENT_SECRET: string;
      JIANGUOYUN_USERNAME: string;
      JIANGUOYUN_APP_PASSWORD: string;
      QUARK_API_KEY: string;
    },
    ctx: ExecutionContext
  ): Promise<void> {
    console.log("定时调度任务执行:", new Date().toLocaleString());
    
    // 获取所有视频源配置
    const sources:any = await env.DB.prepare("SELECT * FROM video_sources WHERE enabled = 1").all();
    
    if (sources.results.length === 0) {
      console.log("无启用的视频源配置");
    } else {
      for (const source of sources.results) {
        // 解析JSON字段
        source.tags = JSON.parse(source.tags || "[]");
        
        // 检查是否到抓取时间
        if (!isTimeToFetch(source)) {
          console.log(`源[${source.name}]未到抓取时间，跳过`);
          continue;
        }
        
        try {
          await setVideoList(source, env);
          console.log(`源[${source.name}]抓取完成`);
        } catch (error) {
          console.error(`源[${source.name}]抓取失败:`, error);
          continue;
        }
      }
    }
    
    // 调用推荐API更新推荐数据
    await fetchVideoRecommend(env);
  },
};
