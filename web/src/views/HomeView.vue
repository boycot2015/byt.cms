<template>
  <div class="home">
    <!-- 横幅轮播 -->
    <Banner />

    <!-- 内容区域 -->
    <main class="content py-4 px-4">
      <div class="container mx-auto">
        <!-- 加载状态 -->
        <!-- <Loading v-if="videoStore.videos.length === 0 && videoStore.loading" message="加载中..." size="md" color="border-red-600" /> -->

        
        <!-- 分类列表 -->
        <section v-for="category in categories" :key="category.key" class="mb-8">
          <!-- 即将上映 -->
          <div class="coming-soon-section mb-6" v-if="category.affix">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <span class="text-red-600 mr-2">●</span>
                {{category.title || '即将上映'}}
              </h2>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">
              <div v-for="video in category.data.slice(0,6)" :key="video.id">
                <VideoCard :video="video" />
              </div>
            </div>
          </div>
          <div v-else>
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <span class="text-red-600 mr-2">●</span>
                {{ category.title }}
              </h2>
              <a :href="category.path" class="text-sm text-gray-600 hover:text-red-600">更多{{ category.title }} ></a>
            </div>
            
            <div class="grid lg:grid-cols-6 gap-4">
              <!-- 视频列表 -->
              <div class="col-span-12 md:col-span-5">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                  <div v-for="item in category.data" :key="item.id">
                    <VideoCard :video="item" />
                  </div>
                </div>
              </div>
              
              <!-- 排行榜 -->
              <div class="hidden lg:block md:col-span-1">
                <Ranking :title="category.title" :items="category.rankings" showSuffix />
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
  </div>
</template>

<script setup lang="ts">
import { onMounted, reactive } from 'vue'
import { useRouter } from 'vue-router'
import Banner from '../components/Banner.vue'
import VideoCard from '../components/VideoCard.vue'
import Ranking from '../components/Ranking.vue'
import { useVideoStore } from '../store/video'
import type { Video } from '../types'

const router = useRouter()
const videoStore = useVideoStore()
const defaultList = [...Array(18).keys()].map(() => ({loading:true})) as Video[]
// 分类配置
const categories = reactive(
  router.options?.routes?.filter((item: any) => item.meta?.showInHome).map(el => ({
      key: el.name,
      path: el.path,
      recommended: (el.meta?.recommended || undefined)  as boolean|undefined,
      title: (el.meta?.title || '') as string,
      category: (el.meta?.category || '') as string,
      affix: el.meta?.affix || false,
      data: defaultList,
      rankings: defaultList
  })) || []
)

// 页面加载时获取数据
onMounted(async () => {
  // 先获取分类数据
  await videoStore.fetchCategories()
  
  // 并行获取所有数据
  await Promise.all([
    // 遍历获取所有分类数据
    ...categories.map(async (category) => {
      const cateIds = videoStore.categories.filter((item: any) => category.category?.includes(item.name)).map((item: any) => item.id)
      // 获取分类视频列表
      const videos = await videoStore.fetchVideosByParams({categoryIds: cateIds.join(','), recommended: category.recommended || undefined})
      // 获取分类排行榜数据
      const rankings = await videoStore.fetchCategoryRankings(cateIds)
      setTimeout(() => {
        category.data = videos
        category.rankings = rankings
      }, 100);
    })
  ])
})
</script>

<style scoped>
.home {
  min-height: 100vh;
}
</style>