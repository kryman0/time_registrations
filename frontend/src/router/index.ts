import { createRouter, createWebHistory } from 'vue-router'
import RouteConstants from '@/constants/RouteConstants.ts'
import HttpResponseConstant from "@/constants/HttpResponseConstant.ts";

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
        const userId = await window.cookieStore.get('userId')
        const token = await window.cookieStore.get('token')

        if (!userId && !token) {
          const unauthMsg = HttpResponseConstant.unauthorized + '! You will be redirected to the login page.'
          alert(unauthMsg)
          return { name: RouteConstants.login.name }
        }
        return true
      }
    }
  ],
})

export default router
