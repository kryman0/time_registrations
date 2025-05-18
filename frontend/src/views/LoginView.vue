<script setup lang="ts">
import { useRouter } from 'vue-router'

const validSsnPattern: string = '^[1-9][0-9]{7}-[0-9]{4}$'
const ssnFormat: string = 'YYYYMMDD-NNNN'
const passwordFormat: string = 'XXXXXXXXXX'

const router = useRouter()

function route() {
  // fetch and send in id from db
  router.push('/user/1/account')
}


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
        value="Login"
        @click="route"
      />
    </div>

    <div class="input-container">
      <Footer />
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
</style>
