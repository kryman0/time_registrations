<script setup lang="ts">
</script>

<template>
  <nav>
    <ul class="text-right">
      <li><RouterLink class="router-link" to="/">Home</RouterLink></li>
      <li><RouterLink class="router-link" to="/login">Login</RouterLink></li>
      <li><RouterLink class="router-link" to="/admin">Admin</RouterLink></li>
    </ul>
  </nav>
</template>

<style>
  li {
    display: block;

    @media (min-width: 320px) {
      display: inline-block;
    }

    border: 1px solid green;
  }
</style>
