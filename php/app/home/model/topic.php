<?php
namespace home\model;
use core\db\DB;
/**
* 主题model
*/
class topic{
	
	//基础主题类增删改查
	/*
	*获取主题信息
	*$id主题id
	*/
	public function info($id){
		$info = DB::query('select * from `topic` where id = '.$id);
		return $info[0];
	}

	/*
	*获取主题列表
	*/
	public function getlist($uid){
		$list = DB::query("select * from topic where uid = ".$uid);
		return $list;
	}

	// 获取主题列表带链接数量
	public function getusertopiclist($uid){
		$list = DB::query("select t.*,count(a.id) as anum from topic t left join `article` a on t.id = a.topicid where t.uid = ".$uid.' group by t.id');
		return $list;
	}

	// 新增主题
	public function add($data){
		$res = DB::exec('insert into `topic` (topicname,remarks,uid) values ("'.$data['topicname'].'","'.$data['remarks'].'",'.$data['uid'].')');
		return $res;
	}

	// 删除主题
	public function delete($id){
		DB::startTrans();
		$resa = DB::exec('delete from `article` where topicid = '.$id);
		$rest = DB::exec('delete from `topic` where id = '.$id);

		if(false !== $resa && false !== $rest){
			DB::commit();
			return true;
		}else{
			DB::rollback();
			return false;
		}
	}
}

?>