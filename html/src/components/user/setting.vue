<template>
  <el-row  class="cardlist" :gutter="25">
    <el-form :model="ruleForm" label-width="100px" class="formdemo">
	  <el-form-item label="登陆设置">    
	    <el-checkbox v-model="ruleForm.auto_setindex" name="type">登录自动设置主页</el-checkbox>
	  </el-form-item>
	  <el-form-item label="登出设置">
	    <el-checkbox v-model="ruleForm.auto_delindex" name="type">退出清除默认主页</el-checkbox>
	  </el-form-item>
    <el-form-item label="首页签名">
      <el-input type="textarea" :maxlength="30" placeholder="最多输入30字" v-model="ruleForm.remarks"></el-input>
    </el-form-item>
	  <el-form-item label-width="100px">
	    <el-button type="primary" @click="saveset">保存</el-button>
	  </el-form-item>
	</el-form>
  </el-row>
</template>

<script>
export default {
  name: 'setting',
  data () {
    return {
      ruleForm: {
        auto_setindex: Boolean(Number(this.H.GL('userinfo').auto_setindex)),
        auto_delindex: Boolean(Number(this.H.GL('userinfo').auto_delindex)),
        remarks: this.H.GL('userinfo').remarks
      }
    }
  },
  methods: {
    saveset: function () {
      var _that = this
      var _data = {
        auto_setindex: _that.ruleForm.auto_setindex ? 1 : 0,
        auto_delindex: _that.ruleForm.auto_delindex ? 1 : 0,
        remarks: _that.ruleForm.remarks || '该用户懒得写！'
      }
      _that.H.ajax('/user/user/changesetting', _data, 'post', data => {
        if (data.success) {
          // 重新赋值本地缓存
          _that.H.SL('userinfo', data.data)
          _that.H.success(data.info)
        } else {
          _that.error(data.info)
        }
      })
    }
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
  .formdemo{
    text-align: left;
  }
</style>
