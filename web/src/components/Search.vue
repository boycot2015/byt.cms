<template>
  <div class="search-container relative">
    <div class="relative">
      <input
        type="text"
        v-model="searchQuery"
        @input="handleInput"
        @blur="handleBlur"
        @focus="handleFocus"
        placeholder="搜索电影、电视剧、动漫、综艺"
        class="w-[210px] lg:w-80 pr-8 px-4 py-2 bg-gray-800 border border-gray-700 rounded-full text-white focus:outline-none focus:ring-2 focus:ring-red-500"
      />
      <button class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </button>
    </div>
    
    <!-- 搜索结果下拉列表 -->
    <div v-if="showDropdown && searchResults.length > 0" class="absolute top-full left-0 right-0 mt-1 bg-gray-900 border border-gray-700 rounded-lg shadow-lg z-50 max-h-80 overflow-y-auto">
      <div 
        v-for="item in searchResults" 
        :key="item.id"
        class="px-4 py-2 hover:bg-gray-800 cursor-pointer flex items-center"
        @mousedown="handleResultClick(item)"
      >
        <img 
          :src="item.cover || 'https://via.placeholder.com/50x75?text=暂无封面'" 
          :alt="item.title" 
          class="w-12 h-16 object-cover rounded mr-3"
        />
        <div class="flex-1 min-w-0">
          <h4 class="text-sm font-medium text-white line-clamp-1">{{ item.title }}</h4>
          <p class="text-xs text-gray-400">{{ item.category }} · {{ item.subTitle || '未知' }}</p>
        </div>
      </div>
    </div>
    
    <!-- 无结果提示 -->
    <div v-if="showDropdown && searchResults.length === 0 && searchQuery.trim()" class="absolute top-full left-0 right-0 mt-1 bg-gray-900 border border-gray-700 rounded-lg shadow-lg z-50 p-4">
      <p class="text-sm text-gray-400 text-center">暂无匹配结果</p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, watch, onMounted, onUnmounted } from 'vue'
import { useRouter } from 'vue-router'
import { apiService } from '../services/api'
import type { Video } from '../types'

const router = useRouter()
const searchQuery = ref('')
const searchResults = ref<Video[]>([])
const showDropdown = ref(false)
let debounceTimer: number | null = null

// 防抖函数
const debounce = (func: Function, delay: number) => {
  return (...args: any[]) => {
    if (debounceTimer) {
      clearTimeout(debounceTimer)
    }
    debounceTimer = window.setTimeout(() => {
      func(...args)
    }, delay)
  }
}

// 搜索函数
const searchVideos = async (query: string) => {
  if (!query.trim()) {
    searchResults.value = []
    return
  }
  
  try {
    const data: any = await apiService.getVideos({
      search: query,
      page: 1,
      pageSize: 10
    })
    searchResults.value = data.list || []
  } catch (error) {
    console.error('搜索失败:', error)
    searchResults.value = []
  }
}

// 防抖处理的搜索
const debouncedSearch = debounce(searchVideos, 300)

// 处理输入
const handleInput = () => {
  debouncedSearch(searchQuery.value)
  showDropdown.value = true
}

// 处理焦点
const handleFocus = () => {
  if (searchQuery.value.trim()) {
    showDropdown.value = true
  }
}

// 处理失焦
const handleBlur = () => {
  // 延迟关闭，以便点击下拉项时能触发点击事件
  setTimeout(() => {
    showDropdown.value = false
  }, 200)
}

// 处理结果点击
const handleResultClick = (item: Video) => {
  showDropdown.value = false
  searchQuery.value = ''
  router.push(`/detail/${item.id}`)
}

// 点击外部关闭下拉框
const handleClickOutside = (event: MouseEvent) => {
  const target = event.target as HTMLElement
  if (!target.closest('.search-container')) {
    showDropdown.value = false
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
  if (debounceTimer) {
    clearTimeout(debounceTimer)
  }
})
</script>

<style scoped>
.search-container {
  position: relative;
}

.search-container input {
  font-size: 14px;
  transition: all 0.3s ease;
}

.search-container input:focus {
  width: 360px;
}
@media screen and (max-width: 768px) {
  .search-container input:focus {
    width: 210px;
  }
}
.search-container ::-webkit-scrollbar {
  width: 6px;
}

.search-container ::-webkit-scrollbar-track {
  background: #1f2937;
  border-radius: 3px;
}

.search-container ::-webkit-scrollbar-thumb {
  background: #4b5563;
  border-radius: 3px;
}

.search-container ::-webkit-scrollbar-thumb:hover {
  background: #6b7280;
}
</style>