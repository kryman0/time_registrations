<script setup lang="ts">
import Input from '@/components/Input.vue';
import Button from '@/components/Button.vue';

const validSsnPattern: string = '^[1-9][0-9]{7}-[0-9]{4}$'
const ssnFormat: string = 'YYYYMMDD-NNNN'
const passwordFormat: string = 'XXXXXXXXXX'

</script>

<template>
  <div class="w-full mt-5 mb-5">
    <div class="input-container">
      <label class="block" for="ssn">Social Security Number</label>
      <Input id="ssn" type="text" :pattern="validSsnPattern" :placeholder="ssnFormat" />
    </div>

    <div class="input-container">
      <label for="password">Password</label>
      <Input id="password" type="password" :placeholder="passwordFormat" />
    </div>

    <div class="input-container">
      <Button
        class="block w-20 border border-white mt-5 relative -right-12 max-xs:w-45 max-xs:left-0"
        value="Login" />
    </div>

  </div>
</template>

<style>
  .input-container {
    width: max-content;
    margin: 0 auto 0.7rem;
  }
  label {
    display: block;
    margin: 0.25rem 0;
  }

  input {
    border: 1px solid green;
    display: block;
    width: 100%;

    @media (max-width: 320px) {
      width: 100%;
    }
  }

  .input-button {
    display: block;
    width: 100px;
    margin: 0 auto;
    border: 1px solid yellow;
    @media (max-width: 320px) {
      width: max-content;
    }
    //border: 1px solid yellow;
  }
</style>
