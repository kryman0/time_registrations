<script setup lang="ts">
</script>

<template>
  <nav>
    <ul className="text-right">
      <li className="xs:pr-10"><RouterLink className="router-link xs:pr-10" to="/login">Login</RouterLink></li>
      <li className=""><RouterLink className="router-link" to="/admin">Admin</RouterLink></li>
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
