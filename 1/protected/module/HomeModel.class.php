<?php 	
require_once DOCROOT . "common/cache.class.php";
    class HomeModel extends Module {	
		var $client;   //客户端信息.	
		var $kv;
		var $db;
		
		public function __construct(){
			parent::__construct();
            $this->load_class('Db'); 
            $this->db = new Db(); 
						
			$this->cache = new SimpleCache('sae', '', 'emop_');
			
		}
		
		public function select_all_product($params){
		
		    $table = "shop_product_info";
		
		    if ($params['limit']){
		        $limit = "limit {$params['limit']}";
		    }
		
		
		    $sql = <<<END
select * from $table
where verify_status = 1
order by update_time desc
$limit
END;
		    $data = $this->db->getData($sql);
		    return $data;
		
		}
		
		
		public function select_travel_product($new=false){
		    $travel = $this->db->getData("select * from travel_product_category");
		    
		    if (!$new){
		        return $travel;
		    }else{
		        
		        $new_travle = array();
		        foreach ($travel as $i=>$new){
		            $new_travle[$new['id']] = $new['name'];
		        }
		        
		        return $new_travle;
		        
		    }
		      
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
    }