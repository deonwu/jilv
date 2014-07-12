<?php  defined('YUNPHP') or exit('can not access!');

	/**
	 * YunPHP4SAE php framework designed for SAE
	 *
	 * @author heyue <heyue@foxmail.com>
	 * @copyright Copyright(C)2010, heyue
	 * @link http://code.google.com/p/yunphp4sae/
	 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
	 * @version YunPHP4SAE version 1.0.2
	 */
	 
	class YunPHP{
		private static $_instance = array();
		const VERSION = '1.0.0';
		static $herlpers = array();
		static $libs = array();
		/**
		 * 构造函数
		 */
		public function __construct(){	
			self::$_instance = &$this;
				
		}
		/**
		 * 加载类库，也就是加载系统lib目录中的东西，但是没有new
		 *
		 * @param unknown_type $class
		 * @return unknown
		 */
		public function load_class($class){
			if(in_array($class,self::$libs)){
				return true;
			}
			if(file_exists(YUNPHP.'lib/'.$class.'.class.php')){
				require_once(YUNPHP.'lib/'.$class.'.class.php');
				return true;
			}else{
				throw  new Exception("Libs error ==> $class.class.php not eixst!");
			}
		}

		
		/**
		 * 加载项目的helper类库
		 *
		 * @param unknown_type $helper
		 */
		public function load_helper($helper){
			if(in_array($helper,self::$herlpers)){
				return true;
			}
			if(file_exists(DOCROOT.'helper/'.$helper.'.class.php')){
				require_once(DOCROOT.'helper/'.$helper.'.class.php');
				self::$herlpers[] = $helper;
				return true;
			}else if(file_exists(DOCROOT.'helper/'.$helper.'.php')){
				require_once (DOCROOT.'helper/'.$helper.'.class.php');
				self::$helpers[] = $helper;
				return true;
			}else{
				throw new Exception("Helper load Error ==> $helper.class.php or $helper.php not found!");
			}
		}
		
		public static function getVersion(){
			return self::VERSION;
		}
		/*
		 * 析构函数
		 */
		public function __destruct(){
			
		}
	}
?>