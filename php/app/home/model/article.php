<?php
namespace home\model;
use core\db\DB;
/**
* 文章model
*/
class article{
	
	/**
	*列出文章列表
	*$id主题id
	**/
	public function getlist($filter){
		$pagenum = ($filter['currentpage']-1)*$filter["pagesize"];
		$list = DB::query('select * from `article` where topicid = '.$filter["id"].' limit '.$pagenum.','.$filter["pagesize"]);
		$count = DB::query('select count(id) as num from `article` where topicid = '.$filter["id"]);
		return array(
			"list"=>$list,
			"count"=>$count['0']['num'],
		);
	}
	//新增文章
	public function add($data){
		$res = DB::exec('insert into `article` (topicid,articlename,articleurl,addtime,status)
		 values ('.$data["topicid"].',"'.$data["articlename"].'","'.$data["articleurl"].'",'.time().',0)');
		return $res;
	}
	//删除文章
	public function delete($id){
		$res = DB::exec('delete from `article` where id = '.$id);
		return $res;
	}
}




?>