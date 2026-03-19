// import type { Request } from 'cloudflare-workers-types';

interface Env {
  DB: D1Database;
}

export async function handleUsers(request: Request, env: Env, corsHeaders: Record<string, string>) {
  const url = new URL(request.url);
  const path = url.pathname;

  // 用户登录
  if (path === "/api/users/login" && request.method === "POST") {
    const body: any = await request.json();
    const { username, password } = body;
    
    if (!username || !password) {
      return new Response(JSON.stringify({ error: "缺少用户名或密码" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 400,
      });
    }
    
    // 查找用户
    const user = await env.DB.prepare(
      "SELECT * FROM users WHERE username = ? AND password = ?"
    ).bind(username, password).first();
    
    if (!user) {
      return new Response(JSON.stringify({ success: false, error: "用户名或密码错误" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 401,
      });
    }
    
    // 生成token（这里简化处理，实际应该使用JWT等方式）
    const token = `token:${Date.now()}_${Math.random().toString(36).slice(2)}`;
    
    return new Response(JSON.stringify({ success: true, user: { ...user, token } }), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
    });
  }

  // 用户注册
  if (path === "/api/users/register" && request.method === "POST") {
    const body: any = await request.json();
    const { username, password, nickname } = body;
    
    if (!username || !password) {
      return new Response(JSON.stringify({ error: "缺少用户名或密码" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 400,
      });
    }
    
    // 检查用户名是否已存在
    const existingUser = await env.DB.prepare(
      "SELECT * FROM users WHERE username = ?"
    ).bind(username).first();
    
    if (existingUser) {
      return new Response(JSON.stringify({ error: "用户名已存在" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 400,
      });
    }
    
    // 创建新用户
    const id = `user:${Date.now()}`;
    const now = new Date().toISOString();
    const user = {
      id,
      username,
      password,
      nickname: nickname || username,
      avatar: "",
      role: "user",
      status: "active",
      createTime: now,
      updateTime: now
    };
    
    await env.DB.prepare(`
      INSERT INTO users (
        id, username, password, nickname, avatar, role, 
        status, createTime, updateTime
      ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    `).bind(
      user.id, user.username, user.password, user.nickname,
      user.avatar, user.role, user.status, user.createTime, user.updateTime
    ).run();
    
    return new Response(JSON.stringify(user), {
      headers: { ...corsHeaders, "Content-Type": "application/json" },
      status: 201,
    });
  }

  return null;
}
