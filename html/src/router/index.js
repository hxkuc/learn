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
    }
  ]
})
