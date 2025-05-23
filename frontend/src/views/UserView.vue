<script setup lang="ts">
import { ref } from "vue";
import TimestampButton from "@/components/TimestampButton.vue"
import ChangePassword from "@/views/ChangePassword.vue";

const isPasswordViewActive = ref(false);

const jsonData =
{
  "2025-05-17 08:00:00": [
    {
      "id": 27,
      "check_in": "2025-05-17 08:00:00",
      "check_out": "2025-05-17 17:00:00",
      "has_checked_in": 0,
      "has_checked_out": 1,
      "latitude_check_in": null,
      "latitude_check_out": null,
      "longitude_check_in": null,
      "longitude_check_out": null,
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
      "latitude_check_in": null,
      "latitude_check_out": null,
      "longitude_check_in": null,
      "longitude_check_out": null,
      "user_id": 1
    },
    {
      "id": 24,
      "check_in": "2025-05-16 08:00:00",
      "check_out": "2025-05-16 17:00:00",
      "has_checked_in": 0,
      "has_checked_out": 1,
      "latitude_check_in": null,
      "latitude_check_out": null,
      "longitude_check_in": null,
      "longitude_check_out": null,
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
      "latitude_check_in": null,
      "latitude_check_out": null,
      "longitude_check_in": null,
      "longitude_check_out": null,
      "user_id": 2
    }
  ]
}

</script>

<template>
  <div class="xs:mt-10 mb-10 w-full ">

    <div class="grid grid-cols-2 grid-rows-3 mb-5 max-xs:grid-col-span-full max-xs:items-stretch gap-5">
      <div class="row-1 col-span-full justify-self-center self-center max-xs:mt-5">
        <h1>Welcome! {{$route.params.id}}</h1>
      </div>
      <div class="row-2 col-span-full justify-self-center self-center max-xs:w-full">
        <Button class="change-password-button" value="Change password" @click="isPasswordViewActive = true" />
        <div v-if="isPasswordViewActive" class="relative">
          <ChangePassword v-model="isPasswordViewActive" />
        </div>
      </div>
      <div class="max-xs:col-span-full">
        <TimestampButton :check_in="true" value="Check in" />
      </div>
      <div class="xs:justify-self-end max-xs:col-span-full">
        <TimestampButton :check_out="true" value="Check out" />
      </div>
    </div>

    <div class="grid-wrapper border border-white">
      <div class="header">
        <div>Datum</div>
        <div>In</div>
        <div>Ut</div>
      </div>
      <div v-for="(arr, key) in jsonData" class="date">
        <div>{{ new Date(key).toLocaleDateString() }}</div>
          <div v-for="value in arr" class="item">
            <div>{{ 'Anv ' + value.user_id }}</div>
            <div>{{ new Date(value.check_in).toLocaleTimeString() }}</div>
            <div>{{ new Date(value.check_out).toLocaleTimeString() }}</div>
          </div>
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
  grid-template-columns: repeat(3, 1fr);
}
.date {
  display: grid;
  grid-column: 1;
  grid-template-columns: subgrid;
  border: 1px solid blue;
}
.item {
  display: grid;
  grid-column: 2;
  grid-template-columns: repeat(3, 1fr);
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
