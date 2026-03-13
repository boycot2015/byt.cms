<template>
  <div v-if="total > 0" class="flex justify-center mt-8">
    <div class="flex items-center space-x-1 md:space-x-4">
      <span class="text-sm">共{{ total }}条</span>
      <button 
        @click="handlePageChange(currentPage - 1)" 
        :disabled="currentPage === 1" 
        class="px-3 py-1 border rounded-md text-sm disabled:opacity-50 disabled:cursor-not-allowed"
      >
        上一页
      </button>
      <span class="text-sm">
        {{ currentPage }} / {{ totalPages }}
      </span>
      <button 
        @click="handlePageChange(currentPage + 1)" 
        :disabled="currentPage === totalPages" 
        class="px-3 py-1 border rounded-md text-sm disabled:opacity-50 disabled:cursor-not-allowed"
      >
        下一页
      </button>
      <div class="flex items-center space-x-2">
        <span class="text-sm">每页:</span>
        <select 
          v-model="localPageSize" 
          @change="handlePageSizeChange" 
          class="border rounded-md text-sm px-2 py-1"
        >
          <option v-for="size in pageSizeOptions" :key="size" :value="size">
            {{ size }}
          </option>
        </select>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed, ref, watch } from 'vue'

const props = defineProps({
  currentPage: {
    type: Number,
    required: true
  },
  total: {
    type: Number,
    required: true
  },
  pageSize: {
    type: Number,
    default: 18
  }
})

const emit = defineEmits(['page-change', 'page-size-change'])

const pageSizeOptions = [12, 18, 72, 120]
const localPageSize = ref(props.pageSize)

// 监听 props.pageSize 变化
watch(() => props.pageSize, (newSize) => {
  localPageSize.value = newSize
})

const totalPages = computed(() => {
  return Math.ceil(props.total / localPageSize.value)
})

const handlePageChange = (page: number) => {
  if (page >= 1 && page <= totalPages.value) {
    emit('page-change', page)
  }
}

const handlePageSizeChange = () => {
  emit('page-size-change', localPageSize.value)
}
</script>

<script lang="ts">
export default {
  name: 'Pagination'
}
</script>