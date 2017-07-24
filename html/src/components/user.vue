<template>
    <el-row type="flex" justify="center">
      <el-col :xs="24" :sm="20" :md="18" :lg="16">
        <h1>用户中心</h1>
        <el-row :gutter="20">
          <el-col  :xs="24" :sm="6" :md="6" :lg="5">
            <el-menu  :default-active="defaulturl" class="el-menu-vertical-demo" router="router">     
                <el-menu-item index="/user/usertopic"><i class="el-icon-setting"></i>链接主题</el-menu-item>
                <el-menu-item index="/user/userarticle"><i class="el-icon-setting"></i>链接列表</el-menu-item>
                <el-menu-item :index="myhomepage"><i class="el-icon-setting"></i>我的主页</el-menu-item>
                <el-menu-item index="/user/userinfo"><i class="el-icon-setting"></i>上传头像</el-menu-item>
                <el-menu-item index="/user/setting"><i class="el-icon-setting"></i>其他设置</el-menu-item>
                <li  class="el-menu-item" style="padding-left: 20px;" @click="outlogin">
                  <i class="el-icon-circle-cross"></i>退出登录
                </li>
            </el-menu>
          </el-col>
          <el-col  :xs="24" :sm="18" :md="18" :lg="19">         
            <router-view></router-view>
          </el-col>
        </el-row>
      </el-col>
    </el-row>
</template>

<script>
export default {
  name: 'hello',
  data () {
    return {
      msg: '',
      defaulturl: this.$route.path,
      myhomepage: '/homepage/' + this.H.GL('userinfo').id,
      router: true
    }
  },
  methods: {
    outlogin: function () {
      var that = this
      this.$confirm('确定要退出登录?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      })
      .then(() => {
        this.H.success('删除成功!')
        // 请求服务器退出登录
        this.H.ajax('/common/login/loginout', {}, 'post', function (data) {
          // 根据用户设置判断是否清空主页配置
          if (Number(that.H.GL('userinfo').auto_delindex) === 1) {
            that.H.SL('showindexuid')
          }
          that.H.SL('userinfo')
          that.H.store('headimg', 'static/login.png')
          that.H.store('userinfo', {})
          that.H.success(data.info)
          that.$router.push('/index')
        })
      })
      .catch(() => {
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
.el-menu-vertical-demo{
  text-align:left;
}
</style>
