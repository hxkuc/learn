<template>
  <div style="padding:20px;width:80%;margin:0px auto;">
    <h1>55</h1>
    <el-row :gutter="20">
      <el-col  :xs="10" :sm="8" :md="6" :lg="5">
        <el-menu mode="vertical" default-active="1" class="el-menu-vertical-demo">
          <el-menu-item-group title="个人信息">
            <el-menu-item index="1"><i class="el-icon-message"></i>个人信息</el-menu-item>
            <el-menu-item index="2"><i class="el-icon-message"></i>修改密码</el-menu-item>
          </el-menu-item-group>
          
        </el-menu>
      </el-col>
      <el-col  :xs="14" :sm="16" :md="18" :lg="19"><div style="background-color:#f70;">11</div></el-col>
    </el-row>

  </div>
</template>

<script>
export default {
  name: 'hello',
  data () {
    return {
      msg: ''
    }
  },
  methods: {
    getmsg: function () {
      var that = this
      that.H.ajax('/admin/user/getarticlelist', {}, 'get', function (response) {
        console.log(response)
      })
    }
  },
  mounted: function () {
    this.getmsg()
  }
}
</script>


<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped> 
h1, h2 {
  font-weight: normal;
}
a {
  color: #42b983;
}
input{
  padding:10px;
  border:1px solid #000;
  border-radius:3px;
}
.btn{
  padding:10px;
  background-color:#42b983;
  color:#fff;
  border-radius:3px;
  border-color:#42b983;
}
</style>
