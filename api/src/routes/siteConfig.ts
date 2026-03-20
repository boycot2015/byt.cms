// import type { Request } from 'cloudflare-workers-types';

interface Env {
  DB: D1Database;
}

export async function handleSiteConfig(request: Request, env: Env, corsHeaders: Record<string, string>) {
  const url = new URL(request.url);
  const path = url.pathname;

  // 网站配置接口
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

  if (path === "/api/site-config" && request.method === "POST") {
    // 更新网站配置
    const body:any = await request.json();
    const { userId, logo, title, bannerCount, categoryIds, categoryCols, recommendTitle, categoryRows, rankingCategoryIds, rankingCount, links } = body;
    
    // 检查用户是否存在且为管理员
    if (!userId) {
      return new Response(JSON.stringify({ error: "用户ID不能为空" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 400,
      });
    }
    
    const user = await env.DB.prepare(
      "SELECT * FROM users WHERE id = ?"
    ).bind(userId).first();
    
    if (!user) {
      return new Response(JSON.stringify({ error: "用户不存在" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 404,
      });
    }
    
    if (user.role !== "admin") {
      return new Response(JSON.stringify({ error: "只有管理员可以配置网站" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 403,
      });
    }
    
    // 检查是否已有配置
    const existingConfig = await env.DB.prepare(
      "SELECT * FROM site_config ORDER BY updateTime DESC LIMIT 1"
    ).first();
    
    const now = new Date().toISOString();
    
    if (existingConfig) {
      // 更新现有配置
      await env.DB.prepare(`
        UPDATE site_config SET 
          userId = ?, logo = ?, title = ?, bannerCount = ?, 
          categoryIds = ?, categoryCols = ?, recommendTitle = ?, categoryRows = ?, 
          rankingCategoryIds = ?, rankingCount = ?, links = ?, 
          updateTime = ?
        WHERE id = ?
      `).bind(
        userId, logo || "", title || "", bannerCount || 6,
        JSON.stringify(categoryIds || []), categoryCols || 4, recommendTitle || '', categoryRows || 2,
        JSON.stringify(rankingCategoryIds || []), rankingCount || 10, JSON.stringify(links || []),
        now, existingConfig.id
      ).run();
      
      return new Response(JSON.stringify({ success: true, message: "网站配置更新成功" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    } else {
      // 创建新配置
      const id = `config:${Date.now()}_${Math.random().toString(36).slice(2)}`;
      await env.DB.prepare(`
        INSERT INTO site_config (
          id, userId, logo, title, bannerCount, categoryIds, 
          categoryCols, recommendTitle, categoryRows, rankingCategoryIds, rankingCount, 
          links, createTime, updateTime
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
      `).bind(
        id, userId, logo || "", title || "", bannerCount || 6,
        JSON.stringify(categoryIds || []), categoryCols || 4, recommendTitle || '', categoryRows || 2,
        JSON.stringify(rankingCategoryIds || []), rankingCount || 10, JSON.stringify(links || []),
        now, now
      ).run();
      
      return new Response(JSON.stringify({ success: true, message: "网站配置创建成功" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }
  }

  return null;
}
