// 工具函数：指数退避重试
async function withRetry<T>(
  fn: () => Promise<T>,
  maxRetries = 3,
  initialDelay = 1000
): Promise<T> {
  let retries = 0;
  while (true) {
    try {
      return await fn();
    } catch (error) {
      retries++;
      if (retries >= maxRetries) {
        throw new Error(`重试${maxRetries}次后仍失败: ${(error as Error).message}`);
      }
      // 指数退避延迟
      const delay = initialDelay * Math.pow(2, retries);
      await new Promise(resolve => setTimeout(resolve, delay));
      console.log(`重试第${retries}次，延迟${delay}ms`);
    }
  }
}

// 夸克网盘API对接函数
async function fetchQuarkVideo(sourceConfig: any, env: any) {
  const { path, categoryId } = sourceConfig;
  const apiKey = env.QUARK_API_KEY;
  
  // 夸克网盘API请求（参考官方文档）
  const response = await withRetry(async () => {
    return fetch(`https://drive.quark.cn/apis/v1/file/list`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Authorization": `Bearer ${apiKey}`,
        "User-Agent": "Cloudflare-Workers-CMS/1.0"
      },
      body: JSON.stringify({
        path: path || "/",
        category_id: categoryId || "",
        limit: 20,
        offset: 0
      })
    });
  });

  if (!response.ok) {
    throw new Error(`夸克网盘API请求失败: ${response.status}`);
  }

  const data = await response.json();
  
  // 解析夸克网盘视频数据（适配官方返回格式）
  return data.data.files
    .filter((file: any) => file.mime_type.startsWith("video/"))
    .map((file: any) => ({
      title: file.file_name,
      url: file.download_url,
      cover: file.cover_url || "",
      size: file.size,
      source: "夸克网盘",
      category: sourceConfig.category || "默认分类",
      tags: sourceConfig.tags || []
    }));
}

// 阿里云盘API对接函数
async function fetchAliyunVideo(sourceConfig: any, env: any) {
  const accessToken = env.ALIYUN_ACCESS_TOKEN;
  const drivePath = sourceConfig.path || "/";

  const files = await withRetry(async () => {
    // 1. 获取用户 drive_id
    const driveRes = await fetch("https://api.aliyundrive.com/v2/user/get", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${accessToken}`,
      },
    });
    const driveData = await driveRes.json();
    const driveId = driveData.default_drive_id;

    // 2. 列出文件
    const listRes = await fetch("https://api.aliyundrive.com/v3/file/list", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${accessToken}`,
      },
      body: JSON.stringify({
        drive_id: driveId,
        parent_file_id: "root", // 根目录，可根据path解析
        limit: 50,
        image_thumbnail_process: "image/resize,w_400/format,jpeg",
        video_thumbnail_process: "video/snapshot,t_1000,f_jpg,ar_auto,w_400"
      }),
    });

    const listData = await listRes.json();
    return listData.items || [];
  });

  // 只保留视频文件并格式化
  const videoList = files.filter((f: any) => f.mime_type?.startsWith("video/"));
  
  return videoList.map((file: any) => ({
    title: file.name,
    url: file.download_url || file.web_content_link || "",
    cover: file.thumbnail || file.video_media_info?.cover_url || "",
    size: file.size,
    source: "阿里云盘",
    category: sourceConfig.category || "默认分类",
    tags: sourceConfig.tags || []
  }));
}

// 通用视频抓取函数（适配不同源）
async function fetchVideoBySource(sourceConfig: any, env: any) {
  switch (sourceConfig.type) {
    case "quark":
      return await fetchQuarkVideo(sourceConfig, env);
    case "aliyun":
      return await fetchAliyunVideo(sourceConfig, env);
    case "bilibili":
      // 可扩展B站/其他源
      return [];
    default:
      throw new Error(`不支持的视频源类型: ${sourceConfig.type}`);
  }
}

// 检查是否到了源的抓取时间
function isTimeToFetch(sourceConfig: any): boolean {
  const now = new Date();
  const cronExpr = sourceConfig.cron || "* * * * *"; // 默认每分钟
  const [minute, hour, day, month, weekday] = cronExpr.split(" ").map(Number);
  
  // 简化版Cron解析（支持 * / 数字 格式）
  return (
    (minute === "*" || now.getMinutes() === minute) &&
    (hour === "*" || now.getHours() === hour) &&
    (day === "*" || now.getDate() === day) &&
    (month === "*" || now.getMonth() + 1 === month) &&
    (weekday === "*" || now.getDay() === weekday)
  );
}

export default {
  // HTTP请求处理
  async fetch(
    request: Request,
    env: {
      KV: KVNamespace,
      UPLOAD_BUCKET: R2Bucket,
      QUARK_API_KEY: string,
      QUARK_API_SECRET: string,
      ALIYUN_ACCESS_TOKEN: string
    },
    ctx: ExecutionContext
  ): Promise<Response> {
    const corsHeaders = {
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, OPTIONS",
      "Access-Control-Allow-Headers": "Content-Type, Authorization",
    };

    if (request.method === "OPTIONS") {
      return new Response(null, { headers: corsHeaders });
    }

    const url = new URL(request.url);
    const path = url.pathname;
    if (path === "/" && request.method === "GET") {
      return new Response(`
        <style>
        * {
          padding: 0;
          margin: 0;
        }
        li,dl{
          padding: 10px 0;
          list-style: none;
        }
        </style>
        <div align="center">
          <h1 style="font-size: 24px;margin: 120px auto 30px;">Welcome to Cloudflare Workers CMS API</h1>
          <div>
            <span>当前版本：v1.0.0</span>
            <a href="https://github.com/boycot2015/byt.cms" target="_blank">项目地址</a>
          <ul>
            <li>GET /api/categories - 获取所有分类</li>
            <li>POST /api/categories - 创建分类</li>
            <li>GET /api/tags - 获取所有标签</li>
            <li>POST /api/tags - 创建标签</li>
          </ul>
        </div>
      `, {
        headers: { ...corsHeaders, "Content-Type": "text/html;charset=utf-8" },
      });
    }
    // ========== 文章管理API（原有） ==========
    // 1. 获取所有文章
    if (path === "/api/articles" && request.method === "GET") {
      const keys = await env.KV.list({ prefix: "article:" });
      const articles = [];
      for (const key of keys.keys) {
        const article = await env.KV.get(key.name);
        articles.push(JSON.parse(article!));
      }
      return new Response(JSON.stringify(articles), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    // 2. 创建文章
    if (path === "/api/articles" && request.method === "POST") {
      const body = await request.json();
      const id = `article:${Date.now()}`;
      const article = {
        id,
        title: body.title,
        content: body.content,
        createdAt: new Date().toISOString(),
        updatedAt: new Date().toISOString(),
      };
      await env.KV.put(id, JSON.stringify(article));
      return new Response(JSON.stringify(article), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 201,
      });
    }

    // 3. 删除文章
    if (path.startsWith("/api/articles/") && request.method === "DELETE") {
      const id = path.replace("/api/articles/", "");
      await env.KV.delete(`article:${id}`);
      return new Response(JSON.stringify({ success: true }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    // 4. 更新文章
    if (path.startsWith("/api/articles/") && request.method === "PUT") {
      const id = path.replace("/api/articles/", "");
      const body = await request.json();
      const oldArticle = await env.KV.get(`article:${id}`);
      if (!oldArticle) {
        return new Response(JSON.stringify({ error: "文章不存在" }), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
          status: 404,
        });
      }
      const newArticle = {
        ...JSON.parse(oldArticle),
        title: body.title,
        content: body.content,
        updatedAt: new Date().toISOString(),
      };
      await env.KV.put(`article:${id}`, JSON.stringify(newArticle));
      return new Response(JSON.stringify(newArticle), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    // ========== 分类/标签管理API ==========
    // 1. 获取所有分类
    if (path === "/api/categories" && request.method === "GET") {
      const keys = await env.KV.list({ prefix: "category:" });
      const categories = [];
      for (const key of keys.keys) {
        const category = await env.KV.get(key.name);
        categories.push(JSON.parse(category!));
      }
      return new Response(JSON.stringify(categories), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    // 2. 创建分类
    if (path === "/api/categories" && request.method === "POST") {
      const body = await request.json();
      const id = `category:${Date.now()}`;
      const category = {
        id,
        name: body.name,
        desc: body.desc || "",
        createTime: new Date().toISOString()
      };
      await env.KV.put(id, JSON.stringify(category));
      return new Response(JSON.stringify(category), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 201,
      });
    }

    // 3. 获取所有标签
    if (path === "/api/tags" && request.method === "GET") {
      const keys = await env.KV.list({ prefix: "tag:" });
      const tags = [];
      for (const key of keys.keys) {
        const tag = await env.KV.get(key.name);
        tags.push(JSON.parse(tag!));
      }
      return new Response(JSON.stringify(tags), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    // 4. 创建标签
    if (path === "/api/tags" && request.method === "POST") {
      const body = await request.json();
      const id = `tag:${Date.now()}`;
      const tag = {
        id,
        name: body.name,
        createTime: new Date().toISOString()
      };
      await env.KV.put(id, JSON.stringify(tag));
      return new Response(JSON.stringify(tag), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 201,
      });
    }

    // ========== 视频管理API ==========
    // 1. 获取视频（支持分类/标签筛选）
    if (path === "/api/videos" && request.method === "GET") {
      const category = url.searchParams.get("category");
      const tag = url.searchParams.get("tag");
      
      const keys = await env.KV.list({ prefix: "video:" });
      let videos = [];
      for (const key of keys.keys) {
        const video = JSON.parse(await env.KV.get(key.name) || "{}");
        videos.push(video);
      }

      // 筛选
      if (category) {
        videos = videos.filter(v => v.category === category);
      }
      if (tag) {
        videos = videos.filter(v => v.tags.includes(tag));
      }

      return new Response(JSON.stringify(videos), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    // 2. 删除视频
    if (path.startsWith("/api/videos/") && request.method === "DELETE") {
      const id = path.replace("/api/videos/", "");
      await env.KV.delete(`video:${id}`);
      return new Response(JSON.stringify({ success: true }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    // 3. 保存视频源配置（含频率）
    if (path === "/api/video-sources" && request.method === "POST") {
      const body = await request.json();
      await env.KV.put("video_sources", JSON.stringify(body));
      return new Response(JSON.stringify({ success: true }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    // 4. 获取视频源配置
    if (path === "/api/video-sources" && request.method === "GET") {
      const sources = await env.KV.get("video_sources") || "[]";
      return new Response(sources, {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }
    // ========== 新增：图片上传接口（对接 R2） ==========
    if (path === "/api/upload/image" && request.method === "POST") {
      try {
        // 解析 FormData 格式的上传请求
        const formData = await request.formData();
        const file = formData.get("file") as File;
        
        if (!file) {
          return new Response(JSON.stringify({ 
            success: false, 
            message: "未选择文件" 
          }), {
            headers: { ...corsHeaders, "Content-Type": "application/json" },
            status: 400,
          });
        }

        // 验证文件类型（仅允许图片）
        const allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
        if (!allowedTypes.includes(file.type)) {
          return new Response(JSON.stringify({ 
            success: false, 
            message: "仅支持 jpg/png/gif/webp 格式" 
          }), {
            headers: { ...corsHeaders, "Content-Type": "application/json" },
            status: 400,
          });
        }

        // 验证文件大小（限制 5MB）
        const maxSize = 5 * 1024 * 1024;
        if (file.size > maxSize) {
          return new Response(JSON.stringify({ 
            success: false, 
            message: "文件大小不能超过 5MB" 
          }), {
            headers: { ...corsHeaders, "Content-Type": "application/json" },
            status: 400,
          });
        }

        // 生成唯一文件名
        const fileName = `upload/${Date.now()}_${Math.random().toString(36).slice(2)}.${file.name.split('.').pop()}`;
        
        // 上传文件到 R2
        await env.UPLOAD_BUCKET.put(fileName, file, {
          httpMetadata: {
            contentType: file.type,
          },
          customMetadata: {
            uploadTime: new Date().toISOString(),
            originalName: file.name,
          },
        });

        // 生成图片访问链接（两种方式二选一）
        // 方式1：R2 公共访问（需开启存储桶公共访问）
        const imageUrl = `https://file.boycot.dpdns.org/${fileName}`; // 替换为你的 R2 公共域名
        
        // 方式2：通过 Workers 代理访问（无需公共访问，更安全）
        // const imageUrl = `https://file.boycot.dpdns.org/${fileName}`;

        return new Response(JSON.stringify({
          success: true,
          data: {
            url: imageUrl, // 富文本需要的图片链接
            name: file.name,
            size: file.size,
          },
        }), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
        });
      } catch (error) {
        console.error("图片上传失败:", error);
        return new Response(JSON.stringify({ 
          success: false, 
          message: "上传失败：" + (error as Error).message 
        }), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
          status: 500,
        });
      }
    }

    // ========== 可选：Workers 代理访问 R2 图片（方式2） ==========
    if (path.startsWith("/api/image/") && request.method === "GET") {
      const fileName = path.replace("/api/image/", "");
      try {
        const object = await env.UPLOAD_BUCKET.get(fileName);
        if (!object) {
          return new Response("图片不存在", { status: 404 });
        }
        return new Response(object.body, {
          headers: {
            "Content-Type": object.httpMetadata.contentType || "image/jpeg",
            "Cache-Control": "public, max-age=31536000", // 缓存1年
          },
        });
      } catch (error) {
        return new Response("获取图片失败", { status: 500 });
      }
    }
    // 未匹配路由
    return new Response(JSON.stringify({ error: "Not Found" }), {
      headers: corsHeaders,
      status: 404,
    });
  },

  // 定时任务主调度
  async scheduled(
    event: ScheduledEvent,
    env: { KV: KVNamespace },
    ctx: ExecutionContext
  ): Promise<void> {
    console.log("定时调度任务执行:", new Date().toISOString());
    
    // 获取所有视频源配置
    const sourceConfigStr = await env.KV.get("video_sources");
    if (!sourceConfigStr) {
      console.log("无视频源配置");
      return;
    }

    const sources = JSON.parse(sourceConfigStr);
    for (const source of sources) {
      // 跳过禁用的源
      if (!source.enabled) continue;
      
      // 检查是否到了该源的抓取时间
      if (!isTimeToFetch(source)) {
        console.log(`源[${source.name}]未到抓取时间，跳过`);
        continue;
      }

      try {
        // 抓取视频（带重试）
        const videos = await withRetry(() => fetchVideoBySource(source, env));
        
        // 去重并存储
        for (const video of videos) {
          const existingKeys = await env.KV.list({ prefix: "video:" });
          // 检查是否已存在相同视频
          let isDuplicate = false;
          for (const key of existingKeys.keys) {
            const v = JSON.parse(await env.KV.get(key.name) || "{}");
            if (v.url === video.url) {
              isDuplicate = true;
              break;
            }
          }

          if (!isDuplicate) {
            const videoId = `video:${Date.now()}_${Math.random().toString(36).slice(2)}`;
            const videoData = {
              id: videoId,
              ...video,
              fetchTime: new Date().toISOString(),
              status: "active"
            };
            await env.KV.put(videoId, JSON.stringify(videoData));
            console.log(`成功存储视频: ${video.title}`);
          }
        }
      } catch (error) {
        console.error(`源[${source.name}]抓取失败:`, error);
        // 单个源失败不影响其他源
        continue;
      }
    }
  },
};