<template>
  <div class="loading-container flex flex-col items-center justify-center py-10">
    <div 
      :class="[
        'loading-spinner animate-spin rounded-full border-t-2 border-b-2 mb-4',
        size === 'sm' ? 'h-8 w-8' : size === 'lg' ? 'h-16 w-16' : 'h-12 w-12',
        color
      ]"
    ></div>
    <p class="text-gray-600">{{ message }}</p>
  </div>
</template>

<script setup lang="ts">
defineProps({
  message: {
    type: String,
    default: '加载中...'
  },
  size: {
    type: String,
    default: 'md',
    validator: (value: string) => ['sm', 'md', 'lg'].includes(value)
  },
  color: {
    type: String,
    default: 'border-red-600'
  }
})
</script>

<script lang="ts">
export default {
  name: 'Loading'
}
</script>

