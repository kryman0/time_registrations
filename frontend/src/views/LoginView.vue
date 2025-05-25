<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { UrlConstant} from '@/Constants/UrlConstant.ts'

const [ssn, password]: [string, string] = [ref(''), ref('')]
const errorResponse: string = ref('')
const validSsnPattern: string = '^[1-9][0-9]{7}-[0-9]{4}$'
const ssnFormat: string = 'YYYYMMDD-NNNN'
const passwordFormat: string = 'XXXXXXXXXX'
const router = useRouter()

// watch((errorResponse), async => ssn, () => {
//
// })

async function login(): object | string {
  try {
    const response = await fetch(UrlConstant.apiLoginUrl, {
      method: 'POST',
      body: { ssn: ssn, password: password },
    })

    switch (response.status) {
      case 401:
        errorResponse.value = 'Unauthorized!'
        break
      default:
        errorResponse.value = ''
    }
  } catch (error) {
    errorResponse.value = await error
  }
  
  routeToUserAccount(1)
}

function routeToUserAccount(int: userId): void {
  router.push({
    name: 'user',
    params: { id: userId }
  })
}


</script>

<template>
  <div class="w-full mt-5 mb-5">
    <div class="input-container">
      <label for="ssn">Social Security Number</label>
      <Input v-model="ssn" id="ssn" type="text" :pattern="validSsnPattern" :placeholder="ssnFormat" />

    </div>

    <div class="input-container">
      <label for="password">Password</label>
      <Input v-model="password" id="password" type="password" :placeholder="passwordFormat" />
    </div>

    <div class="input-container w-10">
      <Button
        class="w-45 mt-3 border border-white xs:w-28 xs:ml-16"
        value="Login"
        @click="login"
      />
    </div>

    <div class="input-container">
      <Footer :response="errorResponse" />
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
