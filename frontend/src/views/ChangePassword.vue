<script setup lang="ts">
const isPasswordViewActive = defineModel({ type: Boolean, default: false })
</script>

<template>
  <div class="absolute -m-10 size-50 border border-red-200 bg-red-500">
    <div class="mx-45 text-2xl inline-block border border-gray:150" @click="isPasswordViewActive = false">X</div>
    <Input id="password" type="password" placeholder="XXXXXX" />
  </div>

</template>
