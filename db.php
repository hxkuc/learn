<?php

/*
@作者:黄
@作用：数据库基础类
*/

//连接mysql
$db = new PDO("mysql:host=localhost;dbname=learn","root","11111111");
//设置报错模式
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//设置连接方式utf-8防止乱码
$db->exec("set names utf8");


?>