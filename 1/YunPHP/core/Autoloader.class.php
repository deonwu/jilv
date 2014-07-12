<?php defined('YUNPHP') or exit('can not access!');

	class Autoloader{
		public $cache = array();
		
		public function __construct(){
		}

		public function loadClass($name){
		    $file = '';
			if($this->str_ends($name, 'Model')){
				$file = DOCROOT.'module/'. $name. '.class.php';
			}else if($this->str_ends($name, 'Trigger')){
				$file = DOCROOT.'trigger/'. $name. '.class.php';
			}else if($this->str_ends($name, 'Builder')){
				$file = DOCROOT.'builder/'. $name. '.class.php';
			}else if($this->str_ends($name, 'Hook')){
				$file = DOCROOT.'hooks/'. $name. '.class.php';
			}else if($this->str_ends($name, 'Helper')){
				$file = DOCROOT.'helper/'. $name. '.class.php';
			}
			
			if(DEBUG){
				echo "include:{$file}\n";
			}
			if(file_exists($file)){
				require_once $file;
			}
		}
		
		private function str_ends($str, $e){
			$slen = strlen($str) - strlen($e);
			if($slen > 0){
				return substr($str, $slen) == $e;
			}
			return false;
		}
		
		public function init(){
			spl_autoload_register(array($this, "loadClass"));
		}
		
	}

?>