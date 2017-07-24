<template>
  <div>
    <img class="logoimg" :src="userinfo.headimg" style="border-radius:50%;" v-if="userinfo.headimg">
    <img class="logoimg" src="static/login.png" style="border-radius:50%;" v-else>
    <h1>
      {{ userinfo.remarks }}
    </h1>
    <h2>主题</h2>
      <transition-group name="fadeindex" tag="ul">
        <li v-for="l in links" v-bind:key="l">
          <router-link :to="{ name:'topic', params:{id:l.id}}">{{l.topicname}}</router-link>
        </li>
      </transition-group>
      <h2>
        <el-button type="info" class="button" @click="setindexid(userinfo.id)" size="mini">据为己有</el-button>
      </h2>
  </div>
</template>

<script>
export default {
  name: 'homepage',
  data () {
    return {
      links: [],
      userinfo: {}
    }
  },
  methods: {
    setindexid: function (id) {
      this.H.SL('showindexuid', id)
      this.H.success('设置成功，去首页看看吧！')
    }
  },
  mounted: function () {
    var that = this
    that.H.ajax('/home/index/getindexuser', {uid: that.$route.params.uid}, 'get', function (response) {
      if (response.success) {
        that.userinfo = response.data.userinfo
        that.links = response.data.topiclist
      } else {
        that.H.error('网络错误！')
      }
    })
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
