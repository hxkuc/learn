<?php
	/*
	*黄总实现类的自动加载
	*/
	spl_autoload_register(function($classname){
		$file = str_replace('\\', '/', $classname).'.php';
		if(is_file(APP_PATH.$file)){
			require_once APP_PATH.$file;
		}elseif (is_file($file)) {
			require_once $file;
		}
	});
?>