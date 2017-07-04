<template>
  <div id="app">
    <div style="text-align:right;height:50px;">
      <i v-show="$route.path != '/'" @click="turnback" style="font-size:50px;cursor:pointer" class="iconfont">&#xe8e7;</i>
    </div>
    <transition name="fade">
    <router-view></router-view>
    </transition>
  </div>
</template>

<script>
export default {
  name: 'app',
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
</style>
