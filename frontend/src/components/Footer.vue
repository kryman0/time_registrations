<script setup lang="ts">
defineProps({
  response: {
    type: String,
    required: false,
    default: '',
  }
})

const model: string = defineModel()
</script>

<template>
  <footer v-if="response" class="w-full mt-5 border-b border-dashed text-red-500">
    {{ response }}
  </footer>
</template>
