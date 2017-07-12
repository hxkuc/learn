<?php
namespace home\controller;
use core\db\DB;
use core\view\VIEW;
/**
* huang
*/
class Index extends base {
	
	public function index(){
		$topiclist = DB::query("select * from topic");
		VIEW::assign('topiclist',$topiclist);
		VIEW::display();
	}

	public function gettopiclist(){
		$topic = new \home\model\topic;
		$list = $topic->getlist();
		$this->assign('success',1);
		$this->assign('data',$list);
		$this->ajaxreturn();
	}
}




?>