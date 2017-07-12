<?php
namespace admin\model;
use core\db\DB;
/**
* 登录操作
*/
class login{
	
	/*
	*登录判断
	*$data
	*/
	public function getuser($data){
		$res = DB::query('select * from `user` where username = "'.$data['username'].'" and password = "'.md5($data['password']).'"');
		return $res?$res[0]:$res;
	}
}

?>