<?php
namespace home\controller;
use core\db\DB;
use core\view\VIEW;
/**
* huang
*/
class index extends base
{
	
	/*public function index(){
		$topiclist = DB::query("select * from topic");
		VIEW::assign('topiclist',$topiclist);
		VIEW::display();
	}*/

	public function gettopiclist()
	{
		$topic = new \home\model\topic;
		$list = $topic->getlist();
		$this->assign('success',1);
		$this->assign('data',$list);
		$this->ajaxreturn();
	}

	// 获取首页用户信息
	public function getindexuser()
	{
		$uid = $_REQUEST['uid'];
		$user = new \user\model\user;
		$userinfo = $user->getuserinfo($uid);

		$topic = new \home\model\topic;
		$topiclist = $topic->getlist($uid);
		$data = array("userinfo"=>$userinfo,"topiclist"=>$topiclist);
		$this->assign('data',$data);
		$this->assign('success',1);
		$this->ajaxreturn();
	}

	// 获取广场用户列表
	public function getuserlist()
	{
		$user = new \user\model\user;
		$list = $user->userlist();
		$this->assign('data', $list);
		$this->assign('success',1);
		$this->ajaxreturn();
	}

	// 获取最新的连接
	public function getNewArticle()
	{
		$article = new \home\model\article;
		$filter['status'] = 1;
		$filter['currentpage'] = 1;
		$filter['pagesize'] = 10;
		$list = $article->getNewArticle($filter);
		$this->assign('data', $list);
		$this->assign('success',1);
		$this->ajaxreturn();
	}
}

