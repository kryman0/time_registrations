import { defineStore } from "pinia";
import { ref, computed } from "vue";

export const useNotifyTimestampChangeStore = defineStore('notifyTimestampChange', () => {
  const isTimestampChange = ref(false)

  const checkIn = (value) => {
    console.log(value)
    isTimestampChange.value = value
  }
  const checkOut = (value) => {
    console.log(value)
    isTimestampChange.value = value
  }

  const getTimestampChange = computed(() => {
    isTimestampChange.value
  })

  return { isTimestampChange, checkIn, checkOut }
})
