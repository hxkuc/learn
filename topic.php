<?php

//加载数据库文件
require_once('db.php');


//获取数据
$topicid = $_REQUEST['id'];
$articlelist = $db->query("select * from article where topicid = ".$topicid);
$articlelist = $articlelist->fetchAll();

?>

<!DOCTYPE html>

<html>
	<head>
		<title>主题页面</title>
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
			foreach($articlelist as $k=>$v){
				
				echo "<a class='h_a' href='topic.php?id=".$v['id']."' >".$v['topicname']."</a> ";
			}
		?>
	</body>
</html>