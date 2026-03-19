// import type { Request } from 'cloudflare-workers-types';
import { sources as sourcesLocal } from '../data/sources';
import { setVideoList, fetchVideoRecommend } from '../services/dbService';

interface Env {
  DB: D1Database;
  QUARK_API_KEY: string;
  ALIYUN_REFRESH_TOKEN: string;
  ALIYUN_CLIENT_ID: string;
  ALIYUN_CLIENT_SECRET: string;
  JIANGUOYUN_USERNAME: string;
  JIANGUOYUN_APP_PASSWORD: string;
}

export async function handleVideoSources(request: Request, env: Env, corsHeaders: Record<string, string>) {
  const url = new URL(request.url);
  const path = url.pathname;

  // 手动抓取视频源
  if (path.startsWith("/api/video-fetch-sources-data/") && request.method === "GET") {
    const sourceName = path.replace("/api/video-fetch-sources-data/", "");
    const source = sourcesLocal.find((s: { name: string }) => s.name === sourceName);
    
    if (!source) {
      return new Response(JSON.stringify({ error: "视频源不存在" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 404,
      });
    }
    
    try {
      const data = await setVideoList(source, env);
      return new Response(JSON.stringify({ success: true, data }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    } catch (error) {
      console.error(`抓取视频源失败:`, error);
      return new Response(JSON.stringify({ error: "抓取视频源失败" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 500,
      });
    }
  }

  // 自动抓取视频源
  if (path === "/api/video-fetch-sources-data" && request.method === "GET") {
    try {
      const results = [];
      
      for (const source of sourcesLocal as any[]) {
        try {
          const data = await setVideoList(source, env);
          results.push({ source: source.name, success: true, data });
        } catch (error) {
          console.error(`抓取视频源 ${source.name} 失败:`, error);
          results.push({ source: source.name, success: false, error: (error as Error).message });
        }
      }
      
      return new Response(JSON.stringify({ success: true, results }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    } catch (error) {
      console.error(`自动抓取视频源失败:`, error);
      return new Response(JSON.stringify({ error: "自动抓取视频源失败" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 500,
      });
    }
  }

  // 刷新推荐视频
  if (path === "/api/video-fetch-recommend" && request.method === "GET") {
    try {
      const data = await fetchVideoRecommend(env);
      return new Response(JSON.stringify({ success: true, data }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    } catch (error) {
      console.error(`刷新推荐视频失败:`, error);
      return new Response(JSON.stringify({ error: "刷新推荐视频失败" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 500,
      });
    }
  }

  return null;
}
