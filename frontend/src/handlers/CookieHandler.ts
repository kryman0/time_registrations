import HttpResponseConstant from "@/constants/HttpResponseConstant.ts";

async function getCookieByKeys(): object | string {
  const userId = await window.cookieStore.get(arguments[0])
  const token = await window.cookieStore.get(arguments[1])

  if (!userId || !userId.value || !token || !token.value) {
    return HttpResponseConstant.noCookieGet
  }

  return Object.create({ userId: userId.value, token: token.value });
}

export { getCookieByKeys };
