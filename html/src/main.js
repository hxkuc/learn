// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import {HF as H, ElementUI, store} from './assets/js/H.js'
Vue.use(ElementUI)
Vue.prototype.H = H

Vue.config.productionTip = false

/* 路由统一验证 */
router.beforeEach((to, from, next) => {
  // 判断该路由是否需要登录权限
  if (to.meta.needlogin) {
    // 通过vuex state获取当前的token是否存在
    let userinfo = H.GL('userinfo')
    if (!userinfo) {
      H.store('showlogin', true)
      H.store('next', next)
      return false
    }
    next()
  } else {
    next()
  }
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: { App }
})
