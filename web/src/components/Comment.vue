<template>
  <div class="comments-section bg-white">
    <h2 class="text-lg font-bold mb-4">评论 ({{ totalComments }})</h2>
    
    <!-- 发表评论 -->
    <div class="mb-6">
      <div v-if="user" class="p-4 rounded-lg">
        <h3 class="text-sm font-medium mb-2">发表评论</h3>
        <textarea 
          v-model="commentContent" 
          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" 
          rows="3" 
          placeholder="写下你的评论..."
        ></textarea>
        <div class="flex justify-end mt-2">
          <button 
            @click="submitComment" 
            :disabled="!commentContent.trim() || submitting"
            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors disabled:bg-gray-400"
          >
            {{ submitting ? '提交中...' : '提交评论' }}
          </button>
        </div>
      </div>
      <div v-else class="p-4 rounded-lg text-center">
        <p class="text-gray-600">请先 <span class="text-red-600 cursor-pointer hover:underline" @click="openLoginModal">登录</span> 后发表评论</p>
      </div>
    </div>
    
    <!-- 评论列表 -->
    <div v-if="comments.length > 0" class="space-y-6">
      <div v-for="comment in comments" :key="comment.id" class="border-b border-gray-200 pb-4">
        <div class="flex">
          <div class="flex-shrink-0 mr-3">
            <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
              <span class="text-sm font-medium text-gray-600">{{ comment.user?.nickname?.[0] || comment.user?.username?.[0] || '?' }}</span>
            </div>
          </div>
          <div class="flex-1">
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-2">
                <h4 class="text-sm font-medium text-gray-700">{{ comment.user?.nickname || comment.user?.username || '匿名用户' }}</h4>
                <span v-if="comment.user?.role === 'admin'" class="text-xs text-red-500 px-1 rounded-full bg-red-100">管理员</span>
              </div>
              <span class="text-xs text-gray-500">{{ formatTime(comment.createTime) }}</span>
            </div>
            <p class="mt-1 text-sm text-gray-600">{{ comment.content }}</p>
            <div class="mt-2 flex items-center space-x-4">
              <button 
                @click="likeComment(comment)" 
                class="flex items-center text-xs text-gray-500 hover:text-red-500 transition-colors"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span>{{ comment.likes || 0 }}</span>
              </button>
              <button 
                @click="replyToComment(comment)" 
                class="text-xs text-gray-500 hover:text-red-500 transition-colors"
              >
                回复
              </button>
            </div>
            
            <!-- 回复列表 -->
            <div v-if="comment.replies && comment.replies.length > 0" class="mt-3 ml-6 space-y-3">
              <div v-for="reply in comment.replies" :key="reply.id" class="flex">
                <div class="flex-shrink-0 mr-2">
                  <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                    <span class="text-xs font-medium text-gray-600">{{ reply.user?.nickname?.[0] || reply.user?.username?.[0] || '?' }}</span>
                  </div>
                </div>
                <div class="flex-1">
                  <div class="flex items-center justify-between">
                    <h5 class="text-xs font-medium text-gray-700">{{ reply.user?.nickname || reply.user?.username || '匿名用户' }}</h5>
                    <span class="text-xs text-gray-500">{{ formatTime(reply.createTime) }}</span>
                  </div>
                  <p class="mt-1 text-xs text-gray-600">{{ reply.content }}</p>
                  <div class="mt-1 flex items-center space-x-4">
                    <button 
                      @click="likeComment(reply)" 
                      class="flex items-center text-xs text-gray-500 hover:text-red-500 transition-colors"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                      </svg>
                      <span>{{ reply.likes || 0 }}</span>
                    </button>
                    <button 
                      @click="replyToComment(reply)" 
                      class="text-xs text-gray-500 hover:text-red-500 transition-colors"
                    >
                      回复
                    </button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- 回复输入框 -->
            <div v-if="replyingTo === comment.id" class="mt-3 ml-6">
              <textarea 
                v-model="replyContent" 
                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" 
                rows="2" 
                placeholder="写下你的回复..."
              ></textarea>
              <div class="flex justify-end mt-1">
                <button 
                  @click="cancelReply" 
                  class="text-xs text-gray-600 mr-2 hover:text-gray-800"
                >
                  取消
                </button>
                <button 
                  @click="submitReply(comment)" 
                  :disabled="!replyContent.trim() || submitting"
                  class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700 transition-colors disabled:bg-gray-400"
                >
                  {{ submitting ? '提交中...' : '回复' }}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- 无评论提示 -->
    <div v-else class="text-center py-8">
      <p class="text-gray-500">暂无评论，快来发表第一条评论吧！</p>
    </div>
    
    <!-- 分页 -->
    <div v-if="totalComments > pageSize" class="mt-6 flex justify-center">
      <div class="inline-flex rounded-md shadow-sm">
        <button 
          @click="changePage(page - 1)" 
          :disabled="page === 1"
          class="px-3 py-1 border border-gray-300 text-sm font-medium rounded-l-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          上一页
        </button>
        <span class="px-3 py-1 border-t border-b border-gray-300 text-sm font-medium text-gray-700 bg-white">
          {{ page }} / {{ Math.ceil(totalComments / pageSize) }}
        </span>
        <button 
          @click="changePage(page + 1)" 
          :disabled="page >= Math.ceil(totalComments / pageSize)"
          class="px-3 py-1 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          下一页
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, watch } from 'vue'
import { apiService } from '../services/api'
import { useUserStore } from '../store/user'
import type { Comment as CommentType } from '../types'

const props = defineProps<{
  videoId: string
  episodeId?: string,
  comments?: CommentType[]
  totalComments?: number
  currentTime?: number
}>()

const emit = defineEmits<{
  (e: 'openLogin'): void,
  (e: 'update', comment: CommentType): void
}>()

const userStore = useUserStore()
const user = ref(userStore.user)
const comments = ref<CommentType[]>(props.comments || [])
const totalComments = ref(props.totalComments || 0)
const page = ref(props.comments ? props?.comments.length > 0 ? 2 : 1 : 1)
const pageSize = ref(20)
const commentContent = ref('')
const replyContent = ref('')
const replyingTo = ref<string | null>(null)
const submitting = ref(false)

const openLoginModal = () => {
  emit('openLogin')
}

const formatTime = (time: string) => {
  return new Date(time).toLocaleString()
}

const fetchComments = async () => {
  if (!props.videoId) return
  try {
    const data = await apiService.getComments({
      videoId: props.videoId,
      episodeId: props.episodeId,
      page: page.value,
      pageSize: pageSize.value
    })
    comments.value = data.list || []
    totalComments.value = data.total || 0
  } catch (error) {
    console.error('获取评论失败:', error)
  }
}

const submitComment = async () => {
  if (!commentContent.value.trim() || !user.value) return
  
  submitting.value = true
  try {
    let res = await apiService.createComment({
      videoId: props.videoId,
      episodeId: props.episodeId,
      userId: user.value.id,
      currentTime: props.currentTime || 0,
      content: commentContent.value.trim()
    })
    res && emit('update', res)
    commentContent.value = ''
    page.value = 1
    await fetchComments()
  } catch (error) {
    console.error('发表评论失败:', error)
  } finally {
    submitting.value = false
  }
}

const submitReply = async (comment: CommentType) => {
  if (!replyContent.value.trim() || !user.value) return
  
  submitting.value = true
  try {
    // console.log(props.currentTime || 0)
    let params = {
      videoId: props.videoId,
      episodeId: props.episodeId,
      userId: user.value.id,
      content: replyContent.value.trim(),
      parentId: comment.id,
      currentTime: comment.currentTime || 0
    }
   let res = await apiService.createComment(params)
    replyContent.value = ''
    replyingTo.value = null
    await fetchComments()
    res && emit('update', res)
  } catch (error) {
    console.error('发表回复失败:', error)
  } finally {
    submitting.value = false
  }
}

const replyToComment = (comment: CommentType) => {
  if (!user.value) {
    openLoginModal()
    return
  }
  replyingTo.value = comment.id
}

const cancelReply = () => {
  replyingTo.value = null
  replyContent.value = ''
}

const likeComment = async (comment: CommentType) => {
  if (!user.value) {
    openLoginModal()
    return
  }
  
  try {
    await apiService.likeComment(comment.id)
    await fetchComments()
  } catch (error) {
    console.error('点赞失败:', error)
  }
}

const changePage = (newPage: number) => {
  if (newPage < 1 || newPage > Math.ceil(totalComments.value / pageSize.value)) return
  page.value = newPage
  fetchComments()
}

onMounted(() => {
  fetchComments()
})

watch(() => props.videoId, () => {
  page.value = 1
  fetchComments()
})

watch(() => props.episodeId, () => {
  page.value = 1
  fetchComments()
})

watch(() => userStore.user, (newUser) => {
  user.value = newUser
})
</script>

<style scoped>
.comments-section {
  /* background-color: white; */
  border-radius: 8px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin-bottom: 20px;
}
</style>