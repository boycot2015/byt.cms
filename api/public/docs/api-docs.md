# API 概览

## 简介

Cloudflare Workers CMS API 是一个基于 Cloudflare Workers 和 D1 数据库的内容管理系统 API，提供了完整的视频、文章、分类、标签、评论等管理功能。

## 基础信息

- API 基础路径: `/api`
- 支持的请求方法: `GET`, `POST`, `PUT`, `DELETE`
- 响应格式: JSON
- 认证方式: Token 认证

## 错误处理

API 返回的错误格式如下：

```json
{
  "error": "错误信息"
}
```

## 分类管理

### 获取所有分类

- **URL**: `/api/categories`
- **方法**: `GET`
- **参数**:
  - `sortBy`: 排序字段 (order, createTime, name)
  - `sortOrder`: 排序方向 (asc, desc)
- **响应**:
  ```json
  [
    {
      "id": "category:123",
      "name": "电影",
      "desc": "电影分类",
      "order": 1,
      "createTime": "2024-01-01T00:00:00Z"
    }
  ]
  ```

### 创建分类

- **URL**: `/api/categories`
- **方法**: `POST`
- **请求体**:
  ```json
  {
    "name": "电影",
    "desc": "电影分类",
    "order": 1
  }
  ```
- **响应**:
  ```json
  {
    "id": "category:123",
    "name": "电影",
    "desc": "电影分类",
    "order": 1,
    "createTime": "2024-01-01T00:00:00Z"
  }
  ```

### 删除分类

- **URL**: `/api/categories/{id}`
- **方法**: `DELETE`
- **响应**:
  ```json
  {
    "success": true
  }
  ```

## 标签管理

### 获取所有标签

- **URL**: `/api/tags`
- **方法**: `GET`
- **响应**:
  ```json
  [
    {
      "id": "tag:123",
      "name": "动作",
      "createTime": "2024-01-01T00:00:00Z"
    }
  ]
  ```

### 创建标签

- **URL**: `/api/tags`
- **方法**: `POST`
- **请求体**:
  ```json
  {
    "name": "动作"
  }
  ```
- **响应**:
  ```json
  {
    "id": "tag:123",
    "name": "动作",
    "createTime": "2024-01-01T00:00:00Z"
  }
  ```

### 删除标签

- **URL**: `/api/tags/{id}`
- **方法**: `DELETE`
- **响应**:
  ```json
  {
    "success": true
  }
  ```

## 视频管理

### 获取视频列表

- **URL**: `/api/videos`
- **方法**: `GET`
- **参数**:
  - `id`: 视频ID（单个查询）
  - `category`: 分类ID
  - `tag`: 标签ID
  - `source`: 视频来源
  - `search`: 搜索关键词
  - `recommended`: 是否推荐
  - `page`: 页码
  - `pageSize`: 每页数量
- **响应**:
  ```json
  {
    "list": [
      {
        "id": "video:123",
        "title": "电影标题",
        "subTitle": "副标题",
        "desc": "电影描述",
        "cover": "封面URL",
        "banner": "Banner URL",
        "category": "电影",
        "categoryId": "category:123",
        "actors": ["演员1", "演员2"],
        "director": "导演",
        "writer": "编剧",
        "recommended": true,
        "sources": [
          {
            "id": "source:123",
            "videoId": "video:123",
            "source": "坚果云",
            "url": "视频URL",
            "urls": [
              { "label": "第1集", "url": "集数URL" }
            ]
          }
        ]
      }
    ],
    "total": 100,
    "page": 1,
    "pageSize": 10
  }
  ```

### 获取推荐视频

- **URL**: `/api/videos/recommended`
- **方法**: `GET`
- **响应**:
  ```json
  [
    {
      "id": "video:123",
      "title": "电影标题",
      "cover": "封面URL",
      "banner": "Banner URL",
      "category": "电影"
    }
  ]
  ```

### 更新视频推荐状态

- **URL**: `/api/videos/recommended/{id}`
- **方法**: `POST`
- **请求体**:
  ```json
  {
    "recommended": true
  }
  ```
- **响应**:
  ```json
  {
    "success": true
  }
  ```

### 删除视频

- **URL**: `/api/videos/{id}`
- **方法**: `DELETE`
- **响应**:
  ```json
  {
    "success": true
  }
  ```

## 评论管理

### 获取评论列表

- **URL**: `/api/comments`
- **方法**: `GET`
- **参数**:
  - `videoId`: 视频ID
  - `episodeId`: 集数ID
  - `page`: 页码
  - `pageSize`: 每页数量
- **响应**:
  ```json
  {
    "list": [
      {
        "id": "comment:123",
        "videoId": "video:123",
        "episodeId": "1",
        "userId": "user:123",
        "content": "评论内容",
        "parentId": null,
        "likes": 0,
        "status": "active",
        "createTime": "2024-01-01T00:00:00Z",
        "updateTime": "2024-01-01T00:00:00Z",
        "replies": [
          {
            "id": "comment:456",
            "videoId": "video:123",
            "episodeId": "1",
            "userId": "user:456",
            "content": "回复内容",
            "parentId": "comment:123",
            "likes": 0,
            "status": "active",
            "createTime": "2024-01-01T00:00:00Z",
            "updateTime": "2024-01-01T00:00:00Z"
          }
        ]
      }
    ],
    "total": 50,
    "page": 1,
    "pageSize": 20
  }
  ```

### 创建评论

- **URL**: `/api/comments`
- **方法**: `POST`
- **请求体**:
  ```json
  {
    "videoId": "video:123",
    "episodeId": "1",
    "userId": "user:123",
    "content": "评论内容",
    "parentId": null,
    "currentTime": 120
  }
  ```
- **响应**:
  ```json
  {
    "id": "comment:123",
    "videoId": "video:123",
    "episodeId": "1",
    "userId": "user:123",
    "content": "评论内容",
    "parentId": null,
    "likes": 0,
    "status": "active",
    "createTime": "2024-01-01T00:00:00Z",
    "updateTime": "2024-01-01T00:00:00Z"
  }
  ```

### 点赞评论

- **URL**: `/api/comments/{id}/like`
- **方法**: `POST`
- **响应**:
  ```json
  {
    "success": true,
    "likes": 1
  }
  ```

### 删除评论

- **URL**: `/api/comments/{id}`
- **方法**: `DELETE`
- **响应**:
  ```json
  {
    "success": true
  }
  ```

## 用户管理

### 用户登录

- **URL**: `/api/users/login`
- **方法**: `POST`
- **请求体**:
  ```json
  {
    "username": "admin",
    "password": "123456"
  }
  ```
- **响应**:
  ```json
  {
    "success": true,
    "user": {
      "id": "user:123",
      "username": "admin",
      "nickname": "管理员",
      "avatar": "",
      "role": "admin",
      "status": "active",
      "token": "token:123",
      "createTime": "2024-01-01T00:00:00Z",
      "updateTime": "2024-01-01T00:00:00Z"
    }
  }
  ```

### 用户注册

- **URL**: `/api/users/register`
- **方法**: `POST`
- **请求体**:
  ```json
  {
    "username": "user1",
    "password": "123456",
    "nickname": "用户1"
  }
  ```
- **响应**:
  ```json
  {
    "id": "user:456",
    "username": "user1",
    "nickname": "用户1",
    "avatar": "",
    "role": "user",
    "status": "active",
    "createTime": "2024-01-01T00:00:00Z",
    "updateTime": "2024-01-01T00:00:00Z"
  }
  ```

## 网站配置

### 获取网站配置

- **URL**: `/api/site-config`
- **方法**: `GET`
- **响应**:
  ```json
  {
    "id": "config:123",
    "userId": "user:123",
    "logo": "logo URL",
    "title": "网站标题",
    "bannerCount": 6,
    "categoryIds": ["category:123", "category:456"],
    "categoryCols": 4,
    "categoryRows": 2,
    "rankingCategoryIds": ["category:123", "category:456"],
    "rankingCount": 10,
    "recommendTitle": "猜你喜欢",
    "links": [
      { "name": "链接1", "url": "https://example.com" }
    ],
    "createTime": "2024-01-01T00:00:00Z",
    "updateTime": "2024-01-01T00:00:00Z"
  }
  ```

### 更新网站配置

- **URL**: `/api/site-config`
- **方法**: `POST`
- **请求体**:
  ```json
  {
    "userId": "user:123",
    "logo": "logo URL",
    "title": "网站标题",
    "bannerCount": 6,
    "categoryIds": ["category:123", "category:456"],
    "categoryCols": 4,
    "categoryRows": 2,
    "rankingCategoryIds": ["category:123", "category:456"],
    "rankingCount": 10,
    "recommendTitle": "猜你喜欢",
    "links": [
      { "name": "链接1", "url": "https://example.com" }
    ]
  }
  ```
- **响应**:
  ```json
  {
    "success": true,
    "message": "配置更新成功"
  }
  ```

## 文件上传

### 上传图片

- **URL**: `/api/upload/image`
- **方法**: `POST`
- **请求体**: `multipart/form-data`
  - `file`: 图片文件
- **响应**:
  ```json
  {
    "success": true,
    "data": {
      "url": "图片URL"
    }
  }
  ```

## 视频源

### 自动抓取视频源

- **URL**: `/api/video-fetch-sources-data`
- **方法**: `GET`
- **响应**:
  ```json
  {
    "success": true,
    "results": [
      {
        "source": "坚果云",
        "success": true,
        "data": { "list": [...] }
      }
    ]
  }
  ```

### 手动抓取视频源

- **URL**: `/api/video-fetch-sources-data/{sourceName}`
- **方法**: `GET`
- **响应**:
  ```json
  {
    "success": true,
    "data": { "list": [...] }
  }
  ```

### 刷新推荐视频

- **URL**: `/api/video-fetch-recommend`
- **方法**: `GET`
- **响应**:
  ```json
  {
    "success": true,
    "data": [
      { "name": "电影1", "pic": "封面URL" }
    ]
  }
  ```