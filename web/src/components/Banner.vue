<template>
  <div class="banner relative h-[200px] md:h-[400px] overflow-hidden" v-if="recommendedVideos.length">
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
      <div
      class="absolute inset-0 bg-gradient-to-r from-black via-transparent to-transparent flex items-center"
      :class="{ 'z-9': currentIndex === index }"
      >
        <div class="container mx-auto px-4 flex justify-between items-center">
          <div class="md:max-w-1/3">
            <h2 class="text-xl md:text-2xl lg:text-4xl font-bold text-white mb-2">{{ video.title }}</h2>
            <p class="text-gray-200 mb-4">{{ video.subTitle || '精彩内容，不容错过' }}</p>
            <div class="flex space-x-3">
              <router-link :key="video.id" :to="`/detail/${video.id}/${video.sources?.[0].source}/${video.sources?.[0].urls?.[0].label}`" class="bg-red-600 text-white px-5 py-2 rounded hover:bg-red-700 flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                播放
              </router-link>
              <!-- <button class="bg-white text-black px-5 py-2 rounded hover:bg-gray-200 flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                收藏
              </button> -->
            </div>
          </div>
          
          <!-- 右侧排行榜 -->
          <Ranking class="!bg-white/60 hidden md:block" :items="hotRanking" :show-suffix="false" />
        </div>
      </div>
    </div>
    <!-- 轮播指示器 -->
    <div class="absolute z-99 bottom-2 md:bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
      <button 
        v-for="(video, index) in recommendedVideos" 
        :key="video.id"
        class="w-6 h-1 md:w-12 md:h-2 rounded-md transition-colors duration-300 cursor-pointer"
        :class="{ 'bg-red-600': currentIndex === index, 'bg-white bg-opacity-50': currentIndex !== index }"
        @click="currentIndex = index"
      ></button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted, computed } from 'vue'
import Ranking from '../components/Ranking.vue'
import { useVideoStore } from '../store/video'

const videoStore = useVideoStore()
const currentIndex = ref(0)
let interval: number

// 从store获取推荐视频数据
const recommendedVideos = computed(() => {
  return videoStore.getBannerVideos
})

// 从store获取热播榜数据
const hotRanking = computed(() => {
  return videoStore.getRecommendedVideos.slice(0, 6)
})

// 自动轮播
const startAutoPlay = () => {
  interval = window.setInterval(() => {
    if (recommendedVideos.value.length > 0) {
      currentIndex.value = (currentIndex.value + 1) % recommendedVideos.value.length
    }
  }, 5000)
}

onMounted(async () => {
  // 确保获取推荐视频数据
  if (videoStore.videos.length === 0) {
    await videoStore.fetchRecommendedVideos()
  }
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
