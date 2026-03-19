// import type { Request } from 'cloudflare-workers-types';

interface Env {
  DB: D1Database;
}

export async function handleSiteConfig(request: Request, env: Env, corsHeaders: Record<string, string>) {
  const url = new URL(request.url);
  const path = url.pathname;

  // 获取网站配置
  if (path === "/api/site-config" && request.method === "GET") {
    // 获取网站配置
    const config = await env.DB.prepare(
      "SELECT * FROM site_config ORDER BY updateTime DESC LIMIT 1"
    ).first();
    
    if (config) {
      // 解析JSON字段
      config.categoryIds = JSON.parse((config.categoryIds as string) || "[]");
      config.rankingCategoryIds = JSON.parse((config.rankingCategoryIds as string) || "[]");
      config.links = JSON.parse((config.links as string) || "[]");
    }
    
    return new Response(JSON.stringify(config || {}), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  // 更新网站配置
  if (path === "/api/site-config" && request.method === "POST") {
    const body: any = await request.json();
    const { userId, logo, title, bannerCount, categoryIds, categoryCols, categoryRows, rankingCategoryIds, rankingCount, links, recommendTitle } = body;
    
    // 检查是否存在配置
    const existingConfig = await env.DB.prepare(
      "SELECT * FROM site_config ORDER BY updateTime DESC LIMIT 1"
    ).first();
    
    const now = new Date().toISOString();
    
    if (existingConfig) {
      // 更新配置
      await env.DB.prepare(`
        UPDATE site_config 
        SET userId = ?, logo = ?, title = ?, bannerCount = ?, 
            categoryIds = ?, categoryCols = ?, categoryRows = ?, 
            rankingCategoryIds = ?, rankingCount = ?, links = ?, 
            recommendTitle = ?, updateTime = ? 
        WHERE id = ?
      `).bind(
        userId, logo || "", title || "", bannerCount || 6,
        JSON.stringify(categoryIds || []), categoryCols || 4, recommendTitle || "", categoryRows || 2,
        JSON.stringify(rankingCategoryIds || []), rankingCount || 10, JSON.stringify(links || []),
        now, existingConfig.id
      ).run();
      
      return new Response(JSON.stringify({ success: true, message: "配置更新成功" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    } else {
      // 创建新配置
      const id = `config:${Date.now()}`;
      await env.DB.prepare(`
        INSERT INTO site_config (
          id, userId, logo, title, bannerCount, categoryIds, 
          categoryCols, categoryRows, rankingCategoryIds, rankingCount, 
          links, recommendTitle, createTime, updateTime
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
      `).bind(
        id, userId, logo || "", title || "", bannerCount || 6,
        JSON.stringify(categoryIds || []), categoryCols || 4, categoryRows || 2,
        JSON.stringify(rankingCategoryIds || []), rankingCount || 10, JSON.stringify(links || []),
        recommendTitle || "", now, now
      ).run();
      
      return new Response(JSON.stringify({ success: true, message: "配置创建成功" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 201,
      });
    }
  }

  return null;
}
