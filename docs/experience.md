# 我用ai工具从零开始搭建自有cms平台

## 项目开发感悟

### 1. 技术选型的重要性

在项目开始阶段，选择合适的技术栈至关重要。我选择了：
- **API 服务**：Cloudflare Workers + D1 数据库
  - 优势：边缘计算，全球分发，低延迟，无需管理服务器
  - 挑战：学习曲线较陡，本地开发环境配置复杂

- **管理后台**：React + Ant Design
  - 优势：组件库丰富，开发效率高
  - 挑战：需要处理权限管理和复杂表单

- **前端网站**：Vue 3 + Tailwind CSS
  - 优势：响应式设计，开发体验好，性能优秀
  - 挑战：需要实现复杂的交互功能

**API 服务示例代码**：
```typescript
// api/src/index.ts - Cloudflare Workers 入口
export default {
  async fetch(request: Request, env: Env, ctx: ExecutionContext) {
    const url = new URL(request.url);
    const path = url.pathname;
    
    // 处理 CORS
    const corsHeaders = {
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, OPTIONS",
      "Access-Control-Allow-Headers": "Content-Type, Authorization",
    };
    
    // 路由分发
    const response = await handleCategories(request, env, corsHeaders)
      || await handleVideos(request, env, corsHeaders)
      || await handleTags(request, env, corsHeaders);
    
    return response || new Response("Not Found", { status: 404 });
  }
};
```

### 2. 模块化开发的优势

将项目拆分为三个独立的模块（API、管理后台、前端）带来了很多好处：
- **职责清晰**：每个模块专注于自己的功能
- **并行开发**：团队成员可以同时开发不同模块
- **独立部署**：可以单独更新某个模块，不影响其他部分
- **技术栈灵活**：每个模块可以选择最适合的技术栈

**模块化路由示例**：
```typescript
// api/src/routes/categories.ts - 分类路由模块
export async function handleCategories(
  request: Request, 
  env: Env, 
  corsHeaders: Record<string, string>
) {
  const url = new URL(request.url);
  const path = url.pathname;

  // 获取分类列表（支持分页和搜索）
  if (path === "/api/categories" && request.method === "GET") {
    const page = parseInt(url.searchParams.get("page") || "1");
    const pageSize = parseInt(url.searchParams.get("pageSize") || "10");
    const search = url.searchParams.get("search") || "";
    
    let query = "SELECT * FROM categories WHERE status = 'active'";
    let countQuery = "SELECT COUNT(*) FROM categories WHERE status = 'active'";
    const params: any[] = [];
    
    if (search) {
      query += " AND name LIKE ?";
      countQuery += " AND name LIKE ?";
      params.push(`%${search}%`);
    }
    
    query += " ORDER BY `order` DESC, createTime DESC LIMIT ? OFFSET ?";
    params.push(pageSize, (page - 1) * pageSize);
    
    const categories = await env.DB.prepare(query).bind(...params).all();
    const countResult = await env.DB.prepare(countQuery).bind(...params.slice(0, -2)).first();
    
    return new Response(
      JSON.stringify({ list: categories.results, total: countResult?.['COUNT(*)'] || 0 }), 
      { headers: { ...corsHeaders, "Content-Type": "application/json" } }
    );
  }
  
  return null;
}
```

### 3. 数据库设计的重要性

良好的数据库设计是项目成功的基础：
- **规范化设计**：避免数据冗余，提高数据一致性
- **索引优化**：提高查询性能
- **外键约束**：保证数据完整性
- **合理的表结构**：便于扩展和维护

**数据库表结构示例**：
```sql
-- api/sql/init.sql - 数据库初始化脚本

-- 用户表
CREATE TABLE IF NOT EXISTS users (
    id TEXT PRIMARY KEY,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    nickname TEXT,
    avatar TEXT,
    role TEXT DEFAULT 'user',
    status TEXT DEFAULT 'active',
    createTime TEXT DEFAULT CURRENT_TIMESTAMP,
    updateTime TEXT DEFAULT CURRENT_TIMESTAMP
);

-- 分类表
CREATE TABLE IF NOT EXISTS categories (
    id TEXT PRIMARY KEY,
    name TEXT NOT NULL,
    desc TEXT,
    `order` INTEGER DEFAULT 0,
    status TEXT DEFAULT 'active',
    createTime TEXT DEFAULT CURRENT_TIMESTAMP
);

-- 视频表
CREATE TABLE IF NOT EXISTS videos (
    id TEXT PRIMARY KEY,
    title TEXT NOT NULL,
    subTitle TEXT,
    desc TEXT,
    cover TEXT,
    category TEXT,
    categoryId TEXT,
    actors TEXT,
    director TEXT,
    writer TEXT,
    recommended BOOLEAN DEFAULT FALSE,
    status TEXT DEFAULT 'active',
    createTime TEXT DEFAULT CURRENT_TIMESTAMP,
    updateTime TEXT DEFAULT CURRENT_TIMESTAMP
);

-- 标签关联表（外键约束示例）
CREATE TABLE IF NOT EXISTS video_tags (
    videoId TEXT NOT NULL,
    tagId TEXT NOT NULL,
    PRIMARY KEY (videoId, tagId),
    FOREIGN KEY (videoId) REFERENCES videos(id) ON DELETE CASCADE,
    FOREIGN KEY (tagId) REFERENCES tags(id) ON DELETE CASCADE
);
```

### 4. 前端性能优化

前端性能直接影响用户体验：
- **图片优化**：使用适当的格式和尺寸，实现懒加载
- **代码分割**：减少初始加载时间
- **缓存策略**：合理使用浏览器缓存
- **API 优化**：实现分页和限流

**Vue 3 状态管理示例（Pinia）**：
```typescript
// web/src/store/video.ts - 视频状态管理
import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import type { Video, Category } from '../types'

export const useVideoStore = defineStore('video', () => {
  // State
  const videos = ref<Video[]>([])
  const categories = ref<Category[]>([])
  const siteConfig = ref<any>({})
  const loading = ref(false)
  
  // Getters
  const recommendedVideos = computed(() => 
    videos.value.filter(v => v.recommended)
  )
  
  const videosByCategory = computed(() => {
    return (categoryId: string) => 
      videos.value.filter(v => v.categoryId === categoryId)
  })
  
  // Actions
  const setVideos = (data: Video[]) => {
    videos.value = data
  }
  
  const setCategories = (data: Category[]) => {
    categories.value = data
  }
  
  const setSiteConfig = (config: any) => {
    siteConfig.value = config
    // 持久化存储
    localStorage.setItem('siteConfig', JSON.stringify(config))
  }
  
  return {
    videos,
    categories,
    siteConfig,
    loading,
    recommendedVideos,
    videosByCategory,
    setVideos,
    setCategories,
    setSiteConfig
  }
})
```

**图片懒加载组件示例**：
```vue
<!-- web/src/components/VideoCard.vue -->
<template>
  <div class="video-card">
    <div class="cover-wrapper">
      <img 
        v-lazy="video.cover" 
        :alt="video.title"
        class="cover-image"
      />
      <div class="play-overlay">
        <PlayCircleOutlined />
      </div>
    </div>
    <div class="info">
      <h3 class="title">{{ video.title }}</h3>
      <p class="meta">{{ video.category }} · {{ video.updateTime }}</p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { PlayCircleOutlined } from '@ant-design/icons-vue'
import type { Video } from '../types'

defineProps<{
  video: Video
}>()
</script>
```

### 5. 安全性考虑

安全是项目开发的重要环节：
- **API 认证**：使用 JWT 进行身份验证
- **输入验证**：防止 SQL 注入和 XSS 攻击
- **权限控制**：确保用户只能访问授权的资源
- **HTTPS**：保护数据传输安全

**JWT 认证示例**：
```typescript
// api/src/routes/users.ts - 用户认证
import { sign, verify } from '@tsndr/cloudflare-worker-jwt';

// 用户登录
export async function handleLogin(request: Request, env: Env) {
  const body = await request.json();
  const { username, password } = body;
  
  // 验证用户
  const user = await env.DB.prepare(
    "SELECT * FROM users WHERE username = ? AND password = ?"
  ).bind(username, password).first();
  
  if (!user) {
    return new Response(JSON.stringify({ error: 'Invalid credentials' }), {
      status: 401,
      headers: { 'Content-Type': 'application/json' }
    });
  }
  
  // 生成 JWT Token
  const token = await sign({ 
    userId: user.id, 
    username: user.username,
    role: user.role 
  }, env.JWT_SECRET);
  
  return new Response(JSON.stringify({ 
    success: true, 
    user: { ...user, password: undefined },
    token 
  }), {
    headers: { 'Content-Type': 'application/json' }
  });
}

// 验证 Token 中间件
export async function verifyToken(request: Request, env: Env) {
  const authHeader = request.headers.get('Authorization');
  if (!authHeader || !authHeader.startsWith('Bearer ')) {
    return null;
  }
  
  const token = authHeader.substring(7);
  try {
    const isValid = await verify(token, env.JWT_SECRET);
    if (!isValid) return null;
    
    const payload = JSON.parse(atob(token.split('.')[1]));
    return payload;
  } catch (error) {
    return null;
  }
}
```

**React 权限控制 Hook 示例**：
```typescript
// admin/src/hooks/usePermission.jsx
import { useContext } from 'react';
import { UserContext } from '../context/UserContext';

export function usePermission() {
  const { user } = useContext(UserContext);
  
  const isAdmin = user?.role === 'admin';
  const isUser = user?.role === 'user';
  const isLoggedIn = !!user?.token;
  
  const hasPermission = (permission) => {
    if (!isLoggedIn) return false;
    if (isAdmin) return true;
    return user.permissions?.includes(permission);
  };
  
  return {
    isAdmin,
    isUser,
    isLoggedIn,
    hasPermission,
    user
  };
}
```

## 团队协作经验

### 1. 代码规范

统一的代码规范有助于提高代码质量：
- 使用 ESLint 和 Prettier 确保代码风格一致
- 遵循 TypeScript 类型定义规范
- 编写清晰的注释和文档

### 2. 版本控制

有效的版本控制是团队协作的基础：
- 使用 Git 进行代码管理
- 遵循 Git Flow 工作流
- 定期提交代码，避免大的变更
- 编写清晰的提交信息

### 3. 沟通协作

良好的沟通是项目成功的关键：
- 定期召开团队会议，讨论进度和问题
- 使用项目管理工具跟踪任务
- 及时解决技术难题，避免阻塞
- 分享经验和知识，共同成长

## 技术成长

### 1. 学习新技术

项目开发过程中，我接触了很多新技术：
- Cloudflare Workers：无服务器架构
- D1 Database：边缘数据库
- Vue 3 Composition API：现代化的前端开发方式
- Tailwind CSS：实用优先的 CSS 框架

### 2. 解决问题的能力

在项目开发中，我遇到了很多挑战，通过不断学习和尝试，提高了解决问题的能力：
- 分析问题的根本原因
- 寻找最佳解决方案
- 测试和验证解决方案
- 总结经验教训

### 3. 系统设计能力

通过完整的项目开发，我提高了系统设计能力：
- 架构设计：从整体考虑系统结构
- 模块划分：合理划分功能模块
- 接口设计：设计清晰的 API 接口
- 数据流程：优化数据流动路径

## 未来改进方向

### 1. 功能扩展

- 添加更多视频源
- 实现用户个性化推荐
- 增加社交功能，如点赞、分享
- 开发移动端应用

### 2. 性能优化

- 进一步优化 API 响应速度
- 实现更智能的缓存策略
- 优化前端渲染性能
- 减少资源加载时间

### 3. 安全性增强

- 加强 API 认证和授权
- 定期进行安全审计
- 实现更严格的输入验证
- 保护用户隐私数据

### 4. 可维护性提升

- 完善文档
- 增加单元测试和集成测试
- 优化代码结构
- 建立自动化部署流程

## 总结

通过这个项目，我不仅完成了一个功能完整的视频网站，还积累了宝贵的开发经验。从技术选型到系统设计，从数据库优化到前端性能，每一个环节都让我收获颇丰。

项目开发是一个不断学习和成长的过程，遇到问题、解决问题的过程也是我技术能力提升的过程。希望未来能够将这些经验应用到更多的项目中，创造出更好的产品。

---

**开发时间**：2026年3月

**项目地址**：https://github.com/boycot2015/byt.cms
