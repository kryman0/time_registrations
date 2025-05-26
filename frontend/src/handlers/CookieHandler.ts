import HttpResponseConstant from "@/constants/HttpResponseConstant.ts";

async function getCookieByKeys(): Promise<object> | string {
  const userId = await window.cookieStore.get(arguments[0])
  const token = await window.cookieStore.get(arguments[1])

  if (!userId.value || !token.value) {
    return HttpResponseConstant.noCookieGet
  }

  return Object.create({ userId: userId.value, token: token.value });
}

export { getCookieByKeys };
