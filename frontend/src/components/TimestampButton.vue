<script setup lang="ts">
defineProps({
  check_in: {
    type: Boolean,
    required: false,
    default: true,
  },
  check_out: {
    type: Boolean,
    required: false,
    default: true,
  },
  checkInValue: {
    type: String,
    required: false,
    default: 'Check in',
  },
  checkOutValue: {
    type: String,
    required: false,
    default: 'Check out',
  },
})

</script>

<template>
  <input type="button" :check_in />
</template>

<style>
  input {
    width: 100px;
    height: 20px;
    border: 1px solid #ccc;
  }
</style>
