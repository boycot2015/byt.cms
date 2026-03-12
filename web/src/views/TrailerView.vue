<template>
  <div class="movie-view">
    <div class="container mx-auto py-4 px-4">
      <h1 class="text-2xl font-bold text-gray-800 mb-6">{{router.currentRoute.value.meta.title}}</h1>
      <!-- 加载状态 -->
      <div v-if="loading" class="flex justify-center items-center py-10">
        <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-red-600"></div>
      </div>
      
      <!-- 视频列表 -->
      <div v-else class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        <VideoCard 
          v-for="video in videos" 
          :key="video.id" 
          :video="video" 
        />
      </div>
      
      <!-- 空状态 -->
      <div v-if="!loading && videos.length === 0" class="py-10 text-center">
        <p class="text-gray-500">暂无视频数据</p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { apiService } from '../services/api'
import VideoCard from '../components/VideoCard.vue'
import type { Category, Video } from '../types'
const router = useRouter()
const categories = ref<Category[]>([])
const videos = ref<Video[]>([])
const loading = ref(false)
const currentCategory = router.currentRoute.value.meta.category as string
const currentCategoryId = ref('')
// 获取分类数据
const fetchCategories = async () => {
  try {
    const data: Category[] = await apiService.getCates()
    categories.value = data.filter(el => currentCategory.includes(el.name)) || []
    // 设置默认分类
    if (categories.value && categories.value.length > 0) {
      currentCategoryId.value = categories.value[0].id
      fetchVideosByCategory(categories.value[0].id)
    }
  } catch (error) {
    console.error('获取分类数据失败:', error)
    categories.value = []
  }
}

// 根据分类获取视频数据
const fetchVideosByCategory = async (categoryId: string) => {
  try {
    loading.value = true
    const data: any = await apiService.getVideos({
      category: categoryId,
      page: 1,
      pageSize: 18
    })
    videos.value = data.list || []
  } catch (error) {
    console.error('获取视频数据失败:', error)
    videos.value = []
  } finally {
    loading.value = false
  }
}

onMounted(async () => {
  await fetchCategories()
})
</script>

<style scoped>
.movie-view {
  min-height: 100vh;
  background-color: #f5f5f5;
}

.movie-card {
  transition: transform 0.3s ease;
}

.movie-card:hover {
  transform: translateY(-3px);
}
</style>