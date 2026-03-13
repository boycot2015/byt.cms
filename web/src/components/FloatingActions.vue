<template>
  <div class="fixed bottom-28 right-6 z-50">
    <!-- 展开的选项 -->
    <div 
      class="flex flex-col items-center space-y-3 transition-all duration-300 ease-in-out"
      :class="{ 'opacity-100 translate-y-[-10px]': isExpanded, 'opacity-0 translate-y-4 pointer-events-none': !isExpanded }"
    >
      <!-- 主题切换按钮 -->
      <button 
        @click="toggleTheme"
        class="w-10 h-10 rounded-full bg-gray-800 text-white flex items-center justify-center shadow-lg hover:bg-gray-700 transition-colors"
        aria-label="切换主题"
      >
        <svg v-if="isDarkTheme" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
        </svg>
      </button>
      
      <!-- 回到顶部按钮 -->
      <button 
        @click="scrollToTop"
        class="w-10 h-10 rounded-full bg-gray-800 text-white flex items-center justify-center shadow-lg hover:bg-gray-700 transition-colors"
        aria-label="回到顶部"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
      </button>
    </div>
    
    <!-- 主按钮 -->
    <button 
      @click="isExpanded = !isExpanded"
      class="w-10 h-10 rounded-full bg-red-600 text-white flex items-center justify-center shadow-lg hover:bg-red-700 transition-colors"
      aria-label="更多选项"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform duration-300" :class="{ 'rotate-135': isExpanded }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m-7-7h14" />
      </svg>
    </button>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'

const isExpanded = ref(false)
const isDarkTheme = ref(false)

// 检测系统主题
onMounted(() => {
  isDarkTheme.value = window.matchMedia('(prefers-color-scheme: dark)').matches || localStorage.getItem('theme') === 'dark'
  applyTheme()
})

// 应用主题
const applyTheme = () => {
  if (isDarkTheme.value) {
    document.documentElement.classList.add('dark')
    localStorage.setItem('theme', 'dark')
  } else {
    document.documentElement.classList.remove('dark')
    localStorage.removeItem('theme')
  }
}

// 切换主题
const toggleTheme = async () => {
  // 开始视图过渡
  if (document.startViewTransition) {
    await document.startViewTransition(() => {
      isDarkTheme.value = !isDarkTheme.value
      applyTheme()
    }).ready
  } else {
    // 降级方案
    isDarkTheme.value = !isDarkTheme.value
    applyTheme()
  }
}

// 回到顶部
const scrollToTop = () => {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  })
  isExpanded.value = false
}
</script>

<style scoped>
/* 可以添加额外的样式 */
</style>

<style>
/* 主题切换的全局过渡样式 */
::view-transition-new(root),
::view-transition-old(root) {
  animation-duration: 0.5s;
}

::view-transition-new(root) {
  animation-name: fade-in;
}

::view-transition-old(root) {
  animation-name: fade-out;
}

@keyframes fade-in {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes fade-out {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
  }
}
</style>