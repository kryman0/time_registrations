<script setup lang="ts">
defineProps({
  value: {
    type: String,
    required: false,
    default: 'Submit',
  },
})
</script>

<template>
  <button>{{ value }}</button>
</template>
