<?php
	/*
	*黄总实现类的自动加载
	*/
	spl_autoload_register(function($classname){
		require_once $classname.'.php';
	});
?>