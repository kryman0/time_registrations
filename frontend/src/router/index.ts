import { createRouter, createWebHistory } from 'vue-router'
import { RouteConstants } from '@/Constants/RouteConstants.ts'

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
    }
  ],
})

export default router
