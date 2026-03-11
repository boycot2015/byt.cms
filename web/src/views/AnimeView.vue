<template>
  <div class="movie-view">
    <div class="container mx-auto py-4 px-4">
      <h1 class="text-2xl font-bold text-gray-800 mb-6">{{router.currentRoute.value.meta.title}}</h1>
      <!-- 分类导航 -->
      <div class="category-nav bg-gray-100 py-2 px-4 border-b border-gray-200 mb-8">
        <div class="container mx-auto">
          <ul class="flex space-x-6 text-sm">
            <li v-for="item in categories" :key="item.id">
              <a 
                href="#" 
                class="text-gray-600 hover:text-red-600" 
                :class="{'text-red-600 border-b-2 border-red-600 pb-2': item.id == currentCategoryId}" 
                @click="handleCategoryChange(item.id)"
              >
                {{ item.name }}
              </a>
            </li>
          </ul>
        </div>
      </div>
      
      <!-- 加载状态 -->
      <div v-if="loading" class="flex justify-center items-center py-10">
        <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-red-600"></div>
      </div>
      
      <!-- 视频列表 -->
      <div v-else class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        <VideoCard 
          v-for="video in videos" 
          :key="video.id" 
          :video="{
            id: video.id,
            title: video.title,
            cover: video.cover || 'https://via.placeholder.com/200x300?text=暂无封面',
            subTitle: video.subTitle || video.category,
            category: video.category
          }" 
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

const router = useRouter()
const categories = ref([])
const videos = ref([])
const loading = ref(false)
const currentCategory = router.currentRoute.value.meta.category as string
const currentCategoryId = ref('')
// 获取分类数据
const fetchCategories = async () => {
  try {
    const data: any = await apiService.getCates()
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
const fetchVideosByCategory = async (categoryId) => {
  try {
    loading.value = true
    const data: any = await apiService.getVideos({
      category: categoryId,
      page: 1,
      pageSize: 24
    })
    videos.value = data.list || []
  } catch (error) {
    console.error('获取视频数据失败:', error)
    videos.value = []
  } finally {
    loading.value = false
  }
}

// 处理分类切换
const handleCategoryChange = (categoryId) => {
  currentCategoryId.value = categoryId
  fetchVideosByCategory(categoryId)
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