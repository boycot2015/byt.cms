// import type { Request } from 'cloudflare-workers-types';
import { setTag } from '../services/dbService';

interface Env {
  DB: D1Database;
}

export async function handleTags(request: Request, env: Env, corsHeaders: Record<string, string>) {
  const url = new URL(request.url);
  const path = url.pathname;
    // 获取标签列表
  if (path === "/api/tags/page" && request.method === "GET") {
    const page = parseInt(url.searchParams.get("page") || "1");
    const pageSize = parseInt(url.searchParams.get("pageSize") || "10");
    const search = url.searchParams.get("search") || "";
    
    let query = "SELECT * FROM tags";
    let countQuery = "SELECT COUNT(*) FROM tags";
    const params: any[] = [];
    
    // WHERE 子句
    if (search) {
      query += " WHERE name LIKE ?";
      countQuery += " WHERE name LIKE ?";
      params.push(`%${search}%`);
    }
    
    // 排序和分页
    query += " ORDER BY createTime DESC LIMIT ? OFFSET ?";
    params.push(pageSize, (page - 1) * pageSize);
    
    // 执行查询
    const tags = await env.DB.prepare(query).bind(...params).all();
    const countResult = await env.DB.prepare(countQuery).bind(...params.slice(0, -2)).first();
    
    return new Response(JSON.stringify({ list: tags.results, total: countResult?.['COUNT(*)'] || 0 }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }
  // 获取标签列表
  if (path === "/api/tags" && request.method === "GET") {
    const tags = await env.DB.prepare(
      "SELECT * FROM tags ORDER BY createTime DESC"
    ).all();
    
    return new Response(JSON.stringify(tags.results), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  // 创建标签
  if (path === "/api/tags" && request.method === "POST") {
    const body = await request.json();
    const tag = await setTag(body, env);
    
    return new Response(JSON.stringify(tag), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
      status: 201,
    });
  }

  // 删除标签
  if (path.startsWith("/api/tags/") && request.method === "DELETE") {
    const id = path.replace("/api/tags/", "");
    const tagId = `tag:${id}`;
    
    // 删除标签
    await env.DB.prepare(
      "DELETE FROM tags WHERE id = ?"
    ).bind(tagId).run();
    
    return new Response(JSON.stringify({ success: true }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
      status: 200,
    });
  }

  return null;
}
