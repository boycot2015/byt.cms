import { createRouter, createWebHistory } from 'vue-router'

const routes = [
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
            // category: '国产动漫,科幻片,预告片',
            hideInMenu: true
        },
        component: () => import('../views/HomeView.vue')
    },
    {
        path: '/anime',
        name: 'Anime',
        meta: {
            title: '动漫',
            showInHome: true,
            category: '国产动漫,日韩动漫',
            hideInMenu: false
        },
        component: () => import('../views/MovieView.vue')
    },
    {
        path: '/movie',
        name: 'Movie',
        meta: {
            title: '电影',
            showInHome: true,
            category: '科幻片,喜剧片,剧情片,爱情片,动作片,战争片,动画片',
            hideInMenu: false
        },
        component: () => import('../views/MovieView.vue')
    },
    {
        path: '/tv',
        name: 'TV',
        meta: {
            title: '电视剧',
            showInHome: true,
            category: '国产剧,韩国剧,欧美剧,香港剧,台湾剧,日本剧',
            hideInMenu: false
        },
        component: () => import('../views/MovieView.vue')
    },
    {
        path: '/variety',
        name: 'Variety',
        meta: {
            title: '综艺',
            showInHome: true,
            category: '大陆综艺,日韩综艺,港台综艺,欧美综艺',
            hideInMenu: false
        },
        component: () => import('../views/MovieView.vue')
    },
    {
        path: '/trailer',
        name: 'Trailer',
        meta: {
            title: '预告片',
            category: '预告片',
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

export default router