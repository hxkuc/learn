<?php
namespace home\controller;

/**
* 主题类
*/
class topic extends base {
	
	//获取主题下的文章
	public function getarticlelist(){
		$filter = $_REQUEST;
		$filter['status'] = 1;//只取已审核的链接
		//获取当前主题的信息
		$topic = new \home\model\topic;
		$topicinfo = $topic->info($filter['id']);
		$article = new \home\model\article;
		$articlelist = $article->getlist($filter);
		$data = array(
			"topicinfo"=>$topicinfo,
			"articlelist"=>$articlelist,
		);
		$this->assign('data',$data);
		$this->ajaxreturn();
	}

}

?>