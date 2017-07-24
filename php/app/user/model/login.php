<?php
namespace user\model;
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
	/*
	*注册
	*/
	public function register($data){
		$res = DB::query('select * from `user` where username = "'.$data['username'].'"');
		if(count($res)>0){
			return array("success"=>0,"info"=>'该用户已经存在！');
		}else{
			$resin = DB::exec('insert into `user` (username,password,auto_setindex,auto_delindex) values ("'.$data['username'].'","'.md5($data['password']).'",1,0)');
			if(false !== $resin){
				return array("success"=>1,"info"=>'注册成功');
			}else{
				return array("success"=>0,"info"=>'注册失败');
			}
		}
	}
}

?>