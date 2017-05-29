<?php
namespace home\controller;
use core\db\db;
/**
* huang
*/
class Index {
	
	public function index(){
		
		$topiclist = DB::query("select * from topic");
		
		var_dump($topiclist);	
	}
}




?>