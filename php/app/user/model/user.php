<?php
namespace user\model;
use core\db\DB;
/**
* 用户类
*/
class user{
	
	/*
	*更新用户信息
	*$data
	*/
	public function edit($data){
		$res = DB::exec('update `user` set headimg = "'.$data['headimg'].'"');
		return $res;
	}
}

?>