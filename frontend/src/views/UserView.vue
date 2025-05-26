<script setup lang="ts">
import { onBeforeMount, ref } from "vue";
import TimestampButton from "@/components/TimestampButton.vue"
import ChangePasswordView from "@/views/ChangePasswordView.vue";
import UrlConstants from '@/constants/UrlConstants.ts'
import HttpResponseConstant from "@/constants/HttpResponseConstant.ts";
import HttpResponsesConstant from "@/constants/HttpResponseConstant.ts";

const isPasswordViewActive = ref(false);
const [userId, token]: [string, string] = [ref(''), ref('')]
const errorResponse: string = ref('')
const data: object = ref(null)

async function getCookieStore(): void {
  userId.value = await window.cookieStore.get('userId')
  token.value = await window.cookieStore.get('token')

  if (!userId.value || !token.value) {
    errorResponse.value = HttpResponseConstant.noCookieGet
  }
}

onBeforeMount(async (): Promise<void> => {
  await getCookieStore()

  try {
    const resp = await fetch(`${UrlConstants.apiBaseUserUrl}/${userId.value['value']}/account`, {
      method: 'GET',
      headers: {
        'token': token.value['value'],
      }
    });
    switch (resp.status) {
      case 200:
        data.value = await resp.json()
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
})
</script>

<template>
  <div class="xs:mt-10 mb-10 w-full">

    <Footer class="mb-5" v-if="errorResponse" :response="errorResponse" />

    <div class="grid grid-cols-2 grid-rows-3 mb-5 max-xs:grid-col-span-full max-xs:items-stretch gap-5">
      <div class="row-1 col-span-full justify-self-center self-center max-xs:mt-5">
        <h1>Welcome! {{$route.params.id}}</h1>
      </div>
      <div class="row-2 col-span-full justify-self-center self-center max-xs:w-full">
        <Button class="change-password-button" value="Change password" @click="isPasswordViewActive = true" />
        <div v-if="isPasswordViewActive" class="relative">
          <ChangePasswordView v-model="isPasswordViewActive" />
        </div>
      </div>
      <div class="max-xs:col-span-full">
        <TimestampButton :check_in="true" value="Check in" />
      </div>
      <div class="xs:justify-self-end max-xs:col-span-full">
        <TimestampButton :check_out="true" value="Check out" />
      </div>
    </div>

    <div v-if="data !== null" class="grid-wrapper border border-white">
      <div class="header">
        <div>In</div>
        <div>Ut</div>
      </div>
      <div v-for="item in data" :key="item.id" class="item">
        <div>{{ item.check_in }}</div>
        <div>{{ item.check_out }}</div>
      </div>
    </div>
  </div>
</template>

<style>
.grid-wrapper {
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  gap: 1rem;
}
.header {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
}
.item {
  display: grid;
  grid-column: 1;
  grid-template-columns: repeat(2, 1fr);
  border: 1px solid grey;
}

.change-password-button {
  width: 130px;
  padding: 5px;

  @media (max-width: 320px) {
    width: 100%;
  }
}
</style>
