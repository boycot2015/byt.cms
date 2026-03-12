<template>
  <div class="detail-view">
    <!-- 主要内容 -->
    <div class="container mx-auto py-6 px-4">
      <div v-if="loading" class="flex justify-center items-center py-10">
        <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-red-600"></div>
      </div>
      <div v-else-if="video" class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex flex-col md:flex-row">
          <!-- 左侧内容 -->
          <div class="md:w-5/6 pr-0 md:pr-6 mb-6 md:mb-0">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ video.title }}</h1>
            <p class="text-sm text-gray-500 mb-4">{{ video.title.toLowerCase().replace(/\s+/g, '') }}</p>
            
            <!-- 标签 -->
            <div class="flex flex-wrap gap-2 mb-4">
              <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ video.category }}</span>
              <span v-for="tag in video.tags" :key="tag.id" class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ tag.name }}</span>
            </div>
            
            <!-- 信息 -->
            <div class="space-y-2 mb-4">
              <p class="text-sm"><span class="text-gray-600">导演：</span> {{ video.director || '未知' }}</p>
              <p class="text-sm"><span class="text-gray-600">主演：</span> {{ JSON.parse(video.actors)?.join('、') || '未知' }}</p>
              <p class="text-sm"><span class="text-gray-600">更新：</span> {{ video.updateTime || '未知' }}</p>
              <p class="text-sm"><span class="text-gray-600">集数：</span> {{ video.subTitle || '未知' }}</p>
              <p class="text-sm"><span class="text-gray-600">评分：</span> 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <span class="ml-1">8.5</span>
              </p>
              <p class="text-sm"><span class="text-gray-600">TAG：</span> {{ video.tags.map(tag => tag.name).join('、') || '未知' }}</p>
            </div>
          </div>
          
          <!-- 右侧推荐 -->
          <div class="md:w-1/6">
            <VideoCard :video="{...video, size: 'large' }" />
          </div>
        </div>
        <!-- 剧情简介 -->
        <div class="mb-6">
          <h3 class="text-gray-600 font-medium mb-2">剧情：</h3>
          <p class="text-sm text-gray-700 leading-relaxed" v-html="video.desc || '未知'"></p>
        </div>
        
        <!-- 播放按钮 -->
        <button class="bg-red-600 text-white px-6 py-2 rounded-full flex items-center hover:bg-red-700 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          立即播放
        </button>
      </div>
      <div v-else class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <p class="text-center text-gray-600">视频不存在或已删除</p>
      </div>
      
      <!-- 选集播放 -->
      <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">选集播放：</h2>
        
        <!-- 资源平台切换 -->
        <div v-if="video?.sources && video.sources.length > 0" class="mb-4">
          <div class="flex space-x-2 border-b border-gray-300">
            <button 
              v-for="(source, index) in video.sources" 
              :key="source.id || index"
              @click="activeSource = index; activeEpisode = 0"
              class="mx-4 py-2 border-b-2 transition-colors"
              :class="activeSource === index ? 'border-red-500 text-red-500' : 'border-transparent text-gray-600 hover:text-red-500'"
            >
              {{ source.source || `资源${index + 1}` }}
            </button>
          </div>
        </div>
        <div v-else class="mb-4">
          <p class="text-gray-500 text-sm">暂无可用的播放资源</p>
        </div>
        
        <!-- 选集列表 -->
        <div class="flex flex-wrap gap-2 max-h-80 overflow-auto">
          <button 
            v-for="(episode, index) in currentEpisodes" 
            :key="index"
            class="px-4 py-1 border rounded text-sm transition-colors"
            :class="activeEpisode === index ? 'border-red-500 bg-red-50 text-red-500' : 'border-gray-300 hover:bg-gray-100'"
            @click="activeEpisode = index"
          >
            {{ episode.label || `第${String(index + 1).padStart(2, '0')}集` }}
          </button>
        </div>
        <div v-if="currentEpisodes.length === 0" class="mt-4">
          <p class="text-gray-500 text-sm">当前资源平台暂无可用剧集</p>
        </div>
      </div>
      
      <!-- 相关影片 -->
      <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">相关影片</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
          <div v-for="item in recommendList" :key="item.id">
            <VideoCard :video="{
              id: item.id,
              title: item.title,
              source: item.source || '未知',
              tags: item.tags || [],
              actors: item.actors || '',
              cover: item.cover || 'https://via.placeholder.com/200x300?text=暂无封面',
              subTitle: item.subTitle || '未知',
            }" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, watch, computed } from 'vue'
import { useRoute } from 'vue-router'
import VideoCard from '../../components/VideoCard.vue'
import { apiService } from '../../services/api'
import type { Video, Source } from '../../types'
const route = useRoute()
const video = ref<Video>()
const recommendList = ref<Video[]>([])
const loading = ref(true)
const activeSource = ref(0)
const activeEpisode = ref(0)

// 计算当前选中资源平台的剧集列表
const currentEpisodes = computed<Source[]>(() => {
  if (!video.value?.sources || !video.value.sources[activeSource.value]) {
    return [] as Source[]
  }
  const source = video.value.sources[activeSource.value]
  return source.urls || [] as Source[]
})

const getRecommendList = async () => {
  try {
    loading.value = true
    let data:any = await apiService.getVideos({ category: video.value?.categoryId, recommended: true, page: 1, pageSize: 12 })
    recommendList.value = data.list || []
    if (!recommendList.value.length) {
      data = await apiService.getVideos({ category: video.value?.categoryId, recommended: false, page: 1, pageSize: 13 })
      recommendList.value.push(...data.list || [])
      recommendList.value = recommendList.value.filter((item: any) => item.id !== video.value?.id).slice(0, 12)
    }
    loading.value = false
  } catch (error) {
    console.error('获取推荐列表失败:', error)
    recommendList.value = []
    loading.value = false
  }
}

const getVideoDetail = async () => {
  try {
    loading.value = true
    const data:any = await apiService.getVideoById(route.params.id as string)
    video.value = data || null
    // 重置选中状态
    activeSource.value = 0
    activeEpisode.value = 0
    loading.value = false
  } catch (error) {
    console.error('获取视频详情失败:', error)
    video.value = undefined
    loading.value = false
  }
}

onMounted(async () => {
  await getVideoDetail()
  await getRecommendList()
})

watch(() => route.params.id, async (newId) => {
  if (newId) {
    await getVideoDetail()
    await getRecommendList()
  }
})
</script>

<style scoped>
.detail-view {
  min-height: 100vh;
  background-color: #f5f5f5;
}
</style>