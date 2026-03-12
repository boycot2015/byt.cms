<template>
  <div class="ranking-container bg-white rounded-lg p-3 border border-gray-200">
    <h3 class="text-base font-bold text-gray-800 mb-3" v-if="title">{{ title }}<span class="text-xs text-red-600 mx-2" v-if="showSuffix">●</span>排行榜</h3>
    <ul class="space-y-3">
      <li v-for="(item, index) in items" :key="item.id">
        <div class="flex items-center gap-2">
          <div class="w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold" 
            :class="index < 3 ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-600'"
          >{{ index + 1 }}</div>
          <router-link v-if="!item.loading" :to="`/detail/${item.id}`" class="flex-1 text-sm text-gray-800 hover:text-red-600 line-clamp-1">{{ item.title }}</router-link>
          <div v-else class="rounded-md h-4 bg-gray-200 flex-1"></div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import  type { Video } from '../types'
const props = defineProps<{
  title?: string
  showSuffix?: boolean
  items?: Video[]
}>()
const items = computed(() => props.items && props.items.length > 0 ? props.items : [...Array(6).keys()].map(() => ({ loading: true, id: '', title: '' })))
</script>

<script lang="ts">
export default {
  name: 'Ranking'
};
</script>

<style scoped>
/* .ranking-container {
  max-height: 420px;
  overflow-y: auto;
} */
</style>