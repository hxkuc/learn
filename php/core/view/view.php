<?php
	namespace core\view;
	use core\route\route;
	/**
	* 模板输出视图类
	*/
	class VIEW {
		
		protected static $assignarr = array();//定义全局数组

		public static function assign($k,$v){
			self::$assignarr[$k] = $v;
		}

		public static function display($view = ''){
			//没有view取当前默认view
			$action = $view?$view:route::$action;
			$file = ROOT_PATH.APP_PATH.route::$model.'\/view\/'.route::$controller.'\/'.$action.'.html';
			
			if(is_file($file)){
				//打开并清空缓冲区
				ob_start();
        		ob_implicit_flush(0);
        		//解析变量
        		extract(self::$assignarr,EXTR_OVERWRITE);
        		include $file;
        		$html = ob_get_clean();
        		header('Content-Type:text/html; charset=utf-8');
        		echo $html;
			}else{
				echo '找不到模板文件！';
				exit;
			}
		}

	}









?>