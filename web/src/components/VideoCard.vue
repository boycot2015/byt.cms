<template>
  <div class="movie-card cursor-pointer relative group" v-if="video">
    <router-link :to="{ path: `/detail/${video.id}` }" v-if="!video.loading">
      <div class="relative overflow-hidden rounded-md">
        <img :src="video.cover" :alt="video.title" class="w-full h-70 md:h-50 lg:h-60 xl:h-70 object-cover rounded" :class="video.size=='large'?'h-120 md:h-90 lg:h-60 xl:h-80':''" />
        <!-- 底部信息区域 -->
        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/90 to-transparent p-4 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out">
          <div class="text-white">
            <p class="text-xs mb-1">导演: {{ video.director || '未知' }}</p>
            <p class="text-xs line-clamp-1 mb-1">主演: {{ video.actors ? video.actors.join(',') || '未知' : '未知' }}</p>
            <p class="text-xs line-clamp-2 mt-2" :title="desc" v-html="desc"></p>
          </div>
        </div>
        <div v-if="placement=='inner'" class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-2 group-hover:opacity-0 transition-opacity duration-300 ease-in-out">
          <p class="text-xs text-white line-clamp-1">{{ video.title }}</p>
          <div class="text-xs text-gray-300">{{ video.subTitle || '更新至第1集' }}</div>
        </div>
      </div>
      <div class="mt-2" v-if="video.size!='large'&&placement!='inner'">
        <p class="text-sm font-medium text-gray-800 line-clamp-1">{{ video.title }}</p>
        <p class="text-xs text-gray-500">{{ video.subTitle || `${video.releaseYear || 2025} ${video.category || '动作片'} ${video.director || '导演'} ${video.country || '荷兰'}` }}</p>
      </div>
    </router-link>
    <div v-else class="w-full">
      <div class="rounded-xl h-70 md:h-50 lg:h-60 xl:h-70 bg-gray-200 w-full animate-pulse"></div>
      <p class="text-sm h-4 mt-2 bg-gray-200 w-[100%] animate-pulse"></p>
      <p class="text-sm h-4 mt-2 bg-gray-200 w-[60%] animate-pulse"></p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import type { Video } from '../types'
const props = defineProps<{
  placement?: string | undefined,
  video: Video & { size?: string | undefined}
}>()
const desc = computed(() => props.video.desc?.replace(/style\s*=\s*["'][^"']*["']/gi, '').replace(/&nbsp;|<p>|<br\/>|<\/p>|<\/br>/g, '').trim() || '暂无描述')
</script>

<style scoped>
.movie-card {
  transition: transform 0.3s ease;
}

.movie-card:hover {
  transform: translateY(-3px);
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  line-clamp: 2;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>