<template>
  <div class="anime-view">
    <div class="container mx-auto py-4 px-4">
      <h1 class="text-2xl font-bold text-gray-800 mb-6">动漫</h1>
      <!-- 分类导航 -->
      <div class="category-nav bg-gray-100 py-2 px-4 border-b border-gray-200 mb-8">
          <div class="container mx-auto">
              <ul class="flex space-x-6 text-sm">
                  <li><a href="#" class="text-gray-600 hover:text-red-600">全部</a></li>
                  <li><a href="#" class="text-gray-600 hover:text-red-600">动作</a></li>
                  <li><a href="#" class="text-gray-600 hover:text-red-600">喜剧</a></li>
                  <li><a href="#" class="text-gray-600 hover:text-red-600">科幻</a></li>
                  <li><a href="#" class="text-gray-600 hover:text-red-600">悬疑</a></li>
                  <li><a href="#" class="text-gray-600 hover:text-red-600">爱情</a></li>
                  <li><a href="#" class="text-gray-600 hover:text-red-600">奇幻</a></li>
                  <li><a href="#" class="text-gray-600 hover:text-red-600">冒险</a></li>
                  <li><a href="#" class="text-gray-600 hover:text-red-600">武侠</a></li>
              </ul>
          </div>
      </div>
      <div class="grid grid-cols-6 gap-3">
        <div class="movie-card" v-for="i in 12" :key="i">
          <div class="relative">
            <img src="https://via.placeholder.com/200x300?text=Anime" alt="动漫" class="w-full h-40 object-cover rounded" />
          </div>
          <div class="mt-2">
            <p class="text-sm font-medium text-gray-800 line-clamp-1">动漫标题 {{ i }}</p>
            <p class="text-xs text-gray-500">更新至第12集</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
</script>

<style scoped>
.anime-view {
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