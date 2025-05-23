<script setup lang="ts">
const isPasswordViewActive = defineModel({ type: Boolean, default: false })
</script>

<template>
  <div class="container w-60 h-60 border border-red-200 bg-red-500">
    <div
      class="text-right pr-3 text-2xl"
      @click="isPasswordViewActive = false">X
    </div>
    <div>
      <p>
        <label for="new-password">Enter new password</label>
        <Input class="block" id="new-password" type="password" placeholder="XXXXXX" />
      </p>
      <p>
        <label for="confirm-new-password">Re-enter new password</label>
        <Input id="confirm-new-password" type="password" placeholder="XXXXXX" />
      </p>
      <p>
        <Button class="submit" />
      </p>
    </div>
  </div>

</template>

<style>
.container {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -40%);
  border-radius: 10px;

  @media (max-width: 320px) {
    width: 100%;
    background-color: blue;
  }
}

input, label {
  display: block;
  margin: 10px 5px 0;
  //width: 100%;

  @media (max-width: 320px) {
    width: 95%;
    margin: 10px 5px 0;
  }
  border: 1px solid black;
}

button.submit {
  display: block;
  margin: 15px auto;

  @media (max-width: 320px) {
    width: 95%;
  }
}
</style>
