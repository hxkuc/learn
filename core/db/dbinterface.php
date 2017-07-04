<?php
namespace core\db;

interface dbinterface{
	public static function query($sql);//查
	public static function exec($sql);//增删改
}

?>