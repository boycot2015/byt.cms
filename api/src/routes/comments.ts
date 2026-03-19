// import type { Request } from 'cloudflare-workers-types';

interface Env {
  DB: D1Database;
}

export async function handleComments(request: Request, env: Env, corsHeaders: Record<string, string>) {
  const url = new URL(request.url);
  const path = url.pathname;

  // 获取评论列表
  if (path === "/api/comments" && request.method === "GET") {
    const videoId = url.searchParams.get("videoId");
    const episodeId = url.searchParams.get("episodeId");
    const page = parseInt(url.searchParams.get("page") || "1");
    const pageSize = parseInt(url.searchParams.get("pageSize") || "20");
    const offset = (page - 1) * pageSize;
    
    // 构建查询条件
    let countQuery = "SELECT COUNT(*) as total FROM comments WHERE status = 'active' AND parentId IS NULL";
    let commentQuery = "SELECT * FROM comments WHERE status = 'active' AND parentId IS NULL ORDER BY createTime DESC LIMIT ? OFFSET ?";
    const params: any[] = [];
    
    // 如果提供了videoId，添加到查询条件中
    if (videoId) {
      countQuery = "SELECT COUNT(*) as total FROM comments WHERE videoId = ? AND status = 'active' AND parentId IS NULL";
      commentQuery = "SELECT * FROM comments WHERE videoId = ? AND status = 'active' AND parentId IS NULL ORDER BY createTime DESC LIMIT ? OFFSET ?";
      params.push(videoId);
      
      // 如果提供了episodeId，添加到查询条件中
      if (episodeId) {
        countQuery = "SELECT COUNT(*) as total FROM comments WHERE videoId = ? AND episodeId = ? AND status = 'active' AND parentId IS NULL";
        commentQuery = "SELECT * FROM comments WHERE videoId = ? AND episodeId = ? AND status = 'active' AND parentId IS NULL ORDER BY createTime DESC LIMIT ? OFFSET ?";
        params.push(episodeId);
      }
    }
    
    // 获取总数量
    const countResult = await env.DB.prepare(countQuery).bind(...params).first();
    const total = countResult?.total || 0;
    
    // 获取评论列表
    const comments = await env.DB.prepare(commentQuery).bind(...params, pageSize, offset).all();
    
    // 为每个评论获取回复
    const commentsWithReplies = await Promise.all(comments.results.map(async (comment: any) => {
      const replies = await env.DB.prepare(
        "SELECT * FROM comments WHERE parentId = ? AND status = 'active' ORDER BY createTime ASC"
      ).bind(comment.id).all();
      
      comment.replies = replies.results;
      return comment;
    }));
    
    return new Response(JSON.stringify({
      list: commentsWithReplies,
      total,
      page,
      pageSize
    }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  // 创建评论
  if (path === "/api/comments" && request.method === "POST") {
    const body: any = await request.json();
    const { videoId, episodeId, userId, content, parentId, currentTime } = body;
    
    if (!videoId || !userId || !content) {
      return new Response(JSON.stringify({ error: "缺少必要参数" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 400,
      });
    }
    
    const id = `comment:${Date.now()}_${Math.random().toString(36).slice(2)}`;
    const now = new Date().toISOString();
    
    await env.DB.prepare(`
      INSERT INTO comments (
        id, videoId, episodeId, userId, content, parentId, 
        likes, status, createTime, updateTime
      ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    `).bind(
      id, videoId, episodeId || null, userId, content, parentId || null,
      0, "active", now, now
    ).run();
    
    // 获取创建的评论
    const comment = await env.DB.prepare("SELECT * FROM comments WHERE id = ?").bind(id).first();
    
    return new Response(JSON.stringify(comment), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
      status: 201,
    });
  }

  // 点赞评论
  if (path.startsWith("/api/comments/") && path.endsWith("/like") && request.method === "POST") {
    const commentId = path.replace("/api/comments/", "").replace("/like", "");
    
    // 检查评论是否存在
    const comment = await env.DB.prepare("SELECT * FROM comments WHERE id = ?").bind(commentId).first();
    
    if (!comment) {
      return new Response(JSON.stringify({ error: "评论不存在" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 404,
      });
    }
    
    // 更新点赞数
    const newLikes = ((comment.likes as number) || 0) + 1;
    await env.DB.prepare(
      "UPDATE comments SET likes = ?, updateTime = ? WHERE id = ?"
    ).bind(newLikes, new Date().toISOString(), commentId).run();
    
    return new Response(JSON.stringify({ success: true, likes: newLikes }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  // 删除评论
  if (path.startsWith("/api/comments/") && request.method === "DELETE") {
    const commentId = path.replace("/api/comments/", "");
    
    // 检查评论是否存在
    const comment = await env.DB.prepare("SELECT * FROM comments WHERE id = ?").bind(commentId).first();
    
    if (!comment) {
      return new Response(JSON.stringify({ error: "评论不存在" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 404,
      });
    }
    
    // 软删除评论
    await env.DB.prepare(
      "UPDATE comments SET status = 'deleted', updateTime = ? WHERE id = ?"
    ).bind(new Date().toISOString(), commentId).run();
    
    return new Response(JSON.stringify({ success: true }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  return null;
}
