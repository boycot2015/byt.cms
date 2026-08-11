# 搭建过程

## 1. 项目初始化

### 1.1 创建项目结构
```bash
mkdir -p byt.cms/{api,admin,web,docs}
cd byt.cms
```

### 1.2 初始化 API 服务
```bash
cd api
npm create vite@latest . -- --template cloudflare-workers
npm install
```

### 1.3 初始化管理后台
```bash
cd ../admin
npm create vite@latest . -- --template react-ts
npm install antd axios
```

### 1.4 初始化前端网站
```bash
cd ../web
npm create vite@latest . -- --template vue-ts
npm install vue-router@4 pinia axios tailwindcss
npx tailwindcss init -p
```

## 2. 数据库配置

### 2.1 创建 D1 数据库
```bash
cd ../api
npx wrangler d1 create byt-cms
```

### 2.2 初始化数据库表结构
在 `api/sql/init.sql` 中定义表结构：
- users - 用户表
- categories - 分类表
- videos - 视频表
- tags - 标签表
- video_tags - 视频标签关联表
- comments - 评论表
- video_sources_mapping - 视频源映射表
- site_config - 网站配置表

### 2.3 执行数据库迁移
```bash
npx wrangler d1 execute byt-cms --file=sql/init.sql
```

## 3. API 服务开发

### 3.1 配置路由
在 `api/src/routes/` 目录下创建各模块路由：
- categories.ts - 分类管理
- videos.ts - 视频管理
- tags.ts - 标签管理
- comments.ts - 评论管理
- users.ts - 用户管理
- siteConfig.ts - 网站配置
- upload.ts - 文件上传
- videoSources.ts - 视频源管理

### 3.2 实现数据库服务
在 `api/src/services/dbService.ts` 中实现数据库操作函数。

### 3.3 实现视频源抓取
在 `api/src/services/videoSourceService.ts` 中实现视频源抓取逻辑。

### 3.4 配置 API 文档
在 `api/src/utils/apiDocs.ts` 中配置 OpenAPI 文档。

## 4. 管理后台开发

### 4.1 创建组件
在 `admin/src/components/` 目录下创建各管理组件：
- Category - 分类管理
- Video - 视频管理
- Tag - 标签管理
- Comment - 评论管理
- User - 用户管理
- SiteConfig - 网站配置

### 4.2 实现权限控制
在 `admin/src/hooks/usePermission.jsx` 中实现权限控制逻辑。

### 4.3 配置环境变量
在 `admin/.env` 中配置 API 地址：
```
VITE_API_BASE=https://your-api-endpoint/api
```

## 5. 前端网站开发

### 5.1 配置路由
在 `web/src/router/index.ts` 中配置前端路由：
- / - 首页
- /movie - 电影页
- /detail/:id - 视频详情页

### 5.2 创建组件
在 `web/src/components/` 目录下创建前端组件：
- VideoCard - 视频卡片
- Banner - 轮播图
- Search - 搜索组件
- Comment - 评论组件
- Pagination - 分页组件
- Player - 播放器组件

### 5.3 实现状态管理
在 `web/src/store/` 目录下创建状态管理：
- user.ts - 用户状态
- video.ts - 视频状态

### 5.4 配置环境变量
在 `web/.env` 中配置 API 地址：
```
VITE_API_BASE=https://your-api-endpoint/api
```

## 6. 部署

### 6.1 部署 API 服务
```bash
cd api
npm run deploy
```

### 6.2 部署管理后台
```bash
cd ../admin
npm run build
# 部署到 Vercel 或 Netlify
```

### 6.3 部署前端网站
```bash
cd ../web
npm run build
# 部署到 Vercel 或 Netlify
```

## 7. 测试

### 7.1 API 测试
使用 Postman 或 Swagger UI 测试 API 接口。

### 7.2 功能测试
- 测试视频上传和播放
- 测试分类和标签管理
- 测试评论功能
- 测试用户登录注册

### 7.3 性能测试
- 测试页面加载速度
- 测试 API 响应时间
- 测试数据库查询性能
