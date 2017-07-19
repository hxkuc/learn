<?php
namespace common\controller;
/**
* 登录控制器，不继承base不需要登录验证
*/
class login extends regulation {
	
	//登录操作
	public function login(){
		$data = $_REQUEST;
		//直接查找是否存在
		$login = new \user\model\login;
		$user = $login->getuser($data);
		if($user){
			$this->assign('success',1);
			$this->assign('info','登陆成功!');
			$this->assign('data',$user);
			$this->assign('islogin',1);
			//登录成功设置session
			$_SESSION['userinfo'] = $user;
		}else{
			$this->assign('info','用户名或密码不正确！!');
		}
		$this->ajaxreturn();
	}
	//判断是否登录
	public function islogin(){
		if(!$_SESSION['userinfo'] || !$_SESSION['userinfo']['id']){
			return false;
		}
		return true;
	}

	public function register(){
		$data = $_REQUEST;
		$login = new \user\model\login;
		$isregister = $login->register($data);
		$this->assign('success',$isregister['success']);
		$this->assign('info',$isregister['info']);
		$this->ajaxreturn();
	}

	//退出登录
	public function loginout(){
		session_destroy();
		$this->assign('success',1);
		$this->assign('info','操作成功!');
		$this->assign('islogin',0);
		$this->ajaxreturn();
	}
}

?>