import { defineStore } from 'pinia'

interface User {
  id: string
  username: string
  token: string
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
        // 模拟API调用
        // 实际项目中替换为真实的API调用
        const response = await new Promise<{ user: User }>((resolve) => {
          setTimeout(() => {
            resolve({
              user: {
                id: '1',
                username,
                token: 'mock-token-' + Date.now()
              }
            })
          }, 1000)
        })
        
        this.user = response.user
        this.saveToLocalStorage()
        return response.user
      } catch (error) {
        this.error = '登录失败，请检查用户名和密码'
        throw error
      } finally {
        this.isLoading = false
      }
    },
    
    // 注册
    async register(username: string, password: string) {
      this.isLoading = true
      this.error = null
      try {
        // 模拟API调用
        // 实际项目中替换为真实的API调用
        const response = await new Promise<{ user: User }>((resolve) => {
          setTimeout(() => {
            resolve({
              user: {
                id: '1',
                username,
                token: 'mock-token-' + Date.now()
              }
            })
          }, 1000)
        })
        
        this.user = response.user
        this.saveToLocalStorage()
        return response.user
      } catch (error) {
        this.error = '注册失败，请稍后重试'
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