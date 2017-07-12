<?php
namespace admin\controller;

/**
* 用户类
*/
class user extends base {
	
	//获取主题下的文章
	public function getarticlelist(){
		$filter = $_REQUEST;
		//获取当前主题的信息
		$topic = new \home\model\topic;
		$topicinfo = $topic->info($filter['id']);
		$article = new \home\model\article;
		$articlelist = $article->getlist($filter);
		$data = array(
			"topicinfo"=>$topicinfo,
			"articlelist"=>$articlelist,
		);
		$this->ajaxreturn($data);
	}
}

?>