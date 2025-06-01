<script setup lang="ts">
import { ref, watch, computed } from 'vue'
import UrlConstants from '@/constants/UrlConstants.ts'
import HttpResponseConstant from "@/constants/HttpResponseConstant.ts";

const props = defineProps({
  cookie: Object
});

const isPasswordViewActive = defineModel({ type: Boolean, default: false })
const [newPassword, retypedNewPassword]: [string, string] = [ref(''), ref('')]
const passwordsDoNotMatch: boolean = ref(false)
const responseInfo: any = ref(null)
const cookie = computed(() => props.cookie)

watch([newPassword, retypedNewPassword], (updatedValues) => {
  const [p1, p2]: [string, string] = [updatedValues[0], updatedValues[1]]
  passwordsDoNotMatch.value = p1 !== p2
})

async function changePassword() {
  if (!cookie || !cookie.value.userId || !cookie.value.token) {
    responseInfo.value = HttpResponseConstant.noCookieGet
    return
  }

  const resp = await fetch(`${UrlConstants.apiBaseUserUrl}/${cookie.value.userId}/account`, {
    method: 'POST',
    body: JSON.stringify({
      id: cookie.value.userId, password: newPassword.value
    }),
    headers: {
      'Content-Type': 'application/json',
      'token': cookie.value.token,
    }
  })
  switch (resp.status) {
    case 200:
      responseInfo.value = await resp.text()
      break
    case 401:
      responseInfo.value = HttpResponseConstant.unauthorized
      break
    default:
      responseInfo.value = await resp.text()
  }
}
</script>

<template>
  <div class="container w-60 h-65 border border-red-200 bg-blue-500">
    <div class="text-right pr-3 text-2xl" @click="isPasswordViewActive = false"><span class="close-button">X</span></div>
    <div class="w-50 m-auto">
      <p>
        <label for="new-password">Enter new password</label>
        <Input v-model="newPassword" class="change-password-input" id="new-password" type="password" placeholder="XXXXXX" required />
      </p>
      <p>
        <label for="confirm-new-password">Re-enter new password</label>
        <Input v-model="retypedNewPassword" class="change-password-input" id="confirm-new-password" type="password" placeholder="XXXXXX" required />
      </p>
      <p v-if="passwordsDoNotMatch" class="text-center">Passwords do not match!</p>
      <p v-else>
        <Button @click="changePassword" class="submit w-20" />
      </p>
    </div>
    <Footer class="text-center" :response="responseInfo" />
  </div>
</template>

<style>
.container {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -40%);
  background-color: ivory;
  border: 1px solid indianred;
  border-radius: 10px;

  @media (max-width: 320px) {
    width: 100%;
  }
}
.submit {
  display: block;
  margin: 5px auto;
  padding: 5px;
  width: calc(var(--spacing) * 25);
  background-color: navajowhite;
  border: 1px solid bisque;
  border-radius: 5px;

  @media (max-width: 320px) {
    width: 100%;
  }
}

.close-button:hover {
  cursor: pointer;
}

.change-password-input {
  width: 100%;
  margin: 10px 0 15px;
}
</style>
