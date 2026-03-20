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
    
    // 构建查询条件
    let whereClause = "WHERE status = 'active'";

    const categories = await env.DB.prepare(
      `SELECT * FROM categories ${whereClause} ${orderByClause}`
    ).all();
    
    return new Response(JSON.stringify(categories.results), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }
  // 获取分类列表 - 分页查询
  if (path === "/api/categories/page" && request.method === "GET") {
    const sortBy = url.searchParams.get("sortBy") || "order";
    const sortOrder = url.searchParams.get("sortOrder") || "desc";
    const search = url.searchParams.get("search") || "";
    const status = url.searchParams.get("status");
    const page = url.searchParams.get("page") || "1";
    const pageSize = url.searchParams.get("pageSize") || "10";
    const offset = (parseInt(page) - 1) * parseInt(pageSize);
    
    // 构建排序语句
    let orderByClause = "ORDER BY `order` DESC, createTime DESC";
    if (sortBy === "createTime") {
      orderByClause = `ORDER BY createTime ${sortOrder.toUpperCase()}`;
    } else if (sortBy === "name") {
      orderByClause = `ORDER BY name ${sortOrder.toUpperCase()}`;
    }
    
    // 构建查询条件
    let whereClause = "WHERE 1=1";
    if (status) {
      whereClause += ` AND status = '${status}'`;
    }
    if (search) {
      whereClause += ` AND name LIKE '%${search}%'`;
    }
    const countQuery = `SELECT COUNT(*) FROM categories ${whereClause}`;
    // 获取总数量
    // console.log(countQuery, 'countQuery');
    const countResult = await env.DB.prepare(countQuery).first();
    // console.log(countResult, 'countResult');
    const total = await env.DB.prepare(
      `SELECT * FROM categories ${whereClause} ${orderByClause} LIMIT ${parseInt(pageSize)} OFFSET ${offset}`
    ).all();
    
    return new Response(JSON.stringify({ list: total.results, total: countResult?.['COUNT(*)'] || 0 }), {
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

  // 更新分类状态
  if (path.startsWith("/api/categories/") && path.endsWith("/status") && request.method === "PUT") {
    const id = path.replace("/api/categories/", "").replace("/status", "");
    const categoryId = `category:${id}`;
    const body:any = await request.json();
    const { status } = body;
    
    // 更新分类状态
    await env.DB.prepare(
      "UPDATE categories SET status = ? WHERE id = ?"
    ).bind(status, categoryId).run();
    
    return new Response(JSON.stringify({ success: true }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
      status: 200,
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
