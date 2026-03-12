import axios from 'axios'
import type { Category, Video } from '../types'
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
    // 可以在这里添加 token 等认证信息
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
    return api.get('/videos', { params }) as Promise<{list: Video[]}>
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
  }
}

export default api