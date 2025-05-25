<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import UrlConstants from '@/Constants/UrlConstants.ts'
import HttpResponsesConstant from '@/Constants/HttpResponseConstant.ts'
import RouteConstants from '@/Constants/RouteConstants.ts'

const [ssn, password]: [string, string] = [ref(''), ref('')]
const errorResponse: string = ref('')
const validSsnPattern: string = '^[1-9][0-9]{7}-[0-9]{4}$'
const ssnFormat: string = 'YYYYMMDD-NNNN'
const passwordFormat: string = 'XXXXXXXXXX'
const router = useRouter()
const hourMs: number = 60 * 60 * 1000

async function login(): void {
  try {
    const response = await fetch(UrlConstants.apiLoginUrl, {
      method: 'POST',
      body: JSON.stringify({ ssn: ssn.value, password: password.value }),
      headers: {
        'Content-Type': 'application/json',
      }
    })

    switch (response.status) {
      case 200:
        const data = await response.json()
        try {
          await window.cookieStore.set({
            name: 'userId',
            value: data.userId,
            expires: Date.now() + hourMs,
          })
          await window.cookieStore.set({
            name: 'token',
            value: data.token,
            expires: Date.now() + hourMs,
          })
        } catch (error) {
          errorResponse.value = HttpResponsesConstant.noCookieSet
        }
        routeToUserAccount(data.userId)
        break
      case 401:
        errorResponse.value = HttpResponsesConstant.unauthorized
        break
      default:
        errorResponse.value = ''
    }
  } catch (error) {
    errorResponse.value = error.toString()
  }
}

function routeToUserAccount(userId: number): void {
  router.push({
    name: RouteConstants.user.name,
    params: { id: userId },
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
