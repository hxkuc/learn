<?php
namespace home\controller;
use core\db\DB;
use core\view\VIEW;
/**
* huang
*/
class Index extends Base {
	
	public function index(){
		$topiclist = DB::query("select * from topic");
		VIEW::assign('topiclist',$topiclist);
		VIEW::display();
	}

	public function gettopiclist(){
		$topiclist = DB::query("select * from topic");
		$this->ajaxreturn($topiclist);
	}
}




?>