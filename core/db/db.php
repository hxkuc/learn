<?php
namespace core\db;

/**
* db类
*黄2017.5.25
*/
class DB {
	
	private static $link = null;
	
	private function __construct(){	
	}

	/*
	*执行sql语句
	*查询所有
	*/
	public static function query($sql){
		self::newdbclass();
		$list = self::$link->query($sql); 
		return $list->fetchAll();
	}

	private static function newdbclass(){
		if(null == self::$link){
			//加载配置文件
			$config = include('config.php');
			//连接mysql
			$db = new \PDO("mysql:host=".$config['host'].";dbname=".$config['dbname'],$config['dbuser'],$config['dbpassword']);
			//设置报错模式
			$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			//设置连接方式utf-8防止乱码
			$db->exec("set names utf8");
			self::$link = $db;
		}
	}




}









?>




