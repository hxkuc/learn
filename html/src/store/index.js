// 定义store
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
const store = new Vuex.Store({
  state: {
    showlogin: false,
    userinfo: {},
    next: () => {}
  },
  mutations: {
    setstates (state, obj) {
      state[obj[0]] = obj[1]
    }
  }
})

export default store
