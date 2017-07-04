<?php
namespace home\model;
use core\db\DB;
use core\view\VIEW;
/**
* 主题model
*/
class topic{
	
	//基础主题类增删改查

	public function add(){

	}
	/*
	*获取主题信息
	*$id主题id
	*/
	public function info($id){
		$info = DB::query('select * from `topic` where id = '.$id);
		return $info[0];
	}
}




?>