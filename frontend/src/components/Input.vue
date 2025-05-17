<script setup lang="ts">
defineProps({
  type: {
    type: String,
    required: true,
    default: 'text',
  }
})

// 19111211-0101
</script>

<template>
  <input :type />
</template>

<style>
  input {
    display: block;
    margin: 10px 0;
    padding: 3px;
    max-width: 200px;
    border: 1px solid blue;
    border-radius: 5px;
  }

  input:invalid {
    border: 1px solid red;
  }
</style>
