<template>
    <el-row class="boxdiv" type="flex" justify="center">
    <el-col :span="18">
    <el-upload class="upload-demo" action="http://up.qbox.me/" 
      :show-file-list="false"
      :on-success="handleAvatarSuccess"
      :before-upload="beforeAvatarUpload"
      :data="data">
      <img v-if="imageUrl" :src="imageUrl" class="avatar">
      <i v-else class="el-icon-plus avatar-uploader-icon"></i>
    </el-upload>
    </el-col>
    </el-row>
</template>

<script>
export default {
  name: 'userinfo',
  data () {
    return {
      data: {token: '', key: ''},
      imageUrl: this.$store.state.headimg
    }
  },
  methods: {
    handleAvatarSuccess (res, file) {
      var that = this
      that.imageUrl = 'http://odfb8y4in.bkt.clouddn.com/' + res.key
      // 获取用户缓存信息
      let userinfo = that.H.GL('userinfo')
      if (!userinfo.id) {
        that.error('用户未登录！')
        return false
      }
      // 更新用户头像
      that.H.ajax('/user/user/edit', {headimg: that.imageUrl, uid: userinfo.id}, 'post', function (response) {
        if (response.success) {
          that.$message({
            message: response.info,
            type: 'success'
          })
          let userinfo = that.H.GL('userinfo')
          userinfo.headimg = that.imageUrl
          that.H.store('headimg', that.imageUrl)
          that.H.SL('userinfo', userinfo)
        } else {
          that.$message.error(response.info)
        }
      })
    },
    beforeAvatarUpload (file) {
      var that = this
      const isLt2M = file.size / 1024 / 1024 < 1
      const fileExtension = file.name.split('.').pop().toLowerCase()
      const isJPG = fileExtension === 'jpg' || fileExtension === 'jpeg' || fileExtension === 'png'
      if (!isJPG) {
        this.$message.error('上传头像图片格式不正确!')
      }
      if (!isLt2M) {
        this.$message.error('上传头像图片大小不能超过 1MB!')
      }
      if (!that.data.token) {
        this.$message.error('网络错误！')
      }
      var userinfo = that.H.GL('userinfo')
      that.data.key = 'learn-headimg-' + userinfo.id + '.' + fileExtension
      return isJPG && isLt2M && that.data.token
    }
  },
  mounted: function () {
    var that = this
    that.H.ajax('/user/base/getqiniutoken', {}, 'get', function (response) {
      that.data.token = response.data
    })
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
.upload-demo .el-upload {
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}
.upload-demo .el-upload:hover {
  border-color: #20a0ff;
}
.avatar-uploader-icon {
  font-size: 28px;
  color: #8c939d;
  width: 178px;
  height: 178px;
  line-height: 178px;
  text-align: center;
}
.avatar {
  width: 178px;
  height: 178px;
  display: block;
  border-radius:5px;
}

.boxdiv{
  padding:20px;margin:0px auto;
  background-color: #fbfbfb;
  border-radius: 4px;
  box-shadow: 0 1px 1px rgba(0,0,0,.15);
  border-color: transparent;
}
</style>
