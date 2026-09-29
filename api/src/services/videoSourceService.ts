import { withRetry } from '../utils/withRetry';
import { AliyunDriveClient } from '../clients/AliyunDriveClient';
import { JianguoYunWebDAV } from '../clients/JianguoYunWebDAV';
import { hasSensitiveWords, randomImage } from '../utils/index';

async function safeFetchJson(url: string, label = "请求"): Promise<any> {
  const res = await fetch(url);
  if (!res.ok) {
    throw new Error(`[${label}] HTTP ${res.status} ${res.statusText}, URL: ${url}`);
  }
  const text = await res.text();
  try {
    return JSON.parse(text);
  } catch {
    throw new Error(`[${label}] JSON解析失败, URL: ${url}, 响应前200字: ${text.slice(0, 200)}`);
  }
}

export async function fetchQuarkVideo(sourceConfig: any, env: any) {
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
  }, 3, 1000, "夸克网盘API");
  if (!response.ok) throw new Error(`夸克网盘API请求失败: HTTP ${response.status}`);
  const data: any = await response.json();
  return (data.data.files || [])
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

export async function fetchAliyunVideo(sourceConfig: any, env: any) {
  if (!env.ALIYUN_REFRESH_TOKEN) {
    throw new Error("缺少阿里云盘环境变量: ALIYUN_REFRESH_TOKEN");
  }
  const client = new AliyunDriveClient(env);
  const videoFiles = await client.listVideoFiles(sourceConfig.path || "/");
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

export async function fetchJianguoYunVideo(sourceConfig: any, env: any) {
  const davClient = new JianguoYunWebDAV(env);
  const videos = await davClient.listVideoFiles(sourceConfig.path || "/");
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

export async function fetchCmsVideo(sourceConfig: any, env: any) {
  const listUrl = sourceConfig.path || "";
  if (!listUrl) {
    throw new Error("CMS视频源 path 为空");
  }
  const detailUrl = listUrl.includes('?ac=list')
    ? listUrl.replace('?ac=list', '?ac=detail')
    : listUrl;

  const video: any = await safeFetchJson(listUrl, "CMS-list");
  const videoDetail: any = await safeFetchJson(detailUrl, "CMS-detail");

  const rawList: any[] = videoDetail?.list || video?.list || [];
  const list = rawList.map((file: any) => ({
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
    cover: hasSensitiveWords(file.vod_name + file.type_name) ? randomImage() : file.vod_pic || "",
    size: file.vod_total || 0,
    source: file.vod_play_from?.split('$$$')?.[0] || sourceConfig.type || "默认源",
    category: file.type_name || "默认分类",
    tags: [file.vod_area, file.vod_lang].filter((tag: string) => tag),
    fetchTime: file.vod_time || "",
    path: file.path || "",
  }));
  return {
    list,
    page: video?.page || 0,
    limit: video?.limit || 0,
    total: video?.total || 0,
    categories: video?.class?.map((item: any) => ({
      id: item?.type_id ? Number(item.type_id) : '',
      name: item?.type_name || '',
    })) || []
  };
}

export async function fetchVideoBySource(sourceConfig: any, env: any) {
  const type = sourceConfig?.type;
  switch (type) {
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
    case "":
      throw new Error(`视频源[${sourceConfig?.name || '未知'}] type 未配置`);
    case undefined:
      throw new Error(`视频源[${sourceConfig?.name || '未知'}] type 未配置`);
    default:
      throw new Error(`不支持的视频源类型: ${type}`);
  }
}

export function isTimeToFetch(sourceConfig: any): boolean {
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