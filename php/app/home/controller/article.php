<?php
namespace home\controller;

/**
* 主题类
*/
class article extends base {
	
	public function addarticle(){
		$data = $_POST;
		$article = new \home\model\article;
		$res = $article->add($data);
		if($res){
			$this->assign('success',1);
			$this->assign('info','添加成功！');
		}else{
			$this->assign('info','添加失败！');
		}
		$this->ajaxreturn();
	}

	//删除主题下的文章
	public function deletearticle(){
		$id = $_REQUEST['id'];
		$article = new \home\model\article;
		$res = $article->delete($id);
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