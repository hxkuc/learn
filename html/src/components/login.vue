<template>
  <div style="padding:20px;width:80%;margin:0px auto;">
    <h1>登录</h1>
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
      msg: '',
      pagesize: 15,
      currentpage: 1,
      totalcount: 0,
      links: [],
      ruleForm: {
        title: '',
        url: ''
      },
      rules: {
        title: [
          { required: true, message: '请输入标题', trigger: 'blur' }
        ],
        url: [
          { required: true, message: '请输入链接地址', trigger: 'blur' },
          { pattern: /^((https|http|ftp|rtsp|mms)?:\/\/)(([0-9a-zA-Z_!~*'().&=+$%-]+: )?[0-9a-zA-Z_!~*'().&=+$%-]+@)?(([0-9]{1,3}.){3}[0-9]{1,3}|([0-9a-zA-Z_!~*'()-]+.)*([0-9a-zA-Z][0-9a-zA-Z-]{0,61})?[0-9a-zA-Z].[a-zA-Z]{2,6})(:[0-9]{1,4})?((\/?)|(\/[0-9a-zA-Z_!~*'().;?:@&=+$,%#-]+)+\/?)$/, message: 'url地址不符合规则！'
          }
        ]
      }

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
    changecurrent: function (val) {
      this.currentpage = val
      this.getmsg()
    },
    changesize: function (val) {
      this.pagesize = val
      this.getmsg()
    },
    getmsg: function () {
      var that = this
      var id = this.$route.params.id
      that.H.ajax('/home/topic/getarticlelist', {
        id: id,
        currentpage: that.currentpage,
        pagesize: that.pagesize
      }, 'get', function (response) {
        that.msg = response.data.topicinfo.topicname
        that.links = response.data.articlelist.list
        that.totalcount = Number(response.data.articlelist.count)
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
