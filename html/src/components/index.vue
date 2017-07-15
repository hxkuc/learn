<template>
  <div class="hello">
    <img class="logoimg" :src="$store.state.headimg" style="border-radius:50%;">
    <h1>{{ msg }}</h1>
    <h2>主题</h2>
      <transition-group name="fadeindex" tag="ul">
        <li v-for="l in links" v-bind:key="l">
          <router-link :to="{ name:'topic', params:{id:l.id}}">{{l.topicname}}</router-link>
        </li>
      </transition-group>
    <h2 v-show="$store.state.userinfo.id"><a href="javascript:;" @click="openpop">创建主题</a></h2>
  </div>
</template>

<script>
export default {
  name: 'hello',
  data () {
    return {
      msg: '前后分离单页应用',
      links: []
    }
  },
  methods: {
    openpop: function () {
      console.log(JSON.stringify(this.$store.state.userinfo))
      this.H.error('暂未开放！')
    }
  },
  mounted: function () {
    var that = this
    that.H.ajax('/home/index/gettopiclist', {}, 'get', function (response) {
      that.links = response.data
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
