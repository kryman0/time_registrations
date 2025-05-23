<script setup lang="ts">
defineProps({
  check_in: {
    type: Boolean,
    required: false,
    default: false,
  },
  check_out: {
    type: Boolean,
    required: false,
    default: false,
  },
})
</script>

<template>
  <Button v-if="check_in" :check_in />
  <Button v-else :check_out />
</template>
