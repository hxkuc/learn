<?php

//引用自动加载文件
require_once('core/autoload/autoload.php');

use core\db\db;

//取出数据
$topiclist = DB::query("select * from topic");
$topiclist1 = DB::query("select * from topic");
$topiclist2 = DB::query("select * from topic");
$topiclist3 = DB::query("select * from topic");
$topiclist4 = DB::query("select * from topic");

/**
* 
*/
class Ds{
	
}

$a = new Ds();
$b = new Ds();

var_dump($a === $b);




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









