import { createRouter, createWebHistory } from 'vue-router'
import { apiService } from '../services/api'
let routes = [
    {
        path: '/',
        name: 'Home',
        meta: {
            title: '首页',
            hideInMenu: false
        },
        component: () => import('../views/HomeView.vue')
    },
    {
        path: '/',
        name: 'Custom',
        meta: {
            title: '热门推荐',
            affix: true,
            showInHome: true,
            recommended: true,
            hideInMenu: true
        },
        component: () => import('../views/HomeView.vue')
    },
    {
        path: '/anime/:id?',
        name: 'Anime',
        meta: {
            title: '动漫',
            showInHome: true,
            hideInMenu: false
        },
        component: () => import('../views/MovieView.vue')
    },
    {
        path: '/movie/:id?',
        name: 'Movie',
        meta: {
            title: '电影',
            showInHome: true,
            hideInMenu: false
        },
        component: () => import('../views/MovieView.vue')
    },
    {
        path: '/tv/:id?',
        name: 'TV',
        meta: {
            title: '电视剧',
            showInHome: true,
            hideInMenu: false
        },
        component: () => import('../views/MovieView.vue')
    },
    {
        path: '/variety/:id?',
        name: 'Variety',
        meta: {
            title: '综艺',
            showInHome: true,
            hideInMenu: false
        },
        component: () => import('../views/MovieView.vue')
    },
    {
        path: '/trailer/:id?',
        name: 'Trailer',
        meta: {
            title: '预告片',
            hideInMenu: false
        },
        component: () => import('../views/MovieView.vue')
    },
    {
        path: '/:title/:id',
        name: 'Detail',
        meta: {
            title: '影视详情',
            hideInMenu: true
        },
        component: () => import('../views/detail/index.vue')
    },
    {
        path: '/:title/:id/:source/:episode',
        name: 'PlayDetail',
        meta: {
            title: '影视播放详情',
            hideInMenu: true
        },
        component: () => import('../views/detail/Player.vue')
    },
]
routes = routes.map((route) => {
  const cateMap = apiService.getCateMap()
  const category = route.name ? cateMap[route.name.toLowerCase() as keyof typeof cateMap] : undefined
  ;(route.meta as any).category = category || ''
  return route
})
const router = createRouter({
  history: createWebHistory(),
  scrollBehavior (to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { top: 0 }
    }
  },
  routes
})
router.beforeEach((to) => {
  document.title = (to.meta.title + '-影视在线') as string
//   return next()
})
export default router