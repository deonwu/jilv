<?php 	
require_once DOCROOT . "common/cache.class.php";

class ProductModel extends Module {	
		var $client;   //客户端信息.	
		var $kv;
		var $db;
		
	public function __construct(){
		parent::__construct();
        $this->load_class('Db'); 
        $this->db = new Db(); 
						
		$this->cache = new SimpleCache('sae', '', 'emop_');
			
	}
		
	
	public function get_product($pid){
		
		$p = $this->db->getLine("select * from shop_product_info where `id`='{$pid}'");
		
		$u = array('m'=>'分钟', "d"=>'天');
		
		//duration_label
		
		
		if($p['shop_id'] > 0){
			$shop = $this->db->getLine("select * from shop_business_enter_info where shop_id='{$p['shop_id']}'");
			
			$price_items = $this->db->getData("select * from shop_product_price_item where pid='{$pid}'");
			
			foreach($price_items as &$i){
				$l = $u[$i['duration_unit']] ? $u[$i['duration_unit']] : "分钟";
				
				$i['duration_label'] = "{$i['duration']} {$l}";
				
			}
			
			$p['shop'] = $shop;
			$p['price_items'] = $price_items;
			
			$p['imgs'] = explode(";", $p['pic_list']);
		}
		
		return $p;
	}
		
	
	public  function get_product_price_item($iid){
		$p = $this->db->getLine("select * from shop_product_price_item where `id`='{$iid}'");
		
		return $p;
		
	}
	
	public function search_products(){
		$sql = <<<SQL
select p.*, s.shop_name, v.*
from shop_product_info p
join shop_business_enter_info s using(shop_id)
left join shop_product_view_info v on (p.id=v.pid)
				
SQL;
		
		$p = $this->db->getData($sql);
		
		if(DEBUG){
			echo "count:" . count($p);
		}
		
		$p = $this->convert_prodcuts_for_view(&$p);
		
		if(DEBUG){
			echo "count 2:" . count($p);
		}
		
		return $p;
	}
	
	public function convert_prodcuts_for_view($items){
		
		foreach($items as &$i){
			$i['imgs'] = explode(";", $i['pic_list']);
			$i['short_description'] = mb_substr($i['description'], 0, 80);
		}
		
		return $items;
	}
	
	
		
}