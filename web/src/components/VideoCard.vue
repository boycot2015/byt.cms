<template>
  <div class="movie-card cursor-pointer">
    <router-link :to="{ path: `/detail/${video.id}` }">
        <div class="relative">
        <img :src="video.cover" :alt="video.title" class="w-full h-40 object-cover rounded" :class="video.size=='large'?'!h-80':''" />
        </div>
        <div class="mt-2" v-if="video.size!='large'">
          <p class="text-sm font-medium text-gray-800 line-clamp-1">{{ video.title }}</p>
          <p class="text-xs text-gray-500">{{ video.subTitle || `${video.releaseYear || 2025} ${video.category || '动作片'} ${video.director || '导演'} ${video.country || '荷兰'}` }}</p>
        </div>
    </router-link>
  </div>
</template>

<script setup lang="ts">
defineProps<{
  video: {
    id: string
    title: string
    cover: string
    subTitle?: string
    releaseYear?: number
    category?: string
    country?: string
    size?: string
  }
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