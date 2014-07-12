<?php
	class SAECache{
		var $mmc;
		function __construct($table) {
			$this->mmc = memcache_init();
			if(!$this->mmc){
				echo "mc init failed\n";
			}
			
			$prefix = 'c';
			if($_SERVER['HTTP_APPVERSION'] > 0){
				$prefix = "{$prefix}_{$_SERVER['HTTP_APPVERSION']}";
			}
			$this->prefix = $prefix;
		}
		
		function get_cache($key){
		    $show_c = isset($_REQUEST['show_c']) ? $_REQUEST['show_c']:'';
			if($show_c == 'y'){
				echo "mc key:{$this->prefix}_{$key}\n";
			}			
			if($this->mmc){
				return memcache_get($this->mmc, "{$this->prefix}_{$key}");
			}
		}
		
		function set_cache($key, $data, $expire){
		    $show_c = isset($_REQUEST['show_c']) ? $_REQUEST['show_c']:'';
			if($show_c == 'y'){
				echo "mc key:{$this->prefix}_{$key}\n";
			}
			if($this->mmc){
				return memcache_set($this->mmc, "{$this->prefix}_{$key}", $data, 0, $expire);
			}
		}
		
		function add_cache($key, $data, $expire){
			if($this->mmc){
				return memcache_add($this->mmc, "{$this->prefix}_{$key}", $data, 0, $expire);
			}
		}	
	}
?>