
import { sources as sourcesLocal } from "./data/sources";
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
  // console.log(videoDetial?.list, 'videoDetial?.list');
  
  let list = videoDetial?.list?.map((file: any) => ({
    title: file.vod_name || file.title || "",
    subTitle: file.vod_remarks || "",
    desc: file.vod_content || "",
    url: file.vod_play_url?.split('#')?.[0]?.split('$')?.[1] || file.url || "",
    urls: file.vod_play_url?.split('#').map((item: string) => ({
      label: item.split('$')?.[0] || "",
      url: item.split('$')?.[1] || "",
    })).filter((item: any) => item.url) || [],
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
  };
}

// 通用视频抓取函数
async function fetchVideoBySource(sourceConfig: any, env: any) {
  switch (sourceConfig.type) {
    case "quark":
      return await fetchQuarkVideo(sourceConfig, env);
    case "aliyun":
      return await fetchAliyunVideo(sourceConfig, env);
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
    case "custom":
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
  const [minute, hour, day, month, weekday] = cronExpr.split(" ");
  return (
    (minute === "*" || now.getMinutes() === parseInt(minute)) &&
    (hour === "*" || now.getHours() === parseInt(hour)) &&
    (day === "*" || now.getDate() === parseInt(day)) &&
    (month === "*" || now.getMonth() + 1 === parseInt(month)) &&
    (weekday === "*" || now.getDay() === parseInt(weekday))
  );
}

// D1 数据库操作函数 - 分类
const setCategory = async (body: any, env: any) => {
  // 检查分类是否已存在
  const existing = await env.DB.prepare(
    "SELECT * FROM categories WHERE name = ?"
  ).bind(body.name).first();
  
  if (existing) {
    // 更新现有分类
    const updatedCategory = { ...existing, ...body };
    await env.DB.prepare(
      "UPDATE categories SET name = ?, desc = ? WHERE id = ?"
    ).bind(updatedCategory.name, updatedCategory.desc || "", updatedCategory.id).run();
    return updatedCategory;
  }
  
  // 创建新分类
  const id = `category:${Date.now()}`;
  const category = {
    id,
    name: body.name,
    desc: body.desc || "",
    createTime: new Date().toISOString()
  };
  
  await env.DB.prepare(
    "INSERT INTO categories (id, name, desc, createTime) VALUES (?, ?, ?, ?)"
  ).bind(category.id, category.name, category.desc, category.createTime).run();
  
  return category;
};

// D1 数据库操作函数 - 标签
const setTag = async (body: any, env: any) => {
  // 检查标签是否已存在
  const existing = await env.DB.prepare(
    "SELECT * FROM tags WHERE name = ?"
  ).bind(body.name).first();
  
  if (existing) {
    // 更新现有标签
    const updatedTag = { ...existing, ...body };
    await env.DB.prepare(
      "UPDATE tags SET name = ? WHERE id = ?"
    ).bind(updatedTag.name, updatedTag.id).run();
    return updatedTag;
  }
  
  // 创建新标签
  const id = `tag:${Date.now()}`;
  const tag = {
    id,
    name: body.name,
    createTime: new Date().toISOString()
  };
  try {
    await env.DB.prepare(
      "INSERT INTO tags (id, name, createTime) VALUES (?, ?, ?)"
    ).bind(tag.id, tag.name, tag.createTime).run();
  } catch (error) {
    console.log("标签创建失败:", error);
    // throw error;
  }
  
  return tag;
};

// 视频存储函数（D1版本）
const setVideoList = async (source: any, env: any) => {
  if (!source.path) {
    return [];
    // throw new Error("视频源路径不能为空");
  }
  try {
    const data = await withRetry(() => fetchVideoBySource(source, env));
    let videos = data.list || data || [];
    // console.log(videos, 'videos');
    for (const video of videos) {
      // 检查视频是否已存在（通过标题和分类判断）
      const existingVideo = await env.DB.prepare(
        "SELECT * FROM videos WHERE title = ? AND category = ?"
      ).bind(video.title || "", video.category || "").first();
      
      // 处理分类
      const category = await setCategory({ name: video.category || "" }, env);
      
      // 处理标签
      const tagIds: string[] = [];
      if (video.tags && Array.isArray(video.tags)) {
        for (const tagName of video.tags) {
          const tag = await setTag({ name: tagName }, env);
          tagIds.push(tag.id);
        }
      }
      
      // 准备视频数据
      const videoId = existingVideo?.id || `video:${Date.now()}_${Math.random().toString(36).slice(2)}`;
      const videoData = {
        id: videoId,
        ...video,
        actors: JSON.stringify(video.actors || []),
        categoryId: category.id || "",
        director: video.director || "",
        writer: video.writer || "",
        createTime: existingVideo?.createTime || new Date().toISOString(),
        updateTime: new Date().toISOString(),
        status: "active"
      };
      
      // 存储视频
      if (!source.action || source.action === "put") {
        if (existingVideo) {
          // 更新现有视频
          await env.DB.prepare(`
            UPDATE videos 
            SET title = ?, subTitle = ?, desc = ?, cover = ?, 
                category = ?, categoryId = ?, fetchTime = ?, 
                actors = ?, director = ?, writer = ?, updateTime = ?, status = ?
            WHERE id = ?
          `).bind(
            videoData.title, videoData.subTitle, videoData.desc, videoData.cover,
            videoData.category, videoData.categoryId, videoData.fetchTime,
            videoData.actors, videoData.director, videoData.writer,
            videoData.updateTime, videoData.status, videoData.id
          ).run();
          
          // 删除原有标签关联
          await env.DB.prepare(
            "DELETE FROM video_tags WHERE videoId = ?"
          ).bind(videoId).run();
        } else {
          // 插入新视频
          await env.DB.prepare(`
            INSERT INTO videos (
              id, title, subTitle, desc, cover, category,
              categoryId, fetchTime, actors, director, writer,
              createTime, updateTime, status
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
          `).bind(
            videoData.id, videoData.title, videoData.subTitle, videoData.desc, videoData.cover,
            videoData.category, videoData.categoryId, videoData.fetchTime,
            videoData.actors, videoData.director, videoData.writer,
            videoData.createTime, videoData.updateTime, videoData.status
          ).run();
        }
        
        // 添加新的标签关联
        for (const tagId of tagIds) {
          await env.DB.prepare(
            "INSERT OR IGNORE INTO video_tags (videoId, tagId) VALUES (?, ?)"
          ).bind(videoId, tagId).run();
        }
        
        // 检查视频来源是否已存在
        const existingSource = await env.DB.prepare(
          "SELECT * FROM video_sources_mapping WHERE videoId = ? AND source = ?"
        ).bind(videoId, video.source || "").first();
        
        // 准备视频来源数据
        const sourceId = existingSource?.id || `source_mapping:${Date.now()}_${Math.random().toString(36).slice(2)}`;
        const sourceData = {
          id: sourceId,
          videoId: videoId,
          source: video.source || "",
          url: video.url || "",
          urls: JSON.stringify(video.urls || []),
          createTime: existingSource?.createTime || new Date().toISOString(),
          updateTime: new Date().toISOString()
        };
        
        // 存储视频来源
        if (existingSource) {
          // 更新现有来源
          await env.DB.prepare(`
            UPDATE video_sources_mapping 
            SET url = ?, urls = ?, updateTime = ?
            WHERE id = ?
          `).bind(
            sourceData.url, sourceData.urls, sourceData.updateTime, sourceData.id
          ).run();
        } else {
          // 插入新来源
          await env.DB.prepare(`
            INSERT INTO video_sources_mapping (
              id, videoId, source, url, urls, createTime, updateTime
            ) VALUES (?, ?, ?, ?, ?, ?, ?)
          `).bind(
            sourceData.id, sourceData.videoId, sourceData.source,
            sourceData.url, sourceData.urls, sourceData.createTime, sourceData.updateTime
          ).run();
        }
        
        console.log(`成功${existingVideo ? '更新' : '存储'}视频: ${video.title}，来源: ${video.source}`);
      }
    }
    return data;
  } catch (error) {
    console.error(`源[${source.name}]设置失败:`, error);
    throw error;
  }
};
async function fetchVideoRecommend(env: any, params: any = {}) {
  params = {
    cmsname: "maccms10",
    bbjtype: "hot",
    codetype: "php",
    filtercondi: "name",
    orderby: "ASC",
    num: 10,
    level: 9,
    ...params
  }
  // bbjtype : 自动更新最热海报: hot, 自动更新最新海报: new, 各分类均衡获取: even 
  // https://bibij.icu/BBJ-code?cmsname=maccms10&bbjtype=hot&codetype=json&filtercondi=name&orderby=ASC&num=10&level=9
  let res = await withRetry(() => fetch(`https://bibij.icu/BBJ-code?${Object.keys(params).map(key => `${key}=${params[key] || ""}`).join('&')}`)).then(res => res.text());
  const result = [];
  let recommendedVideos = [];
  let match;
  const regex = /vod_pic_slide='([^']+)'[\s,]+vod_level=\d+[\s,]+where[\s,]+vod_name='([^']+)'/g;
  while (match = regex.exec(res)) {
    const pic = match[1];
    const name = match[2];
    result.push({name, pic});
  }
  try {
    console.log("开始更新推荐数据");
    // 获取视频海报数据
    console.log(`获取到 ${result.length} 个视频海报`);
    
    // 更新视频的 banner 字段并设置为推荐
    for (const poster of result) {
      try {
        // 查找匹配的视频（通过标题）
        const video = await env.DB.prepare(
          "SELECT * FROM videos WHERE title LIKE ?"
        ).bind(`%${poster.name}%`).first();
        
        if (video) {
          // 更新视频的 banner 字段和推荐状态
          await env.DB.prepare(
            "UPDATE videos SET banner = ?, recommended = ?, updateTime = ? WHERE id = ?"
          ).bind(poster.pic, true, new Date().toISOString(), video.id).run();
          console.log(`更新视频 ${video.title} 的海报和推荐状态`);
        } else {
          console.log(`未找到匹配的视频: ${poster.name}`);
        }
      } catch (error) {
        console.error(`更新视频 ${poster.name} 失败:`, error);
      }
    }
    
    // 检查推荐视频数量
    recommendedVideos = await env.DB.prepare(
      "SELECT * FROM videos WHERE recommended = 1 ORDER BY updateTime DESC"
    ).all();
    
    console.log(`推荐视频数量: ${recommendedVideos.results.length}`);
    if (recommendedVideos.results.length === 0) {
      console.log("无推荐视频，将使用最近更新的视频作为推荐");
    }
    console.log("推荐数据更新完成");
  } catch (error) {
    console.error("更新推荐数据失败:", error);
  }
  return recommendedVideos.results || result;
}
export default {
  async fetch(
    request: Request,
    env: {
      DB: D1Database; // 替换 KV 为 D1
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
            <span>当前版本：v1.0.0 (D1 数据库版)</span>
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

    // 分类管理
    if (path === "/api/categories" && request.method === "GET") {
      const categories = await env.DB.prepare(
        "SELECT * FROM categories ORDER BY createTime DESC"
      ).all();
      
      return new Response(JSON.stringify(categories.results), {
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

    // 标签管理
    if (path === "/api/tags" && request.method === "GET") {
      const tags = await env.DB.prepare(
        "SELECT * FROM tags ORDER BY createTime DESC"
      ).all();
      
      return new Response(JSON.stringify(tags.results), {
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

    // 视频管理
    if (path === "/api/videos" && request.method === "GET") {
      const id = url.searchParams.get("id");
      const category = url.searchParams.get("category");
      const tag = url.searchParams.get("tag");
      const source = url.searchParams.get("source");
      const search = url.searchParams.get("search");
      const recommended = url.searchParams.get("recommended");
      const page = parseInt(url.searchParams.get("page") || "1");
      const pageSize = parseInt(url.searchParams.get("pageSize") || "10");
      const offset = (page - 1) * pageSize;
      
      // 如果提供了id参数，直接根据id查询单个视频
      if (id) {
        const videoId = id.startsWith("video:") ? id : `video:${id}`;
        const video = await env.DB.prepare("SELECT * FROM videos WHERE id = ?").bind(videoId).first();
        
        if (!video) {
          return new Response(JSON.stringify({ error: "视频不存在" }), {
            headers: { ...corsHeaders, "Content-Type": "application/json" },
            status: 404,
          });
        }
        
        // 获取标签
        const tagRelations = await env.DB.prepare(`
          SELECT t.* FROM video_tags vt
          JOIN tags t ON vt.tagId = t.id
          WHERE vt.videoId = ?
        `).bind(video.id).all();
        
        video.tags = tagRelations.results;
        
        // 获取视频来源
        const sources = await env.DB.prepare(`
          SELECT * FROM video_sources_mapping WHERE videoId = ?
        `).bind(video.id).all();
        
        // 解析来源的JSON字段
        video.sources = sources.results.map((source: any) => {
          source.urls = JSON.parse(source.urls || "[]");
          return source;
        });
        
        return new Response(JSON.stringify(video), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
        });
      }
      
      // 构建查询条件
      let query = "SELECT DISTINCT v.* FROM videos v";
      let countQuery = "SELECT COUNT(DISTINCT v.id) as total FROM videos v";
      const params: any[] = [];
      
      // 标签筛选
      if (tag) {
        query += " JOIN video_tags vt ON v.id = vt.videoId";
        countQuery += " JOIN video_tags vt ON v.id = vt.videoId";
      }
      
      // 来源筛选
      if (source) {
        query += " JOIN video_sources_mapping vsm ON v.id = vsm.videoId";
        countQuery += " JOIN video_sources_mapping vsm ON v.id = vsm.videoId";
      }
      
      //  WHERE 子句
      query += " WHERE 1=1";
      countQuery += " WHERE 1=1";
      
      if (category) {
        query += " AND v.categoryId = ?";
        countQuery += " AND v.categoryId = ?";
        params.push(category);
      }
      
      if (tag) {
        query += " AND vt.tagId = ?";
        countQuery += " AND vt.tagId = ?";
        params.push(tag);
      }
      
      if (source) {
        query += " AND vsm.source = ?";
        countQuery += " AND vsm.source = ?";
        params.push(source);
      }
      
      if (search) {
        query += " AND v.title LIKE ?";
        countQuery += " AND v.title LIKE ?";
        params.push(`%${search}%`);
      }
      
      if (recommended !== null) {
        const isRecommended = recommended === "true";
        query += " AND v.recommended = ?";
        countQuery += " AND v.recommended = ?";
        params.push(isRecommended);
      }
      
      // 获取总数量
      const countResult = await env.DB.prepare(countQuery).bind(...params).first();
      const total = countResult?.total || 0;
      
      // 基础视频查询（带分页）
      let videos:any = await env.DB.prepare(query + " ORDER BY v.updateTime DESC LIMIT ? OFFSET ?").bind(...params, pageSize, offset).all();
      videos = videos.results;
      
      // 补充标签和来源信息
      const videosWithDetails = await Promise.all(videos.map(async (video: any) => {
        // 解析JSON字段
        video.actors = JSON.parse(video.actors || "[]");
        
        // 获取标签
        const tagRelations = await env.DB.prepare(`
          SELECT t.* FROM video_tags vt
          JOIN tags t ON vt.tagId = t.id
          WHERE vt.videoId = ?
        `).bind(video.id).all();
        
        video.tags = tagRelations.results;
        
        // 获取视频来源
        const sources = await env.DB.prepare(`
          SELECT * FROM video_sources_mapping WHERE videoId = ?
        `).bind(video.id).all();
        
        // 解析来源的JSON字段
        video.sources = sources.results.map((source: any) => {
          source.urls = JSON.parse(source.urls || "[]");
          return source;
        });
        
        return video;
      }));
      
      return new Response(JSON.stringify({
        list: videosWithDetails,
        total,
        page,
        pageSize
      }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    if (path.startsWith("/api/videos/") && request.method === "DELETE") {
      const id = path.replace("/api/videos/", "");
      const videoId = `video:${id}`;
      
      // 删除视频来源映射
      await env.DB.prepare(
        "DELETE FROM video_sources_mapping WHERE videoId = ?"
      ).bind(videoId).run();
      
      // 删除视频标签关联
      await env.DB.prepare(
        "DELETE FROM video_tags WHERE videoId = ?"
      ).bind(videoId).run();
      
      // 删除视频
      await env.DB.prepare(
        "DELETE FROM videos WHERE id = ?"
      ).bind(videoId).run();
      
      return new Response(JSON.stringify({ success: true }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    if (path.startsWith("/api/videos/recommended/") && request.method === "POST") {
      const id = path.replace("/api/videos/recommended/", "");
      const videoId = `video:${id}`;
      const body = await request.json();
      const { recommended } = body as any;
      
      // 更新视频推荐状态
      await env.DB.prepare(
        "UPDATE videos SET recommended = ?, updateTime = ? WHERE id = ?"
      ).bind(recommended, new Date().toISOString(), videoId).run();
      
      return new Response(JSON.stringify({ success: true }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    if (path === "/api/videos/recommended" && request.method === "GET") {
      // 首先查询推荐的视频
      const recommendedVideos = await env.DB.prepare(
        "SELECT * FROM videos WHERE recommended = 1 ORDER BY updateTime DESC"
      ).all();
      let videos = recommendedVideos.results;
      
      // 如果没有推荐数据，返回每个分类最近更新的5条数据
      if (videos.length === 0) {
        // 获取所有分类
        const categories = await env.DB.prepare(
          "SELECT DISTINCT categoryId, category FROM videos WHERE categoryId IS NOT NULL AND categoryId != ''"
        ).all();
        
        const categoryList = categories.results;
        const categoryVideos: any[] = [];
        
        // 为每个分类获取最近更新的5条视频
        for (const category of categoryList) {
          const categoryLatestVideos = await env.DB.prepare(
            "SELECT * FROM videos WHERE categoryId = ? ORDER BY updateTime DESC LIMIT 5"
          ).bind(category.categoryId).all();
          
          categoryVideos.push(...categoryLatestVideos.results);
        }
        
        videos = categoryVideos;
      }
      
      // 补充标签和来源信息
      const videosWithDetails = await Promise.all(videos.map(async (video: any) => {
        // 解析JSON字段
        video.actors = JSON.parse(video.actors || "[]");
        
        // 获取标签
        const tagRelations = await env.DB.prepare(`
          SELECT t.* FROM video_tags vt
          JOIN tags t ON vt.tagId = t.id
          WHERE vt.videoId = ?
        `).bind(video.id).all();
        
        video.tags = tagRelations.results;
        
        // 获取视频来源
        const sources = await env.DB.prepare(`
          SELECT * FROM video_sources_mapping WHERE videoId = ?
        `).bind(video.id).all();
        
        // 解析来源的JSON字段
        video.sources = sources.results.map((source: any) => {
          source.urls = JSON.parse(source.urls || "[]");
          return source;
        });
        
        return video;
      }));
      
      return new Response(JSON.stringify(videosWithDetails), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }
    if (path === "/api/videos/recommended/async" && request.method === "GET") {
      let res = await fetchVideoRecommend(env, {
        bbjtype: "hot",
        num: 15,
        level: 1,
      });
      return new Response(JSON.stringify({ success: true, data: res, message: "推荐数据更新完成" }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }
    // 视频源配置管理
    if (path === "/api/video-sources" && request.method === "POST") {
      const body = await request.json();
      
      // 清空现有配置（或根据需求改为增量更新）
      await env.DB.prepare("DELETE FROM video_sources").run();
      
      // 插入新配置
      if (Array.isArray(body)) {
        for (const source of body) {
          const id = source.id || `source:${Date.now()}_${Math.random().toString(36).slice(2)}`;
          await env.DB.prepare(`
            INSERT INTO video_sources (
              id, name, type, cron, enabled, path, categoryId, category, tags, action
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
          `).bind(
            id,
            source.name || "",
            source.type || "",
            source.cron || "* * * * *",
            source.enabled !== false,
            source.path || "",
            source.categoryId || "",
            source.category || "",
            JSON.stringify(source.tags || []),
            source.action || "put"
          ).run();
        }
      }
      
      return new Response(JSON.stringify({ success: true }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    if (path === "/api/video-sources" && request.method === "GET") {
      const sources = await env.DB.prepare("SELECT * FROM video_sources").all();
      
      // 解析JSON字段
      const parsedSources = sources.results.map((source: any) => {
        source.tags = JSON.parse(source.tags || "[]");
        source.category = parseInt(source.category);
        return source;
      });
      return new Response(JSON.stringify(parsedSources), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    // 手动抓取视频源数据
    if (path.startsWith("/api/video-source-data/") && request.method === "GET") {
      const type = path.replace("/api/video-source-data/", "");
      const action = url.searchParams.get("action");
      const cid = url.searchParams.get("cid");
      
      // 获取视频源配置
      const sources:any = await env.DB.prepare(
        "SELECT * FROM video_sources WHERE type = ?"
      ).bind(type).all();
      
      const source = sources.results.find((s: any) => s.type === type) || {
        ...sourcesLocal[type],
        "action": "put"
      };      
      if (!source) {
        return new Response(JSON.stringify({ error: "视频源不存在" }), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
          status: 404
        });
      }
      if (source.path) {
        // 处理路径参数
        if (source.path.includes("t=")) {
          source.path = source.path.replace(/t=([^&]*)/g, `t=${cid || ""}`);
        } else {
          source.path += `&t=${cid || ""}`;
        }
      }
      
      // console.log(source.path, 'source.path');
      
      // 抓取并存储视频数据
      const data = await setVideoList({ ...source, action }, env);
      
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

    // 用户管理
    if (path === "/api/users" && request.method === "GET") {
      const users = await env.DB.prepare(
        "SELECT id, username, nickname, avatar, role, status, createTime, updateTime FROM users ORDER BY createTime DESC"
      ).all();
      
      return new Response(JSON.stringify(users.results), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    if (path === "/api/users/register" && request.method === "POST") {
      const body = await request.json();
      const { username, password, nickname } = body as any;
      
      if (!username || !password) {
        return new Response(JSON.stringify({ error: "用户名和密码不能为空" }), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
          status: 400,
        });
      }
      
      // 检查用户是否已存在
      const existing = await env.DB.prepare(
        "SELECT * FROM users WHERE username = ?"
      ).bind(username).first();
      const users = await env.DB.prepare(
        "SELECT id, username, nickname, avatar, role, status, createTime, updateTime FROM users ORDER BY createTime DESC"
      ).raw();
      if (existing) {
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
        password, // 实际项目中应该加密密码
        nickname: nickname || username,
        avatar: "",
        role: users?.length ? 'user' : "admin",
        status: "active",
        createTime: now,
        updateTime: now
      };
      
      await env.DB.prepare(
        "INSERT INTO users (id, username, password, nickname, avatar, role, status, createTime, updateTime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
      ).bind(user.id, user.username, user.password, user.nickname, user.avatar, user.role, user.status, user.createTime, user.updateTime).run();
      
      // 不返回密码
      const { password: _, ...userWithoutPassword } = user;
      return new Response(JSON.stringify(userWithoutPassword), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 201,
      });
    }

    if (path === "/api/users/login" && request.method === "POST") {
      const body = await request.json();
      const { username, password } = body as any;
      
      if (!username || !password) {
        return new Response(JSON.stringify({ error: "用户名和密码不能为空" }), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
          status: 400,
        });
      }
      
      // 查找用户
      const user = await env.DB.prepare(
        "SELECT * FROM users WHERE username = ?"
      ).bind(username).first();
      
      if (!user || user.password !== password) {
        return new Response(JSON.stringify({ error: "用户名或密码错误" }), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
          status: 401,
        });
      }
      
      // 检查用户状态
      if (user.status !== 'active') {
        return new Response(JSON.stringify({ error: "用户已被禁用，请联系管理员" }), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
          status: 403,
        });
      }
      
      // 不返回密码
      const { password: _, ...userWithoutPassword } = user;
      return new Response(JSON.stringify({
        success: true,
        user: userWithoutPassword
      }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    if (path.startsWith("/api/users/") && request.method === "POST") {
      const id = path.replace("/api/users/", "");
      const userId = `user:${id}`;
      const body:any = await request.json();
      
      // 检查用户是否存在
      const oldUser = await env.DB.prepare(
        "SELECT * FROM users WHERE id = ?"
      ).bind(userId).first();
      
      if (!oldUser) {
        return new Response(JSON.stringify({ error: "用户不存在" }), {
          headers: { ...corsHeaders, "Content-Type": "application/json" },
          status: 404,
        });
      }
      
      // 更新用户
      const now = new Date().toISOString();
      const newUser:any = {
        ...oldUser,
        nickname: body.nickname || oldUser.nickname,
        avatar: body.avatar || oldUser.avatar,
        role: body.role || oldUser.role,
        status: body.status || oldUser.status,
        updateTime: now
      };
      
      if (body.password) {
        newUser.password = body.password;
      }
      
      await env.DB.prepare(`
        UPDATE users 
        SET nickname = ?, avatar = ?, role = ?, status = ?, password = ?, updateTime = ?
        WHERE id = ?
      `).bind(
        newUser.nickname, newUser.avatar, newUser.role, newUser.status,
        newUser.password, newUser.updateTime, userId
      ).run();
      
      // 不返回密码
      const { password: _, ...userWithoutPassword } = newUser as any;
      return new Response(JSON.stringify(userWithoutPassword), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
      });
    }

    if (path.startsWith("/api/users/") && request.method === "DELETE") {
      const id = path.replace("/api/users/", "");
      const userId = `user:${id}`;
      
      // 删除用户
      await env.DB.prepare(
        "DELETE FROM users WHERE id = ?"
      ).bind(userId).run();
      
      return new Response(JSON.stringify({ success: true }), {
        headers: { ...corsHeaders, "Content-Type": "application/json" },
        status: 200,
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
      DB: D1Database; // 替换 KV 为 D1
      ALIYUN_REFRESH_TOKEN: string;
      ALIYUN_CLIENT_ID: string;
      ALIYUN_CLIENT_SECRET: string;
      JIANGUOYUN_USERNAME: string;
      JIANGUOYUN_APP_PASSWORD: string;
      QUARK_API_KEY: string;
    },
    ctx: ExecutionContext
  ): Promise<void> {
    console.log("定时调度任务执行:", new Date().toLocaleString());
    
    // 获取所有视频源配置
    const sources:any = await env.DB.prepare("SELECT * FROM video_sources WHERE enabled = 1").all();
    
    if (sources.results.length === 0) {
      console.log("无启用的视频源配置");
    } else {
      for (const source of sources.results) {
        // 解析JSON字段
        source.tags = JSON.parse(source.tags || "[]");
        
        // 检查是否到抓取时间
        if (!isTimeToFetch(source)) {
          console.log(`源[${source.name}]未到抓取时间，跳过`);
          continue;
        }
        
        try {
          await setVideoList(source, env);
          console.log(`源[${source.name}]抓取完成`);
        } catch (error) {
          console.error(`源[${source.name}]抓取失败:`, error);
          continue;
        }
      }
    }
    
    // 调用推荐API更新推荐数据
    await fetchVideoRecommend(env);
  },
};