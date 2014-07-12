<?php 	
require_once DOCROOT . "common/cache.class.php";
    class ShopModel extends Module {	
		var $client;   //客户端信息.	
		var $kv;
		var $db;
		
		public function __construct(){
			parent::__construct();
            $this->load_class('Db'); 
            $this->db = new Db(); 
						
			$this->cache = new SimpleCache('sae', '', 'emop_');
			
		}
		
		
		
		
		
		/**
		 * 分类
		 * 
		 * 大类  product_travel_type
		 * 中类  product_travel_topic
		 * 小类 product_travel_category
		 */
		public function product_travel_type(){
		    
		   $type = $this->db->selectData('travel_type');
		   
		   return $type;
		   
		}
		
		public function product_travel_topic(){
		    
		    $table = "travel_topic";
		    
		    if ($_REQUEST['type_id']){
		        $condition = "type_id = {$_REQUEST['type_id']}";
		    }
		    
		    
		    $data = $this->db->selectData($table,$condition);
		    return $data;
		       
		}
		
		
		public function product_travel_category(){
		
		    $table = "travel_topic_category";
		
		    if ($_REQUEST['topic_id']){
		        $condition = "topic_id = {$_REQUEST['topic_id']}";
		    }
		
		
		    $data = $this->db->selectData($table,$condition);
		    return $data;
		     
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function product_base_save(){
		    $fields = array(
		            'id','shop_id','name','description',
		            'type_select','topic_select','detail_select',
		            'continent','country','city','address',
		            'arrive_way','tips',
		            'language','pic_list');
		    
		    $data = array();
		    foreach ($fields as $f){
		        if ($_REQUEST[$f]){
		            $data[$f] = addslashes(trim($_REQUEST[$f]));
		        }
		    }
		    
		    $data['create_time'] = time();
		    $data['update_time'] = time();
		    $data['verify_status'] = 0;
		    
		    $r = $this->db->insertOrUpdate("shop_product_info",$data);
		    
		    if (DEBUG){
		        var_dump($r);
		    }
		    
		    if($this->db->errno()!=0){
		        return array('status'=>'err','msg'=>$this->db->errmsg());
		    }
		    
		    if ($_REQUEST['id']){
		        $id = $_REQUEST['id'];
		    }else{
		        $id = $this->db->lastId();
		    }
		    
		    return array('status'=>'ok','pid'=>$id);
		    
		    
		    
		}
		
		public function product_price_save(){
		    $fields = array('id','shop_id','pid','price_name','base_price',
		                'adult_descrip','child_descrip',
		                'start_date','end_date',
		                'start_time','duration','duration_unit','advance_day',
		                'time_range','suit_group',
		                'people_limit','pickup',
		                'lightspot','fee_descrip','refund_rule');
		    $data = array();
		    
		    foreach ($fields as $f){
		        if ($_REQUEST[$f]){
		            $data[$f] = addslashes(trim($_REQUEST[$f]));
		        }
		    }
		    
		    $data['create_time'] = time();
		    $data['update_time'] = time();
		    
		    $r = $this->db->insertOrUpdate("shop_product_price_item",$data);
		    
		    if (DEBUG){
		        var_dump($r);
		    }
		    
		    if($this->db->errno()!=0){
		        return array('status'=>'err','msg'=>$this->db->errmsg());
		    }
		    
		    if ($_REQUEST['id']){
		        $id = $_REQUEST['id'];
		    }else{
		        $id = $this->db->lastId();
		    }
		    
		    
		    return array('status'=>'ok','pid'=>$_REQUEST['pid'],'item_id'=>$id);
		    
		}
		
		public function product_price_list($pid){
		    $condition = "pid = $pid";
		    
		    $data = $this->db->selectData("shop_product_price_item",$condition);
		    
		    return $data;
		    
		}
		
		public function product_price_one($id){
		    $condition = "id = $id";
		    
		    $data = $this->db->selectData("shop_product_price_item",$condition);
		    
		    return $data[0];
		}
		
		
		public function product_one($id){
		    
		    $condition = "id = $id";
		    
		    $data = $this->db->selectData("shop_product_info",$condition);
		    
		    return $data[0];
		    
		}
		
		
		public function product_list($sid, $status=1){
			if($status == 1){
		    	$condition = "shop_id = $sid and verify_status={$status}";
			}else {
				$condition = "shop_id = $sid and verify_status in ({$status})";				
			}
			
		    $data = $this->db->selectData("shop_product_info",$condition);
		    
		    return $data;
		}
		
		public function generate_item_price($shop_id, $item_id, $st, $et, $adult_price, $child_price, $inventory){
			
			$start_time = strtotime($st);
			$end_time = strtotime($et);
			
			for($i = 0; $i < 365 && $start_time <= $end_time; $i++){
				$day = date("Ymd", $start_time);
				
				$this->db->insertOrUpdate("shop_product_price_detail",
						array("shop_id"=>$shop_id,
							  "item_id"=>$item_id,
							  "price_date"=>$day,
							  "adult_price"=>$adult_price,
							  "child_price"=>$child_price,
							  "inventory"=>$inventory,
							  "update_time"=>time()
								), array('shop_id', 'item_id'));
				
				$start_time = $start_time + 24 * 60 * 60;
			}

			return array('status'=>'ok','item_id'=>$item_id);
			
		}
		
		public function save_item_date_price($shop_id, $item_id, $st, $adult_price, $child_price, $inventory){

			
			$start_time = strtotime($st);

			$day = date("Ymd", $start_time);
				
			$this->db->insertOrUpdate("shop_product_price_detail",
					array("shop_id"=>$shop_id,
							"item_id"=>$item_id,
							"price_date"=>$day,
							"adult_price"=>$adult_price,
							"child_price"=>$child_price,
							"inventory"=>$inventory,
							"update_time"=>time()
					), array('shop_id', 'item_id'));
			
			if($this->db->errno == 0){
		
				return array('status'=>'ok');
			}else {
				return array('status'=>'err', "code"=>$this->db->errno());				
			}
		}
		
		
		public function product_remove(){
		    $product_id = $_REQUEST['pid'];
		    
		    $this->db->delById('shop_product_info',$product_id);
		    
		    
		    $sql = <<<END
select group_concat(id)
from shop_product_price_item
where pid = $product_id
END;
		    $item_idds = $this->db->getVar($sql);
		    
		    $this->db->deleteData('shop_product_price_item',"pid=$product_id");
		    $this->db->deleteData("shop_product_price_detail","item_id in($item_idds)");

		    
		    if ($this->db->errno()!=0){
		        return array('status'=>'err','msg'=>$this->db->errmsg());
		    }
		    
		    return array('status'=>'ok');
		}
		
		
		
		
		
    }