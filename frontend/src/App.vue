<script setup lang="ts">
import { RouterView } from 'vue-router'
import Navigator from "@/components/Navigator.vue";
</script>

<template>
  <header>
    <Navigator />
  </header>
  <RouterView />
</template>

<style>
body {
  background-color: sandybrown;
  background-image: url('/src/assets/clock.jpg');
  background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center;
  background-blend-mode: screen;
  color: maroon;
}

input, .grid-button {
  padding: 5px;
  border: 1px solid darksalmon;
  background-color: floralwhite;
  border-radius: 5px;
}

input:focus {
  background-color: bisque;
}
</style>
