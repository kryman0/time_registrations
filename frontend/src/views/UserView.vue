<script setup lang="ts">
import TimestampButton from "@/components/TimestampButton.vue"

const data = [
  { 'datum': '2025-10-04', 'name': 'Adam', 'check_in': '11:51:33', 'check_out': '2025-05-14 11:51:36', 'latitude_check_in': '45.943161', 'longitude_check_in': '-24.96676', 'latitude_check_out': '45.943161', 'longitude_check_out': '-24.96676' },
  { 'datum': '2025-10-04', 'name': 'David', 'check_in': '11:51:33', 'check_out': '2025-05-14 11:51:36', 'latitude_check_in': '45.943161', 'longitude_check_in': '-24.96676', 'latitude_check_out': '45.943161', 'longitude_check_out': '-24.96676' },
  { 'datum': '2025-10-11', 'name': 'Bengt', 'check_in': '11:51:33', 'check_out': '2025-05-14 11:51:36', 'latitude_check_in': '45.943161', 'longitude_check_in': '-24.96676', 'latitude_check_out': '45.943161', 'longitude_check_out': '-24.96676' },
  { 'datum': '2025-10-17', 'name': 'Carl', 'check_in': '11:51:33', 'check_out': '2025-05-14 11:51:36', 'latitude_check_in': '45.943161', 'longitude_check_in': '-24.96676', 'latitude_check_out': '45.943161', 'longitude_check_out': '-24.96676' },
  { 'datum': '2025-10-17', 'name': 'Erik', 'check_in': '11:51:33', 'check_out': '2025-05-14 11:51:36', 'latitude_check_in': '45.943161', 'longitude_check_in': '-24.96676', 'latitude_check_out': '45.943161', 'longitude_check_out': '-24.96676' },
]

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
  <div class="mt-10 mb-10 w-full border border-white">
    <h1>Welcome! {{$route.params.id}}</h1>

    <div>
      <TimestampButton :check_in="true" value="Check in" />
      <TimestampButton :check_out="true" value="Check out" />
    </div>

    <div>
      <table>
        <thead>
        <tr>
          <th>Personal</th>
          <th>Check in</th>
          <th>Check out</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(arr, key) in jsonData">
          <td>{{new Date(key).toDateString()}}</td>
          <td v-for="value in arr">{{value.check_in}}</td>
<!--          <td>{{value.check_out}}</td>-->
        </tr>
        </tbody>
      </table>
    </div>

<!--    <div class="flex-container grid grid-cols-3 gap-2">-->
<!--      <div class="col-1 h-7">Personal</div>-->
<!--      <div class="col-2 h-7">Check in</div>-->
<!--      <div class="col-3 h-7">Check out</div>-->
<!--      <div v-for="user in data">-->
<!--        <div class="row-2 col-1">{{user.user_id}}</div>-->
<!--        <div class="row-2 col-2">{{user.check_in}}</div>-->
<!--      </div>-->
<!--      <div class="row-2 col-2">-->
<!--        <div v-for="user in data">{{user.check_in}}</div>-->
<!--      </div>-->
<!--      <div class="row-2 col-3">-->
<!--        <div v-for="user in data">{{user.check_out}}</div>-->
<!--      </div>-->
<!--    </div>-->
  </div>
</template>

<style>
  button {
    display: inline-block;
    width: 30%;
    margin: 10px 0;

    @media (max-width: 320px) {
      width: 100%;
    }
  }

  button:first-of-type {
    margin-right: 40%;
  }

  .flex-container div {
    background-color: green;
    border: 1px solid blue;
  }
</style>
