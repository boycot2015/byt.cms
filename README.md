# 影视在线项目总结

## 项目概述

影视在线是一个现代化的视频网站项目，包含三个主要部分：

- **admin**：基于 React + Vite 的管理后台
- **api**：基于 Cloudflare Workers + D1 数据库的 API 服务
- **web**：基于 Vue 3 + Vite + Tailwind CSS 的前端网站

## 技术栈

### 前端 (web)
- Vue 3 + Composition API
- TypeScript
- Vite
- Tailwind CSS
- Vue Router
- Pinia (状态管理)
- Axios (API 调用)

### 管理后台 (admin)
- React 18
- TypeScript
- Vite
- Ant Design
- Axios

### API 服务 (api)
- Cloudflare Workers
- D1 Database (SQLite)
- TypeScript
- Wrangler

## 核心功能

### 前端网站
- 视频列表展示与分页
- 视频详情页
- 分类筛选
- 搜索功能
- 推荐视频
- 评论系统
- 会员登录注册
- 响应式设计
- 主题切换

### 管理后台
- 视频管理（上传、编辑、删除）
- 分类管理（增删改查、排序、启用/禁用）
- 标签管理（增删改查）
- 评论管理（审核、删除）
- 用户管理（增删改查）
- 网站配置（logo、标题、友情链接等）
- 视频源管理（配置、抓取）

### API 服务
- RESTful API 设计
- 数据库操作（D1）
- 文件上传（R2）
- 视频源抓取
- 推荐算法
- API 文档（Swagger）

## 项目结构

```
├── admin/          # 管理后台
├── api/            # API 服务
├── web/            # 前端网站
├── docs/           # 项目文档
└── README.md       # 项目说明
```

## 本地开发

### 前置条件
- Node.js v20.0.0 或更高
- npm 或 pnpm
- Cloudflare 账户（用于 Workers 和 D1）

### 启动步骤

1. **安装依赖**
   ```bash
   # 安装 API 依赖
   cd api && npm install
   
   # 安装管理后台依赖
   cd ../admin && npm install
   
   # 安装前端依赖
   cd ../web && npm install
   ```

2. **配置环境变量**
   - API: 复制 `.env.example` 为 `.env` 并填写相关配置
   - Admin: 复制 `.env.example` 为 `.env` 并填写相关配置
   - Web: 复制 `.env.example` 为 `.env` 并填写相关配置

3. **启动服务**
   ```bash
   # 启动 API 服务（开发模式）
   cd api && npm run dev
   
   # 启动管理后台
   cd ../admin && npm run dev
   
   # 启动前端网站
   cd ../web && npm run dev
   ```

## 生产部署

### API 服务
```bash
cd api && npm run deploy
```

### 管理后台
```bash
cd admin && npm run build
# 部署到静态网站托管服务
```

### 前端网站
```bash
cd web && npm run build
# 部署到静态网站托管服务
```

## 文档

- [搭建过程](./docs/setup.md)
- [遇到的坑及解决方案](./docs/issues.md)
- [API 文档](./api/public/docs/api-docs.md)
- [开发规范](./docs/guidelines.md)

## 贡献指南

1. Fork 项目
2. 创建特性分支
3. 提交更改
4. 推送分支
5. 开启 Pull Request

## 许可证

MIT License
