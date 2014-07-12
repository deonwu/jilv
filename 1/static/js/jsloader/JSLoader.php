<?php

class JSLoader{
	private $root;
	private $common;
	private $groups;
	private $root_app;
	
	public function __construct($root, $common, $groups) {
		$this->root = $root;
		$this->common = $common;
		$this->groups = $groups;
	}	
	
	public function clean_cache(){
		header("Content-Type: text/plain; charset=utf8");
		$mmc = memcache_init();
		foreach($this->groups as $k => $v){
			$ck = "js_loader_{$k}";
			memcache_delete($mmc, $ck, 0);
			echo "clean up '$k'\n";
		}
	}
	
	public function load(){
		header("Content-Type: text/javascript; charset=utf8");
		$ver = 'dev'; //$_GET['ver'];
		$group_name = $_GET['group'];
		$group_name = $group_name ? $group_name : "index";
		
		if($_REQUEST['debug'] != 'true'){
			ob_clean();
		}
		if($ver == 'dev'){
			header("Cache-Control: no-cache, no-store, max-age=0, must-revalidate");
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			echo $this->load_packed_content($group_name);
			echo $this->load_unpack_content($group_name, false);
		}else {
			header("Cache-Control: must-revalidate; max-age: 3600");
			header("Expires: " . gmdate ("D, d M Y H:i:s", time() + 3600) . " GMT");
			
			echo $this->load_cached_content($group_name);
		}
	}

	public function load_cached_content($group_name){
		$mmc = memcache_init();
		
		$ck = "js_loader_{$group_name}";
		if($mmc){
			$data = memcache_get($mmc, $ck);
		}
		if(empty($data) || $_REQUEST['no_cache'] == 'y'){
			$data = $this->load_packed_content($group_name);
			$data .= ";\n" . $this->load_unpack_content($group_name, true);
			$cache_data = $data . ";\n// cached in" . date("Y-m-d H:i:s");
			
			if($mmc){
				memcache_set($mmc, $ck, $cache_data, MEMCACHE_COMPRESSED, 3600);
			}
		}
		
		return $data;
	}

	
	public function load_unpack_content($group_name, $is_pack){
		$common_list = $this->common[1];
		$common_list2 = $this->groups[$group_name][1];
		if(is_array($common_list2)){
			$common = array_merge($common_list, $common_list2);
		}else {
			$common = $common_list;
		}
		
		
		$zip_level = $_REQUEST['zl'];
		$zip_level = $zip_level ? $zip_level : 'None';
		$data = $this->load_file_list($common);
		if($is_pack){
			include "JavaScriptPacker.php";			
			$packer = new JavaScriptPacker($data, $zip_level);
			$data = $packer->pack();
			
			$br = $_REQUEST['br'];
			if($br){
				$data = str_replace("{$br}", "{$br}\n", $data);
			}
		}
		return $data;
	}
	
	public function load_packed_content($group_name){
		$common_list = $this->common[0];
		$common_list2 = $this->groups[$group_name][0];
		if(is_array($common_list2)){
			$common = array_merge($common_list, $common_list2);
		}else {
			$common = $common_list;
		}
		
		$data = $this->load_file_list($common);	
		
		return $data;
	}

	private function load_file_list($files){
		$data = "";
		
		foreach($files as $f){
			
			$file = "{$this->root}/{$f}";
			
			if(!is_file($file)){
				
				$file = $this->load_file_app($f);
			}
			

			if(!is_file($file)){
					
				$data .= "// not found '{$f}'\n";
					
				continue;
			}
			
			$data .= ";\n" . file_get_contents($file);
		}
		
		return $data;
	}
	
	private function load_file_app($file){
		
		preg_match("/apps\.(?<dir>.*)\.(?<name>.*\.js)$/", $file, $matches);
		
		$file_dir = str_replace('.', '/', $matches['dir']);
		$file_name = $matches['name'];
		
		$path = <<<PATH
{$this->root_app}/{$file_dir}/static/js/{$file_name}
PATH;

		return $path;
		
	}
	
	public function set_app_root_path($path){
		
		$this->root_app = $path;
	}
	
	private function load_file_list_bak($files){
		$data = "";
		foreach($files as $f){
			$file = "{$this->root}/{$f}";
			if(!is_file($file)){
				$data .= "// not found '{$f}'\n";
				continue;
			}
			$data .= ";\n" . file_get_contents($file);
		}
		
		return $data;
	}
}
?>