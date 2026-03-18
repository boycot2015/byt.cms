<template>
  <div class="app">
    <!-- 头部导航栏 -->
    <header class="header bg-black rounded-t-2xl">
      <div class="container p-4 border-b md:border-0 border-gray-800 mx-auto flex justify-between items-center">
        <div class="flex items-center text-white ">
          <h1 class="text-xs md:text-2xl font-bold text-red-600 mr-1 md:mr-6 cursor-pointer" @click="router.push('/')">影视在线</h1>
          <nav class="hidden md:block">
            <ul class="flex space-x-4 text-sm">
              <li v-for="route in routes" :key="route.path"><router-link :to="route.path" class="hover:text-red-600" :class="activeClass(route)">{{route.meta?.title||route.name}}</router-link></li>
            </ul>
          </nav>
        </div>
        <div class="flex items-center space-x-3 text-white">
          <Search />
          <div v-if="userStore.isLoggedIn" class="flex items-center space-x-3">
            <span class="text-sm text-white-700">{{ userStore.user?.username }}</span>
            <button @click="handleLogout" class="text-sm text-white-600 hover:text-red-500">退出</button>
          </div>
          <button v-else @click="showLoginModal = true" class="bg-red-600 text-white px-3 py-1.5 rounded-full hover:bg-red-700 text-sm">登录</button>
        </div>
        <LoginModal 
          :visible="showLoginModal" 
          @close="showLoginModal = false"
        />
      </div>
      <nav class="md:hidden flex px-4 py-2 mx-auto text-white">
        <ul class="flex space-x-4 text-sm">
          <li v-for="route in routes" v-show="!route.meta?.hideInMenu" :key="route.path"><router-link :to="route.path" class="hover:text-red-600" :active-class="currentRoute.path.includes(route.path)?'text-red-600 border-b-2 border-red-600 pb-2':''">{{route.meta?.title||route.name}}</router-link></li>
        </ul>
      </nav>
    </header>
    <!-- 路由视图 -->
    <router-view />

    <!-- 页脚 -->
    <footer class="footer bg-gray-800 text-white py-6 px-4">
      <div class="container mx-auto">
        <!-- <div class="flex justify-center mb-4">
          <ul class="flex space-x-2 md:space-x-6 text-sm">
            <li><a href="#" class="hover:text-red-600">关于我们</a></li>
            <li><a href="#" class="hover:text-red-600">联系方式</a></li>
            <li><a href="#" class="hover:text-red-600">隐私政策</a></li>
            <li><a href="#" class="hover:text-red-600">用户协议</a></li>
            <li><a href="#" class="hover:text-red-600">网站地图</a></li>
          </ul>
        </div> -->
        <div class="text-center text-sm text-gray-400">
          <p>© 2026 影视在线 版权所有</p>
        </div>
      </div>
    </footer>
    <FloatingActions />
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import { useRouter } from 'vue-router'
import Search from './components/Search.vue'
import FloatingActions from './components/FloatingActions.vue'
import LoginModal from './components/LoginModal.vue'
import { useUserStore } from './store/user'
const router = useRouter()
const routes = router.options?.routes.filter(route => !route.meta?.hideInMenu).map(route => ({
  ...route,
  path: route.path.replace('/:id?', '')
})) || []
const currentRoute = router.currentRoute
const activeClass = computed(() => {
  return (route:any) => {
    let className = ''
    let routePath = route.path.substring(1)
    if (!routePath && currentRoute.value.path === '/') return 'text-red-600 border-b-2 border-red-600 pb-2'
    let currentPath = currentRoute.value.path.substring(1)
    if (currentPath.startsWith(routePath) && routePath) {
      className = 'text-red-600 border-b-2 border-red-600 pb-2'
    }
    return className
  }
})

const showLoginModal = ref(false)
const userStore = useUserStore()

// 从本地存储加载用户信息
onMounted(() => {
  userStore.loadFromLocalStorage()
})

const handleLogout = () => {
  userStore.logout()
}
</script>

<style scoped>

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