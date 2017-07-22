<template>
  <el-row  class="cardlist" :gutter="25">
    
  </el-row>
</template>

<script>
export default {
  name: 'setting',
  data () {
    return {
      msg: ''
    }
  },
  methods: {
    submitForm (formName) {
      var that = this
      that.$refs[formName].validate((valid) => {
        if (valid) {
          let loadingInstance = that.$loading({ fullscreen: true })
          that.H.ajax('/home/article/addarticle', {
            topicid: that.$route.params.id,
            articlename: that.ruleForm.title,
            articleurl: that.ruleForm.url
          }, 'post', function (data) {
            loadingInstance.close()
            if (data.data.success) {
              that.$message({message: data.data.info, type: 'success'})
              that.getmsg()
              // 清除表单内容
              that.$refs[formName].resetFields()
            } else {
              that.$message.error(data.data.info)
            }
          })
        } else {
          this.$notify.error({
            title: '错误',
            message: '信息填写不完整！'
          })
          return false
        }
      })
    },
    deletearticle: function (id) {
      var that = this
      this.$confirm('此操作将永久删除该文章, 是否继续?', '警告', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).then(() => {
        that.H.ajax('/home/topic/deletearticle', {id: id}, 'post', function (data) {
          if (data.data.success === 1) {
            that.$message({
              type: 'success',
              message: data.data.info
            })
            that.getmsg()
          } else {
            that.$message({
              type: 'error',
              message: data.data.info
            })
          }
        })
      }).catch(() => {
      })
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
