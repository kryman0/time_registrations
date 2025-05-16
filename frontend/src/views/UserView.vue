<script setup lang="ts">
import TimestampButton from "@/components/TimestampButton.vue"

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
  value: {
    type: String,
    required: false,
    default: 'Submit',
  },
})
</script>

<template>
  <h1>Welcome!</h1>

  <div>
    <TimestampButton :check_in :value />
    <TimestampButton :check_out :value />
  </div>
</template>
