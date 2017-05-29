<?php

//引用自动加载文件
require_once('core/autoload/autoload.php');

use core\db\db;
use core\route\route;

//定义应用目录路径
define('APP_PATH','./app/');

//加载路由类
route::run();


//取出数据
$topiclist = DB::query("select * from topic");

?>



<!DOCTYPE html>

<html>
	<head>
		<title>分类首页</title>
		<meta charset="utf-8">

		<style>
			.h_a{
				color:#02b690;
				text-decoration: none;
			}
		</style>

	</head>
	<body>
		<?php
			foreach($topiclist as $k=>$v){
				
				echo "<a class='h_a' href='topic.php?id=".$v['id']."' >".$v['topicname']."</a> ";
			}
		?>
	</body>
</html>









