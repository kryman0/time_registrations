<script setup lang="ts">
import { useRouter } from 'vue-router'

const validSsnPattern: string = '^[1-9][0-9]{7}-[0-9]{4}$'
const ssnFormat: string = 'YYYYMMDD-NNNN'
const passwordFormat: string = 'XXXXXXXXXX'

const [ssn, password] = defineModel()

const router = useRouter()

function routeToUserAccount() {
  router.push({
    name: 'user',
    params: { id: 1 } // get user id from db
  })
}


</script>

<template>
  <div class="w-full mt-5 mb-5">
    <div class="input-container">
      <label for="ssn">Social Security Number</label>
      <Input id="ssn" type="text" :pattern="validSsnPattern" :placeholder="ssnFormat" />
    </div>

    <div class="input-container">
      <label for="password">Password</label>
      <Input id="password" type="password" :placeholder="passwordFormat" />
    </div>

    <div class="input-container w-10">
      <Button
        class="w-45 mt-3 border border-white xs:w-28 xs:ml-16"
        value="Login"
        @click="routeToUserAccount"
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
  margin: 0.25rem 0;
}

input {
  border: 1px solid green;
  display: block;

  @media (max-width: 320px) {
    width: 100%;
  }
}
</style>
