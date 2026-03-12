import { defineStore } from 'pinia'
import { apiService } from '../services/api'
import type { Video, Category } from '../types'

export const useVideoStore = defineStore('video', {
  state: () => ({
    videos: [] as Video[],
    total: 0, 
    categories: [] as Category[],
    loading: false,
    error: null as string | null
  }),

  getters: {
    getVideosByCategory: (state) => (categoryId: string) => {
      return state.videos.filter(video => video.categoryId === categoryId)
    },
    getRecommendedVideos: (state) => {
      return state.videos.filter(video => video.recommended)
    },
    getBannerVideos: (state) => {
      return state.videos.filter(video => video.banner)
    }
  },

  actions: {
    async fetchCategories() {
      try {
        this.loading = true
        const data = await apiService.getCates()
        this.categories = data || []
      } catch (error) {
        console.error('获取分类数据失败:', error)
        this.error = '获取分类数据失败'
        this.categories = []
      } finally {
        this.loading = false
      }
    },

    async fetchVideos(params: {category: string, recommended?: boolean, page?: number, pageSize?: number}) {
      try {
        this.loading = true
        const data: { list: Video[], total: number } = await apiService.getVideos(params)
        const videos = data.list || []
        // 将获取的视频数据添加到store中
        videos.forEach(video => {
          const existingIndex = this.videos.findIndex(v => v.id === video.id)
          if (existingIndex === -1) {
            this.videos.push(video)
          } else {
            this.videos[existingIndex] = video
          }
        })
        this.total = data.total || 0
        return videos
      } catch (error) {
        console.error('获取视频数据失败:', error)
        this.error = '获取视频数据失败'
        return []
      } finally {
        this.loading = false
      }
    },

    async fetchVideosByParams({ categoryIds = '', recommended = undefined}:{categoryIds: string, recommended?: boolean|undefined}) {
      try {
        this.loading = true
        const promises = categoryIds.split(',').map(category => this.fetchVideos({ category: category, recommended, page: 1, pageSize: 10 }))
        const results = await Promise.all(promises)
        return results.flat().slice(0, 10)
      } catch (error) {
        console.error('获取分类视频失败:', error)
        this.error = '获取分类视频失败'
        return []
      } finally {
        this.loading = false
      }
    },

    async fetchCategoryRankings(categoryIds: string[]) {
      try {
        this.loading = true
        const promises = categoryIds.map(id => this.fetchVideos({ category: id, recommended: true, page: 1, pageSize: 10 }))
        const results = await Promise.all(promises)
        const rankings = results.flat().slice(0, 10)
        return rankings.length > 0 ? rankings : this.fetchVideosByParams({ categoryIds: categoryIds.join(',') })
      } catch (error) {
        console.error('获取分类排行榜失败:', error)
        this.error = '获取分类排行榜失败'
        return []
      } finally {
        this.loading = false
      }
    },

    async fetchRecommendedVideos() {
      try {
        this.loading = true
        const data: Video[] = await apiService.getRecommendedVideos()
        const videos = data || []
        // 将获取的视频数据添加到store中
        videos.forEach(video => {
          const existingIndex = this.videos.findIndex(v => v.id === video.id)
          if (existingIndex === -1) {
            this.videos.push(video)
          } else {
            this.videos[existingIndex] = video
          }
        })
        return videos
      } catch (error) {
        console.error('获取推荐视频失败:', error)
        this.error = '获取推荐视频失败'
        return []
      } finally {
        this.loading = false
      }
    }
  }
})
