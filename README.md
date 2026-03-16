# 影视在线 CMS 系统

## 项目简介

影视在线 CMS 系统是一个完整的视频网站解决方案，包含前端网站、管理后台和API服务三个模块。该系统支持视频管理、文章管理、分类管理等功能，为用户提供优质的视频观看体验。

## 技术栈

### 前端网站 (web)
- **框架**: Vue 3 + TypeScript
- **构建工具**: Vite
- **样式**: TailwindCSS
- **状态管理**: Pinia
- **路由**: Vue Router
- **HTTP客户端**: Axios
- **视频播放器**: XGPlayer

### 管理后台 (admin)
- **框架**: React + TypeScript
- **UI组件库**: Ant Design
- **富文本编辑器**: WangEditor
- **视频播放器**: XGPlayer
- **HTTP客户端**: Axios

### API服务 (api)
- **运行环境**: Cloudflare Workers
- **语言**: TypeScript
- **数据库**: Cloudflare D1

## 功能介绍

### 前端网站
- **首页**: 轮播推荐视频、分类视频列表、排行榜
- **电影页**: 电影分类浏览、分页加载、搜索功能
- **详情页**: 视频播放、剧集选择、相关推荐
- **搜索功能**: 支持关键词搜索、下拉建议
- **主题切换**: 支持亮色/暗色主题
- **用户系统**: 登录注册功能

### 管理后台
- **视频管理**: 视频上传、编辑、删除、推荐设置
- **文章管理**: 文章发布、编辑、删除
- **分类管理**: 分类创建、编辑、排序
- **标签管理**: 标签创建、编辑
- **用户管理**: 用户权限管理

### API服务
- **视频接口**: 视频列表、详情、推荐
- **文章接口**: 文章列表、详情
- **分类接口**: 分类列表、排序
- **搜索接口**: 支持关键词搜索
- **用户接口**: 登录、注册

## 本地启动

### 前置条件
- Node.js 18.0.0+
- npm 9.0.0+
- Cloudflare Workers CLI (wrangler)

### 启动步骤

#### 1. 启动 API 服务
```bash
cd api
npm install
npm run dev
```

#### 2. 启动管理后台
```bash
cd admin
npm install
npm run dev
```

#### 3. 启动前端网站
```bash
cd web
npm install
npm run dev
```

## 生产发布

### API 服务
```bash
cd api
npm run deploy
```

### 管理后台
```bash
cd admin
npm run build
# 将 dist 目录部署到静态网站托管服务
```

### 前端网站
```bash
cd web
npm run build
# 将 dist 目录部署到静态网站托管服务
```

## 开源代码贡献

### 贡献流程
1. Fork 本仓库
2. 创建特性分支 (`git checkout -b feature/amazing-feature`)
3. 提交更改 (`git commit -m 'Add some amazing feature'`)
4. 推送到分支 (`git push origin feature/amazing-feature`)
5. 打开 Pull Request

### 代码规范
- **前端**: 遵循 ESLint 规则
- **API**: 遵循 TypeScript 最佳实践
- **提交信息**: 清晰描述更改内容

### 开发建议
- 提交代码前确保所有测试通过
- 为新功能添加适当的测试
- 保持代码风格一致
- 提供详细的代码注释

## 项目结构

```
byt.cms/
├── admin/            # 管理后台
│   ├── src/          # 源代码
│   └── package.json  # 依赖配置
├── api/              # API服务
│   ├── src/          # 源代码
│   └── wrangler.toml # Cloudflare配置
├── web/              # 前端网站
│   ├── src/          # 源代码
│   └── package.json  # 依赖配置
└── README.md         # 项目文档
```

## 许可证

MIT License

## 联系方式

如有问题或建议，请通过 GitHub Issues 提出。