# 遇到的坑及解决方案

## 1. 数据库相关

### 1.1 D1 数据库连接问题
**问题**：Cloudflare Workers 本地开发时无法连接到 D1 数据库
**解决方案**：
- 确保使用最新版本的 Wrangler
- 在 `wrangler.toml` 中正确配置数据库绑定
- 使用 `npx wrangler dev` 启动开发服务器

### 1.2 外键约束失败
**问题**：插入数据时出现 `FOREIGN KEY constraint failed` 错误
**解决方案**：
- 确保关联表中的记录存在
- 在插入数据前先检查关联记录
- 使用 `INSERT OR IGNORE` 语句避免重复插入

**解决方案代码示例**：
```typescript
// api/src/services/dbService.ts - 标签处理优化
import { setTag } from './dbService';

export const setTag = async (body: any, env: any) => {
  // 检查标签是否已存在（通过ID）
  const existing = await env.DB.prepare(
    "SELECT * FROM tags WHERE id = ?"
  ).bind(body.id || '').first();
  
  if (existing) {
    // 更新现有标签
    const updatedTag = { name: body.name, id: existing.id };
    await env.DB.prepare(
      "UPDATE tags SET name = ? WHERE id = ?"
    ).bind(updatedTag.name, updatedTag.id).run();
    return updatedTag;
  }
  
  // 检查标签是否已存在（通过名称）
  const existingByName = await env.DB.prepare(
    "SELECT * FROM tags WHERE name = ?"
  ).bind(body.name).first();
  
  if (existingByName) {
    return existingByName;
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
    return tag;
  } catch (error) {
    console.log("标签创建失败:", error);
    return null;
  }
};

// 视频标签关联处理
const handleVideoTags = async (videoId: string, tagNames: string[], env: any) => {
  const tagIds: string[] = [];
  
  for (const tagName of tagNames) {
    const tag = await setTag({ name: tagName }, env);
    if (tag) {
      tagIds.push(tag.id);
    }
  }
  
  // 批量插入标签关联
  for (const tagId of tagIds) {
    await env.DB.prepare(
      "INSERT OR IGNORE INTO video_tags (videoId, tagId) VALUES (?, ?)"
    ).bind(videoId, tagId).run();
  }
};
```

### 1.3 数据库查询性能
**问题**：大量数据时查询速度慢
**解决方案**：
- 添加适当的索引
- 使用分页查询
- 优化 SQL 语句，避免复杂的 JOIN 操作

## 2. API 服务相关

### 2.1 `__dirname is not defined` 错误
**问题**：在 Cloudflare Workers 环境中使用 Node.js 特定的 `__dirname` 变量
**解决方案**：
- 移除 `fs` 和 `path` 模块的引用
- 将静态内容直接嵌入到代码中作为模板字面量

**解决方案代码示例**：
```typescript
// 错误代码（Node.js 环境）
import fs from 'fs';
import path from 'path';

const templatePath = path.join(__dirname, 'templates', 'docute.html');
const template = fs.readFileSync(templatePath, 'utf8');

// 修复后代码（Cloudflare Workers 环境）
// 直接将模板内容嵌入为字符串
const docuteTemplate = `
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>API 文档</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/docute@4/dist/docute.css">
</head>
<body>
  <div id="docute"></div>
  <script src="https://cdn.jsdelivr.net/npm/docute@4/dist/docute.js"></script>
  <script>
    new Docute({
      title: 'API 文档',
      nav: [
        { title: '首页', path: '/' },
        { title: 'API', path: '/api' }
      ],
      sidebar: [
        { title: '概览', path: '/' },
        { title: '认证', path: '/auth' },
        { title: '分类', path: '/categories' },
        { title: '视频', path: '/videos' }
      ]
    })
  </script>
</body>
</html>
`;

// 使用模板
return new Response(docuteTemplate, {
  headers: { 'Content-Type': 'text/html' }
});
```

### 2.2 跨域问题
**问题**：前端请求 API 时出现 CORS 错误
**解决方案**：
- 在 API 响应中添加正确的 CORS 头
- 使用 `corsHeaders` 常量统一管理 CORS 配置

**解决方案代码示例**：
```typescript
// api/src/index.ts - CORS 配置

// 统一的 CORS 头配置
const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, OPTIONS",
  "Access-Control-Allow-Headers": "Content-Type, Authorization",
  "Access-Control-Max-Age": "86400" // 24小时
};

// 处理 OPTIONS 请求（预检请求）
if (request.method === "OPTIONS") {
  return new Response("OK", {
    headers: corsHeaders
  });
}

// 在所有响应中添加 CORS 头
const response = await handleRequest(request, env);
if (response) {
  const headers = new Headers(response.headers);
  // 添加 CORS 头
  Object.entries(corsHeaders).forEach(([key, value]) => {
    headers.set(key, value);
  });
  return new Response(response.body, {
    status: response.status,
    statusText: response.statusText,
    headers
  });
}
```

### 2.3 视频源抓取失败
**问题**：视频源 API 调用失败或数据格式不一致
**解决方案**：
- 实现重试机制（使用 `withRetry` 函数）
- 对不同视频源的返回数据进行统一处理
- 添加错误处理和日志记录

**解决方案代码示例**：
```typescript
// api/src/utils/withRetry.ts - 重试机制

export async function withRetry<T>(
  fn: () => Promise<T>,
  maxRetries: number = 3,
  delay: number = 1000
): Promise<T> {
  let lastError: Error;
  
  for (let i = 0; i < maxRetries; i++) {
    try {
      return await fn();
    } catch (error) {
      lastError = error as Error;
      console.log(`尝试 ${i + 1} 失败:`, lastError.message);
      
      // 等待一段时间后重试
      if (i < maxRetries - 1) {
        await new Promise(resolve => setTimeout(resolve, delay * (i + 1)));
      }
    }
  }
  
  throw lastError!
}

// api/src/services/videoSourceService.ts - 视频源抓取
import { withRetry } from '../utils/withRetry';

export async function fetchVideoBySource(sourceConfig: any, env: any) {
  switch (sourceConfig.type) {
    case "quark":
      return await withRetry(() => fetchQuarkVideo(sourceConfig, env));
    case "aliyun":
      return await withRetry(() => fetchAliyunVideo(sourceConfig, env));
    default:
      throw new Error(`不支持的视频源类型: ${sourceConfig.type}`);
  }
}

// 视频源数据统一处理
function normalizeVideoData(videos: any[], source: string) {
  return videos.map(video => ({
    id: video.id || `video:${Date.now()}_${Math.random().toString(36).slice(2)}`,
    title: video.title || video.name || '',
    subTitle: video.subTitle || video.episode || '',
    desc: video.desc || video.description || '',
    cover: video.cover || video.poster || '',
    category: video.category || source,
    actors: video.actors || video.cast || [],
    director: video.director || video.directors || '',
    writer: video.writer || '',
    source: source,
    updateTime: new Date().toISOString()
  }));
}
```

## 3. 前端相关

### 3.1 状态管理问题
**问题**：页面刷新后状态丢失
**解决方案**：
- 使用 Pinia 的持久化插件
- 将用户信息存储在 localStorage 中
- 实现 `loadFromLocalStorage` 方法

**解决方案代码示例**：
```typescript
// web/src/store/user.ts - 用户状态管理
import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

export const useUserStore = defineStore('user', () => {
  // State
  const user = ref<any>(null)
  const token = ref<string>('')
  
  // Getters
  const isLoggedIn = computed(() => !!token.value)
  const isAdmin = computed(() => user.value?.role === 'admin')
  
  // Actions
  const login = (userData: any, userToken: string) => {
    user.value = userData
    token.value = userToken
    // 存储到 localStorage
    localStorage.setItem('user', JSON.stringify(userData))
    localStorage.setItem('token', userToken)
  }
  
  const logout = () => {
    user.value = null
    token.value = ''
    // 从 localStorage 移除
    localStorage.removeItem('user')
    localStorage.removeItem('token')
  }
  
  // 从 localStorage 加载
  const loadFromLocalStorage = () => {
    const storedUser = localStorage.getItem('user')
    const storedToken = localStorage.getItem('token')
    
    if (storedUser && storedToken) {
      try {
        user.value = JSON.parse(storedUser)
        token.value = storedToken
      } catch (error) {
        console.error('Failed to parse user data from localStorage', error)
        // 清除无效数据
        localStorage.removeItem('user')
        localStorage.removeItem('token')
      }
    }
  }
  
  return {
    user,
    token,
    isLoggedIn,
    isAdmin,
    login,
    logout,
    loadFromLocalStorage
  }
})

// 在应用启动时加载
// web/src/main.ts
import { useUserStore } from './store/user'

const app = createApp(App)
const userStore = useUserStore()
userStore.loadFromLocalStorage()
app.use(createPinia())
app.use(router)
app.mount('#app')
```

### 3.2 图片懒加载
**问题**：图片加载慢影响用户体验
**解决方案**：
- 使用 Vue 的 `v-lazy` 指令
- 添加占位符图片
- 实现渐进式加载效果

### 3.3 响应式设计
**问题**：在不同设备上显示不一致
**解决方案**：
- 使用 Tailwind CSS 的响应式类
- 设计移动优先的布局
- 测试不同屏幕尺寸

## 4. 管理后台相关

### 4.1 权限控制
**问题**：未登录用户也能访问管理页面
**解决方案**：
- 实现 `usePermission` 钩子
- 在路由层面添加权限检查
- 在组件层面控制操作按钮的显示

### 4.2 表单验证
**问题**：表单提交时数据验证不严格
**解决方案**：
- 使用 Ant Design 的表单验证
- 添加前端和后端双重验证
- 对特殊字符进行处理，防止 SQL 注入

### 4.3 批量操作
**问题**：批量删除操作性能差
**解决方案**：
- 实现批量删除的异步处理
- 添加加载状态和错误处理
- 优化数据库操作，使用事务提高性能

## 5. 部署相关

### 5.1 Node.js 版本问题
**问题**：Wrangler requires at least Node.js v20.0.0
**解决方案**：
- 更新 Node.js 到最新版本
- 使用 nvm 管理多个 Node.js 版本

### 5.2 环境变量配置
**问题**：部署后环境变量未生效
**解决方案**：
- 在 Cloudflare Workers 控制台中配置环境变量
- 确保 `.env` 文件中的配置正确
- 重启服务使配置生效

### 5.3 构建失败
**问题**：npm run build 命令失败
**解决方案**：
- 检查依赖版本兼容性
- 运行 `npm run cf-typegen` 生成类型定义
- 确保代码中没有语法错误

## 6. 性能优化

### 6.1 页面加载速度
**问题**：首页加载时间长
**解决方案**：
- 实现图片懒加载
- 优化 API 响应速度
- 使用缓存策略

### 6.2 API 响应时间
**问题**：API 请求响应慢
**解决方案**：
- 优化数据库查询
- 实现分页和限流
- 使用 Cloudflare Workers 的边缘计算能力

### 6.3 内存使用
**问题**：Worker 内存使用过高
**解决方案**：
- 减少内存占用，及时释放资源
- 优化数据处理逻辑
- 使用流式处理大型数据

## 7. 其他问题

### 7.1 视频播放兼容性
**问题**：不同浏览器播放视频的兼容性问题
**解决方案**：
- 使用 HTML5 video 标签
- 提供多种格式的视频源
- 添加播放器错误处理

### 7.2 搜索功能
**问题**：搜索结果不准确
**解决方案**：
- 实现模糊搜索
- 优化搜索算法
- 添加搜索建议

### 7.3 推荐系统
**问题**：推荐内容不精准
**解决方案**：
- 基于用户行为分析
- 结合热门内容和最新内容
- 定期更新推荐数据
