<?php
//引用自动加载文件
require_once('core/autoload/autoload.php');
//加载路由类
use core\route\route;

//定义应用目录路径
define('APP_PATH','./app/');
define('ROOT_PATH',__DIR__.'/');
//开启session
session_start();
//路由解析
route::run();

?>