<script setup lang="ts">
import { onBeforeMount, ref } from "vue";
import { getCookieByKeys } from "@/handlers/CookieHandler.ts";
import UrlConstants from "@/constants/UrlConstants.ts";
import HttpResponsesConstant from "@/constants/HttpResponseConstant.ts";
import EditImage from "@/components/icons/EditImage.vue";
import SaveImage from "@/components/icons/SaveImage.vue";

const decimals = 4
const lang = window.navigator.language
const dateTimeFormat = new Intl.DateTimeFormat(lang, {
  hour: '2-digit',
  minute: '2-digit',
})
const data: object = ref(null)
const fetchResponse: string = ref('')
const cookie: object = ref(null)
const openedTimestamps: object = ref([])
const timeInput: HTMLElement = ref(null)

onBeforeMount(async () => {
  cookie.value = await getCookieByKeys('userId', 'token')

  if (!cookie || !cookie.value.userId || !cookie.value.token) {
    fetchResponse.value = HttpResponseConstant.noCookieGet
    return
  }

  try {
    const resp = await fetch(`${UrlConstants.apiAdminUrl}`, {
      method: 'GET',
      headers: {
        'token': cookie.value.token,
      },
    })
    switch (resp.status) {
      case 200:
        data.value = await resp.json()
        break
      case 400:
        fetchResponse.value = HttpResponsesConstant.unauthorized
        break
      case 401:
        fetchResponse.value = await resp.text()
        break
      default:
        fetchResponse.value = await resp.text()
    }
  } catch (error) {
    fetchResponse.value = error.toString()
  }
})

function handleTimestamp(event: Event, checkInCheckOutId: string) {
  const saveImageIcon = event.target.parentElement.children[3]
  timeInput.value = event.target.parentElement.children[0]

  if (!openedTimestamps.value.find(x => x === checkInCheckOutId)) {
    openedTimestamps.value.push(checkInCheckOutId)
    saveImageIcon.classList.replace('hide-element', 'show-save-icon')
    timeInput.value.classList.replace('hide-element', 'show-container')
  } else {
    openedTimestamps.value.pop(checkInCheckOutId)
    saveImageIcon.classList.replace('show-save-icon', 'hide-element')
    timeInput.value.classList.replace('show-container', 'hide-element')
  }
}

async function editTimestamp(event: Event, isCheckIn: boolean, id: string) {
  console.log(timeInput.value.value)
  return
  const resp = await fetch(`${UrlConstants.apiAdminUrl}/${id}/edit`, {
    method: 'POST',
    body: JSON.stringify({
      id: id,
      check_in: checkIn ? true : null,
      check_out: !checkIn ? true : null,
      check_in_time: isCheckin ? timeInput.value.value : null,
      check_out_time: !isCheckIn ? timeInput.value.value : null,
    }),
    headers: {
      'token': cookie.value.token,
    }
  })

}
</script>

<template>
  <Footer class="mt-5 mb-5" :response="fetchResponse" />

  <div class="grid grid-cols-1 gap-y-[1.5rem]">
    <div class="header-grid grid grid-cols-2 xs:grid-cols-3 2xs:grid-cols-4 sm:grid-cols-7">
      <div>Datum</div>
      <div>In</div>
      <div>Ut</div>
      <div>Lat In</div>
      <div>Lat Ut</div>
      <div>Long In</div>
      <div>Long Ut</div>
    </div>

  <div v-if="data !== null"
       class="grid grid-cols-2 grid-cols-subgrid xs:grid-cols-3 xs:grid-cols-subgrid 2xs:grid-cols-4 2xs:grid-cols-subgrid sm:grid-cols-7 sm:grid-cols-subgrid"
       v-for="(arr, key) in data">
    <div>{{ new Date(key).toLocaleDateString() }}</div>

    <div class="item-grid grid grid-cols-2 xs:grid-cols-3 2xs:grid-cols-4 sm:grid-cols-7" v-for="value in arr">
      <div :key="value.id">{{ value.user_id }}</div>
      <div :id="'check_in_' + value.id">
        <Input
          :id="'check_in_' + value.id"
          class="hide-element check-in-out"
          type="datetime-local"
        />
        <span>{{ dateTimeFormat.format(new Date(value.check_in)) }}</span>
        <EditImage
          @click="handleTimestamp($event, 'check_in_' + value.id)"
          class="icon"

        />
        <SaveImage
          @keyup.prevent="editTimestamp($event, true, value.id)"
          @click.prevent="editTimestamp($event, true, value.id)"
          :id="'save_image_check_in_' + value.id"
          class="hide-element icon"
        />
      </div>
      <div :id="'check_out_' + value.id">
        <Input
          :id="'check_out_' + value.id"
          class="hide-element check-in-out"
          type="datetime-local"
        />
        <span>{{ dateTimeFormat.format(new Date(value.check_out)) }}</span>
        <EditImage
          @click="handleTimestamp($event, 'check_out_' + value.id)"
          class="icon"
        />
        <SaveImage
          @keyup.prevent="editTimestamp($event, true, value.id)"
          @click.prevent="editTimestamp($event, true, value.id)"
          :id="'save_image_check_in_' + value.id"
          class="hide-element icon"
        />
      </div>
      <div>{{ value.latitude_check_in?.toFixed(decimals) }}</div>
      <div>{{ value.latitude_check_out?.toFixed(decimals) }}</div>
      <div>{{ value.longitude_check_in?.toFixed(decimals) }}</div>
      <div>{{ value.longitude_check_out?.toFixed(decimals) }}</div>
      </div>
    </div>
  </div>
</template>

<style>
body {
  background-color: darkgray;
}
.hide-element {
  display: none;
}
.show-container {
  display: block;
}
.show-save-icon {
  display: inline;
}
.header-grid, .item-grid {
  @media (max-width: 20rem) {
    grid-template-columns: 33% 33% 33%;
  }
  @media (min-width: 20rem) {
    grid-template-columns: 30% 35% 35%;
  }
  @media (min-width: 40rem) {
    grid-template-columns: 15% 22.5% 22.5% 10% 10% 10% 10%;
  }
  @media (min-width: 64rem) {
    grid-template-columns: 10% 20% 20% 10% 10% 10% 10%;
  }
}
input.check-in-out {
  @media (max-width: 20rem) {
    width: 90%;
  }
  @media (min-width: 20rem) {
    width: 100%;
  }
  @media (min-width: 30rem) {
    width: 100%;
  }
  @media (min-width: 40rem) {
    width: 90%;
  }
}
.icon {
  @media (max-width: 20rem) {
    width: 30%;
    display: flex;
    margin: 0;
    padding: 0;
  }

  @media (max-width: 30rem) {
    margin-left: 5px;
  }
}
</style>
