<template>
  <div v-if="visible" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4 transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-md overflow-hidden transform transition-all duration-300 scale-100">
      <!-- 头部 -->
      <div class="p-6 pt-8 pb-4">
        <div class="flex justify-center mb-8">
          <h1 class="text-2xl font-bold text-red-600">影视在线</h1>
        </div>
      </div>
      
      <!-- 内容 -->
      <div class="px-6 pb-8">
        <!-- 登录表单 -->
        <div v-if="activeTab === 'login' && loginMode === 'password'">
          <!-- 账号输入 -->
          <div class="mb-4 relative">
            <div class="flex border border-gray-300 rounded-md overflow-hidden">
              <input 
                v-model="loginForm.phone" 
                type="text" 
                class="flex-1 px-3 py-2 focus:outline-none"
                placeholder="请输入账号"
              />
            </div>
          </div>
          
          <!-- 密码输入 -->
          <div class="mb-4 relative">
            <div class="flex border border-gray-300 rounded-md overflow-hidden">
              <input 
                v-model="loginForm.password" 
                :type="showPassword ? 'text' : 'password'" 
                class="flex-1 px-3 py-2 focus:outline-none"
                placeholder="请输入密码"
              />
              <button 
                @click="showPassword = !showPassword"
                class="px-3 py-2 border-l border-gray-300 flex items-center"
              >
                <svg v-if="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" v-else width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13"/></svg>
              </button>
            </div>
          </div>
          
          <!-- 登录方式切换和忘记密码 -->
          <div class="flex justify-between mb-6 text-sm text-red-600">
            <button @click="loginMode = 'sms'" class="hover:underline">验证码登录</button>
            <button @click="showForgotPassword = true" class="hover:underline">忘记密码</button>
          </div>
          
          <!-- 登录按钮 -->
          <button 
            @click="handleLogin" 
            class="w-full bg-red-600 text-white py-2.5 rounded-md hover:bg-red-600 transition-colors flex items-center justify-center"
            :disabled="userStore.isLoading"
          >
            <svg v-if="userStore.isLoading" class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ userStore.isLoading ? '登录中...' : '登录' }}
          </button>
          
          <!-- 注册链接 -->
          <div class="mt-4 text-center text-sm">
            <span>还没有账号，</span>
            <button @click="activeTab = 'register'" class="text-red-600 hover:underline">前往注册</button>
          </div>
        </div>
        
        <!-- 验证码登录 -->
        <div v-else-if="loginMode === 'sms'">
          <!-- 手机号输入 -->
          <div class="mb-4 relative">
            <div class="flex border border-gray-300 rounded-md overflow-hidden">
              <div class="px-3 py-2 border-r border-gray-300 flex items-center">
                <span>+86</span>
              </div>
              <input 
                v-model="smsForm.phone" 
                type="tel" 
                class="flex-1 px-3 py-2 focus:outline-none"
                placeholder="请输入手机号"
              />
            </div>
          </div>
          
          <!-- 验证码输入 -->
          <div class="mb-4 relative">
            <div class="flex border border-gray-300 rounded-md overflow-hidden">
              <input 
                v-model="smsForm.code" 
                type="text" 
                class="flex-1 px-3 py-2 focus:outline-none"
                placeholder="请输入验证码"
              />
              <button 
                @click="sendCode"
                class="px-3 py-2 border-l border-gray-300"
                :disabled="countdown > 0"
              >
                {{ countdown > 0 ? `${countdown}s后重发` : '获取验证码' }}
              </button>
            </div>
          </div>
          
          <!-- 登录方式切换 -->
          <div class="flex justify-start mb-6 text-sm text-red-600">
            <button @click="loginMode = 'password'" class="hover:underline">密码登录</button>
          </div>
          
          <!-- 登录按钮 -->
          <button 
            @click="handleSmsLogin" 
            class="w-full bg-red-600 text-white py-2.5 rounded-md hover:bg-red-600 transition-colors flex items-center justify-center"
            :disabled="userStore.isLoading"
          >
            <svg v-if="userStore.isLoading" class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ userStore.isLoading ? '登录中...' : '登录' }}
          </button>
          
          <!-- 注册链接 -->
          <div class="mt-4 text-center text-sm">
            <span>还没有账号，</span>
            <button @click="activeTab = 'register'" class="text-red-600 hover:underline">前往注册</button>
          </div>
        </div>
        
        <!-- 注册表单 -->
        <div v-else>
          <!-- 手机号输入 -->
          <div class="mb-4 relative">
            <div class="flex border border-gray-300 rounded-md overflow-hidden">
              <div class="px-3 py-2 border-r border-gray-300 flex items-center">
                <span>+86</span>
              </div>
              <input 
                v-model="registerForm.phone" 
                type="tel" 
                class="flex-1 px-3 py-2 focus:outline-none"
                placeholder="请输入手机号"
              />
            </div>
          </div>
          
          <!-- 验证码输入 -->
          <div class="mb-4 relative">
            <div class="flex border border-gray-300 rounded-md overflow-hidden">
              <input 
                v-model="registerForm.code" 
                type="text" 
                class="flex-1 px-3 py-2 focus:outline-none"
                placeholder="请输入验证码"
              />
              <button 
                @click="sendRegisterCode"
                class="px-3 py-2 border-l border-gray-300"
                :disabled="registerCountdown > 0"
              >
                {{ registerCountdown > 0 ? `${registerCountdown}s后重发` : '获取验证码' }}
              </button>
            </div>
          </div>
          
          <!-- 密码输入 -->
          <div class="mb-4 relative">
            <div class="flex border border-gray-300 rounded-md overflow-hidden">
              <input 
                v-model="registerForm.password" 
                :type="showRegisterPassword ? 'text' : 'password'" 
                class="flex-1 px-3 py-2 focus:outline-none"
                placeholder="请设置密码"
              />
              <button 
                @click="showRegisterPassword = !showRegisterPassword"
                class="px-3 py-2 border-l border-gray-300 flex items-center"
              >
                <svg v-if="showRegisterPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" v-else width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13"/></svg>
              </button>
            </div>
          </div>
          
          <!-- 注册按钮 -->
          <button 
            @click="handleRegister" 
            class="w-full bg-red-600 text-white py-2.5 rounded-md hover:bg-red-600 transition-colors flex items-center justify-center"
            :disabled="userStore.isLoading"
          >
            <svg v-if="userStore.isLoading" class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ userStore.isLoading ? '注册中...' : '注册' }}
          </button>
          
          <!-- 登录链接 -->
          <div class="mt-4 text-center text-sm">
            <span>已有账号，</span>
            <button @click="activeTab = 'login'" class="text-red-600 hover:underline">前往登录</button>
          </div>
        </div>
        
        <!-- 错误信息 -->
        <div v-if="userStore.error" class="mt-4 p-3 bg-red-50 text-red-600 rounded-md text-sm animate-fade-in">
          {{ userStore.error }}
        </div>
      </div>
      
      <!-- 关闭按钮 -->
      <button 
        @click="$emit('close')" 
        class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors"
        aria-label="关闭"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useUserStore } from '../store/user'

const props = defineProps<{
  visible: boolean
}>()

const emit = defineEmits<{
  (e: 'close'): void
}>()

const userStore = useUserStore()
const activeTab = ref('login')
const loginMode = ref('password') // 'password' 或 'sms'
const showPassword = ref(false)
const showRegisterPassword = ref(false)
const showForgotPassword = ref(false)

// 倒计时
const countdown = ref(0)
const registerCountdown = ref(0)

// 登录表单
const loginForm = ref({
  phone: '',
  password: ''
})

// 验证码登录表单
const smsForm = ref({
  phone: '',
  code: ''
})

// 注册表单
const registerForm = ref({
  phone: '',
  code: '',
  password: ''
})

// 发送验证码
const sendCode = () => {
  if (!smsForm.value.phone) {
    userStore.error = '请输入手机号'
    return
  }
  
  // 模拟发送验证码
  countdown.value = 60
  const timer = setInterval(() => {
    countdown.value--
    if (countdown.value <= 0) {
      clearInterval(timer)
    }
  }, 1000)
  
  userStore.error = ''
}

// 发送注册验证码
const sendRegisterCode = () => {
  if (!registerForm.value.phone) {
    userStore.error = '请输入手机号'
    return
  }
  
  // 模拟发送验证码
  registerCountdown.value = 60
  const timer = setInterval(() => {
    registerCountdown.value--
    if (registerCountdown.value <= 0) {
      clearInterval(timer)
    }
  }, 1000)
  
  userStore.error = ''
}

// 密码登录
const handleLogin = async () => {
  if (!loginForm.value.phone || !loginForm.value.password) {
    userStore.error = '请填写手机号和密码'
    return
  }
  
  try {
    await userStore.login(loginForm.value.phone, loginForm.value.password)
    emit('close')
  } catch (error) {
    // 错误已经在store中处理
  }
}

// 验证码登录
const handleSmsLogin = async () => {
  if (!smsForm.value.phone || !smsForm.value.code) {
    userStore.error = '请填写手机号和验证码'
    return
  }
  
  try {
    // 模拟验证码登录
    await userStore.login(smsForm.value.phone, smsForm.value.code)
    emit('close')
  } catch (error) {
    // 错误已经在store中处理
  }
}

// 注册
const handleRegister = async () => {
  if (!registerForm.value.phone || !registerForm.value.code || !registerForm.value.password) {
    userStore.error = '请填写完整的注册信息'
    return
  }
  
  try {
    await userStore.register(registerForm.value.phone, registerForm.value.password)
    emit('close')
  } catch (error) {
    // 错误已经在store中处理
  }
}
</script>

<style scoped>
/* 可以添加额外的样式 */
.animate-fade-in {
  animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>