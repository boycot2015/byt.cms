<template>
  <div class="banner relative h-[400px] overflow-hidden" v-if="recommendedVideos.length">
    <div 
      v-for="(video, index) in recommendedVideos" 
      :key="video.id"
      class="banner-item absolute inset-0 transition-opacity duration-1000 ease-in-out"
      :class="{ 'opacity-100': currentIndex === index, 'opacity-0': currentIndex !== index }"
    >
      <img 
        :src="video.banner || video.cover" 
        :alt="video.title"
        class="w-full h-full object-cover"
      />
      <div class="absolute inset-0 bg-gradient-to-r from-black via-transparent to-transparent flex items-center">
        <div class="container mx-auto px-4 flex justify-between items-center">
          <div class="max-w-1/3">
            <h2 class="text-4xl font-bold text-white mb-2">{{ video.title }}</h2>
            <p class="text-gray-200 mb-4">{{ video.subTitle || '精彩内容，不容错过' }}</p>
            <div class="flex space-x-3">
              <button class="bg-red-600 text-white px-5 py-2 rounded hover:bg-red-700 flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                播放
              </button>
              <button class="bg-white text-black px-5 py-2 rounded hover:bg-gray-200 flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                收藏
              </button>
            </div>
          </div>
          
          <!-- 右侧排行榜 -->
          <div class="bg-black/80 rounded-lg p-3 w-64">
            <h3 class="text-white font-bold mb-3">热播榜</h3>
            <ul class="space-y-2">
              <li v-for="(item, idx) in hotRanking" :key="idx" class="flex items-center">
                <span class="w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold" :class="idx < 3 ? 'bg-red-600 text-white' : 'bg-gray-600 text-white'">
                  {{ idx + 1 }}
                </span>
                <a href="#" class="ml-2 text-white text-sm hover:text-red-600 line-clamp-1">{{ item.title }}</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- 轮播指示器 -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
      <button 
        v-for="(video, index) in recommendedVideos" 
        :key="index"
        class="w-12 h-2 rounded-md transition-colors duration-300 cursor-pointer"
        :class="{ 'bg-red-600': currentIndex === index, 'bg-white bg-opacity-50': currentIndex !== index }"
        @click="currentIndex = index"
      ></button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import { apiService } from '../services/api'

const recommendedVideos = ref([])
const hotRanking = ref([])
const currentIndex = ref(0)
let interval: number

// 从API获取推荐视频数据
const fetchRecommendedVideos = async () => {
  try {
    const data:any = await apiService.getRecommendedVideos()
    recommendedVideos.value = data.filter(el => el.banner) || []
    
    // 获取热播榜数据
    const rankingData:any = await apiService.getVideos({ recommended: true, page: 1, pageSize: 6 })
    hotRanking.value = rankingData.list || []
  } catch (error) {
    console.error('获取推荐视频失败:', error)
  }
}

// 自动轮播
const startAutoPlay = () => {
  interval = window.setInterval(() => {
    currentIndex.value = (currentIndex.value + 1) % recommendedVideos.value.length
  }, 5000)
}

onMounted(() => {
  fetchRecommendedVideos()
  startAutoPlay()
})

onUnmounted(() => {
  clearInterval(interval)
})
</script>

<style scoped>
.banner {
  position: relative;
}

.banner-item {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
</style>
