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
	 
	class Configure {
		 public static $mainConfig = array();
		 public static $is_load = array();
		 public static $routeArray = array();
		
		 /**
		  * 加载函数库，file为函数名
		  *
		  * @param unknown_type $file
		  * @return unknown
		  */
		public static function load($file = 'config'){
			
			if(in_array($file,self::$is_load)){
				return true;
			}
			
//			if(file_exists(DOCROOT."config/$file.php")){
				include_once (DOCROOT."config/$file.php");
//				if(is_array($config)){
					self::$mainConfig[$file] = &$config;
					self::$is_load[] = $file;
//				}else{
//					throw new Exception("configure ==> the config in config/$file.php not an array!");
//				}
//			}else{
//				throw new Exception("configure ==> config/$file.php not exists!");
//			}
		}
		
		/**
		 * 返回某种配置文件的数组,无参数时候返回所有的配置文件
		 *
		 * @param unknown_type $index
		 * @return unknown
		 */
		public static function getItems($index = ''){
			if($index == ''){
				return self::$mainConfig;
			}
			if(isset(self::$mainConfig[$index])){
				return self::$mainConfig[$index];	
			}else{
				self::load($index);
				if(isset(self::$mainConfig[$index])){
					return self::$mainConfig[$index];
				}else{
					throw new Exception("configure ==> config/$index.php not exists!");
				}
			}
			
		}
		/**
		 * 获取某一个项的配置配置参数
		 *
		 * @param 参数项 $item
		 * @param 配置文件名称 $index
		 */
		public static function getItem($item,$index = 'config'){
			if(! in_array($index,self::$is_load)){
				self::load($file);
			}
			return self::$mainConfig[$index][$item];
		}
		/**
		 * 返回已经加载的列表
		 *
		 * @return unknown
		 */
		public static function getIsLoad(){
			return self::$is_load;
		}

		/**
		 * 取得当前已经配置的route数组中的所有前缀
		 *
		 * @return unknown
		 */
		public static function getRouteArray(){
			if(!is_array(self::$mainConfig['route'])){
				return array();
			}
			$uri_segmentation = self::$mainConfig['config']['uri_segmentation'];
			foreach (self::$mainConfig['route'] as $key => $val){
				if(strpos($key,$uri_segmentation)){
					$temp = explode($uri_segmentation,$key);
					self::$routeArray[] = $temp[0];
					unset($temp);
				}else{
					self::$routeArray[] = $key;
				}
			}
			return self::$routeArray;
		}
	}
//	var_dump(Config::getIsLoad());
//	Config::cleanIsLoad();
//	
//	Config::load('config'); 
//	$res = Config::getItems();
//	var_dump($res);
//	var_dump(Config::getIsLoad());
//	echo 'the fist to load config<br/>';
//	
//	Config::load('route');
//	var_dump(Config::getItems());
//	var_dump(Config::getIsLoad());
//	
//	echo 'the first time to load route<br/>';
//	
//	Config::load('config');
//	$res = Config::getItems();
//	var_dump($res);
//	var_dump(Config::getIsLoad());
//	echo 'the second time to load config<br/>';
?>