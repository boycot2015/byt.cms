// D1 数据库操作函数 - 分类
export const setCategory = async (body: any, env: any) => {
  // 检查分类是否已存在
  const existing = await env.DB.prepare(
    "SELECT * FROM categories WHERE name = ?"
  ).bind(body.name).first();
  
  if (existing) {
    // 更新现有分类
    const updatedCategory = { ...existing, ...body };
    await env.DB.prepare(
      "UPDATE categories SET name = ?, desc = ?, `order` = ? WHERE id = ?"
    ).bind(updatedCategory.name, updatedCategory.desc || "", updatedCategory.order || 0, updatedCategory.id).run();
    return updatedCategory;
  }
  
  // 创建新分类
  const id = `category:${Date.now()}`;
  const category = {
    id,
    name: body.name,
    desc: body.desc || "",
    order: body.order || 0,
    createTime: new Date().toISOString()
  };
  
  await env.DB.prepare(
    "INSERT INTO categories (id, name, desc, `order`, createTime) VALUES (?, ?, ?, ?, ?)"
  ).bind(category.id, category.name, category.desc, category.order, category.createTime).run();
  
  return category;
};

// D1 数据库操作函数 - 标签
export const setTag = async (body: any, env: any) => {
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
  }
  
  return tag;
};

// 视频存储函数（D1版本）
export const setVideoList = async (source: any, env: any) => {
  if (!source.path) {
    return [];
  }
  try {
    const { fetchVideoBySource } = await import('./videoSourceService');
    const data = await fetchVideoBySource(source, env);
    let videos = data.list || data || [];
    
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
