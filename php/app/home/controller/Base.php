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
		header("Access-Control-Allow-Origin:*");
		echo json_encode($data);
		exit;
	}
}




?>