import { withRetry } from "../utils/withRetry";
import { fetchVideoBySource } from "./videoSourceService";

export const setCategory = async (body: any, env: any) => {
  const existing = await env.DB.prepare(
    "SELECT * FROM categories WHERE name = ?"
  ).bind(body.name).first();
  
  if (existing) {
    const updatedCategory = { ...existing, ...body };
    await env.DB.prepare(
      "UPDATE categories SET name = ?, desc = ?, `order` = ?, status = ? WHERE id = ?"
    ).bind(updatedCategory.name, updatedCategory.desc || "", updatedCategory.order || 0, updatedCategory.status || "active", updatedCategory.id).run();
    return updatedCategory;
  }
  
  const id = `category:${Date.now()}`;
  const category = {
    id,
    name: body.name,
    desc: body.desc || "",
    order: body.order || 0,
    status: body.status || "active",
    createTime: new Date().toISOString()
  };
  
  await env.DB.prepare(
    "INSERT INTO categories (id, name, desc, `order`, status, createTime) VALUES (?, ?, ?, ?, ?, ?)"
  ).bind(category.id, category.name, category.desc, category.order, category.status, category.createTime).run();
  
  return category;
};

export const setTag = async (body: any, env: any) => {
  const existing = await env.DB.prepare(
    "SELECT * FROM tags WHERE id = ?"
  ).bind(body.id || '').first();
  if (existing) {
    const updatedTag = { name: body.name, id: existing.id };
    await env.DB.prepare(
      "UPDATE tags SET name = ? WHERE id = ?"
    ).bind(updatedTag.name, updatedTag.id).run();
    return updatedTag;
  }
  
  const existingByName = await env.DB.prepare(
    "SELECT * FROM tags WHERE name = ?"
  ).bind(body.name).first();
  if (existingByName) {
    return existingByName;
  }
  
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
    return tag;
  } catch (error) {
    console.log("标签创建失败:", (error as Error).message);
    return null;
  }
};

export const setVideoList = async (source: any, env: any) => {
  if (!source.path) {
    console.warn(`源[${source.name || '未知'}] path 未配置，跳过抓取`);
    return [];
  }
  if (!source.type) {
    console.warn(`源[${source.name || '未知'}] type 未配置，跳过抓取`);
    return [];
  }
  try {
    const data = await withRetry(
      () => fetchVideoBySource(source, env),
      3,
      1500,
      `抓取源[${source.name || source.type}]`
    );
    let videos = data.list || data || [];
    if (!source.action || source.action === "put") {
      for (const video of videos) {
        const existingVideo = await env.DB.prepare(
          "SELECT * FROM videos WHERE title = ? AND category = ?"
        ).bind(video.title || "", video.category || "").first();
        
        const category = await setCategory({ name: video.category || "" }, env);
        
        const tagIds: string[] = [];
        if (video.tags && Array.isArray(video.tags)) {
          for (const tagName of video.tags) {
            const tag = await setTag({ name: tagName }, env);
            if (tag) {
              tagIds.push(tag.id);
            }
          }
        }
        
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
        
        if (existingVideo) {
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
          
          await env.DB.prepare(
            "DELETE FROM video_tags WHERE videoId = ?"
          ).bind(videoId).run();
        } else {
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
        
        for (const tagId of tagIds) {
          await env.DB.prepare(
            "INSERT OR IGNORE INTO video_tags (videoId, tagId) VALUES (?, ?)"
          ).bind(videoId, tagId).run();
        }
        
        const existingSource = await env.DB.prepare(
          "SELECT * FROM video_sources_mapping WHERE videoId = ? AND source = ?"
        ).bind(videoId, video.source || "").first();
        
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
        
        if (existingSource) {
          await env.DB.prepare(`
            UPDATE video_sources_mapping 
            SET url = ?, urls = ?, updateTime = ?
            WHERE id = ?
          `).bind(
            sourceData.url, sourceData.urls, sourceData.updateTime, sourceData.id
          ).run();
        } else {
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
    const e = error as Error;
    console.error(`源[${source.name}]设置失败: ${e.message}`);
    if (e.stack) {
      console.error(e.stack);
    }
    throw error;
  }
};

export async function fetchVideoRecommend(env: any, params: any = {}) {
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
  
  let res = await fetch(`https://bibij.icu/BBJ-code?${Object.keys(params).map(key => `${key}=${params[key] || ""}`).join('&')}`).then(res => res.text());
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
    
    for (const poster of result) {
      try {
        const video = await env.DB.prepare(
          "SELECT * FROM videos WHERE title LIKE ?"
        ).bind(`%${poster.name}%`).first();
        
        if (video) {
          await env.DB.prepare(
            "UPDATE videos SET banner = ?, recommended = ?, updateTime = ? WHERE id = ?"
          ).bind(poster.pic, true, new Date().toISOString(), video.id).run();
          console.log(`更新视频 ${video.title} 的海报和推荐状态`);
        } else {
          console.log(`未找到匹配的视频: ${poster.name}`);
        }
      } catch (error) {
        console.error(`更新视频 ${poster.name} 失败:`, (error as Error).message);
      }
    }
    
    recommendedVideos = await env.DB.prepare(
      "SELECT * FROM videos WHERE recommended = 1 ORDER BY updateTime DESC"
    ).all();
    
    console.log(`推荐视频数量: ${recommendedVideos.results.length}`);
    if (recommendedVideos.results.length === 0) {
      console.log("无推荐视频，将使用最近更新的视频作为推荐");
    }
    console.log("推荐数据更新完成");
  } catch (error) {
    console.error("更新推荐数据失败:", (error as Error).message);
  }
  return recommendedVideos.results || result;
}