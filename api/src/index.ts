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
      const delay = initialDelay * Math.pow(2, retries);
      await new Promise(resolve => setTimeout(resolve, delay));
      console.log(`重试第${retries}次，延迟${delay}ms`);
    }
  }
}

// 阿里云盘工具类
class AliyunDriveClient {
  private refreshToken: string;
  private clientId: string;
  private clientSecret: string;
  private accessToken: string | null = null;
  private tokenExpireTime: number = 0;

  constructor(env: any) {
    this.refreshToken = env.ALIYUN_REFRESH_TOKEN;
    this.clientId = env.ALIYUN_CLIENT_ID || "";
    this.clientSecret = env.ALIYUN_CLIENT_SECRET || "";
  }

  private async refreshAccessToken(): Promise<string|null> {
    if (this.accessToken && Date.now() < this.tokenExpireTime) {
      return this.accessToken;
    }
    const response = await fetch("https://openapi.aliyundrive.com/oauth/access_token", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        client_id: this.clientId,
        client_secret: this.clientSecret,
        grant_type: "refresh_token",
        refresh_token: this.refreshToken
      })
    });
    if (!response.ok) throw new Error(`刷新令牌失败: ${response.status}`);
    const data:any = await response.json();
    this.accessToken = data.access_token;
    this.tokenExpireTime = Date.now() + (data.expires_in - 300) * 1000;
    if (data.refresh_token) this.refreshToken = data.refresh_token;
    return this.accessToken;
  }

  private async getHeaders(): Promise<HeadersInit> {
    const token = await this.refreshAccessToken();
    return {
      "Content-Type": "application/json",
      "Authorization": `Bearer ${token}`
    };
  }

  private async getFileIdByPath(driveId: string, path: string, parentFileId = "root"): Promise<string> {
    if (path === "/" || path === "") return parentFileId;
    const pathParts = path.split("/").filter(part => part);
    const currentFolder = pathParts[0];
    const response = await fetch("https://api.aliyundrive.com/v2/file/list", {
      method: "POST",
      headers: await this.getHeaders(),
      body: JSON.stringify({
        drive_id: driveId,
        parent_file_id: parentFileId,
        limit: 100,
        fields: "file_id,name,type"
      })
    });
    if (!response.ok) throw new Error(`获取目录列表失败: ${response.status}`);
    const data:any = await response.json();
    const folder = data.items?.find((item: any) => item.type === "folder" && item.name === currentFolder);
    if (!folder) throw new Error(`路径不存在: ${path}`);
    const remainingPath = pathParts.slice(1).join("/");
    return this.getFileIdByPath(driveId, remainingPath, folder.file_id);
  }

  private async getDefaultDriveId(): Promise<string> {
    const response = await fetch("https://api.aliyundrive.com/v2/user/get", {
      method: "POST",
      headers: await this.getHeaders()
    });
    if (!response.ok) throw new Error(`获取drive_id失败: ${response.status}`);
    const data:any = await response.json();
    return data.default_drive_id;
  }

  async listVideoFiles(path: string = "/"): Promise<any[]> {
    const driveId = await this.getDefaultDriveId();
    const parentFileId = await this.getFileIdByPath(driveId, path);
    let allFiles: any[] = [];
    let marker = "";
    do {
      const response = await fetch("https://api.aliyundrive.com/v3/file/list", {
        method: "POST",
        headers: await this.getHeaders(),
        body: JSON.stringify({
          drive_id: driveId,
          parent_file_id: parentFileId,
          limit: 100,
          marker: marker,
          image_thumbnail_process: "image/resize,w_400/format,jpeg",
          video_thumbnail_process: "video/snapshot,t_1000,f_jpg,ar_auto,w_400",
          fields: "file_id,name,size,mime_type,thumbnail,video_media_info,download_url,web_content_link"
        })
      });
      if (!response.ok) throw new Error(`获取文件列表失败: ${response.status}`);
      const data:any = await response.json();
      allFiles = allFiles.concat(data.items || []);
      marker = data.next_marker || "";
    } while (marker);
    return allFiles.filter((file: any) => file.mime_type?.startsWith("video/"));
  }
}

// 坚果云 WebDAV 客户端
class JianguoYunWebDAV {
  private username: string;
  private password: string;
  private baseUrl = "https://dav.jianguoyun.com/dav/";

  constructor(env: any) {
    this.username = env.JIANGUOYUN_USERNAME;
    this.password = env.JIANGUOYUN_APP_PASSWORD;
    if (!this.username || !this.password) {
      throw new Error("缺少坚果云环境变量：JIANGUOYUN_USERNAME / JIANGUOYUN_APP_PASSWORD");
    }
  }

  private getAuthHeader(): string {
    const auth = btoa(`${this.username}:${this.password}`);
    return `Basic ${auth}`;
  }

  private parseWebDAVResponse(xmlText: string): any[] {
    const files: any[] = [];
    
    // 正则匹配每个 <d:response> 块
    const responseRegex = /<d:response>([\s\S]*?)<\/d:response>/g;
    let responseMatch;
    
    while ((responseMatch = responseRegex.exec(xmlText)) !== null) {
      const responseBlock = responseMatch[1];
      
      // 提取各个字段（使用正则匹配）
      const hrefMatch = responseBlock.match(/<d:href>([\s\S]*?)<\/d:href>/);
      const href = hrefMatch ? hrefMatch[1].trim() : "";
      
      const displayNameMatch = responseBlock.match(/<d:displayname>([\s\S]*?)<\/d:displayname>/);
      const displayName = displayNameMatch ? displayNameMatch[1].trim() : "";
      
      // 判断是否是文件夹
      const isFolder = /<d:resourcetype>[\s\S]*?<d:collection>[\s\S]*?<\/d:collection>[\s\S]*?<\/d:resourcetype>/.test(responseBlock);
      
      const sizeMatch = responseBlock.match(/<d:getcontentlength>([\s\S]*?)<\/d:getcontentlength>/);
      const size = sizeMatch ? sizeMatch[1].trim() : "0";
      
      const contentTypeMatch = responseBlock.match(/<d:getcontenttype>([\s\S]*?)<\/d:getcontenttype>/);
      const contentType = contentTypeMatch ? contentTypeMatch[1].trim() : "";
      
      const lastModifiedMatch = responseBlock.match(/<d:getlastmodified>([\s\S]*?)<\/d:getlastmodified>/);
      const lastModified = lastModifiedMatch ? lastModifiedMatch[1].trim() : "";
      
      // 只处理文件（非文件夹）且有有效路径的条目
      if (!isFolder && href) {
        files.push({
          path: decodeURIComponent(href),
          name: displayName || href.split("/").pop() || "", // 兜底：从路径提取文件名
          size: parseInt(size, 10) || 0,
          contentType,
          lastModified,
          downloadUrl: `${this.baseUrl}${href.replace("/dav/", "")}`,
        });
      }
    }
    
    return files;
  }

  async listFiles(path: string = "/"): Promise<any[]> {
    const fullPath = path.startsWith("/") ? path.slice(1) : path;
    const url = `${this.baseUrl}${fullPath}`;
    const response = await fetch(url, {
      method: "PROPFIND",
      headers: {
        Authorization: this.getAuthHeader(),
        Depth: "1",
        "Content-Type": "application/xml",
      },
    });
    if (!response.ok) {
      throw new Error(`坚果云 PROPFIND 失败：${response.status} ${response.statusText}`);
    }
    const xmlText = await response.text();
    return this.parseWebDAVResponse(xmlText);
  }

  async listVideoFiles(path: string = "/"): Promise<any[]> {
    const files = await this.listFiles(path);
    return files.filter(file => file.contentType?.startsWith("video/"));
  }
}

// 夸克网盘API对接函数
async function fetchQuarkVideo(sourceConfig: any, env: any) {
  const { path, categoryId } = sourceConfig;
  const apiKey = env.QUARK_API_KEY;
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
  if (!response.ok) throw new Error(`夸克网盘API请求失败: ${response.status}`);
  const data:any = await response.json();
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
  if (!env.ALIYUN_REFRESH_TOKEN) {
    throw new Error("缺少阿里云盘环境变量: ALIYUN_REFRESH_TOKEN");
  }
  const client = new AliyunDriveClient(env);
  const videoFiles = await withRetry(() => client.listVideoFiles(sourceConfig.path || "/"));
  return videoFiles.map((file: any) => ({
    title: file.name,
    url: file.download_url || file.web_content_link || "",
    cover: file.thumbnail || file.video_media_info?.cover_url || "",
    size: file.size,
    source: "阿里云盘",
    category: sourceConfig.category || "默认分类",
    tags: sourceConfig.tags || [],
    fileId: file.file_id
  }));
}

// 坚果云视频源对接函数
async function fetchJianguoYunVideo(sourceConfig: any, env: any) {
  const davClient = new JianguoYunWebDAV(env);
  const videos = await withRetry(() => davClient.listVideoFiles(sourceConfig.path || "/"));
  return videos.map(file => ({
    title: file.name,
    url: file.downloadUrl,
    cover: "",
    size: file.size,
    source: "坚果云",
    category: sourceConfig.category || "默认分类",
    tags: sourceConfig.tags || [],
    path: file.path,
  }));
}
async function fetchCmsVideo(sourceConfig: any, env: any) {
  const video:any = await withRetry(() => fetch(sourceConfig.path || "/").then(res => res.json()));
  const videoDetial:any = await withRetry(() => fetch(sourceConfig.path.replace('?ac=list', '?ac=detail') || "/").then(res => res.json()));
  let list = videoDetial?.list?.map((file: any) => ({
    title: file.vod_name || file.title || "",
    subTitle: file.vod_remarks || "",
    url: file.vod_play_url?.split('#')?.[0]?.split('$')?.[1] || file.url || "",
    urls: file.vod_play_url?.split('#').map((item: string) => ({
      label: item.split('$')?.[0] || "",
      url: item.split('$')?.[1] || "",
    })) || [],
    actors: file.vod_actor?.split('/').map((actor: string) => actor.trim()).filter((actor: string) => actor && actor !== '暂无') || [],
    director: file.vod_director || "",
    writer: file.vod_writer || "",
    cover: file.vod_pic || "",
    size: file.vod_total || 0,
    source: file.vod_play_from.split('$$$')?.[0] || sourceConfig.type || "默认源",
    category: file.type_name || "默认分类",
    tags:  [file.vod_area, file.vod_lang].filter((tag: string) => tag),
    fetchTime: file.vod_time || "",
    path: file.path || "",
  }));
  return {
    list,
    page: video?.page || 0,
    limit: video?.limit || 0,
    total: video?.total || 0,
    categories: video?.class?.map((item: any) => ({
      id: item.type_id,
      name: item.type_name,
    })) || []
  }
  
}
// 通用视频抓取函数
async function fetchVideoBySource(sourceConfig: any, env: any) {
  switch (sourceConfig.type) {
    case "quark":
      return await fetchQuarkVideo(sourceConfig, env);
    // case "aliyun":
    //   return await fetchAliyunVideo(sourceConfig, env);
    case "jianguoyun":
      return await fetchJianguoYunVideo(sourceConfig, env);
    case "wolong":
    case "liangzi":
    case "shandian":
    case "sdm3u8":
    case "wjm3u8":
    case "wujin":
    case "baiwan":
    case "1080zyk":
    case "jingying":
    case "youzhi":
    case "yhm3u8":
      return await fetchCmsVideo(sourceConfig, env);
    case "bilibili":
      return [];
    default:
      throw new Error(`不支持的视频源类型: ${sourceConfig.type}`);
  }
}

// 检查是否到了源的抓取时间
function isTimeToFetch(sourceConfig: any): boolean {
  const now = new Date();
  const cronExpr = sourceConfig.cron || "* * * * *";
  const [minute, hour, day, month, weekday] = cronExpr.split(" ").map(Number);
  return (
    (minute === "*" || now.getMinutes() === minute) &&
    (hour === "*" || now.getHours() === hour) &&
    (day === "*" || now.getDate() === day) &&
    (month === "*" || now.getMonth() + 1 === month) &&
    (weekday === "*" || now.getDay() === weekday)
  );
}
const setVideoList = async (source: any, env: any) => {
  try {
    const data = await withRetry(() => fetchVideoBySource(source, env));
    let videos = data.list || data || [];
    // console.log(videos.map((el:any) => el.title + el.url), 'cms----videos');
    for (const video of videos) {
      const existingKeys = await env.KV.list({ prefix: "video:" });
      let isDuplicate = false;
      let existing = null;
      for (const key of existingKeys.keys) {
        const v = JSON.parse(await env.KV.get(key.name) || "{}");
        // console.log(v, videos, 'video');
        if (v.url === video.url) {
          isDuplicate = true;
          existing = v
          break;
        }
      }
      const tags = await Promise.all(video.tags.map((tag: string) => setTag({ name: tag }, env)));
      const category = await setCategory({ name: video.category || "" }, env);

      const videoId = `video:${Date.now()}_${Math.random().toString(36).slice(2)}`;
      const videoData = {
        id: isDuplicate ? existing.id || videoId : videoId,
        ...video,
        categoryId: category.id || "",
        createTime: isDuplicate ? existing.createTime || new Date().toISOString() : new Date().toISOString(),
        tagIds: tags.map((tag:any) => tag.id) || [],
        updateTime: isDuplicate ? existing.fetchTime || existing.updateTime || new Date().toISOString() : new Date().toISOString(),
        status: "active"
      };
      if (!source.action || source.action === "put") {
        await env.KV.put(videoData.id, JSON.stringify(videoData));
        console.log(`成功存储视频: ${video.title}`);
      }
    }
    return data;
  } catch (error) {
    console.error(`源[${source.name}]设置失败:`, error);
  }
}
const setCategory = async (body:any, env: any) => {
  const id = `category:${Date.now()}`;
  let existingCategory = null;
  // console.log(existingexistingCategory, body.id || `category:${body.name}`, 'setCategory');
  const existingKeys = await env.KV.list({ prefix: "category:" });
  let isDuplicate = false;
  for (const key of existingKeys.keys) {
    const v = JSON.parse(await env.KV.get(key.name) || "{}");
    if (v.name === body.name) {
      isDuplicate = true;
      existingCategory = v
      break;
    }
  }
  if (isDuplicate) {
    if (existingCategory)  {
      let newCategory = {...existingCategory, ...body };
      if (existingCategory.id) await env.KV.put(existingCategory.id, JSON.stringify(newCategory));
      return newCategory;
    };
  }
  const category = {
    id,
    name: body.name,
    desc: body.desc || "",
    createTime: new Date().toISOString()
  };
  await env.KV.put(id, JSON.stringify(category));
  return category;
}
const setTag = async (body:any, env: any) => {
  let existing = null;
  const existingKeys = await env.KV.list({ prefix: "tag:" });
  let isDuplicate = false;
  for (const key of existingKeys.keys) {
    const v = JSON.parse(await env.KV.get(key.name) || "{}");
    if (v.name === body.name) {
      isDuplicate = true;
      existing = v
      break;
    }
  }
  if (isDuplicate) {
    if (existing){
      let newTag = {...existing, ...body };
      if(existing.id) await env.KV.put(existing.id, JSON.stringify(newTag));
      return newTag;
    };
    return JSON.parse(existing);
  }
  const id = `tag:${Date.now()}`;
  const tag = {
    id,
    name: body.name,
    createTime: new Date().toISOString()
  };
  await env.KV.put(id, JSON.stringify(tag));
  return tag;
}
export default {
  async fetch(
    request: Request,
    env: {
      KV: KVNamespace;
      UPLOAD_BUCKET: R2Bucket;
      QUARK_API_KEY: string;
      ALIYUN_REFRESH_TOKEN: string;
      ALIYUN_CLIENT_ID: string;
      ALIYUN_CLIENT_SECRET: string;
      JIANGUOYUN_USERNAME: string;
      JIANGUOYUN_APP_PASSWORD: string;
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

    // 首页
    if (path === "/" && request.method === "GET") {
      return new Response(`
        <style>
        * { padding: 0; margin: 0; }
        li,dl{ padding: 10px 0; list-style: none; }
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
            <li>GET /api/videos - 获取视频</li>
            <li>GET /api/video-fetch-sources-data/jianguoyun - 手动抓取坚果云</li>
          </ul>
        </div>
      `, {
        headers: { ...corsHeaders, "Content-Type": "text/html;charset=utf-8" },
      });
    }

    // 文章管理
    if (path === "/api/articles" && request.method === "GET") {
      const keys = await env.KV.list({ prefix: "article:" });
      const articles = [];
      for (const key of keys.keys) {
        const article = await env.KV.get(key.name);
        articles.push(JSON.parse(article!));
      }
      let articlesWithDetails = await Promise.all(articles.map(async el => {
        if (el.categoryId) {
          const category = await env.KV.get(el.categoryId);
          el.category = JSON.parse(category || "{}");
          el.categoryId = el.category.id;
        }
        if (el.tagIds) {
          const tags = await Promise.all(el.tagIds.map(async (tagId: string) => {
            const tag = await env.KV.get(tagId);
            return JSON.parse(tag || "{}");
          }));
          el.tags = tags.filter(tag => tag && tag.id);
        }
        return el;
      }))
      return new Response(JSON.stringify(articlesWithDetails), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    if (path === "/api/articles" && request.method === "PUT") {
      const body:any = await request.json();
      const id = `article:${Date.now()}`;
      const article = {
        id,
        title: body.title,
        categoryId: body.categoryId,
        tagIds: body.tagIds,
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

    if (path.startsWith("/api/articles/") && request.method === "DELETE") {
      const id = path.replace("/api/articles/", "");
      await env.KV.delete(`article:${id}`);
      return new Response(JSON.stringify({ success: true }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    if (path.startsWith("/api/articles/") && request.method === "POST") {
      const id = path.replace("/api/articles/", "");
      const body:any = await request.json();
      const oldArticle = await env.KV.get(`article:${id}`);
      if (!oldArticle) {
        return new Response(JSON.stringify({ error: "文章不存在" }), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
          status: 404,
        });
      }
      const newArticle = {
        ...JSON.parse(oldArticle),
        categoryId: body.categoryId,
        tagIds: body.tagIds,
        title: body.title,
        content: body.content,
        updatedAt: new Date().toISOString(),
      };
      await env.KV.put(`article:${id}`, JSON.stringify(newArticle));
      return new Response(JSON.stringify(newArticle), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    // 分类管理
    if (path === "/api/categories" && request.method === "GET") {
      const keys = await env.KV.list({ prefix: "category:" });
      const categories = [];
      for (const key of keys.keys) {
        const category = await env.KV.get(key.name);
        categories.push(JSON.parse(category!));
      }
      return new Response(JSON.stringify(categories.reverse()), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    if (path === "/api/categories" && request.method === "POST") {
      const body = await request.json();
      const category = await setCategory(body, env);
      return new Response(JSON.stringify(category), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 201,
      });
    }
    if (path.startsWith("/api/categories/") && request.method === "DELETE") {
      const id = path.replace("/api/categories/", "");
      await env.KV.delete(`category:${id}`);
      return new Response(JSON.stringify({success: true}), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 201,
      });
    }
    // 标签管理
    if (path === "/api/tags" && request.method === "GET") {
      const keys = await env.KV.list({ prefix: "tag:" });
      const tags = [];
      for (const key of keys.keys) {
        const tag = await env.KV.get(key.name);
        tags.push(JSON.parse(tag!));
      }
      return new Response(JSON.stringify(tags.reverse()), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }
    if (path === "/api/tags" && request.method === "POST") {
      const body = await request.json();
      const tag = await setTag(body, env);
      return new Response(JSON.stringify(tag), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 201,
      });
    }
    if (path.startsWith("/api/tags/") && request.method === "DELETE") {
      const id = path.replace("/api/tags/", "");
      await env.KV.delete(`tag:${id}`);
      return new Response(JSON.stringify({success: true}), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 201,
      });
    }
    // 视频管理
    if (path === "/api/videos" && request.method === "GET") {
      const category = url.searchParams.get("category");
      const tag = url.searchParams.get("tag");
      const source = url.searchParams.get("source");
      const keys = await env.KV.list({ prefix: "video:" });
      let videos = [];
      for (const key of keys.keys) {
        const video = JSON.parse(await env.KV.get(key.name) || "null");
        video && videos.push(video);
      }
      if (category) videos = videos.filter(v => v.categoryId === category);
      if (source) videos = videos.filter(v => v.source === source);
      if (tag) videos = videos.filter(v => v.tagIds.includes(tag));
      return new Response(JSON.stringify(videos.filter(el => el).reverse()), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    if (path.startsWith("/api/videos/") && request.method === "DELETE") {
      const id = path.replace("/api/videos/", "");
      await env.KV.delete(`video:${id}`);
      return new Response(JSON.stringify({ success: true }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    if (path === "/api/video-sources" && request.method === "POST") {
      const body = await request.json();
      await env.KV.put("video_sources", JSON.stringify(body));
      return new Response(JSON.stringify({ success: true }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    if (path === "/api/video-sources" && request.method === "GET") {
      const sources = await env.KV.get("video_sources") || "[]";
      return new Response(sources, {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    if (path.startsWith("/api/video-source-data/") && request.method === "GET") {
      const type = path.replace("/api/video-source-data/", "");
      const action = url.searchParams.get("action"); // get, put 默认put
      const cid = url.searchParams.get("cid"); // 分类ID，默认空
      const sources: any = JSON.parse(await env.KV.get("video_sources") || "[]");
      const source = sources.find((s: any) => s.type === type) || {
          "type": "wolong",
          "cron": "* * * * *",
          "enabled": true,
          "path": "https://collect.wolongzy.cc/api.php/provide/vod/?ac=detail",
          "categoryId": "",
          "category": "动漫",
          "tags": [
              "修仙"
          ]
      }
      if (!source) {
        return new Response(JSON.stringify({ error: "视频源不存在" }), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
          status: 404
        });
      }
      if (source.path.includes("t=")) source.path = source.path.replace(/t=([^&]*)/g, `t=${cid || ""}`);
      else source.path+=`&t=${cid || ""}`;
      console.log(source.path, 'source.path');
      
      const data = await setVideoList({...source, action}, env);
      return new Response(JSON.stringify({
        success: true,
        code: 200,
        count: data?.total || 0,
        page: data?.page || 1,
        data
      }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    // 图片上传
    if (path === "/api/upload/image" && request.method === "POST") {
      try {
        const formData = await request.formData();
        const file = formData.get("file") as File;
        if (!file) {
          return new Response(JSON.stringify({ success: false, message: "未选择文件" }), {
            headers: { ...corsHeaders, "Content-Type": "application/json" },
            status: 400,
          });
        }
        const allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
        if (!allowedTypes.includes(file.type)) {
          return new Response(JSON.stringify({ success: false, message: "仅支持 jpg/png/gif/webp" }), {
            headers: { ...corsHeaders, "Content-Type": "application/json" },
            status: 400,
          });
        }
        const maxSize = 5 * 1024 * 1024;
        if (file.size > maxSize) {
          return new Response(JSON.stringify({ success: false, message: "文件大小不能超过 5MB" }), {
            headers: { ...corsHeaders, "Content-Type": "application/json" },
            status: 400,
          });
        }
        const fileName = `upload/${Date.now()}_${Math.random().toString(36).slice(2)}.${file.name.split('.').pop()}`;
        await env.UPLOAD_BUCKET.put(fileName, file, {
          httpMetadata: { contentType: file.type },
          customMetadata: { uploadTime: new Date().toISOString(), originalName: file.name },
        });
        const imageUrl = `https://file.boycot.dpdns.org/${fileName}`;
        return new Response(JSON.stringify({
          success: true,
          data: { url: imageUrl, name: file.name, size: file.size }
        }), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
        });
      } catch (error) {
        console.error("图片上传失败:", error);
        return new Response(JSON.stringify({ success: false, message: "上传失败" }), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
          status: 500,
        });
      }
    }

    // 图片代理
    if (path.startsWith("/api/image/") && request.method === "GET") {
      const fileName = path.replace("/api/image/", "");
      const object = await env.UPLOAD_BUCKET.get(fileName);
      if (!object) {
        return new Response("图片不存在", { status: 404 });
      }
      return new Response(object.body, {
        headers: {
          "Content-Type": object.httpMetadata?.contentType || "image/jpeg",
          "Cache-Control": "public, max-age=31536000",
        },
      });
    }

    return new Response(JSON.stringify({ error: "Not Found" }), {
      headers: corsHeaders,
      status: 404,
    });
  },
  async scheduled(
    event: ScheduledEvent,
    env: {
      KV: KVNamespace;
      ALIYUN_REFRESH_TOKEN: string;
      ALIYUN_CLIENT_ID: string;
      ALIYUN_CLIENT_SECRET: string;
      JIANGUOYUN_USERNAME: string;
      JIANGUOYUN_APP_PASSWORD: string;
      QUARK_API_KEY: string;
    },
    ctx: ExecutionContext
  ): Promise<void> {
    console.log("定时调度任务执行:", new Date().toISOString());
    const sourceConfigStr = await env.KV.get("video_sources");
    if (!sourceConfigStr) {
      console.log("无视频源配置");
      return;
    }
    const sources = JSON.parse(sourceConfigStr);
    for (const source of sources) {
      if (!source.enabled) continue;
      if (!isTimeToFetch(source)) {
        console.log(`源[${source.name}]未到抓取时间，跳过`);
        continue;
      }
      try {
        await setVideoList(source, env);
      } catch (error) {
        console.error(`源[${source.name}]抓取失败:`, error);
        continue;
      }
    }
  },
};