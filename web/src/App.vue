<template>
  <div class="app">
    <!-- 头部导航栏 -->
    <header class="header bg-black text-white py-3 pb-0 md:pb-3">
      <div class="container px-4 pb-2 md:pb-0 border-b md:border-0 border-gray-700 mx-auto flex justify-between items-center">
        <div class="flex items-center">
          <h1 class="text-xs md:text-2xl font-bold text-red-600 mr-1 md:mr-6">影视在线</h1>
          <nav class="hidden md:block">
            <ul class="flex space-x-4 text-sm">
              <li v-for="route in routes" v-show="!route.meta?.hideInMenu" :key="route.path"><router-link :to="route.path" class="hover:text-red-600" :active-class="currentRoute.path==route.path?'text-red-600 border-b-2 border-red-600 pb-1':''">{{route.meta?.title||route.name}}</router-link></li>
            </ul>
          </nav>
        </div>
        <div class="flex items-center space-x-3">
          <Search />
          <button class="bg-red-600 text-white px-3 py-1.5 rounded-xl md:rounded-full hover:bg-red-700 text-sm">登录</button>
        </div>
      </div>
      <nav class="md:hidden flex px-4 py-2 mx-auto">
        <ul class="flex space-x-4 text-sm">
          <li v-for="route in routes" v-show="!route.meta?.hideInMenu" :key="route.path"><router-link :to="route.path" class="hover:text-red-600" :active-class="currentRoute.path==route.path?'text-red-600 border-b-2 border-red-600 pb-2':''">{{route.meta?.title||route.name}}</router-link></li>
        </ul>
      </nav>
    </header>
    <!-- 路由视图 -->
    <router-view />

    <!-- 页脚 -->
    <footer class="footer bg-gray-800 text-white py-6 px-4">
      <div class="container mx-auto">
        <div class="flex justify-center mb-4">
          <ul class="flex space-x-2 md:space-x-6 text-sm">
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
import Search from './components/Search.vue'
const router = useRouter()
// console.log(router, 'router');
const routes = router.options?.routes || []
const currentRoute = router.currentRoute
</script>

<style scoped>
.app {
  /* min-height: 100vh;
  background-color: #f5f5f5;
  display: flex;
  flex-direction: column; */
}

.header {
  position: sticky;
  top: 0;
  z-index: 99999;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.footer {
  margin-top: auto;
}
</style>