<template>
  <div id="app">
    <el-menu theme="light" class="menui" :default-active="$route.path" mode="horizontal" router="router">
      <el-menu-item index="/index">首页</el-menu-item>
      <el-menu-item index="/square">广场</el-menu-item>
      <li class="rightli">
        <router-link :to="{ name:'usertopic'}">
          <img class="headimg" :src="$store.state.headimg"/>
        </router-link>
      </li>
    </el-menu>
    <transition name="fade">
      <router-view></router-view>
    </transition>
    <div>
      <login></login>
      <register></register>
    </div>
  </div>
</template>

<script>
import login from '@/components/login'
import register from '@/components/register'
export default {
  name: 'app',
  data () {
    return {
      router: true
    }
  },
  mounted: function () {
    // 刷新时要保存到store里的数据，防止刷新页面丢失数据
    if (this.H.GL('userinfo')) {
      this.H.store('userinfo', this.H.GL('userinfo'))
      if (this.H.GL('userinfo').headimg) {
        this.H.store('headimg', this.H.GL('userinfo').headimg)
      } else {
        this.H.store('headimg', 'static/login.png')
      }
    }
  },
  components: { login, register }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
a{
  text-decoration:none;
}
.fade-enter-active{
    transition: opacity .5s;
}
.fade-enter{
   opacity: 0;
}
.rightli{
  float:right;
  margin:10px;
}
.menui{
  background-color:#fbfbfb;
}
body{
  margin:0px;
}
.headimg{
  width:40px;
  height:40px;
  border-radius:50%;
  cursor:pointer;
}
</style>
