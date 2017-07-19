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
		$res = DB::exec('update `user` set headimg = "'.$data['headimg'].'" where id = '.$data['uid']);
		return $res;
	}

	// 获取用户信息
	public function getuserinfo($id){
		$info = DB::query('select * from `user` where id = '.$id);
		return $info?$info[0]:'';
	}

	// 获取所有用户列表
	public function userlist(){
		$list = DB::query('select id,username,headimg,remarks from `user`');
		return $list;
	}
}

?>