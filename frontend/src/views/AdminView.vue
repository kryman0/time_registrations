<script setup lang="ts">
import { onBeforeMount, ref } from "vue";
import { getCookieByKeys } from "@/handlers/CookieHandler.ts";
import UrlConstants from "@/constants/UrlConstants.ts";
import HttpResponsesConstant from "@/constants/HttpResponseConstant.ts";
import EditImage from "@/components/EditImage.vue";

const decimals = 4
const lang = window.navigator.language
const dateTimeFormat = new Intl.DateTimeFormat(lang, {
  hour: '2-digit',
  minute: '2-digit',
})
const data: object = ref(null)
const fetchResponse: string = ref('')
const cookie: object = ref(null)
const isTimestampEditable: boolean = ref(false)

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

function editTimestamp() {
  isTimestampEditable.value = true
}

function handleClick(event) {
  console.log(event)
  console.log(event.target.value)
}
</script>

  <template>
    <Footer class="mt-5 mb-5" :response="fetchResponse" />

    <div class="grid grid-cols-1 gap-[1.5rem]">
      <div class="grid grid-cols-2 xs:grid-cols-3 2xs:grid-cols-4 sm:grid-cols-7">
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

      <div class="grid grid-cols-2 xs:grid-cols-3 2xs:grid-cols-4 sm:grid-cols-7" v-for="value in arr">
        <div>{{ value.user_id }}</div>
        <div>
          <Input @click="handleClick($event)" :key="value.id" v-if="isTimestampEditable" :id="'check_in_' + value.id" type="time" />
          <span>{{ dateTimeFormat.format(new Date(value.check_in)) }}</span>
          <EditImage @click="editTimestamp('check_in_' + value.id, true)" />
        </div>
        <div>{{ dateTimeFormat.format(new Date(value.check_out)) }}</div>
        <div>{{ value.latitude_check_in?.toFixed(decimals) }}</div>
        <div>{{ value.latitude_check_out?.toFixed(decimals) }}</div>
        <div>{{ value.longitude_check_in?.toFixed(decimals) }}</div>
        <div>{{ value.longitude_check_out?.toFixed(decimals) }}</div>
      </div>
    </div>
  </div>
</template>




