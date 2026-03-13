<template>
  <div class="player-view bg-black text-white min-h-screen">
    <!-- 主要内容 -->
    <div class="container mx-auto py-4 px-4">
      <!-- 面包屑导航 -->
      <div class="breadcrumb text-sm text-gray-400 mb-4">
        <a href="/" class="hover:text-white">首页</a> &gt; 
        <a href="/anime" class="hover:text-white">{{video?.category||''}}</a> &gt; 
        <span class="text-white">{{ video?.title || '视频详情' }}</span>
      </div>

      <!-- 视频播放区域 -->
      <div class="flex flex-col lg:flex-row gap-6" v-if="video">
        <!-- 左侧视频播放器 -->
        <div class="lg:w-2/3">
          <!-- 播放器容器 -->
          <div class="player-container bg-gray-900 rounded-lg overflow-hidden mb-6">
            <!-- 视频播放器 -->
            <div class="aspect-video bg-gray-900 relative">
              <!-- 视频 -->
              <Player id="video" ref="playerRef" v-if="activeEpisode" class="w-full h-full object-cover" :url="activeEpisode" :poster="video.banner||video.cover" :urlList="video.sources?.[0]?.urls?.map(el =>el.url||'') || []" />
            </div>
            
            <!-- 视频信息和控制栏 -->
            <div class="p-4 bg-gray-800">
              <div class="flex justify-between items-center mb-4">
                <h2 class="md:text-xl flex flex-col md:flex-row md:items-center md:gap-2 font-bold">{{ video?.title || '视频标题' }} <span class="text-sm hidden md:block font-normal text-gray-400">{{ video?.subTitle || '第1集' }}</span></h2>
                <div class="flex space-x-2 md:space-x-4">
                  <button class="text-xs text-gray-400 hover:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    下载
                  </button>
                  <button class="text-xs text-gray-400 hover:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    收藏
                  </button>
                  <button class="text-xs text-gray-400 hover:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                    分享
                  </button>
                  <!-- <button class="text-gray-400 hover:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    更多
                  </button> -->
                </div>
              </div>
              <div class="flex text-xs flex-wrap items-center gap-4 mb-4" v-if="video.actors && video.actors.length > 0">
                <span>导演：{{video.director}}</span>
                <span>主演：{{video.actors.join('、')}}</span>
              </div>
              <!-- 视频标签 -->
              <div class="flex flex-wrap gap-2 mb-4">
                <span v-for="tag in video?.tags || []" :key="tag.id" class="bg-purple-600 text-white text-xs px-2 py-1 rounded">{{ tag.name }}</span>
              </div>
            </div>
          </div>
        </div>
        
        <!-- 右侧剧集选择 -->
        <div class="lg:w-1/3">
          <div class="bg-gray-900 rounded-lg p-4">
            <h3 class="text-lg font-bold mb-4 flex justify-between items-center">
              <span>{{ video?.title || '视频标题' }}</span>
            </h3>
            
            <!-- 资源选择 -->
            <div class="mb-4">
              <div class="flex space-x-2 mb-2">
                <button v-for="source in (video?.sources || [])" :key="source.id"
                :class="activeSource === source.id ? 'bg-red-600' : 'bg-gray-800'"
                class="text-white text-xs px-3 py-1 rounded hover:bg-gray-700"
                @click="handleSourceChange(source.id)"
              >{{source.source}}</button>
              <!-- <button class="bg-gray-800 text-white text-xs px-3 py-1 rounded hover:bg-gray-700">奶牛资源</button>
              <button class="bg-gray-800 text-white text-xs px-3 py-1 rounded hover:bg-gray-700">快速云播</button> -->
            </div>
            </div>
            <!-- 剧集列表 -->
             <div class="h-[460px] overflow-y-auto pr-2">
              <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-3 xl:grid-cols-4 gap-2">
                <button 
                  v-for="episode in episodes" 
                  :key="episode.id"
                  class="bg-gray-800 text-white text-sm py-2 px-3 rounded hover:bg-gray-700 text-center"
                  :class="activeEpisode === episode.id ? 'bg-red-600' : ''"
                  @click="handleEpisodeChange(episode.id)"
                >
                  {{ episode.title }}
                </button>
               </div>
             </div>
          </div>
        </div>
      </div>
      <!-- 视频简介 -->
      <div class="bg-gray-900 rounded-lg p-4 mt-6 lg:!mt-0 mb-6">
        <h3 class="text-lg font-bold mb-2">剧情简介</h3>
        <div v-if="video?.desc" class="text-gray-300 text-sm leading-relaxed" v-html="video?.desc || '暂无剧情简介'"></div>
        <p v-else class="text-gray-300 text-sm leading-relaxed">暂无剧情简介</p>
      </div>
      <!-- 相关影片 -->
      <div class="bg-gray-900 rounded-lg p-4">
        <h3 class="text-lg font-bold mb-4">相关影片</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
          <div v-for="item in relatedVideos" :key="item.id" class="movie-card">
            <router-link :to="{ path: `/detail/${item.id}` }" class="relative cursor-pointer">
              <img 
                :src="item.cover || 'https://via.placeholder.com/200x300?text=暂无封面'" 
                :alt="item.title" 
                class="w-full aspect-[2/3] object-cover rounded"
              />
              <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-2">
                <p class="text-xs text-white line-clamp-1">{{ item.title }}</p>
                <p class="text-xs text-gray-300">{{ item.subTitle || '更新至第1集' }}</p>
              </div>
            </router-link>
          </div>
        </div>
      </div>
      <!-- 影片评论 -->
      <div class="mt-6 bg-gray-900 rounded-lg p-4">
        <h3 class="text-lg font-bold mb-4">影片评论</h3>
        <div class="mb-4">
          <textarea 
            class="w-full bg-gray-800 border border-gray-700 rounded p-3 text-white text-sm"
            placeholder="请输入评论内容..."
            rows="3"
          ></textarea>
          <div class="mt-2 flex justify-end">
            <button class="bg-red-600 text-white px-4 py-1 rounded text-sm hover:bg-red-700">
              发表评论
            </button>
          </div>
        </div>
        <div class="space-y-4">
          <div v-for="comment in comments" :key="comment.id" class="border-b border-gray-800 pb-4">
            <div class="flex items-start">
              <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-3">
                <span class="text-sm">{{ comment.user.charAt(0) }}</span>
              </div>
              <div class="flex-1">
                <div class="flex justify-between items-center mb-1">
                  <span class="text-sm font-medium">{{ comment.user }}</span>
                  <span class="text-xs text-gray-500">{{ comment.time }}</span>
                </div>
                <p class="text-sm text-gray-300">{{ comment.content }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { apiService } from '../../services/api'
import type { Video } from '../../types'
import Player from '../../components/Player/index.vue'
const playerRef = ref<any>(null)
const route = useRoute()
const router = useRouter()
const video = ref<Video>()
const relatedVideos = ref<Video[]>([])
const episodes = ref<{ id: string, title: string }[]>([])
const activeEpisode = ref('')
const activeSource = ref('')
const comments = ref([
  { id: 1, user: '用户1', time: '2024-01-02 15:30', content: '主角的成长历程很感人，配音也很到位，期待下一季！' },
  { id: 2, user: '用户2', time: '2024-01-01 12:00', content: '这部动漫真的太精彩了，剧情紧凑，画面精美，强烈推荐！' },
  { id: 3, user: '用户3', time: '2024-01-03 10:15', content: '打斗场景制作得非常出色，看得很过瘾，支持国漫！' },
])

const getVideoDetail = async () => {
  try {
    const data: any = await apiService.getVideoById(route.params.id as string)
    video.value = data || null
    if (video.value) {
      video.value.desc = video.value?.desc?.replace(/style\s*=\s*["'][^"']*["']/gi, '')
      video.value.actors = JSON.parse((video.value?.actors || '[]') as unknown as string)
      // 处理路由参数中的 source
      const source = route.params.source as string
      const episode = route.params.episode as string
      // console.log(episode, video.value.sources?.[0]?.urls, 'video.value.sources')
      
      // 初始化资源和集数
      if (video.value.sources && video.value.sources.length > 0) {
        // 如果有 source，尝试解析资源和集数
        if (source) {
          // 查找匹配的资源
          const sourceIndex = video.value.sources.findIndex(item => 
            source.includes(item.source || '')
          )
          
          if (sourceIndex >= 0) {
            activeSource.value = video.value.sources[sourceIndex].id
            // 更新集数列表
            episodes.value = video.value.sources[sourceIndex].urls.map(el => ({
              id: el.url || '',
              title: el.label || ''
            })) || []
            
            // 查找匹配的集数
            const episodeIndex = video.value.sources[sourceIndex].urls.findIndex(item => 
              episode.includes(item.label || '')
            )
            activeEpisode.value = episodeIndex >= 0 ? 
              video.value.sources[sourceIndex].urls[episodeIndex].url || '' : 
              video.value.sources[sourceIndex].urls[0]?.url || ''
          } else {
            // 默认使用第一个资源
            activeSource.value = video.value.sources[0].id
            episodes.value = video.value.sources[0].urls.map(el => ({
              id: el.url || '',
              title: el.label || ''
            })) || []
            activeEpisode.value = video.value.sources[0].urls[0]?.url || ''
          }
        } else {
          // 默认使用第一个资源和第一集
          activeSource.value = video.value.sources[0].id
          episodes.value = video.value.sources[0].urls.map(el => ({
            id: el.url || '',
            title: el.label || ''
          })) || []
          activeEpisode.value = video.value.sources[0].urls[0]?.url || ''
        }
      }
    }
  } catch (error) {
    console.error('获取视频详情失败:', error)
    video.value = undefined
  }
}

const getRelatedVideos = async () => {
  try {
    let data: any = await apiService.getVideos({ category: video.value?.categoryId, recommended: true, page: 1, pageSize: 12 })
    relatedVideos.value = data.list || []
    if (!relatedVideos.value.length) {
      data = await apiService.getVideos({ category: video.value?.categoryId, recommended: false, page: 1, pageSize: 12 })
      relatedVideos.value = data.list || []
    }
  } catch (error) {
    console.error('获取相关视频失败:', error)
    relatedVideos.value = []
  }
}

// 切换资源
const handleSourceChange = (sourceId: string) => {
  activeSource.value = sourceId
  
  // 更新集数列表
  const source = video.value?.sources?.find(s => s.id === sourceId)
  if (source) {
    episodes.value = source.urls.map(el => ({
      id: el.url || '',
      title: el.label || ''
    })) || []
    // 切换到新资源的第一集
    activeEpisode.value = source.urls[0]?.url || ''
    
    // 更新路由参数
    updateRouteParams(sourceId, activeEpisode.value)
  }
}

// 切换集数
const handleEpisodeChange = (episodeId: string) => {
  activeEpisode.value = episodeId
  
  // 更新路由参数
  updateRouteParams(activeSource.value, episodeId)
}

// 更新路由参数
const updateRouteParams = (sourceId: string, episodeId: string) => {
  let source = video.value?.sources?.find(s => s.id === sourceId)
  let episode = source?.urls?.find(item => item.url === episodeId)?.label || ''
  let data = {
    source: source?.source || '',
    episode: episode || ''
  }
  router.push({
    path: `/detail/${route.params.id}/${data.source}/${data.episode}`,
  })
}

// 监听路由参数变化
watch(() => route.params.source, async (newsource) => {
  if (newsource && video.value) {
    await getVideoDetail()
  }
})

onMounted(async () => {
  await getVideoDetail()
  await getRelatedVideos()
  document.addEventListener('scroll', (e:any) => {
    if (playerRef.value && e.target?.scrollingElement?.scrollTop > 300) {
      playerRef.value.player?.root?.children?.[1].requestPictureInPicture()
    } else if (document.pictureInPictureElement) {
      document.exitPictureInPicture();
    }
  })
})
</script>

<style scoped>
.player-view {
  background-color: #000;
  color: #fff;
  min-height: 100vh;
}

.movie-card {
  transition: transform 0.3s ease;
}

.movie-card:hover {
  transform: translateY(-3px);
}
</style>