<?php

/*
*网站入口
*/

// 配置报错信息
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);

//定义应用目录路径
define("__DIR__",dirname(__FILE__));
define('APP_PATH','./app/');//路径可移出到别的文件夹
define('ROOT_PATH',__DIR__.'/');

require_once('core/index.php');//路径可移出到别的文件夹
?>