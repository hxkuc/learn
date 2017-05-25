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

	<div style="width:20%;float:left">
		<h1>下级分类</h1>
		<div>
			<ul>
				<li>12</li>
				<li>12</li>
				<li>23</li>
				<li>552</li>
			</ul>
		</div>
	</div>
	<div style="width:80%;float:left">1212</div>
		<?php
			foreach($articlelist as $k=>$v){
				echo "<a class='h_a' target='_blank' href='".$v['articleurl']."' >".$v['articlename']."</a> ";
			}
		?>
	</body>
</html>