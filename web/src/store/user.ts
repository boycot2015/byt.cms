import { defineStore } from 'pinia'
import { apiService } from '../services/api'

interface User {
  id: string
  username: string
  nickname: string
  avatar: string
  role: string
  status: string
  token: string
  createTime: string
  updateTime: string
}

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null as User | null,
    isLoading: false,
    error: null as string | null
  }),
  getters: {
    isLoggedIn: (state) => !!state.user
  },
  actions: {
    // 登录
    async login(username: string, password: string) {
      this.isLoading = true
      this.error = null
      try {
        const response = await apiService.login({ username, password })
        if (response.success) {
          this.user = response.user
          this.saveToLocalStorage()
          return response.user
        } else {
          this.error = '登录失败，请检查用户名和密码'
          throw new Error('登录失败')
        }
      } catch (error: any) {
        this.error = error.response?.data?.error || '登录失败，请检查用户名和密码'
        throw error
      } finally {
        this.isLoading = false
      }
    },
    
    // 注册
    async register(username: string, password: string, nickname?: string) {
      this.isLoading = true
      this.error = null
      try {
        const user = await apiService.register({ username, password, nickname })
        this.user = user
        this.saveToLocalStorage()
        return user
      } catch (error: any) {
        this.error = error.response?.data?.error || '注册失败，请稍后重试'
        throw error
      } finally {
        this.isLoading = false
      }
    },
    
    // 退出登录
    logout() {
      this.user = null
      this.removeFromLocalStorage()
    },
    
    // 保存到本地存储
    saveToLocalStorage() {
      if (this.user) {
        localStorage.setItem('user', JSON.stringify(this.user))
      }
    },
    
    // 从本地存储加载
    loadFromLocalStorage() {
      const userStr = localStorage.getItem('user')
      if (userStr) {
        try {
          this.user = JSON.parse(userStr)
        } catch (error) {
          console.error('Failed to parse user from localStorage', error)
          this.removeFromLocalStorage()
        }
      }
    },
    
    // 从本地存储移除
    removeFromLocalStorage() {
      localStorage.removeItem('user')
    }
  }
})