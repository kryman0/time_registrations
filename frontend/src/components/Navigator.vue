<script setup lang="ts">
</script>

<template>
  <nav>
    <ul class="text-right">
      <li class="xs:pr-10"><RouterLink class="router-link xs:pr-10" to="/login">Login</RouterLink></li>
      <li><RouterLink class="router-link" to="/admin">Admin</RouterLink></li>
    </ul>
  </nav>
</template>

<style>
li {
    @media (min-width: 320px) {
      display: inline-block;
    }

    border: 1px solid green;
  }
</style>
