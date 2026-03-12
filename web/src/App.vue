<template>
  <div class="app">
    <!-- 头部导航栏 -->
    <header class="header bg-black text-white py-3 px-4">
      <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center">
          <h1 class="text-2xl font-bold text-red-600 mr-6">影视在线</h1>
          <nav>
            <ul class="flex space-x-4 text-sm">
              <li v-for="route in routes" v-show="!route.meta?.hideInMenu" :key="route.path"><router-link :to="route.path" class="hover:text-red-600" :active-class="currentRoute.path==route.path?'text-red-600 border-b-2 border-red-600 pb-1':''">{{route.meta?.title||route.name}}</router-link></li>
            </ul>
          </nav>
        </div>
        <div class="flex items-center space-x-3">
          <div class="relative">
            <input type="text" placeholder="搜索电影、电视剧、综艺、动漫" class="bg-gray-800 text-white px-3 py-1.5 rounded-full w-64 focus:outline-none focus:ring-2 focus:ring-red-600 text-sm" />
            <button class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-red-600">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </button>
          </div>
          <button class="bg-red-600 text-white px-3 py-1.5 rounded-full hover:bg-red-700 text-sm">登录</button>
        </div>
      </div>
    </header>

    <!-- 路由视图 -->
    <router-view />

    <!-- 页脚 -->
    <footer class="footer bg-gray-800 text-white py-6 px-4">
      <div class="container mx-auto">
        <div class="flex justify-center mb-4">
          <ul class="flex space-x-6 text-sm">
            <li><a href="#" class="hover:text-red-600">关于我们</a></li>
            <li><a href="#" class="hover:text-red-600">联系方式</a></li>
            <li><a href="#" class="hover:text-red-600">隐私政策</a></li>
            <li><a href="#" class="hover:text-red-600">用户协议</a></li>
            <li><a href="#" class="hover:text-red-600">网站地图</a></li>
          </ul>
        </div>
        <div class="text-center text-sm text-gray-400">
          <p>© 2026 影视在线 版权所有</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router'
const router = useRouter()
// console.log(router, 'router');
const routes = router.options?.routes || []
const currentRoute = router.currentRoute
</script>

<style scoped>
.app {
  min-height: 100vh;
  background-color: #f5f5f5;
  display: flex;
  flex-direction: column;
}

.header {
  position: sticky;
  top: 0;
  z-index: 100;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.footer {
  margin-top: auto;
}
</style>