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
      path: '/square',
      name: 'square',
      component: resolve => require(['@/components/square'], resolve)
    },
    {
      path: '/homepage/:uid',
      name: 'homepage',
      component: resolve => require(['@/components/homepage'], resolve)
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
      children: [
        {
          path: 'userinfo',
          name: 'userinfo',
          meta: {
            needlogin: true
          },
          component: resolve => require(['@/components/user/userinfo'], resolve)
        },
        {
          path: 'usertopic',
          name: 'usertopic',
          meta: {
            needlogin: true
          },
          component: resolve => require(['@/components/user/usertopic'], resolve)
        },
        {
          path: 'changepassword',
          name: 'changepassword',
          meta: {
            needlogin: true
          },
          component: resolve => require(['@/components/user/changepassword'], resolve)
        },
        {
          path: 'userarticle',
          name: 'userarticle',
          meta: {
            needlogin: true
          },
          component: resolve => require(['@/components/user/userarticle'], resolve)
        },
        {
          path: 'setting',
          name: 'setting',
          meta: {
            needlogin: true
          },
          component: resolve => require(['@/components/user/setting'], resolve)
        },
        {
          path: 'addtopic',
          name: 'addtopic',
          meta: {
            needlogin: true
          },
          component: resolve => require(['@/components/user/addtopic'], resolve)
        }
      ],
      component: resolve => require(['@/components/user'], resolve)
    },
    {
      path: '/login',
      name: 'login',
      component: resolve => require(['@/components/login'], resolve)
    },
    {
      path: '/register',
      name: 'register',
      component: resolve => require(['@/components/register'], resolve)
    }
  ]
})
