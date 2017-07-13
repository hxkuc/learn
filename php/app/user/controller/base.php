<?php
namespace user\controller;
use common\controller\regulation;
/**
* 黄总制作基础类
*/
class base extends regulation{
	
	//要构造函数有何用
	public function __construct(){
		//判断是否登录
		if(!$this->islogin()){
			//未登录返回统一json数据
			$this->assign('needlogin',1);
			$this->ajaxreturn();
		}

	}

	//判断是否登录
	public function islogin(){
		if(!isset($_SESSION['userinfo']) || !$_SESSION['userinfo']['id']){
			return false;
		}
		return true;
	}
}

?>