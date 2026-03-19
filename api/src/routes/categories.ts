// import type { Request } from 'cloudflare-workers-types';
import { setCategory } from '../services/dbService';

interface Env {
  DB: D1Database;
}

export async function handleCategories(request: Request, env: Env, corsHeaders: Record<string, string>) {
  const url = new URL(request.url);
  const path = url.pathname;

  // 获取分类列表
  if (path === "/api/categories" && request.method === "GET") {
    const sortBy = url.searchParams.get("sortBy") || "order";
    const sortOrder = url.searchParams.get("sortOrder") || "desc";
    
    // 构建排序语句
    let orderByClause = "ORDER BY `order` DESC, createTime DESC";
    if (sortBy === "createTime") {
      orderByClause = `ORDER BY createTime ${sortOrder.toUpperCase()}`;
    } else if (sortBy === "name") {
      orderByClause = `ORDER BY name ${sortOrder.toUpperCase()}`;
    }
    
    const categories = await env.DB.prepare(
      `SELECT * FROM categories ${orderByClause}`
    ).all();
    
    return new Response(JSON.stringify(categories.results), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  // 创建分类
  if (path === "/api/categories" && request.method === "POST") {
    const body = await request.json();
    const category = await setCategory(body, env);
    
    return new Response(JSON.stringify(category), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
      status: 201,
    });
  }

  // 删除分类
  if (path.startsWith("/api/categories/") && request.method === "DELETE") {
    const id = path.replace("/api/categories/", "");
    const categoryId = `category:${id}`;
    
    // 删除分类
    await env.DB.prepare(
      "DELETE FROM categories WHERE id = ?"
    ).bind(categoryId).run();
    
    return new Response(JSON.stringify({ success: true }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
      status: 200,
    });
  }

  return null;
}
