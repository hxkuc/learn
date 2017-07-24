<template>
  <el-row type="flex" justify="center" class="box">
    <el-col :xs="24" :sm="22" :md="20" :lg="18">
      <el-row  class="cardlist" :gutter="25">
        <el-col :xs="24" :sm="8" :md="6" :lg="4" v-for="(o, index) in userlist" :key="o" class="cardlistone">
          <el-card :body-style="{ padding: '0px'}">
            <div>
              <img @click="gotohomepage(o.id)" :src="o.headimg" class="image" v-if="o.headimg">
              <img @click="gotohomepage(o.id)" src="static/login.png" class="image" v-else>
              <div style="padding:14px;">
                <el-tooltip :content="o.remarks" placement="top" effect="light">
                  <span class="time">{{o.remarks}}</span>
                </el-tooltip>
                <div class="bottom clearfix">
                  <el-button type="info" class="button" @click="setindexid(o.id)" size="mini">据为己有</el-button>
                </div>
              </div>
            </div>
          </el-card>
        </el-col>
      </el-row>
    </el-col>
  </el-row>
</template>

<script>
export default {
  name: 'square',
  data () {
    return {
      userlist: {}
    }
  },
  methods: {
    gotohomepage: function (id) {
      this.$router.push({name: 'homepage', params: {uid: id}})
    },
    setindexid: function (id) {
      this.H.SL('showindexuid', id)
      this.H.success('设置成功，去首页看看吧！')
    }
  },
  mounted: function () {
    var that = this
    that.H.ajax('/home/index/getuserlist', {}, 'get', function (response) {
      if (response.success) {
        that.userlist = response.data
      }
    })
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .box{
    margin-top:80px;
  }
  .cardlist{
    border: 1px solid #eaeefb;
    border-radius: 4px;
    transition: .2s;
    padding:20px;
  }
  .cardlist:hover{
    box-shadow: 0 0 8px 0 rgba(232,237,250,.6),0 2px 4px 0 rgba(232,237,250,.5);
  }
  .image{
    width: 100%;
    display: block;
    cursor: pointer;
  }
  .cardlistone{
    margin-bottom:20px;
  }

  .time {
    font-size: 13px;
    color: #999;
    display: block;
    height: 40px;
    overflow: hidden;
  }
  .clearfix:before,
  .clearfix:after {
      display: table;
      content: "";
  }
  
  .clearfix:after {
      clear: both
  }
</style>
