<?php

//引用自动加载文件
require_once('core/autoload/autoload.php');

use core\db\db;

$db = new DB('127.0.0.1','learn','root','11111111');

//取出数据
$topiclist = $db->query("select * from topic");
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









