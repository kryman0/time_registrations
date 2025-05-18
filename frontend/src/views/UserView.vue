<script setup lang="ts">
import TimestampButton from "@/components/TimestampButton.vue"

const data = [
  { 'datum': '2025-10-04', 'name': 'Adam', 'check_in': '11:51:33', 'check_out': '2025-05-14 11:51:36', 'latitude_check_in': '45.943161', 'longitude_check_in': '-24.96676', 'latitude_check_out': '45.943161', 'longitude_check_out': '-24.96676' },
  { 'datum': '2025-10-04', 'name': 'David', 'check_in': '11:51:33', 'check_out': '2025-05-14 11:51:36', 'latitude_check_in': '45.943161', 'longitude_check_in': '-24.96676', 'latitude_check_out': '45.943161', 'longitude_check_out': '-24.96676' },
  { 'datum': '2025-10-11', 'name': 'Bengt', 'check_in': '11:51:33', 'check_out': '2025-05-14 11:51:36', 'latitude_check_in': '45.943161', 'longitude_check_in': '-24.96676', 'latitude_check_out': '45.943161', 'longitude_check_out': '-24.96676' },
  { 'datum': '2025-10-17', 'name': 'Carl', 'check_in': '11:51:33', 'check_out': '2025-05-14 11:51:36', 'latitude_check_in': '45.943161', 'longitude_check_in': '-24.96676', 'latitude_check_out': '45.943161', 'longitude_check_out': '-24.96676' },
  { 'datum': '2025-10-17', 'name': 'Erik', 'check_in': '11:51:33', 'check_out': '2025-05-14 11:51:36', 'latitude_check_in': '45.943161', 'longitude_check_in': '-24.96676', 'latitude_check_out': '45.943161', 'longitude_check_out': '-24.96676' },
]

const a = data.map(v =>
  `<p>${v.datum}</p>`
);

const b = data
// console.log(a)

</script>

<template>
  <div class="mt-10 mb-10 w-full border border-white">
    <h1>Welcome! {{$route.params.id}}</h1>

    <div>
      <TimestampButton :check_in="true" value="Check in" />
      <TimestampButton :check_out="true" value="Check out" />
    </div>

    <div v-html="a"></div>

    <div>
      <table>
        <thead>
        <th>Personal</th>
        <th>Check in</th>
        <th>Check out</th>
        </thead>
        <tbody>
        <tr v-for="user in data">
          <td>{{user.datum}}</td>
          <td>{{user.check_in}}</td>
          <td>{{user.check_out}}</td>
        </tr>
        </tbody>
      </table>
    </div>

    <div class="flex-container grid grid-cols-3 gap-2">
      <div class="col-1 h-7">Personal</div>
      <div class="col-2 h-7">Check in</div>
      <div class="col-3 h-7">Check out</div>
      <div v-for="user in data">
        <div class="row-2 col-1">{{user.user_id}}</div>
        <div class="row-2 col-2">{{user.check_in}}</div>
      </div>
      <div class="row-2 col-2">
        <div v-for="user in data">{{user.check_in}}</div>
      </div>
      <div class="row-2 col-3">
        <div v-for="user in data">{{user.check_out}}</div>
      </div>
    </div>
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
