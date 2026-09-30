// import type { Request } from 'cloudflare-workers-types';
import { sources as sourcesLocal } from '../data/sources';
import { setVideoList, fetchVideoRecommend } from '../services/dbService';
import { fetchCmsVideo } from '../services/videoSourceService';
import { normalizeCmsUrl } from '../utils/index';

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
    const rows = sources.results.length > 0
      ? sources.results
      : Object.values(sourcesLocal).map((s: any) => ({
          id: `local:${s.type}`,
          ...s,
          enabled: s.enabled !== false,
          tags: JSON.stringify(s.tags || []),
        }));
    
    const parsedSources = rows.map((source: any) => {
      try {
        source.tags = JSON.parse(source.tags || "[]");
      } catch {
        source.tags = [];
      }
      const categoryNum = parseInt(source.category, 10);
      source.category = Number.isNaN(categoryNum) ? source.category : categoryNum;
      return source;
    });
    return new Response(JSON.stringify(parsedSources), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }
  // 探测 CMS 视频源 path，返回第一条视频的 source 值
  if (path === "/api/video-source-probe" && request.method === "GET") {
    const rawPath = url.searchParams.get("path");
    if (!rawPath) {
      return new Response(JSON.stringify({ error: "path 不能为空" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 400,
      });
    }
    try {
      const source: any = { path: rawPath, type: "custom" };
      const { list, categories } = await fetchCmsVideo(source, env);
      const first = list?.[0] || null;
      return new Response(JSON.stringify({
        success: true,
        source: first?.source || "",
        categories,
        sample: first ? {
          title: first.title,
          category: first.category,
        } : null,
        total: list?.length || 0,
      }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    } catch (error: any) {
      return new Response(JSON.stringify({ error: error?.message || "探测失败" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 500,
      });
    }
  }

  // 手动抓取视频源数据
  if (path.startsWith("/api/video-source-data/") && request.method === "GET") {
    const type = path.replace("/api/video-source-data/", "");
    const action = url.searchParams.get("action");
    const cid = url.searchParams.get("cid");
    const queryPath = url.searchParams.get("path");
    
    const dbResults: any = await env.DB.prepare(
      "SELECT * FROM video_sources WHERE type = ?"
    ).bind(type).all();
    
    const sourceFromDb = dbResults.results.find((s: any) => s.type === type);
    const localFallback = sourcesLocal[type];
    
    let source: any;
    if (queryPath) {
      source = {
        ...(sourceFromDb || localFallback || { type, name: type }),
        path: queryPath,
      };
    } else if (sourceFromDb) {
      try {
        sourceFromDb.tags = JSON.parse(sourceFromDb.tags || "[]");
      } catch {
        sourceFromDb.tags = [];
      }
      source = sourceFromDb;
    } else if (localFallback) {
      source = { ...localFallback, action: "put" };
    } else {
      return new Response(JSON.stringify({ error: `视频源类型不存在: ${type}` }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 404
      });
    }

    if (!source.path) {
      return new Response(JSON.stringify({ error: `视频源[${source.name || type}] path 未配置` }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 400
      });
    }

    source.path = normalizeCmsUrl(source.path, {
      ac: source.path.includes('ac=') ? undefined : 'list',
      t: cid || undefined,
    });
    
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