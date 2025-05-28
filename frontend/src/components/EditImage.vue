<script setup lang="ts">
const img: object = {
  src: '/src/assets/pencil-edit-office-2-svgrepo-com.svg',
  alt: 'Edit time',
  title: 'Edit time'
}
</script>

<template>
  <img class="w-7 inline pt--3 ml-1" :src="img.src" :alt="img.alt" :title="img.title" />
</template>
