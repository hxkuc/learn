import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      redirect: '/index'
    },
    {
      path: '/index',
      name: 'index',
      component: resolve => require(['@/components/index'], resolve)
    },
    {
      path: '/topic/:id',
      name: 'topic',
      component: resolve => require(['@/components/topic'], resolve)
    },
    {
      path: '/user',
      name: 'user',
      meta: {
        needlogin: true
      },
      component: resolve => require(['@/components/user'], resolve)
    },
    {
      path: '/login',
      name: 'login',
      component: resolve => require(['@/components/login'], resolve)
    },
    {
      path: '/loginpop',
      name: 'loginpop',
      component: resolve => require(['@/components/loginpop'], resolve)
    }
  ]
})
