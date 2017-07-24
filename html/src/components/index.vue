<template>
  <div>
    <template v-if="showindexuid">
      <img class="logoimg" :src="userinfo.headimg" style="border-radius:50%;">
      <h1>{{ userinfo.remarks }}</h1>
    </template>
    <template v-else>
      <img class="logoimg" src="static/login.png" style="border-radius:50%;">
      <h1>去<router-link :to="{ name:'square'}">广场</router-link>看看别人的收藏夹，并且据为己有</h1>
    </template>
    <h2>主题</h2>
      <transition-group name="fadeindex" tag="ul">
        <li v-for="l in links" v-bind:key="l">
          <router-link :to="{ name:'topic', params:{id:l.id}}">{{l.topicname}}</router-link>
        </li>
      </transition-group>
  </div>
</template>

<script>
export default {
  name: 'index',
  data () {
    return {
      showindexuid: this.H.GL('showindexuid'),
      links: [],
      userinfo: {}
    }
  },
  mounted: function () {
    var that = this
    // that.showindexuid = 1
    if (that.showindexuid) {
      that.H.ajax('/home/index/getindexuser', {uid: that.showindexuid}, 'get', function (response) {
        if (response.success) {
          that.userinfo = response.data.userinfo
          that.links = response.data.topiclist
          console.log(response.data.userinfo)
        } else {
          that.H.error('网络错误！')
        }
      })
    }
  }
}
</script>


<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
.fadeindex-enter-active{
    transition: all 0.2s linear;
}
.fadeindex-enter{
   opacity: 0;
   transform:translateY(20px);
}
.logoimg{
  margin-top: 60px;
}
</style>
