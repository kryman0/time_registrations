<script setup lang="ts">
import { RouterView } from 'vue-router'
import Navigator from "@/components/Navigator.vue";
import User from "@/views/UserView.vue";
</script>

<template>
  <header>
    <Navigator />
  </header>
  <main>
    <User />
  </main>
<!--  <RouterView />-->
</template>
