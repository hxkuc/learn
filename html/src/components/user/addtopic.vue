<template>
  <el-row  class="cardlist" :gutter="25">
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px">
      <el-form-item label="主题名称" prop="topicname">
        <el-input v-model="ruleForm.topicname"></el-input>
      </el-form-item>
      <el-form-item label="主题描述" prop="remarks">
        <el-input type="textarea" v-model="ruleForm.remarks"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="submitForm('ruleForm')">立即创建</el-button>
        <el-button @click="resetForm('ruleForm')">重置</el-button>
      </el-form-item>
    </el-form>
  </el-row>
</template>

<script>
export default {
  name: 'addtopic',
  data () {
    return {
      ruleForm: {
        topicname: '',
        remarks: ''
      },
      rules: {
        topicname: [
          { required: true, message: '名称不能为空', trigger: 'blur' }
        ]
      }
    }
  },
  methods: {
    submitForm (formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.H.ajax('/user/user/addtopic', this.ruleForm, 'post', (r) => {
            if (r.success) {
              this.H.success(r.info)
              this.$router.push('/user/usertopic')
            } else {
              this.H.error(r.info)
            }
          })
        } else {
          this.H.error('请填写正确信息！')
          return false
        }
      })
    },
    resetForm (formName) {
      this.$refs[formName].resetFields()
    }
  },
  mounted: function () {
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .cardlist{
    border: 1px solid #eaeefb;
    border-radius: 4px;
    transition: .2s;
    padding:20px;
  }
  .cardlist:hover{
    box-shadow: 0 0 8px 0 rgba(232,237,250,.6),0 2px 4px 0 rgba(232,237,250,.5);
  }
</style>
