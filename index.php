<?php

//加载数据库文件
require_once('db.php');

//取出数据
$topiclist = $db->query("select * from topic"); 

$topiclist = $topiclist->fetchAll();

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









