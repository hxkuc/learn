<?php
//引用自动加载文件
require_once('autoload/autoload.php');
//加载路由类
use core\route\route;

//开启session
session_start();
//路由解析
route::run();
?>