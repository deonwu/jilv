<?php	defined('YUNPHP') or exit('can not access!');
	/**
	 * YunPHP4SAE php framework designed for SAE
	 *
	 * @author heyue <heyue@foxmail.com>
	 * @copyright Copyright(C)2010, heyue
	 * @link http://code.google.com/p/yunphp4sae/
	 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
	 * @version YunPHP4SAE version 1.0.2
	 */
	class Router  {
		private $default_action = 'index';
		private $default_method = 'index';
		private $uri_segmentation = '/';
		private $uri_suffix = '';
		private $uri_argvs = array();
		private $uri = '';
		private $class = '';
		private $method = '';
		private $route = '';
		private $route_array = array();//route中的action的数组
		
		public function __construct($uri){
			$this->uri_segmentation = Configure::getItem('uri_segmentation');
			$this->default_action = Configure::getItem('default_action');
			$this->default_method = Configure::getItem('default_method');
			Configure::load('route');
			$this->route = Configure::getItems('route');
			$this->route_array = Configure::getRouteArray();
			$this->uri = $uri;
			$this->_parseUrl();
		
		}	
		
		private function _parseUrl(){
			//处理一下uri前后的 '/'
			if((substr($this->uri,-1) == '/')){
				if($this->uri != '/'){
					$this->uri = substr($this->uri,1,-1);
				}
			}else{
				$this->uri = substr($this->uri,1);
			}
			
			if($this->uri == '/'){
					//为根目录的时候
					$this->uri_argvs[0] = $this->class = $this->default_action;
					$this->uri_argvs[1] = $this->method = $this->default_method;
			}else{
				$temp = explode($this->uri_segmentation,$this->uri);
				if(empty($this->route) or !in_array($temp[0],$this->route_array)){
					//如果没有设置route，将会是/class/method/argvs/的顺序
					$temp_uri = explode($this->uri_segmentation,$this->uri);
					if(count($temp_uri)== 1){
						//如果只有action的时候
						$this->uri_argvs[0] = $this->class = $temp_uri[0];
						$this->uri_argvs[1] = $this->method = $this->default_method;
					}else{
						$this->uri_argvs = & $temp_uri;
						$this->class = $temp_uri[0];
						$this->method = $temp_uri[1];
					}
				}else{
					//如果设置了路由，这里进行路由的匹配
					foreach ($this->route as $key => $val) {
						$key = str_replace(':any','.+',$key);
						$key = str_replace(':num','[0-9]+',$key);
						
						if(preg_match('#^'.$key.'$#',$this->uri)){
							$val = preg_replace('#^'.$key.'$#',$val,$this->uri);
							$temp_uri = explode($this->uri_segmentation,$val);
							echo "'{$key}' -->aaa'{$val}'";
							$this->uri_argvs = & $temp_uri;
							$this->class = $temp_uri[0];
							$this->method = $temp_uri[1];
							//var_dump($this->uri_argvs);
							return true;					
						}
					}
					Log::write_log('ERROR',"$this->route is not in the route.php ");					
				}
			}
		}
		
		/**
		 * 返回从url中取出的数据,uri_argvs['class'] uri_argvs['method'] uri_argvs['argvs']
		 *
		 * @return unknown
		 */
		public function getUriArgvs(){
			return $this->uri_argvs;
		}
		
		/**
		 * 返回操作的Class
		 *
		 * @return unknown
		 */
		public function getClass(){
			return $this->class;
		}
		
		/**
		 * 返回操作的method
		 *
		 * @return unknown
		 */
		public function getMethod(){
			return $this->method;
		}
	}
?>