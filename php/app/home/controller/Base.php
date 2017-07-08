<?php
namespace home\controller;
use core\view\VIEW;
/**
* 黄总制作基础类
*/
class Base {
	
	//要构造函数有何用
	public function __construct(){

	}
	//ajax统一返回数据格式
	public function ajaxreturn($data){
		header("Access-Control-Allow-Origin:http://localhost:8080");
		header("Access-Control-Allow-Headers:x-requested-with");
		header("Access-Control-Request-Method:GET,POST,PUT,DELETE");
		header("Access-Control-Allow-Credentials:true");
		echo json_encode($data);
		exit;
	}
}




?>