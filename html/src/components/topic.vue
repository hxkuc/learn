<template>
  <div>
    <h2>
      <a href="javascript:;" @click="$router.back(-1)">
        <i class="el-icon-caret-left"></i>返回
      </a>
    </h2>
    <h1>{{ msg }}</h1>
    <ul style="margin-bottom: 161px;">
      
      <el-card class="cards" v-for="l in links"  :body-style="{ padding: '5px' }">
      <transition-group name="fadetopic" tag="div">
      <li v-bind:key="l">
          <a :href="l.articleurl" target="_blank">{{l.articlename}}</a>
          <i @click="deletearticle(l.id)" class="el-icon-delete delete"></i> 
      </li>
      </transition-group>
      </el-card>
      
    </ul>
    
    <div style="position:fixed;bottom:0px;width:100%;background-color:rgba(255, 255, 255, 0.8);" >
      <el-pagination
        @size-change="changesize"
        @current-change="changecurrent"
        :current-page="currentpage"
        :page-sizes="[10, 15, 20, 50, 100]"
        :page-size="pagesize"
        layout="total, sizes, prev, pager, next"
        :total="totalcount">
      </el-pagination>
    <h2>添加文章</h2>
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
      <el-row type="flex" :gutter="10" justify="center">
        <el-col :span="3" >
          <el-form-item prop="title">
            <el-input v-model="ruleForm.title" placeholder="请输入标题"></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="3">
          <el-form-item prop="url">
            <el-input v-model="ruleForm.url" placeholder="请输入链接"></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="1"><el-button class="btn" type="primary" @click="submitForm('ruleForm')">添加</el-button></el-col>
      </el-row>
    </el-form>
    </div>

    
  </div>
</template>

<script>
export default {
  name: 'topic',
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
            if (data.success) {
              that.$message({message: data.info, type: 'success'})
              that.getmsg()
              // 清除表单内容
              that.$refs[formName].resetFields()
            } else {
              that.$message.error(data.info)
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
        that.H.ajax('/home/article/deletearticle', {id: id}, 'post', function (data) {
          if (data.success === 1) {
            that.$message({
              type: 'success',
              message: data.info
            })
            that.getmsg()
          } else {
            that.$message({
              type: 'error',
              message: data.info
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

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
.fadetopic-enter-active{
    transition: all 0.5s linear;
}
.fadetopic-enter{
   opacity: 0;
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
.cards{
  margin:5px;
  border:none;
  box-shadow:none;
}
.delete{
  margin:0px 5px;
  color:rgb(191, 191, 191);
  cursor:pointer;
  opacity:0.2;
}
.delete:hover{
  opacity:1;
}
</style>
