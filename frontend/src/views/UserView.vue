<script setup lang="ts">
import { onBeforeMount, ref, watch } from "vue";
import TimestampButton from "@/components/TimestampButton.vue"
import ChangePasswordView from "@/views/ChangePasswordView.vue";
import UrlConstants from '@/constants/UrlConstants.ts'
import HttpResponseConstant from "@/constants/HttpResponseConstant.ts";
import HttpResponsesConstant from "@/constants/HttpResponseConstant.ts";
import { getCookieByKeys } from "@/handlers/CookieHandler.ts";

const isPasswordViewActive = ref(false);
const fetchResponse: string = ref('')
const data: object = ref(null)
const coords: object = ref(null)
const cookie: object = ref(null)
const checkIn: boolean = ref(false)

watch(coords, async (newValue) => {
  coords.value = await newValue

  if (coords.value === null) {
    fetchResponse.value = "Could not get location of the device"
    return
  }

  const url = checkIn ?
    `${UrlConstants.apiBaseUserUrl}/${cookie.value.userId}/checkin`
    : `${UrlConstants.apiBaseUserUrl}/${cookie.value.userId}/checkout`

  const resp = await fetch(url, {
    method: 'POST',
    body: JSON.stringify({
      id: cookie.value.userId,
      latitude_check_in: coords.value.latitude,
      longitude_check_in: coords.value.longitude,
      latitude_check_out: coords.value.latitude,
      longitude_check_out: coords.value.longitude,
    }),
    headers: {
      'Content-Type': 'application/json',
      'token': cookie.value.token,
    }
  })

  switch (resp.status) {
    case 200:
      fetchResponse.value = await resp.text()
      break
    default:
      fetchResponse.value = await resp.text()
  }
})

onBeforeMount(async () => {
  cookie.value = await getCookieByKeys('userId', 'token')

  if (!cookie || !cookie.value.userId || !cookie.value.token) {
    fetchResponse.value = HttpResponseConstant.noCookieGet
    return
  }

  try {
    const resp = await fetch(`${UrlConstants.apiBaseUserUrl}/${cookie.value.userId}/account`, {
      method: 'GET',
      headers: {
        'token': cookie.value.token,
      }
    });
    switch (resp.status) {
      case 200:
        data.value = await resp.json()
        break
      case 401:
        fetchResponse.value = HttpResponsesConstant.unauthorized
        break
      default:
        fetchResponse.value = ''
    }
  } catch (error) {
    fetchResponse.value = error.toString()
  }
})

async function registerTime(checkin: boolean, checkout: boolean): void {
  checkIn.value = checkin

  await window.navigator.geolocation.getCurrentPosition((success, error) => {
    if (success) {
      coords.value = success.coords;
    }
    else {
      fetchResponse.value = error.toString()
    }
  })
}
</script>

<template>
  <div class="xs:mt-10 mb-10 w-full">

    <Footer class="mb-5 text-center" :response="fetchResponse" />

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
        <TimestampButton @click="registerTime(true, false)" :check_in="true" value="Check in" />
      </div>
      <div class="xs:justify-self-end max-xs:col-span-full">
        <TimestampButton @click="registerTime(false, true)" :check_out="true" value="Check out" />
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
