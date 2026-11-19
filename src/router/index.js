import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import TransparentView from '../views/TransparentView.vue'
import NewsDetailView from '../views/NewsDetailView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/news/:id',
    name: 'news-detail',
    component: NewsDetailView
  },
  {
    path: '/transparent',
    name: 'transparent',
    component: TransparentView,
    alias: '/transparent-header'
  },
  {
    path: '/:pathMatch(.*)*',
    redirect: '/'
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    }
    if (to.hash) {
      return { el: to.hash, behavior: 'smooth' }
    }
    return { top: 0 }
  }
})

export default router
