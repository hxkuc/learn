<?php
namespace home\model;
use core\db\DB;
/**
* 文章model
*/
class article
{
	/*
	*获取文章信息
	*/
	public function info($id)
	{
		$info = DB::query('select * from `article` where id = '.$id);
		return $info[0];
	}

	/**
	*列出文章列表
	*$id主题id
	**/
	public function getlist($filter)
	{
		$pagenum = ($filter['currentpage']-1)*$filter["pagesize"];
		$where = '1';
		$where .= isset($filter["id"]) && $filter["id"] ? ' and topicid = '.$filter["id"] : '';
		$where .= isset($filter["status"]) && $filter["status"] ? ' and status = '.$filter["status"] : '';

		$order = ' order by addtime desc';

		$list = DB::query('select * from `article` where '.$where.$order.' limit '.$pagenum.','.$filter["pagesize"]);
		$count = DB::query('select count(id) as num from `article` where '.$where);
		return array(
			"list"=>$list,
			"count"=>$count['0']['num'],
		);
	}
	/*
	*列出文章列表（列出文章所属主题和推送人--后台使用）
	*/
	public function getarticlelist($filter)
	{
		$where = 'a.status = '.$filter["status"].' and a.uid = '.$filter['uid'];
		if($filter["topicid"]){
			$where .= ' and a.topicid = '.$filter["topicid"];
		}
		$pagenum = ($filter['currentpage']-1)*$filter["pagesize"];
		/*$sql = 'select a.*,t.topicname,u.username from `article` a left join `topic` t on a.topicid = t.id left join `user` u on a.adduid = u.id where '.$where.' limit '.$pagenum.','.$filter["pagesize"];

		print_r($sql);exit;*/
		$list = DB::query('select a.*,t.topicname,u.username from `article` a left join `topic` t on a.topicid = t.id left join `user` u on a.adduid = u.id where '.$where.' limit '.$pagenum.','.$filter["pagesize"]);
		$count = DB::query('select count(id) as num from `article` a where '.$where);
		return array(
			"list"=>$list,
			"count"=>$count['0']['num'],
		);
	}

	//新增文章
	public function add($data)
	{
		$res = DB::exec('insert into `article` (topicid,articlename,articleurl,addtime,status,uid,adduid)
		 values ('.$data["topicid"].',"'.$data["articlename"].'","'.$data["articleurl"].'",'.time().','.$data['status'].','.$data['uid'].','.$data['adduid'].')');
		return $res;
	}
	//删除文章
	public function delete($id)
	{
		$res = DB::exec('delete from `article` where id = '.$id);
		return $res;
	}

	// 改变状态
	public function changestatus($data)
	{
		$res = DB::exec('update `article` set status = '.$data['status'].' where id = '.$data['id']);
		return $res;
	}

	// 列出首页的最新文章
	public function getNewArticle($filter)
	{
		$pagenum = ($filter['currentpage']-1)*$filter["pagesize"];
		$where = '1';
		$where .= isset($filter["id"]) && $filter["id"] ? ' and topicid = '.$filter["id"] : '';
		$where .= isset($filter["status"]) && $filter["status"] ? ' and status = '.$filter["status"] : '';

		$order = ' order by a.addtime desc';

		$list = DB::query('
			select a.articlename,a.articleurl,a.addtime,u.username,u.headimg,u.id from `article` a left join `user` u on a.uid = u.id where '.$where.$order.' limit '.$pagenum.','.$filter["pagesize"]
			);

		return $list;
	}
}




?>