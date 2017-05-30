<?php

namespace home\controller;
use core\db\db;
use core\view\view;

/**
* 主题类
*/
class topic {
	
	public function index(){
		$topicid = $_REQUEST['id'];
		$articlelist = DB::query("select * from article where topicid = ".$topicid);
		VIEW::assign('articlelist',$articlelist);
		VIEW::display();
	}
}








?>