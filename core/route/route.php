<?php

namespace core\route;

/**
* 路由类
*/
class route{
	public static $model;
	public static $controller;
	public static $action;

	public static function run(){
		if(isset($_GET['s'])){
			$s = explode('/',substr($_GET['s'],1));
			self::$model = array_shift($s);
			self::$controller = array_shift($s);
			self::$action = array_shift($s);
			//重新定义GET和REQUEST
			$_GET = array();
			preg_replace_callback('/(\w+)\/([^\/]+)/', function($match) use(&$_GET){
				$_GET[$match[1]]=strip_tags($match[2]);
			}, implode('/',$s));
			unset($_REQUEST['s']);
			$_REQUEST = array_merge($_REQUEST,$_GET);
		}else{
			self::$model = 'home';
			self::$controller = 'index';
			self::$action = 'index';
		}


		//默认传过来的是controller
		$namespace = self::$model.'\\controller\\'.self::$controller;
		if(class_exists($namespace)){
			$class = new $namespace;
			$reflectionclass = new \ReflectionMethod($class,self::$action);
			$reflectionclass->invoke($class);
		}else{
			header('content-type:text/html;charset=utf-8');
			echo 'url地址错误！';
		}
	}
}









?>