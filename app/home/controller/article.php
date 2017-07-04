<?php

namespace home\controller;

/**
* 主题类
*/
class article extends Base {
	
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

	public function addarticle(){
		$data = $_POST;
		$return = array(
			"success"=>0,
			"info"=>'',
		);
		$article = new \home\model\article;
		$res = $article->add($data);
		if($res){
			$return['success'] = 1;
			$return['info'] = '添加成功！';
		}else{
			$return['info'] = '添加失败！';
		}
		$this->ajaxreturn($return);
	}
}

?>