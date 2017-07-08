<template>
  <div id="app">
    <el-menu theme="light" class="menui" :default-active="$route.path" mode="horizontal" router="router">
      <el-menu-item index="/index">首页</el-menu-item>
      <el-menu-item index="/topic/1">订单管理</el-menu-item>
      <li v-show="$route.name != 'index'" class="rightli">
        <i @click="turnback" class="el-icon-caret-left back"></i>
      </li>
      <li class="rightli">
        <img class="headimg" src="./assets/login.png"/>
      </li>
    </el-menu>
    <transition name="fade">
      <router-view></router-view>
    </transition>
  </div>
</template>

<script>
export default {
  name: 'app',
  data () {
    return {
      router: true
    }
  },
  methods: {
    turnback: function () {
      this.$router.go(-1)
    }
  }
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
.back{
  font-size:40px;
  cursor:pointer;
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
