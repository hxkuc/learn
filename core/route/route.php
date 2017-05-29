<?php

namespace core\route;

/**
* 路由类
*/
class route{
	protected static $model;
	protected static $controller;
	protected static $action;

	public static function run(){
		if(isset($_REQUEST['s'])){
			$s = explode('/',substr($_REQUEST['s'],1));
			self::$model = $s[0];
			self::$controller = $s[1];
			self::$action = $s[2];
		}else{
			self::$model = 'home';
			self::$controller = 'index';
			self::$action = 'index';
		}
		//默认传过来的是controller
		$namespace = self::$model.'\\controller\\'.self::$controller;
		$class = new $namespace;
		$reflectionclass = new \ReflectionMethod($class,self::$action);
		$reflectionclass->invoke($class);
	}
}









?>