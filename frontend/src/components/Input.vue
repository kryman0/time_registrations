<script setup lang="ts">
defineProps({
  type: {
    type: String,
    required: true,
    default: 'text',
  },
  placeholder: {
    type: String,
    required: true,
  },
  id: {
    type: String,
    required: true,
    default: '',
  }
})

// 19111211-0101
</script>

<template>
  <input :id :type :placeholder />
</template>

<style>
  /*input {
    //border: 1px solid blue;
  }*/
  /*input {
    display: block;
    margin: 10px 0;
    padding: 3px;
    max-width: 200px;
    border: 1px solid blue;
    border-radius: 5px;
  }*/

  /*input:invalid {
    border: 1px solid red;
  }*/
</style>
