<?php
namespace user\controller;

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

	public function edit(){
		$data['headimg'] = $_REQUEST['headimg'];
		$data['uid'] = $_REQUEST['uid'];
		$user = new \user\model\user;
		$res = $user->edit($data);
		if (false !== $res) {
			$this->assign('info','更新成功！');
			$this->assign('success',1);
		}else{
			$this->assign('info','更新失败！');
		}
		$this->ajaxreturn();
	}
}

?>