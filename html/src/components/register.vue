<template>
  <div>
    <el-dialog title="注册" :visible.sync="$store.state.showregister" :lock-scroll="false" custom-class="loginstyle" top="30%">
      <el-form :model="form" ref="form" :rules="rules">
        <el-form-item  prop="username">
          <el-input type="text" placeholder="请输入用户名" v-model="form.username" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item  prop="password">
          <el-input type="password" placeholder="请输入密码" v-model="form.password" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item  prop="spassword">
          <el-input type="password" placeholder="确认密码" v-model="form.spassword" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item>
          <el-row :gutter="10">
            <el-col :span="12"><el-button style="width:100%" @click="submitForm('form')">确认注册</el-button></el-col>
            <el-col :span="12"><el-button style="width:100%" @click="showlogin">已有账号去登录</el-button></el-col>
          </el-row> 
        </el-form-item>
      </el-form>
    </el-dialog>
  </div>
  
</template>
<script>
  export default {
    data () {
      var validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请再次输入密码'))
        } else if (value !== this.form.password) {
          callback(new Error('两次输入密码不一致!'))
        } else {
          callback()
        }
      }
      return {
        form: {
          username: '',
          password: '',
          spassword: ''
        },
        rules: {
          username: [
            { required: true, message: '用户名不能为空', trigger: 'blur' }
          ],
          password: [
            { required: true, message: '密码不能为空', trigger: 'change' }
          ],
          spassword: [
            { validator: validatePass2, trigger: 'blur' }
          ]
        },
        labelPosition: 'left'
      }
    },
    methods: {
      submitForm (formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            this.H.ajax('/common/login/register', this.form, 'post', (data) => {
              // 登陆成功
              if (data.success) {
                // 注册成功后关闭注册页面弹出提示，打开登录页面
                this.H.store('showregister', false)
                this.$confirm('注册成功！, 是否现在登录?', '提示', {
                  confirmButtonText: '确定',
                  cancelButtonText: '取消',
                  type: 'success'
                }).then(() => {
                  this.H.store('showlogin', true)
                }).catch(() => {})
              } else {
                this.$message.error(data.info)
              }
            })
          } else {
            return false
          }
        })
      },
      showlogin () {
        var that = this
        that.H.store('showregister', false)
        setTimeout(function () {
          that.H.store('showlogin', true)
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
