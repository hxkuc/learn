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
	// 编辑头像
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

	// 获取用户的主题列表
	public function topiclist(){
		$uid = $_REQUEST['uid'];
		$topic = new \home\model\topic;
		$list = $topic->getusertopiclist($uid);
		$this->assign('data',$list);
		$this->ajaxreturn();
	}
    // 新增主题
	public function addtopic(){
		$data = $_REQUEST;
		$data['uid'] = $_SESSION['userinfo']['id'];
		$topic = new \home\model\topic;
		$res = $topic->add($data);
		if(false !== $res){
			$this->assign('success',1);
			$this->assign('info','操作成功！');
		}else{
			$this->assign('info','操作失败！');
		}
		$this->ajaxreturn();
	}
	// 删除主题及主题下所有链接
	public function deletetopic(){
		$id = $_REQUEST['id'];
		$topic = new \home\model\topic;
		$res = $topic->delete($id);
		if($res){
			$this->assign('success',1);
			$this->assign('info','删除成功！');
		}else{
			$this->assign('info','删除失败！');
		}
		$this->ajaxreturn();
	}
}

?>