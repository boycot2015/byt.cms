import axios from 'axios'
import type { Category, Video, Comment } from '../types'
let baseURL = 'https://cms-api.boycot.dpdns.org/api'
if (import.meta.env.DEV) {
  baseURL = 'http://localhost:8787/api'
}
const api = axios.create({
  baseURL, // API 基础URL
  timeout: 10000, // 请求超时时间
  headers: {
    'Content-Type': 'application/json'
  }
})

// 请求拦截器
api.interceptors.request.use(
  config => {
    // 添加 token 认证信息
    const userStr = localStorage.getItem('user')
    if (userStr) {
      try {
        const user = JSON.parse(userStr)
        if (user.token) {
          config.headers['Authorization'] = `Bearer ${user.token}`
        }
      } catch (error) {
        console.error('Failed to parse user from localStorage', error)
      }
    }
    return config
  },
  error => {
    return Promise.reject(error)
  }
)

// 响应拦截器
api.interceptors.response.use(
  response => {
    return response.data
  },
  error => {
    console.error('API 请求错误:', error)
    return Promise.reject(error)
  }
)

// API 接口
export const apiService = {
  // 获取推荐视频
  getRecommendedVideos: () => {
    return api.get('/videos/recommended') as Promise<Video[]>
  },
    // 获取分类
  getCates: (params?: {
    page?: number
    pageSize?: number
    search?: string
  }) => {
    return api.get('/categories', { params }) as Promise<Category[]>
  },
  // 获取视频列表
  getVideos: (params?: {
    page?: number
    pageSize?: number
    categoryId?: string
    category?: string
    search?: string
    recommended?: boolean
    id?: string
  }) => {
    return api.get('/videos', { params }) as Promise<{list: Video[], total: number}>
  },
  
  // 根据 id 获取视频详情
  getVideoById: (id: string) => {
    return api.get('/videos', { params: { id } })
  },
  
  // 获取文章列表
  getArticles: (params?: {
    page?: number
    pageSize?: number
    search?: string
  }) => {
    return api.get('/articles', { params })
  },
  
  // 获取评论列表
  getComments: (params: {
    videoId: string
    episodeId?: string
    page?: number
    pageSize?: number
  }) => {
    return api.get('/comments', { params }) as Promise<{list: Comment[], total: number}>
  },
  
  // 创建评论
  createComment: (data: {
    videoId: string
    episodeId?: string
    userId: string
    content: string
    parentId?: string
    currentTime?: number
  }) => {
    return api.post('/comments', data) as Promise<Comment>
  },
  
  // 点赞评论
  likeComment: (commentId: string) => {
    return api.post(`/comments/${commentId}/like`) as Promise<{success: boolean, likes: number}>
  },
  
  // 用户登录
  login: (data: {
    username: string
    password: string
  }) => {
    return api.post('/users/login', data) as Promise<{success: boolean, user: any}>
  },
  
  // 用户注册
  register: (data: {
    username: string
    password: string
    nickname?: string
  }) => {
    return api.post('/users/register', data) as Promise<any>
  },
  
  // 获取网站配置
  getSiteConfig: () => {
    return api.get('/site-config') as Promise<any>
  },
  
  // 更新网站配置
  updateSiteConfig: (data: {
    userId: string
    logo?: string
    title?: string
    bannerCount?: number
    categoryIds?: string[]
    categoryCols?: number
    categoryRows?: number
    rankingCategoryIds?: string[]
    rankingCount?: number
    links?: any[]
    recommendTitle?: string
  }) => {
    return api.post('/site-config', data) as Promise<any>
  }
}

export default api