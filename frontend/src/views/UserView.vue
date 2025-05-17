<script setup lang="ts">
import TimestampButton from "@/components/TimestampButton.vue"

</script>

<template>
  <h1>Welcome!</h1>

  <div>
    <TimestampButton :check_in :value="checkInValue" />
    <TimestampButton :check_out :value="checkOutValue" />
  </div>
</template>
