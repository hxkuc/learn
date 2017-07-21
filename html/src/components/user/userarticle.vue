<template>  
  <el-row  class="cardlist" :gutter="25">
    <el-row style="margin-bottom:10px;"> 
      <el-select v-model="filter.status" placeholder="请选择">
        <el-option
          v-for="item in filterstatus"
          :label="item.label"
          :value="item.value">
        </el-option>
      </el-select>
      <el-select v-model="filter.topicid" placeholder="请选择">
        <el-option
          v-for="item in filtertopiclist"
          :key="item.id"
          :label="item.topicname"
          :value="item.id">
        </el-option>
      </el-select> 
      <el-button class="filter-item" type="primary" v-waves icon="search" @click="searchlist">搜索</el-button>
    </el-row>
    <el-row>
      <el-table
        :data="table"
        style="width: 100%;text-align:left;">
        <el-table-column prop="articlename" label="名称" width="180">
          <template scope="scope">
            <a :href="scope.row.articleurl" target="_blank">{{scope.row.articlename}}</a>
          </template>
        </el-table-column>
        <el-table-column prop="topicname" label="所属主题">
        </el-table-column>
        <el-table-column prop="status" label="状态">
          <template scope="scope">
            <el-tag v-if="scope.row.status == 0" type="primary" close-transition>未审核</el-tag>
            <el-tag type="success" close-transition v-else>已审核</el-tag>    
          </template>
        </el-table-column>
        <el-table-column prop="username" label="添加人">
        </el-table-column>
        <el-table-column
          label="操作"
          width="120">
          <template scope="scope">
            <el-button @click="changestatus(scope.row)" type="success" size="mini" v-if="scope.row.status == 0">
              审核
            </el-button>
            <el-button @click="changestatus(scope.row)" type="warning" size="mini" v-else>
              隐藏
            </el-button>
            <el-button @click="deleteRow(scope.row.id)" type="danger"
              size="mini">
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
  name: 'userarticle',
  data () {
    return {
      table: [],
      filterstatus: [{
        value: 1,
        label: '已审核'
      }, {
        value: 0,
        label: '待审核'
      }],
      filtertopiclist: null,
      total: 0,
      currentpage: 1,
      filter: {
        pagesize: 10,
        status: 1,
        topicid: ''
      }
    }
  },
  methods: {
    changecurrent: function (val) {
      this.currentpage = val
      this.getmsg()
    },
    deleteRow: function (id) {
      let that = this
      this.$confirm('此操作将永久删除该链接, 是否继续?', '警告', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).then(() => {
        that.H.ajax('/user/user/deletearticle', {id: id}, 'post', function (data) {
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
    changestatus: function (row) {
      var that = this
      console.log(row.status)
      var status = Number(row.status) === 1 ? 0 : 1
      that.H.ajax('/user/user/changearticlestatus', {id: row.id, status: status}, 'post', function (data) {
        if (data.success === 1) {
          that.H.success(data.info)
          that.getmsg()
        } else {
          that.H.error(data.info)
        }
      })
    },
    getmsg: function () {
      var that = this
      var filter = that.filter
      filter.currentpage = that.currentpage
      that.H.ajax('/user/user/getuserarticlelist', filter, 'get', function (response) {
        that.table = response.data.list
        that.total = Number(response.data.count)
      })
    },
    searchlist: function () {
      this.getmsg()
    }
  },
  mounted: function () {
    // 获取主题信息
    var that = this
    that.H.ajax('/user/user/getusertopiclist', {}, 'get', function (response) {
      that.filtertopiclist = response.data
    })
    this.getmsg()
  }
}
</script>


<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  a {
    color: #42b983;
  }
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
