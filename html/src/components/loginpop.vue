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
            <el-col :span="12"><el-button style="width:100%">注册</el-button></el-col>
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
                this.$store.commit('setstates', ['userinfo', data.info])
                this.H.set_localStorage('userinfo', data.info)
                // 提示登录成功
                this.$message({
                  message: '登陆成功！',
                  type: 'success'
                })
                // 关闭当前页面
                this.$store.commit('setstates', ['showlogin', false])
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
      }
    }
  }
</script>

<style>
.loginstyle{
  width: 330px;
  margin-bottom:0px;
  background: #fbfbfb;
  border-radius: 3px;
}
.el-dialog__header{
  padding: 20px 20px;
  background-color: #000;
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
}
.el-dialog__body {
  padding: 30px 20px 5px;
  color: #445972;
  font-size: 14px;
}
.el-dialog__title{
  color:#bfcbd9;
}
</style>
