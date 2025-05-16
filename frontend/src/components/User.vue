<script setup lang="ts">
import TimestampButton from "@/components/TimestampButton.vue"

defineProps<{
  checkIn: {
    type: string,
    value: "check-in",
  },
  checkOut: {
    type: string,
    value: 'check-out'
  }
}>()

</script>

<template>
  <h1>Welcome!</h1>

  <div>
    <!-- add props here   -->
    <TimestampButton /> 
  </div>
</template>
