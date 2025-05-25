<script setup lang="ts">
defineProps({
  type: {
    type: String,
    required: true,
    default: 'text',
  },
  placeholder: {
    type: String,
    required: true,
  },
  id: {
    type: String,
    required: true,
    default: '',
  },
})

const model: string = defineModel({type: String, default: ''})
</script>

<template>
  <input v-model="model" :id :type :placeholder />
</template>
