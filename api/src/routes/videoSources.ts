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
  // 视频源配置管理
  if (path === "/api/video-sources" && request.method === "POST") {
    const body = await request.json();
    
    // 清空现有配置（或根据需求改为增量更新）
    await env.DB.prepare("DELETE FROM video_sources").run();
    
    // 插入新配置
    if (Array.isArray(body)) {
      for (const source of body) {
        const id = source.id || `source:${Date.now()}_${Math.random().toString(36).slice(2)}`;
        await env.DB.prepare(`
          INSERT INTO video_sources (
            id, name, type, cron, enabled, path, categoryId, category, tags, action
          ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        `).bind(
          id,
          source.name || "",
          source.type || "",
          source.cron || "* * * * *",
          source.enabled !== false,
          source.path || "",
          source.categoryId || "",
          source.category || "",
          JSON.stringify(source.tags || []),
          source.action || "put"
        ).run();
      }
    }
    
    return new Response(JSON.stringify({ success: true }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  if (path === "/api/video-sources" && request.method === "GET") {
    const sources = await env.DB.prepare("SELECT * FROM video_sources").all();
    
    // 解析JSON字段
    const parsedSources = sources.results.map((source: any) => {
      source.tags = JSON.parse(source.tags || "[]");
      source.category = parseInt(source.category);
      return source;
    });
    return new Response(JSON.stringify(parsedSources), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }
  // 手动抓取视频源数据
  if (path.startsWith("/api/video-source-data/") && request.method === "GET") {
    const type = path.replace("/api/video-source-data/", "");
    const action = url.searchParams.get("action");
    const cid = url.searchParams.get("cid");
    
    // 获取视频源配置
    const sources:any = await env.DB.prepare(
      "SELECT * FROM video_sources WHERE type = ?"
    ).bind(type).all();
    
    const source = sources.results.find((s: any) => s.type === type) || {
      ...sourcesLocal[type],
      "action": "put"
    };      
    if (!source) {
      return new Response(JSON.stringify({ error: "视频源不存在" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 404
      });
    }
    if (source.path) {
      // 处理路径参数
      if (source.path.includes("t=")) {
        source.path = source.path.replace(/t=([^&]*)/g, `t=${cid || ""}`);
      } else {
        source.path += `&t=${cid || ""}`;
      }
    }
    
    // console.log(source.path, 'source.path');
    
    // 抓取并存储视频数据
    const data = await setVideoList({ ...source, action }, env);
    
    return new Response(JSON.stringify({
      success: true,
      code: 200,
      count: data?.total || 0,
      page: data?.page || 1,
      data
    }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
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
