<script setup lang="ts">
defineProps({
  response: {
    type: String,
    required: false,
    default: '',
  }
})
</script>

<template>
  <footer class="w-full mt-5 border-b border-dashed text-red-500">
    <slot>{{ response }}</slot>
  </footer>
</template>
