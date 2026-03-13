<template>
  <div class="movie-card cursor-pointer">
    <router-link :to="{ path: `/detail/${video.id}` }" v-if="!video.loading">
        <div class="relative">
        <img :src="video.cover" :alt="video.title" class="w-full h-60 md:h-40 object-cover rounded" :class="video.size=='large'?'!h-120 md:!h-80':''" />
        </div>
        <div class="mt-2" v-if="video.size!='large'">
          <p class="text-sm font-medium text-gray-800 line-clamp-1">{{ video.title }}</p>
          <p class="text-xs text-gray-500">{{ video.subTitle || `${video.releaseYear || 2025} ${video.category || '动作片'} ${video.director || '导演'} ${video.country || '荷兰'}` }}</p>
        </div>
    </router-link>
    <div v-else class="w-full">
      <div class="rounded-md h-36 bg-gray-200 w-full"></div>
      <p class="text-sm h-4 mt-2 bg-gray-200 w-[80%]"></p>
      <p class="text-sm h-4 mt-2 bg-gray-200 w-[50%]"></p>
    </div>
  </div>
</template>

<script setup lang="ts">
import type { Video } from '../types'
defineProps<{
  video: Video & { size?: string | undefined }
}>()
</script>

<style scoped>
.movie-card {
  transition: transform 0.3s ease;
}

.movie-card:hover {
  transform: translateY(-3px);
}
</style>