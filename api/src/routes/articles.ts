// import type { Request } from 'cloudflare-workers-types';

interface Env {
  DB: D1Database;
}

export async function handleArticles(request: Request, env: Env, corsHeaders: Record<string, string>) {
  const url = new URL(request.url);
  const path = url.pathname;

  // 获取文章列表
  if (path === "/api/articles" && request.method === "GET") {
    let categoryId = url.searchParams.get("categoryId");
    let tagId = url.searchParams.get("tagId");
    const search = url.searchParams.get("search");
    const page = parseInt(url.searchParams.get("page") || "1");
    const pageSize = parseInt(url.searchParams.get("pageSize") || "10");
    const offset = (page - 1) * pageSize;
    
    // 构建查询条件
    let query = "SELECT DISTINCT a.* FROM articles a";
    let countQuery = "SELECT COUNT(DISTINCT a.id) as total FROM articles a";
    const params: any[] = [];
    
    // 标签筛选
    if (tagId) {
      query += " JOIN article_tags at ON a.id = at.articleId";
      countQuery += " JOIN article_tags at ON a.id = at.articleId";
    }
    
    //  WHERE 子句
    query += " WHERE 1=1";
    countQuery += " WHERE 1=1";
    
    if (categoryId) {
      query += " AND a.categoryId = ?";
      countQuery += " AND a.categoryId = ?";
      params.push(categoryId);
    }
    
    if (tagId) {
      query += " AND at.tagId = ?";
      countQuery += " AND at.tagId = ?";
      params.push(tagId);
    }
    
    if (search) {
      query += " AND a.title LIKE ?";
      countQuery += " AND a.title LIKE ?";
      params.push(`%${search}%`);
    }
    
    // 获取总数量
    const countResult = await env.DB.prepare(countQuery).bind(...params).first();
    const total = countResult?.total || 0;
    
    // 基础文章查询（带分页）
    let articles = await env.DB.prepare(query + " ORDER BY a.createdAt DESC LIMIT ? OFFSET ?").bind(...params, pageSize, offset).all();
    
    let articlesWithDetails = await Promise.all(articles.results.map(async (article: any) => {
      // 获取分类信息
      if (article.categoryId) {
        const category = await env.DB.prepare(
          "SELECT * FROM categories WHERE id = ?"
        ).bind(article.categoryId).first();
        article.category = category || {};
      }
      
      // 获取标签信息
      if (article.id) {
        const tagRelations = await env.DB.prepare(`
          SELECT t.* FROM article_tags at
          JOIN tags t ON at.tagId = t.id
          WHERE at.articleId = ?
        `).bind(article.id).all();
        
        article.tags = tagRelations.results;
      }
      
      return article;
    }));
    
    return new Response(JSON.stringify({
      list: articlesWithDetails,
      total,
      page,
      pageSize
    }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  // 创建文章
  if (path === "/api/articles" && request.method === "PUT") {
    const body: any = await request.json();
    const id = `article:${Date.now()}`;
    const article = {
      id,
      title: body.title || "",
      categoryId: body.categoryId || "",
      content: body.content || "",
      createdAt: new Date().toISOString(),
      updatedAt: new Date().toISOString(),
    };
    
    // 插入文章
    await env.DB.prepare(`
      INSERT INTO articles (id, title, categoryId, content, createdAt, updatedAt)
      VALUES (?, ?, ?, ?, ?, ?)
    `).bind(
      article.id, article.title, article.categoryId, article.content,
      article.createdAt, article.updatedAt
    ).run();
    
    // 处理标签关联
    if (body.tagIds && Array.isArray(body.tagIds)) {
      for (const tagId of body.tagIds) {
        await env.DB.prepare(
          "INSERT OR IGNORE INTO article_tags (articleId, tagId) VALUES (?, ?)"
        ).bind(article.id, tagId).run();
      }
    }
    
    return new Response(JSON.stringify(article), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
      status: 201,
    });
  }

  // 删除文章
  if (path.startsWith("/api/articles/") && request.method === "DELETE") {
    const id = path.replace("/api/articles/", "");
    const articleId = `article:${id}`;
    
    // 删除文章标签关联
    await env.DB.prepare(
      "DELETE FROM article_tags WHERE articleId = ?"
    ).bind(articleId).run();
    
    // 删除文章
    await env.DB.prepare(
      "DELETE FROM articles WHERE id = ?"
    ).bind(articleId).run();
    
    return new Response(JSON.stringify({ success: true }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  // 更新文章
  if (path.startsWith("/api/articles/") && request.method === "POST") {
    const id = path.replace("/api/articles/", "");
    const articleId = `article:${id}`;
    const body: any = await request.json();
    
    // 检查文章是否存在
    const oldArticle = await env.DB.prepare(
      "SELECT * FROM articles WHERE id = ?"
    ).bind(articleId).first();
    
    if (!oldArticle) {
      return new Response(JSON.stringify({ error: "文章不存在" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 404,
      });
    }
    
    // 更新文章
    const newArticle = {
      ...oldArticle,
      title: body.title || oldArticle.title,
      categoryId: body.categoryId || oldArticle.categoryId,
      content: body.content || oldArticle.content,
      updatedAt: new Date().toISOString(),
    };
    
    await env.DB.prepare(`
      UPDATE articles 
      SET title = ?, categoryId = ?, content = ?, updatedAt = ?
      WHERE id = ?
    `).bind(
      newArticle.title, newArticle.categoryId, newArticle.content,
      newArticle.updatedAt, articleId
    ).run();
    
    // 更新标签关联
    if (body.tagIds && Array.isArray(body.tagIds)) {
      // 删除原有标签
      await env.DB.prepare(
        "DELETE FROM article_tags WHERE articleId = ?"
      ).bind(articleId).run();
      
      // 添加新标签
      for (const tagId of body.tagIds) {
        await env.DB.prepare(
          "INSERT OR IGNORE INTO article_tags (articleId, tagId) VALUES (?, ?)"
        ).bind(articleId, tagId).run();
      }
    }
    
    return new Response(JSON.stringify(newArticle), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  return null;
}
