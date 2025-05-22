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
  }
})
</script>

<template>
  <input :id :type :placeholder />
</template>
