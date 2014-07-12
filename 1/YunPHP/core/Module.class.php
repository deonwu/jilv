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
	class Module extends YunPHP {
		public function __construnct(){
			parent::__construct();
		}
	//目前没有想清楚这里写什么函数
	
		public function __destruct(){
			parent::__destruct();
		}
		
		public function model($model){
			$model = ucfirst($model);
			if(file_exists(DOCROOT.'module/'.$model.'Model.class.php')){
				require_once DOCROOT.'module/'.$model.'Model.class.php';
			}else{
				throw new Exception("Action ==> $model model not exists");
			}
		}		
	}
?>