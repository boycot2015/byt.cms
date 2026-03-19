// import type { Request } from 'cloudflare-workers-types';
import { setTag } from '../services/dbService';

interface Env {
  DB: D1Database;
}

export async function handleTags(request: Request, env: Env, corsHeaders: Record<string, string>) {
  const url = new URL(request.url);
  const path = url.pathname;

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
