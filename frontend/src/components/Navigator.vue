<script setup lang="ts">
</script>

<template>
  <nav class="mb-5">
    <ul class="text-right">
      <li><RouterLink class="router-link" to="/">Home</RouterLink></li>
      <li><RouterLink class="router-link" to="/login">Login</RouterLink></li>
      <li><RouterLink class="router-link" to="/admin">Admin</RouterLink></li>
      <li><RouterLink class="router-link" to="/user/1/account">User</RouterLink></li>
    </ul>
  </nav>
</template>

<style>
  li {
    display: block;
    margin-left: 20px;

    @media (min-width: 320px) {
      display: inline-block;
    }
  }
</style>
