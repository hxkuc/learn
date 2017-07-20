<template>  
  <el-row  class="cardlist" :gutter="25">
    <el-row style="margin-bottom:10px;">
      <el-col :span="4">
      <router-link :to="{ name:'addtopic'}">
      <el-button type="primary">创建主题</el-button>
      </router-link>
      
      </el-col>
    </el-row>
    <el-row>
      <el-table
        :data="currenttable"
        style="width: 100%;text-align:left;">
        <el-table-column
          prop="topicname"
          label="名称"
          width="180">
        </el-table-column>
        <el-table-column
          prop="remarks"
          label="描述">
        </el-table-column>
        <el-table-column
          prop="anum"
          label="链接数量">
        </el-table-column>

        <el-table-column
          label="操作"
          width="120">
          <template scope="scope">
            <el-button
              @click="deleteRow(scope.$index, currenttable)"
              type="text"
              size="small">
              移除
            </el-button>
          </template>
        </el-table-column>
      </el-table>
    </el-row>
    <el-row type="flex" justify="end" style="padding:5px 0px;">
        <el-pagination
          small
          @current-change="changecurrent"
          :current-page="currentpage"
          layout="prev, pager, next"
          :total="total">
        </el-pagination>
    </el-row>   
  </el-row>
</template>

<script>
export default {
  name: 'usertopic',
  data () {
    return {
      table: [],
      total: 0,
      currentpage: 1
    }
  },
  methods: {
    changecurrent: function (val) {
      this.currentpage = val
    },
    deleteRow: function (index, rows) {
      let that = this
      this.$confirm('此操作将永久删除该主题以及主题下所有链接, 是否继续?', '警告', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).then(() => {
        that.H.ajax('/user/user/deletetopic', {id: rows[index].id}, 'post', function (data) {
          if (data.success === 1) {
            that.H.success(data.info)
            that.getmsg()
          } else {
            that.H.error(data.info)
          }
        })
      }).catch(() => {
      })
    },
    getmsg: function () {
      var that = this
      var userinfo = that.H.GL('userinfo')
      that.H.ajax('/user/user/topiclist', {uid: userinfo.id}, 'get', function (response) {
        that.table = response.data
        that.total = response.data.length
      })
    }
  },
  computed: {
    currenttable: function () {
      return this.table.slice((this.currentpage - 1) * 10, this.currentpage * 10)
    }
  },
  mounted: function () {
    this.getmsg()
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
  .el-table .info-row {
    background: #c9e5f5;
  }
  .el-table .positive-row {
    background: #e2f0e4;
  }
</style>
