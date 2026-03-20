// import type { Request } from 'cloudflare-workers-types';

interface Env {
  DB: D1Database;
}

export async function handleVideos(request: Request, env: Env, corsHeaders: Record<string, string>) {
  const url = new URL(request.url);
  const path = url.pathname;

  // 获取视频列表
  if (path === "/api/videos" && request.method === "GET") {
    const id = url.searchParams.get("id");
    const category = url.searchParams.get("category");
    const tag = url.searchParams.get("tag");
    const source = url.searchParams.get("source");
    const search = url.searchParams.get("search");
    const recommended = url.searchParams.get("recommended");
    const page = parseInt(url.searchParams.get("page") || "1");
    const pageSize = parseInt(url.searchParams.get("pageSize") || "10");
    const offset = (page - 1) * pageSize;
    
    // 如果提供了id参数，直接根据id查询单个视频
    if (id) {
      const videoId = id.startsWith("video:") ? id : `video:${id}`;
      const video = await env.DB.prepare("SELECT * FROM videos WHERE id = ?").bind(videoId).first();
      
      if (!video) {
        return new Response(JSON.stringify({ error: "视频不存在" }), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
          status: 404,
        });
      }
      
      // 获取标签
      const tagRelations = await env.DB.prepare(`
        SELECT t.* FROM video_tags vt
        JOIN tags t ON vt.tagId = t.id
        WHERE vt.videoId = ?
      `).bind(video.id).all();
      
      video.tags = tagRelations.results;
      
      // 获取视频来源
      const sources = await env.DB.prepare(`
        SELECT * FROM video_sources_mapping WHERE videoId = ?
      `).bind(video.id).all();
      
      // 解析来源的JSON字段
      video.sources = sources.results.map((source: any) => {
        source.urls = JSON.parse(source.urls || "[]");
        return source;
      });
      
      return new Response(JSON.stringify(video), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }
    
    // 构建查询条件
    let query = "SELECT DISTINCT v.* FROM videos v JOIN categories c ON v.categoryId = c.id";
    let countQuery = "SELECT COUNT(DISTINCT v.id) as total FROM videos v JOIN categories c ON v.categoryId = c.id";
    const params: any[] = [];
    
    // 标签筛选
    if (tag) {
      query += " JOIN video_tags vt ON v.id = vt.videoId";
      countQuery += " JOIN video_tags vt ON v.id = vt.videoId";
    }
    
    // 来源筛选
    if (source) {
      query += " JOIN video_sources_mapping vsm ON v.id = vsm.videoId";
      countQuery += " JOIN video_sources_mapping vsm ON v.id = vsm.videoId";
    }
    
    //  WHERE 子句
    query += " WHERE c.status = 'active'";
    countQuery += " WHERE c.status = 'active'";
    
    if (category) {
      query += " AND v.categoryId = ?";
      countQuery += " AND v.categoryId = ?";
      params.push(category);
    }
    
    if (tag) {
      query += " AND vt.tagId = ?";
      countQuery += " AND vt.tagId = ?";
      params.push(tag);
    }
    
    if (source) {
      query += " AND vsm.source = ?";
      countQuery += " AND vsm.source = ?";
      params.push(source);
    }
    
    if (search) {
      query += " AND v.title LIKE ?";
      countQuery += " AND v.title LIKE ?";
      params.push(`%${search}%`);
    }
    
    if (recommended !== null) {
      const isRecommended = recommended === "true";
      query += " AND v.recommended = ?";
      countQuery += " AND v.recommended = ?";
      params.push(isRecommended);
    }
    
    // 获取总数量
    const countResult = await env.DB.prepare(countQuery).bind(...params).first();
    const total = countResult?.total || 0;
    
    // 基础视频查询（带分页）
    let videos:any = await env.DB.prepare(query + " ORDER BY v.updateTime DESC LIMIT ? OFFSET ?").bind(...params, pageSize, offset).all();
    videos = videos.results;
    
    // 补充标签和来源信息
    const videosWithDetails = await Promise.all(videos.map(async (video: any) => {
      // 解析JSON字段
      video.actors = JSON.parse(video.actors || "[]");
      
      // 获取标签
      const tagRelations = await env.DB.prepare(`
        SELECT t.* FROM video_tags vt
        JOIN tags t ON vt.tagId = t.id
        WHERE vt.videoId = ?
      `).bind(video.id).all();
      
      video.tags = tagRelations.results;
      
      // 获取视频来源
      const sources = await env.DB.prepare(`
        SELECT * FROM video_sources_mapping WHERE videoId = ?
      `).bind(video.id).all();
      
      // 解析来源的JSON字段
      video.sources = sources.results.map((source: any) => {
        source.urls = JSON.parse(source.urls || "[]");
        return source;
      });
      
      return video;
    }));
    
    return new Response(JSON.stringify({
      list: videosWithDetails,
      total,
      page,
      pageSize
    }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  // 删除视频
  if (path.startsWith("/api/videos/") && request.method === "DELETE") {
    const id = path.replace("/api/videos/", "");
    const videoId = `video:${id}`;
    
    // 删除视频来源映射
    await env.DB.prepare(
      "DELETE FROM video_sources_mapping WHERE videoId = ?"
    ).bind(videoId).run();
    
    // 删除视频标签关联
    await env.DB.prepare(
      "DELETE FROM video_tags WHERE videoId = ?"
    ).bind(videoId).run();
    
    // 删除视频
    await env.DB.prepare(
      "DELETE FROM videos WHERE id = ?"
    ).bind(videoId).run();
    
    return new Response(JSON.stringify({ success: true }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  // 更新视频推荐状态
  if (path.startsWith("/api/videos/recommended/") && request.method === "POST") {
    const id = path.replace("/api/videos/recommended/", "");
    const videoId = `video:${id}`;
    const body = await request.json();
    const { recommended } = body as any;
    
    // 更新视频推荐状态
    await env.DB.prepare(
      "UPDATE videos SET recommended = ?, updateTime = ? WHERE id = ?"
    ).bind(recommended, new Date().toISOString(), videoId).run();
    
    return new Response(JSON.stringify({ success: true }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  // 获取推荐视频
  if (path === "/api/videos/recommended" && request.method === "GET") {
    // 首先查询推荐的视频（只查询启用分类的视频）
    const recommendedVideos = await env.DB.prepare(
      "SELECT v.* FROM videos v JOIN categories c ON v.categoryId = c.id WHERE v.recommended = 1 AND c.status = 'active' ORDER BY v.updateTime DESC"
    ).all();
    let videos = recommendedVideos.results;
    const maxRecommendedCount = 10;
    // 如果没有推荐数据，返回每个分类最近更新的5条数据
    if (videos.length <= maxRecommendedCount) {
      // 获取所有启用的分类
      const categories = await env.DB.prepare(
        "SELECT id, name FROM categories WHERE status = 'active'"
      ).all();
      
      const categoryList = categories.results;
      
      // 为每个分类获取最近更新的视频
      for (const category of categoryList) {
        const categoryVideos = await env.DB.prepare(
          "SELECT v.* FROM videos v WHERE v.categoryId = ? ORDER BY v.updateTime DESC LIMIT 5"
        ).bind(category.id).all();
        
        videos = [...videos, ...categoryVideos.results];
        
        // 达到最大数量后停止
        if (videos.length >= maxRecommendedCount) {
          break;
        }
      }
      
      // 去重并限制数量
      const uniqueVideos = videos.filter((video: any, index: number, self: any[]) => 
        index === self.findIndex((v: any) => v.id === video.id)
      );
      
      videos = uniqueVideos.slice(0, maxRecommendedCount);
    }
    
    // 补充标签和来源信息
    const videosWithDetails = await Promise.all(videos.map(async (video: any) => {
      // 解析JSON字段
      video.actors = JSON.parse(video.actors || "[]");
      
      // 获取标签
      const tagRelations = await env.DB.prepare(`
        SELECT t.* FROM video_tags vt
        JOIN tags t ON vt.tagId = t.id
        WHERE vt.videoId = ?
      `).bind(video.id).all();
      
      video.tags = tagRelations.results;
      
      // 获取视频来源
      const sources = await env.DB.prepare(`
        SELECT * FROM video_sources_mapping WHERE videoId = ?
      `).bind(video.id).all();
      
      // 解析来源的JSON字段
      video.sources = sources.results.map((source: any) => {
        source.urls = JSON.parse(source.urls || "[]");
        return source;
      });
      
      return video;
    }));
    
    return new Response(JSON.stringify(videosWithDetails), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  return null;
}
