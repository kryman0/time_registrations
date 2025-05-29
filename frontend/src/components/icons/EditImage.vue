<script setup lang="ts">
const img: object = {
  src: '/src/assets/date.svg',
  alt: 'Edit time',
  title: 'Edit time'
}
</script>

<template>
  <img class="w-5 inline ml-3" :src="img.src" :alt="img.alt" :title="img.title" />
</template>
