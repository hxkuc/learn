// 定义store
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
const store = new Vuex.Store({
  state: {
    showlogin: false,
    showregister: false,
    userinfo: {},
    next: () => {},
    headimg: 'static/login.png'
  },
  mutations: {
    setstates (state, obj) {
      state[obj[0]] = obj[1]
    }
  }
})

export default store
