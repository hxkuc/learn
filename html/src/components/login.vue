<template>
  <div>
    <el-dialog title="登录" :visible.sync="$store.state.showlogin" :lock-scroll="false" custom-class="loginstyle" top="30%">
      <el-form :model="form" ref="form" :rules="rules">
        <el-form-item  prop="username">
          <el-input type="text" placeholder="请输入用户名" v-model="form.username" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item  prop="password">
          <el-input type="password" placeholder="请输入密码" v-model="form.password" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item>
          <el-row :gutter="10">
            <el-col :span="12"><el-button style="width:100%" @click="submitForm('form')">登录</el-button></el-col>
            <el-col :span="12"><el-button style="width:100%" @click="showregister">没有账号去注册</el-button></el-col>
          </el-row> 
        </el-form-item>
      </el-form>
    </el-dialog>
  </div>
  
</template>
<script>
  export default {
    data () {
      return {
        form: {
          username: '',
          password: ''
        },
        rules: {
          username: [
            { required: true, message: '用户名不能为空', trigger: 'blur' }
          ],
          password: [
            { required: true, message: '密码不能为空', trigger: 'change' }
          ]
        },
        labelPosition: 'left'
      }
    },
    methods: {
      submitForm (formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            this.H.ajax('/common/login/login', this.form, 'post', (data) => {
              // 登陆成功
              if (data.success) {
                // 赋值vuex和sessionstorage
                this.H.store('userinfo', data.data)
                if (data.data.headimg) {
                  this.H.store('headimg', data.data.headimg)
                }
                this.H.SL('userinfo', data.data)
                // 设置首页的主题为自己（根据用户设置判断）
                if (Number(data.data.auto_setindex) === 1) {
                  this.H.SL('showindexuid', data.data.id)
                }
                // 提示登录成功
                this.$message({
                  message: data.info,
                  type: 'success'
                })
                // 关闭当前页面
                this.H.store('showlogin', false)
                // 跳转
                this.$store.state.next()
              } else {
                this.$message.error(data.info)
              }
            })
          } else {
            return false
          }
        })
      },
      showregister () {
        var that = this
        that.H.store('showlogin', false)
        setTimeout(function () {
          that.H.store('showregister', true)
        }, 250)
      }
    }
  }
</script>

<style>
.loginstyle{
  width: 330px !important;
  margin-bottom:0px !important;
  background: #fbfbfb !important;
  border-radius: 3px !important;
}
.el-dialog__header{
  padding: 20px 20px !important;
  background-color: #000 !important;
  border-top-left-radius: 3px !important;
  border-top-right-radius: 3px !important;
}
.el-dialog__body {
  padding: 30px 20px 5px !important;
  color: #445972 !important;
  font-size: 14px !important;
}
.el-dialog__title{
  color:#bfcbd9 !important;
}
</style>
