<template>
  <div id="app">
    <el-menu theme="light" class="menui" :default-active="$route.path" mode="horizontal" router="router">
      <el-menu-item index="/index">首页</el-menu-item>
      <el-menu-item index="/topic/1">主题页</el-menu-item>
      <li class="rightli">
        <router-link :to="{ name:'user'}">
          <img class="headimg" src="./assets/login.png"/>
        </router-link>
      </li>
    </el-menu>
    <transition name="fade">
      <router-view></router-view>
    </transition>
    <div>
      <login></login>
    </div>
  </div>
</template>

<script>
import login from '@/components/loginpop'
export default {
  name: 'app',
  data () {
    return {
      router: true
    }
  },
  components: { login }
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
    transition: all 0.5s linear;
}
.fade-enter{
   opacity: 0;
   transform:none;
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
