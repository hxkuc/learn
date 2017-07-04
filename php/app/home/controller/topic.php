<?php

namespace home\controller;

/**
* 主题类
*/
class topic extends Base {
	
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

	//删除主题下的文章
	public function deletearticle(){
		$id = $_REQUEST['id'];
		$return = array("success"=>0,"info"=>'');
		$article = new \home\model\article;
		$res = $article->delete($id);
		if($res){
			$return['success'] = 1;
			$return['info'] = '删除成功！';
		}else{
			$return['info'] = '删除失败！';
		}
		$this->ajaxreturn($return);
	}
}

?>