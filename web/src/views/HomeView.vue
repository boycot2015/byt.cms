<template>
  <div class="home">
    <!-- 横幅轮播 -->
    <Banner />

    <!-- 内容区域 -->
    <main class="content py-4 px-4">
      <div class="container mx-auto">
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
            <div class="grid grid-cols-6 gap-3">
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
              <a :href="'#'" class="text-sm text-gray-600 hover:text-red-600">更多{{ category.title }} ></a>
            </div>
            
            <div class="grid grid-cols-6 gap-4">
              <!-- 视频列表 -->
              <div class="col-span-5">
                <div class="grid grid-cols-5 gap-3">
                  <div v-for="item in category.data" :key="item.id">
                    <VideoCard :video="item" />
                  </div>
                </div>
              </div>
              
              <!-- 排行榜 -->
              <div class="col-span-1">
                <div class="bg-white rounded-lg p-3 border border-gray-200">
                  <h3 class="text-base font-bold text-gray-800 mb-3">{{ category.title }}排行榜</h3>
                  <ul class="space-y-3">
                    <li v-for="(item, index) in category.rankings" :key="item.id">
                      <div class="flex items-center">
                        <div class="w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold" :class="index < 3 ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-600'">
                          {{ index + 1 }}
                        </div>
                        <a href="#" class="ml-2 text-sm text-gray-800 hover:text-red-600 line-clamp-1">{{ item.title }}</a>
                      </div>
                    </li>
                  </ul>
                </div>
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
import { apiService } from '../services/api'
const router = useRouter()
// 分类配置
const categories = reactive(
  router.options?.routes?.filter((item: any) => item.meta?.showInHome).map(el => ({
      key: el.name,
      title: el.meta?.title || '',
      category: el.meta?.category || '',
      affix: el.meta?.affix || false,
      data: [],
      rankings: []
  })) || []
)

// 获取视频数据的通用函数
const fetchVideos = async (params) => {
  try {
    const data:any = await apiService.getVideos(params)
    return data.list || []
  } catch (error) {
    console.error('获取视频数据失败:', error)
    return []
  }
}
const fetchCategories = async () => {
  try {
    const data = await apiService.getCates()
    return data || []
  } catch (error) {
    console.error('获取分类数据失败:', error)
    return []
  }
}
// 页面加载时获取数据
onMounted(async () => {
 let cates:any = await fetchCategories()
//  console.log(cates, 'cates');
   // 并行获取所有数据
  await Promise.all([
    // 遍历获取所有分类数据
    ...categories.map(async (category) => {
      let cateIds = cates.filter((item: any) => category.category?.includes(item.name)).map((item: any) => item.id)
      // 获取分类视频列表
      let datas:any = await Promise.all(cateIds.map((id: string) => fetchVideos({ category: id, page: 1, pageSize: 10 })))
      category.data = datas.flat().slice(0, 10)
      // 获取分类排行榜
      let rankingsDatas:any = await Promise.all(cateIds.map((id: string) => fetchVideos({ category: id, recommended: true, page: 1, pageSize: 10})))
      category.rankings = rankingsDatas.flat().slice(0, 10)
      // 如果没有推荐数据，使用普通列表数据
      if (!category.rankings.length) {
        category.rankings = category.data.slice(0, 10)
      }
    })
  ])
})
</script>

<style scoped>
.home {
  min-height: 100vh;
}
</style>