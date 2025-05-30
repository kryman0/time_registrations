import { createRouter, createWebHistory } from 'vue-router'
import RouteConstants from '@/constants/RouteConstants.ts'
import HttpResponseConstant from "@/constants/HttpResponseConstant.ts";
import { getCookieByKeys } from '@/handlers/CookieHandler.ts'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: RouteConstants.home.path,
      name: RouteConstants.home.name,
      component: () => import('@/views/HomeView.vue'),
    },
    {
      path: RouteConstants.admin.path,
      name: RouteConstants.admin.name,
      component: () => import('@/views/AdminView.vue'),
      beforeEnter: async (to, from) => {
        const cookie = await getCookieByKeys('userId', 'token')

        if (!cookie || typeof cookie === 'string') {
          const unAuthMsg = HttpResponseConstant.unauthorized + '! You will be redirected to the login page.'

          alert(unAuthMsg)

          return { name: RouteConstants.login.name }
        }
        return true
      }
    },
    {
      path: RouteConstants.login.path,
      name: RouteConstants.login.name,
      component: () => import('@/views/LoginView.vue'),
    },
    {
      path: RouteConstants.user.path,
      name: RouteConstants.user.name,
      component: () => import('@/views/UserView.vue'),
      beforeEnter: async (to, from) => {
        const cookie = await getCookieByKeys('userId', 'token')

        if (!cookie || typeof cookie === 'string') {
          const unAuthMsg = HttpResponseConstant.unauthorized + '! You will be redirected to the login page.'

          alert(unAuthMsg)

          return { name: RouteConstants.login.name }
        }
        return true
      }
    }
  ],
})

export default router
