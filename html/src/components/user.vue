<template>
    <el-row type="flex" justify="center">
      <el-col :span="12">
        <h1>用户中心</h1>
        <el-row :gutter="20">
          <el-col  :xs="10" :sm="8" :md="6" :lg="4">
            <el-menu  :default-active="defaulturl" class="el-menu-vertical-demo" router="router">     
                <el-menu-item index="/user/userinfo"><i class="el-icon-setting"></i>个人信息</el-menu-item>
                <el-menu-item index="/user/changepassword"><i class="el-icon-edit"></i>修改密码</el-menu-item>
                <li  class="el-menu-item" style="padding-left: 20px;">
                  <i class="el-icon-circle-cross"></i>退出登录
                </li>
            </el-menu>
          </el-col>
          <el-col  :xs="14" :sm="16" :md="18" :lg="20">
            <transition name="fade">
            <router-view></router-view>
            </transition>
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
      defaulturl: '/user/userinfo',
      router: true
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
</style>
