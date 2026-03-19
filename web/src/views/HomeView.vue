<template>
  <div class="home">
    <!-- 横幅轮播 -->
    <Banner />

    <!-- 内容区域 -->
    <main class="content py-4 px-4">
      <div class="container mx-auto">
        <!-- 加载状态 -->
        <!-- <Loading v-if="videoStore.videos.length === 0 && videoStore.loading" message="加载中..." size="md" color="border-red-600" /> -->

        
        <!-- 推荐内容 -->
        <section v-if="recommendedVideos.length > 0" class="mb-8">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
              <span class="text-red-600 mr-2">●</span>
              {{videoStore.siteConfig?.recommendTitle || (recommendedVideos.length > 0 ? '热门推荐' : '')}}
            </h2>
          </div>
          <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">
            <div v-for="video in recommendedVideos" :key="video.id">
              <VideoCard :video="video" />
            </div>
          </div>
        </section>

        <!-- 分类列表 -->
        <section v-for="category in categories" :key="category.id" class="mb-8">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
              <span class="text-red-600 mr-2">●</span>
              {{ category.name }}
            </h2>
            <a :href="`${category.path}/${category.id}`" class="text-sm text-gray-600 hover:text-red-600">更多{{ category.name }} ></a>
          </div>
          
          <div class="grid lg:grid-cols-6 gap-4">
            <!-- 视频列表 -->
            <div class="col-span-12 md:col-span-5">
              <div class="grid gap-3" :class="gridClass">
                <div v-for="item in category.videos" :key="item.id">
                  <VideoCard :video="item" />
                </div>
              </div>
            </div>
            
            <!-- 排行榜 -->
            <div class="hidden lg:block md:col-span-1">
              <Ranking :title="category.name" :items="category.rankings" showSuffix />
            </div>
          </div>
        </section>
      </div>
    </main>
  </div>
</template>

<script setup lang="ts">
import { onMounted, ref, computed } from 'vue'
import Banner from '../components/Banner.vue'
import VideoCard from '../components/VideoCard.vue'
import Ranking from '../components/Ranking.vue'
import { useVideoStore } from '../store/video'
import type { Video } from '../types'
import {useRouter } from 'vue-router'
const router = useRouter()
const videoStore = useVideoStore()
const defaultList = [...Array(18).keys()].map(() => ({loading:true})) as Video[]
const categories = ref<Array<{id: string, name: string, path: string, videos: Video[], rankings: Video[],loading?: boolean}>>([])
const recommendedVideos = ref<Video[]>([...defaultList.slice(0, 6)])

// 根据配置计算网格类名
const gridClass = computed(() => {
  const categoryCols = videoStore.siteConfig?.categoryCols || 5
  return `grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-${categoryCols} `
})

// 获取推荐视频
const fetchRecommendedVideos = async () => {
  const rankingCategoryIds = videoStore.siteConfig?.rankingCategoryIds || []
  if (rankingCategoryIds.length === 0) {
    return []
  }
  
  const promises = rankingCategoryIds.map(async (categoryId: string) => {
    // 先获取推荐视频
    const recommended = await videoStore.fetchVideos({ category: categoryId, recommended: true, page: 1, pageSize: 10 })
    if (recommended.length >= 6) {
      return recommended
    }
    // 如果没有推荐视频，获取最新视频
    const latest = await videoStore.fetchVideos({ category: categoryId, page: 1, pageSize: 10 })
    return [...recommended, ...latest]
  })
  
  const results = await Promise.all(promises)
  const allVideos = results.flat().sort((a, b) => b.recommended - a.recommended)
  // 去重并限制数量为6个
  const uniqueVideos = allVideos.filter((video, index, self) => 
    index === self.findIndex(v => v.id === video.id)
  )
  return uniqueVideos.slice(0, 6)
}
const getInitData = async () => {
  // 先获取网站配置
  await videoStore.fetchSiteConfig()
  const count = (videoStore.siteConfig?.categoryCols || 5) * (videoStore.siteConfig?.categoryRows || 2)
  categories.value = router.options?.routes?.filter((item: any) => item.meta?.showInHome).map(el => ({
      id: el.name as string,
      path: el.path as string,
      name: (el.meta?.title || '') as string,
      affix: el.meta?.affix || false,
      loading: true,
      videos: defaultList.slice(0, count || 5),
      rankings: defaultList.slice(0, videoStore.siteConfig?.rankingCount || 8)
  })) || []
  // 获取分类数据
  await videoStore.fetchCategories()
  
  // 获取配置的分类
  const categoryIds = videoStore.siteConfig?.categoryIds || []
  if (categoryIds.length > 0) {
    // 获取每个分类的视频和排行数据
    const categoryPromises = categoryIds.map(async (categoryId: string) => {
      // 获取分类信息
      const category = videoStore.categories.find(c => c.id === categoryId)
      if (!category) return null
      // 获取分类视频
      const videos = await videoStore.fetchVideos({ category: categoryId, page: 1, pageSize: count || 5 })
      
      // 获取排行榜数据
      const rankingCount = videoStore.siteConfig?.rankingCount || 8
      const rankings = await videoStore.fetchCategoryRankings([categoryId])
      const currentRoute = router.options.routes.find((item: any) => item.meta.category?.includes(category.name)) || { path: '/movie', name: category.name,meta: { title: category.name } }
      return {
        id: categoryId,
        path: currentRoute.path.replace('/:id?', ''),
        name: category.name || currentRoute.name,
        videos: videos.slice(0, count),
        rankings: rankings.slice(0, rankingCount)
      }
    })
    
    const categoryResults = await Promise.all(categoryPromises)
    categories.value = categoryResults.filter(el => el.videos.length > 0) as any
  }
  
  // 获取推荐视频
  recommendedVideos.value = await fetchRecommendedVideos()
}
onMounted(async () => {
  // 页面加载时获取数据
  await getInitData()
})
</script>

<style scoped>
.home {
  min-height: 100vh;
}
</style>