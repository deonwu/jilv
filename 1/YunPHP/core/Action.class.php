<?php defined('YUNPHP') or exit('can not access!');
	/**
	 * YunPHP4SAE php framework designed for SAE
	 *
	 * @author heyue <heyue@foxmail.com>
	 * @copyright Copyright(C)2010, heyue
	 * @link http://code.google.com/p/yunphp4sae/
	 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
	 * @version YunPHP4SAE version 1.0.2
	 */
	#global $view_vars;
	
	class Action extends YunPHP{
		private static $_instance;
		public  $view_vars = array();
		public $platform = "";
		public $style = "";		
		
		public function __construct(){
			parent::__construct();
		}
 		/**
 		 * 赋值变量到模板
 		 *
 		 * @param unknown_type $key
 		 * @param unknown_type $val
 		 */
		public function assign($key,$val){
			$this->view_vars[$key] = $val;
		}
		/**
		 * 页面显示
		 *
		 * @param unknown_type $path
		 */
		public function display($path, $shop_id = 0){
			if(!DEBUG){
				ob_clean();
			}
            header("Content-type: text/html; charset=utf-8");
			$this->view_vars['platform'] = $this->platform;
			$this->view_vars['style'] = $this->style;
			
			global $view_vars;			
			$view_vars = $this->view_vars;
			
			extract($this->view_vars);
			
			$view_file = array(
				WEBROOT."/sites/{$this->platform}/view/{$this->style}/".$path,
				WEBROOT."/sites/{$this->platform}/view/".$path,
						
				DOCROOT."view/{$this->platform}/{$this->style}/".$path,		
				DOCROOT."view/{$this->platform}/".$path,
				DOCROOT."view/".$path,
				$path
			);
			if($shop_id > 0){
				array_unshift($view_file, DOCROOT."view/shop/{$shop_id}/".$path);
				define("SHOP_ID", $shop_id);
			}
			
			$found = false;
			foreach($view_file as $v){
				if (is_file ( $v )){
					$found = true;
					include $v;
					break;
				}
			}
			if(!$found){
				include DOCROOT."view/".$path;
			}
		}
		
		public function json($data){
			if(!DEBUG){
				ob_clean();
			}
			echo json_encode($data);		
		}        
		/**
		 * 加载model
		 *
		 * @param unknown_type $model
		 */
		public function model($model){
			$model = ucfirst($model);
			if(file_exists(DOCROOT.'module/'.$model.'Model.class.php')){
				require_once DOCROOT.'module/'.$model.'Model.class.php';
			}else{
				throw new Exception("Action ==> $model model not exists");
			}
		}
		
		/**
		 * 加载model
		 *
		 * @param unknown_type $model
		 */
		public function action($model){
			$model = ucfirst($model);
			if(file_exists(DOCROOT.'action/'.$model.'Action.class.php')){
				require_once DOCROOT.'action/'.$model.'Action.class.php';
			}else{
				throw new Exception("Action ==> $model model not exists");
			}
		}
		
		/**
		 * 获取当前实例
		 *
		 * @return unknown
		 */
		public function getInstance(){
			if(self::$_instance == NULL){
				self::$_instance = new Action();
			}
			return self::$_instance;
		}
		/**
		 * 默认的__call函数的调用，如果上层没有重写，这里将默认出现一个404的错误提示
		 */
		public function __call($name,$arguments){
			throw new Exception("404 $name function not exist!");
		}
			
	}
?>