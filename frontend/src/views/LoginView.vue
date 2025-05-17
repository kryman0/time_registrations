<script setup lang="ts">
import Input from '@/components/Input.vue';

const validSsnPattern: String = '^[1-9][0-9]{7}-[0-9]{4}$'

</script>

<template>
  <div class="">
    <div class="input-ssn">
      <label class="block m-10" for="ssn">Social Security Number</label>
      <Input id="ssn" type="text" :pattern="validSsnPattern" />
    </div>

    <div>
      <label for="password">Password</label>
      <Input id="password" type="password" />
    </div>
  </div>
</template>

<style>
  .input-ssn {
    margin: 0 auto;
    width: 50%;
  }
  /*label {
    display: block;
    width: 100%;
    //margin: 0 auto;
    text-align: left;
  }*/

  div {
    border: 1px solid green;
  }
</style>
