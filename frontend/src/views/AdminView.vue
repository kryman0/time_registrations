<script setup lang="ts">
const decimals = 4
const lang = window.navigator.language
const dateTimeFormat = new Intl.DateTimeFormat(lang, {
  hour: '2-digit',
  minute: '2-digit',
})

const jsonData =
  {
    "2025-05-17 08:00:00": [
      {
        "id": 27,
        "check_in": "2025-05-17 08:00:00",
        "check_out": "2025-05-17 17:00:00",
        "has_checked_in": 0,
        "has_checked_out": 1,
        "latitude_check_in": 52.3555177,
        "latitude_check_out": -1.1743197,
        "longitude_check_in": 52.3555177,
        "longitude_check_out": -1.1743197,
        "user_id": 2
      }
    ],
    "2025-05-16 08:00:00": [
      {
        "id": 23,
        "check_in": "2025-05-16 08:00:00",
        "check_out": "2025-05-16 17:00:00",
        "has_checked_in": 0,
        "has_checked_out": 1,
        "latitude_check_in": 52.3555177,
        "latitude_check_out": -1.1743197,
        "longitude_check_in": 52.3555177,
        "longitude_check_out": -1.1743197,
        "user_id": 1
      },
      {
        "id": 24,
        "check_in": "2025-05-16 08:00:00",
        "check_out": "2025-05-16 17:00:00",
        "has_checked_in": 0,
        "has_checked_out": 1,
        "latitude_check_in": 52.3555177,
        "latitude_check_out": -1.1743197,
        "longitude_check_in": 52.3555177,
        "longitude_check_out": -1.1743197,
        "user_id": 2
      },
      {
        "id": 25,
        "check_in": "2025-05-16 08:00:00",
        "check_out": "2025-05-16 17:00:00",
        "has_checked_in": 0,
        "has_checked_out": 1,
        "latitude_check_in": null,
        "latitude_check_out": null,
        "longitude_check_in": null,
        "longitude_check_out": null,
        "user_id": 3
      }
    ],
    "2025-05-15 08:00:00": [
      {
        "id": 17,
        "check_in": "2025-05-15 08:00:00",
        "check_out": "2025-05-15 17:00:00",
        "has_checked_in": 0,
        "has_checked_out": 1,
        "latitude_check_in": null,
        "latitude_check_out": null,
        "longitude_check_in": null,
        "longitude_check_out": null,
        "user_id": 2
      },
      {
        "id": 18,
        "check_in": "2025-05-15 08:00:00",
        "check_out": "2025-05-15 17:00:00",
        "has_checked_in": 0,
        "has_checked_out": 1,
        "latitude_check_in": null,
        "latitude_check_out": null,
        "longitude_check_in": null,
        "longitude_check_out": null,
        "user_id": 1
      },
      {
        "id": 22,
        "check_in": "2025-05-15 08:00:00",
        "check_out": "2025-05-15 17:00:00",
        "has_checked_in": 0,
        "has_checked_out": 1,
        "latitude_check_in": null,
        "latitude_check_out": null,
        "longitude_check_in": null,
        "longitude_check_out": null,
        "user_id": 3
      }
    ],
    "2025-05-14 08:00:00": [
      {
        "id": 26,
        "check_in": "2025-05-14 08:00:00",
        "check_out": "2025-05-14 17:00:00",
        "has_checked_in": 0,
        "has_checked_out": 1,
        "latitude_check_in": 52.3555177,
        "latitude_check_out": -1.1743197,
        "longitude_check_in": 52.3555177,
        "longitude_check_out": -1.1743197,
        "user_id": 2
      }
    ]
  }
</script>

<template>
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

    <div class="grid grid-cols-2 grid-cols-subgrid xs:grid-cols-3 xs:grid-cols-subgrid 2xs:grid-cols-4 2xs:grid-cols-subgrid sm:grid-cols-7 sm:grid-cols-subgrid" v-for="(arr, key) in jsonData">
      <div>{{ new Date(key).toLocaleDateString() }}</div>

      <div class="grid grid-cols-2 xs:grid-cols-3 2xs:grid-cols-4 sm:grid-cols-7" v-for="value in arr">
        <div>{{ value.user_id }}</div>
        <div>{{ dateTimeFormat.format(new Date(value.check_in)) }}</div>
        <div>{{ dateTimeFormat.format(new Date(value.check_out)) }}</div>
        <div>{{ value.latitude_check_in?.toFixed(decimals) }}</div>
        <div>{{ value.latitude_check_out?.toFixed(decimals) }}</div>
        <div>{{ value.longitude_check_in?.toFixed(decimals) }}</div>
        <div>{{ value.longitude_check_out?.toFixed(decimals) }}</div>
      </div>
    </div>

  </div>
</template>





