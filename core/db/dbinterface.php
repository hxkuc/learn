<?php
namespace core\db;

interface dbinterface{
	public static function query($sql);
	public static function exec($sql);
}

?>