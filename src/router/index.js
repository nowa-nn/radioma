import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import TransparentView from '../views/TransparentView.vue'
import NewsDetailView from '../views/NewsDetailView.vue'
import DirectionDetailView from '../views/DirectionDetailView.vue'
import CompactView from '../views/CompactView.vue'
import ClassicView from '../views/ClassicView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: ClassicView,
    alias: ['/classic', '/variant-3', '/standard', '/classic-header']
  },
  {
    path: '/compact',
    name: 'compact',
    component: CompactView,
    alias: ['/half-hero', '/compact-hero', '/variant-2']
  },
  {
    path: '/transparent',
    name: 'transparent',
    component: TransparentView,
    alias: ['/transparent-header', '/default']
  },
  {
    path: '/directions/:id',
    name: 'direction-detail',
    component: DirectionDetailView
  },
  {
    path: '/news/:id',
    name: 'news-detail',
    component: NewsDetailView
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
