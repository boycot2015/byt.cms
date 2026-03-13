<template>
  <div class="movie-view">
    <div class="container mx-auto md:p-4">
      <h1 class="hidden md:block text-2xl font-bold text-gray-800 mb-6">{{router.currentRoute.value.meta.title}}</h1>
      <!-- 分类导航 -->
      <div v-if="categories.length > 1" class="category-nav bg-gray-100 p-4 pb-2 md:py-2 md:px-4 border-b border-gray-200 mb-3 md:mb-8">
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
      <div class="p-4 pt-1 md:p-0">
        <!-- 视频列表 -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
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
        
        <!-- 分页 -->
        <Pagination 
          v-if="!loading && videos.length > 0" 
          :current-page="currentPage" 
          :total="total" 
          :page-size="pageSize" 
          @page-change="handlePageChange"
          @page-size-change="handlePageSizeChange"
        />
      </div>

    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, watch } from 'vue'
import { useRouter } from 'vue-router'
import { apiService } from '../services/api'
import VideoCard from '../components/VideoCard.vue'
import Pagination from '../components/Pagination.vue'
import type { Category, Video } from '../types'

const router = useRouter()
const currentCategoryId = ref('')
const currentPage = ref(1)
const pageSize = ref(18)
const total = ref(0)
const categories = ref<Category[]>([])
const defaultList = [...Array(12).keys()].map((_, index) => ({
  id: index.toString(),
  loading: true
}))
const videos = ref<Video[]>(defaultList)
const loading = ref(false)
// 获取分类数据
const fetchCategories = async (category = router.currentRoute.value.meta.category as string) => {
  try {
    const data: Category[] = await apiService.getCates()
    categories.value = data.filter(el => category.includes(el.name)) || []
    // 设置默认分类
    if (categories.value && categories.value.length > 0) {
      currentCategoryId.value = categories.value[0].id
      fetchVideosByCategory(categories.value[0].id, 1)
    }
  } catch (error) {
    console.error('获取分类数据失败:', error)
    categories.value = []
  }
}

// 根据分类获取视频数据
const fetchVideosByCategory = async (categoryId: string, page: number) => {
  try {
    loading.value = true
    videos.value = [...defaultList]
    window.scrollTo(0, 0)
    const data: any = await apiService.getVideos({
      category: categoryId,
      page: page,
      pageSize: pageSize.value
    })
    setTimeout(() => {
      videos.value = data.list || []
      total.value = data.total || 0
    }, 300)
    currentPage.value = page
  } catch (error) {
    console.error('获取视频数据失败:', error)
    videos.value = []
    total.value = 0
  } finally {
    loading.value = false
  }
}

// 处理分类切换
const handleCategoryChange = (categoryId: string) => {
  currentCategoryId.value = categoryId
  currentPage.value = 1
  fetchVideosByCategory(categoryId, 1)
}

// 处理分页
const handlePageChange = (page: number) => {
  fetchVideosByCategory(currentCategoryId.value, page)
}

// 处理页码数变化
const handlePageSizeChange = (size: number) => {
  pageSize.value = size
  currentPage.value = 1
  fetchVideosByCategory(currentCategoryId.value, 1)
}

onMounted(async () => {
  await fetchCategories()
})
watch(() => router.currentRoute.value.meta.category, async () => {
  if (router.currentRoute.value.meta.category) {
    await fetchCategories(router.currentRoute.value.meta.category as string)
  }
})
</script>

<style scoped>
.movie-view {
  min-height: 100%;
  background-color: #f5f5f5;
}

.movie-card {
  transition: transform 0.3s ease;
}

.movie-card:hover {
  transform: translateY(-3px);
}
</style>