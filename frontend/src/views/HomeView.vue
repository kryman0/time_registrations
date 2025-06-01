<script setup lang="ts">
</script>

<template>
  <main class="w-auto h-dvh">
    <h1 class="mt-5 mb-5 text-shadow-yellow-100 text-shadow-sm">Welcome to Time Registrations</h1>
    <p>This app allows employees to register their check in and check out time. The GPS coordinates will be saved at the same time.</p>
    <br />
    <p>Employers can modify the employees' check in/out times.</p>
    <br />
    <p>If a non-logged in user tries to reach a user's account or the admin account an alert message will be displayed and the user will be redirected to the login page.</p>
    <br />
    <p>A user can only check in or check out once at a time. A user can also change his password. If the user's password does not match when changing the password a text will be displayed informing the user and the submit button will disappear.</p>
  </main>
</template>
