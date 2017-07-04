<?php
namespace core\db;
use core\db\dbinterface;

/**
* db类
*黄2017.5.25
*/
class DB implements dbinterface {
	
	private static $link = null;
	
	private function __construct(){	
	}

	/*
	*执行select语句
	*返回所有行
	*/
	public static function query($sql){
		self::initlink();
		$list = self::$link->query($sql);
		$list->setFetchMode(\PDO::FETCH_ASSOC);//只取关联索引
		return $list->fetchAll();
	}

	/*
	*执行delete,update,insert语句
	*返回改变行数
	*/
	public static function exec($sql){
		self::initlink();
		return self::$link->exec($sql);
	}

	/*
	*初始化连接
	*/
	private static function initlink(){
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




