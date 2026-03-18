-- 分类表
CREATE TABLE IF NOT EXISTS categories (
  id TEXT PRIMARY KEY,
  name TEXT NOT NULL UNIQUE,
  desc TEXT DEFAULT '',
  `order` INTEGER DEFAULT 0,
  createTime TEXT NOT NULL
);

-- 标签表
CREATE TABLE IF NOT EXISTS tags (
  id TEXT PRIMARY KEY,
  name TEXT NOT NULL UNIQUE,
  createTime TEXT NOT NULL
);

-- 文章表
CREATE TABLE IF NOT EXISTS articles (
  id TEXT PRIMARY KEY,
  title TEXT NOT NULL,
  content TEXT NOT NULL,
  categoryId TEXT,
  createdAt TEXT NOT NULL,
  updatedAt TEXT NOT NULL,
  FOREIGN KEY (categoryId) REFERENCES categories(id)
);

-- 文章标签关联表
CREATE TABLE IF NOT EXISTS article_tags (
  articleId TEXT NOT NULL,
  tagId TEXT NOT NULL,
  PRIMARY KEY (articleId, tagId),
  FOREIGN KEY (articleId) REFERENCES articles(id),
  FOREIGN KEY (tagId) REFERENCES tags(id)
);

-- 视频表
CREATE TABLE IF NOT EXISTS videos (
  id TEXT PRIMARY KEY,
  title TEXT NOT NULL,
  desc TEXT DEFAULT '',
  subTitle TEXT DEFAULT '',
  cover TEXT DEFAULT '',
  banner TEXT DEFAULT '',
  size INTEGER DEFAULT 0,
  category TEXT DEFAULT '',
  categoryId TEXT,
  fetchTime TEXT DEFAULT '',
  path TEXT DEFAULT '',
  actors TEXT DEFAULT '[]',
  director TEXT DEFAULT '',
  writer TEXT DEFAULT '',
  createTime TEXT NOT NULL,
  updateTime TEXT NOT NULL,
  status TEXT DEFAULT 'active',
  recommended BOOLEAN DEFAULT false,
  FOREIGN KEY (categoryId) REFERENCES categories(id)
);

-- 视频来源表
CREATE TABLE IF NOT EXISTS video_sources_mapping (
  id TEXT PRIMARY KEY,
  videoId TEXT NOT NULL,
  source TEXT NOT NULL,
  url TEXT NOT NULL,
  urls TEXT DEFAULT '[]',
  createTime TEXT NOT NULL,
  updateTime TEXT NOT NULL,
  FOREIGN KEY (videoId) REFERENCES videos(id)
);

-- 视频标签关联表
CREATE TABLE IF NOT EXISTS video_tags (
  videoId TEXT NOT NULL,
  tagId TEXT NOT NULL,
  PRIMARY KEY (videoId, tagId),
  FOREIGN KEY (videoId) REFERENCES videos(id),
  FOREIGN KEY (tagId) REFERENCES tags(id)
);

-- 视频源配置表
CREATE TABLE IF NOT EXISTS video_sources (
  id TEXT PRIMARY KEY,
  name TEXT NOT NULL,
  type TEXT NOT NULL,
  cron TEXT DEFAULT '* * * * *',
  enabled BOOLEAN DEFAULT true,
  path TEXT NOT NULL,
  categoryId TEXT DEFAULT '',
  category TEXT DEFAULT '',
  tags TEXT DEFAULT '[]',
  action TEXT DEFAULT 'put'
);

-- 用户表
CREATE TABLE IF NOT EXISTS users (
  id TEXT PRIMARY KEY,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL,
  nickname TEXT DEFAULT '',
  avatar TEXT DEFAULT '',
  role TEXT DEFAULT 'user',
  status TEXT DEFAULT 'active',
  createTime TEXT NOT NULL,
  updateTime TEXT NOT NULL
);

-- 评论表
CREATE TABLE IF NOT EXISTS comments (
  id TEXT PRIMARY KEY,
  videoId TEXT NOT NULL,
  episodeId TEXT DEFAULT NULL,
  userId TEXT NOT NULL,
  content TEXT NOT NULL,
  parentId TEXT DEFAULT NULL,
  likes INTEGER DEFAULT 0,
  status TEXT DEFAULT 'active',
  createTime TEXT NOT NULL,
  updateTime TEXT NOT NULL,
  currentTime INTEGER DEFAULT 0,
  FOREIGN KEY (videoId) REFERENCES videos(id),
  FOREIGN KEY (userId) REFERENCES users(id),
  FOREIGN KEY (parentId) REFERENCES comments(id)
);

-- 网站配置表
CREATE TABLE IF NOT EXISTS site_config (  
  id TEXT PRIMARY KEY,
  userId TEXT NOT NULL,  -- 关联管理员用户
  logo TEXT DEFAULT '',  -- 网站logo
  title TEXT DEFAULT '',  -- 网站标题
  bannerCount INTEGER DEFAULT 6,  -- 首页banner展示数量（最多6个）
  categoryIds TEXT DEFAULT '[]',  -- 首页分类列表展示的分类id（JSON数组）
  categoryCols INTEGER DEFAULT 5,  -- 首页分类一行展示几个
  categoryRows INTEGER DEFAULT 1,  -- 首页分类展示几行
  recommendTitle TEXT DEFAULT '',  -- 首页推荐标题
  rankingCategoryIds TEXT DEFAULT '[]',  -- 首页排行展示的分类id（JSON数组）
  rankingCount INTEGER DEFAULT 8,  -- 首页排行每个分类展示几个
  links TEXT DEFAULT '[]',  -- 网站底部友情链接（JSON数组）
  createTime TEXT NOT NULL,
  updateTime TEXT NOT NULL,
  FOREIGN KEY (userId) REFERENCES users(id)
);

-- 创建索引提升查询性能
CREATE INDEX IF NOT EXISTS idx_videos_categoryId ON videos(categoryId);
CREATE INDEX IF NOT EXISTS idx_videos_source_mapping_videoId ON video_sources_mapping(videoId);
CREATE INDEX IF NOT EXISTS idx_videos_source_mapping_source ON video_sources_mapping(source);
CREATE INDEX IF NOT EXISTS idx_categories_name ON categories(name);
CREATE INDEX IF NOT EXISTS idx_tags_name ON tags(name);
CREATE INDEX IF NOT EXISTS idx_users_username ON users(username);
CREATE INDEX IF NOT EXISTS idx_comments_videoId ON comments(videoId);
CREATE INDEX IF NOT EXISTS idx_comments_episodeId ON comments(episodeId);
CREATE INDEX IF NOT EXISTS idx_comments_userId ON comments(userId);
CREATE INDEX IF NOT EXISTS idx_comments_parentId ON comments(parentId);
CREATE INDEX IF NOT EXISTS idx_site_config_userId ON site_config(userId);