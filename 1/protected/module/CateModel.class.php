<?php 	
require_once DOCROOT . "common/cache.class.php";

class CateModel extends Module {	
		var $client;   //客户端信息.	
		var $kv;
		var $db;
		
	public function __construct(){
		parent::__construct();
        $this->load_class('Db'); 
        $this->db = new Db(); 
						
		$this->cache = new SimpleCache('sae', '', 'emop_');
			
	}
		
	
	public function get_cate_list(){
		
		$cates = $this->db->getData("select * from app_cate_filter where status=0 order by cate_type, view_order asc");
		
		$cat_groups = array();
		
		foreach($cates as $c){
			$cat_groups[$c['cate_type']][] = $c;
		}
		
		return $cat_groups;
		
	}
	
	
		
}