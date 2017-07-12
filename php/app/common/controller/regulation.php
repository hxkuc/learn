<?php
namespace common\controller;
/**
* 基本规则类所有前端控制器都要继承此类
* 主要用于前后分离统一的返回格式
*/
class regulation {
	
	//返回数据格式
	protected $result = array(
		"success"=>0,	//操作是否成功
		"info"=>'',		//操作信息
		"data"=>'',		//返回数据
		"islogin"=>0,	//登录是否成功
		"needlogin"=>0,	//是否需要判断登录
	);

	//设置返回数据
	public function assign($k,$v){
		$this->result[$k] = $v;
	}

	//ajax统一返回数据格式
	public function ajaxreturn(){
		header("Access-Control-Allow-Origin:http://localhost:8080");
		header("Access-Control-Allow-Headers:x-requested-with");
		header("Access-Control-Request-Method:GET,POST,PUT,DELETE");
		header("Access-Control-Allow-Credentials:true");
		echo json_encode($this->result);
		exit;
	}	
}

?>