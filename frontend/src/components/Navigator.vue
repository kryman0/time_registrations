<script setup lang="ts">
</script>

<template>
  <nav class="mb-5">
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
    width: 100%;
    margin: 0 auto 5px;
    padding: 5px;
    background-color: indianred;
    border-radius: 5px;
    text-align: center;

    @media (min-width: 430px) {
      width: 100px;
      display: inline-block;
      margin-left: 20px;
    }
  }
  li a {
    color: white;
  }
</style>
