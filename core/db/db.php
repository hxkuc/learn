<?php
namespace core\db;

/**
* db类
*黄2017.5.25
*/
class DB {
	
	protected $link = null;

	function __construct($host,$dbname,$username,$password){
		//连接mysql
		$db = new \PDO("mysql:host=".$host.";dbname=".$dbname,$username,$password);
		//设置报错模式
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		//设置连接方式utf-8防止乱码
		$db->exec("set names utf8");
		$this->link = $db;
	}

	/*
	*查询数据
	*查询所有
	*/
	public function query($sql){
		$list = $this->link->query($sql); 
		return $list->fetchAll();
	}




}









?>




