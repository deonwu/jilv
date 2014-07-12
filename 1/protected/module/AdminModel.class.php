<?php 	

require_once DOCROOT . "common/cache.class.php";
    class AdminModel extends Module {	
		var $client;   //客户端信息.	
		var $kv;
		var $db;
		
		public function __construct(){
			parent::__construct();
            $this->load_class('Db'); 
            $this->db = new Db(); 
						
			$this->cache = new SimpleCache('sae', '', 'emop_');
			
		}
		
        public function all_shop_list($param){
            $link_url = "?";
            $page_shop = $param['page_shop'] ? $param['page_shop']:1;
            $page_size = 10;
            
            $start = ($page_shop-1) * $page_size;
            
            $where = "where 1";
            
            if ($param['shop_name']){
                $where.=" and shop_name like '%{$param['shop_name']}%'";
                $link_url .= "shop_name={$param['shop_name']}&";
            }
            
            if ($param['subject']){
                $where.=" and subject = '{$param['subject']}'";
                $link_url .= "subject={$param['subject']}";
            }
            

            
            if ($param['verify_status'] || $param['verify_status'] === '0' ){
                $where.=" and verify_status = {$param['verify_status']}";
                $link_url .= "verify_status = {$param['verify_status']}&";
            }
            
            
            
            
            $sql = <<<END
select * from shop_business_enter_info
$where                    
order by create_time desc            
END;
            
            $total = count($this->db->getData($sql));
            if (DEBUG){
                $link_url .="debug={$_REQUEST['debug']}&";
            }
            $link_url .="page_shop=";
            $page = $this->page($total, $page_size, $link_url,$page_shop);
            
            
            $data_sql = $sql." limit $start , $page_size";
            $data = $this->db->getData($data_sql);
            
            if (DEBUG){
                echo "sql".$data_sql;
            }
            
            
            return array($data,$page);           
        }
		
        public function all_product_list($param){
            
            $link_url = "?";
            $page_no = $param['page_no'] ? $param['page_no']:1;
            $page_size = 10;
            
            $start = ($page_no-1) * $page_size;
            
            
            $where = "where 1";
            
            if ($param['name']){
                $where.=" and info.name like '%{$param['name']}%'";
                $link_url .= "info.name={$param['name']}&";
            }
            
            if ($param['verify_status'] || $param['verify_status'] === '0' ){
                $where.=" and info.verify_status = {$param['verify_status']}";
                $link_url .= "info.verify_status = {$param['verify_status']}&";
            }
            
            
            $sql = <<<END
select info.*,
cate.name as category_name,
topic.name as topic_name,
typ.name as type_name 
from shop_product_info info
left join travel_topic_category cate
on(info.detail_select = cate.id)
left join travel_topic topic
on(info.topic_select = topic.id)
left join travel_type typ
on(info.type_select = typ.id)    
$where                                    
order by info.update_time desc 
END;
            
            $total = count($this->db->getData($sql));
            if (DEBUG){
                $link_url .="debug={$_REQUEST['debug']}&";
            }
            $link_url .="page_no=";
            $page = $this->page($total, $page_size, $link_url,$page_no);
            
            
            $data_sql = $sql." limit $start , $page_size";
            $data = $this->db->getData($data_sql);
            
            if (DEBUG){
                echo "sql".$data_sql;
            }
            
            
            return array($data,$page);

        }
        
        public function one_shop($shop_id){
            
            $table = "shop_business_enter_info";
            $condition = "shop_id=$shop_id";
            
            $data = $this->db->selectData($table,$condition);

            return $data[0];
            
        }
        
        public function one_product($product_id){
            $table = "shop_product_info";
            $condition = "id=$product_id";
            
            $data = $this->db->selectData($table,$condition);
            
            return $data[0];
        }
        
        
        public function one_product_price($product_id){
            $table = "shop_product_price_item";
            
            $condition = "pid=$product_id";
            
            $data = $this->db->selectData($table,$condition);
            $product = $this->one_product($product_id);
            
            return array($product,$data);
            
            
        }
        
        
        
        
        
        
        
        
        
        
        
		
		
		public function refund_shop(){
		    
		    $refund_content = array();
		    $fields = array('refund_excuse','refund_proof','refund_user');
		    foreach ($fields as $f){
		        if ($_REQUEST[$f]){
		            $refund_content[$f] = $_REQUEST[$f];
		        }
		    }
		    $refund_content['refund_date'] = date("Y-m-d H:i:s");
		    
		    
		    $data = array();
		    $data['verify_status'] = $_REQUEST['verify_status'];
		    $data['refund_content'] = addslashes(json_encode($refund_content));
		    

		    $table = "shop_business_enter_info"; 
		    $condition = "shop_id={$_REQUEST['shop_id']}";
		    		   
		    $this->db->updateData($table,$data,$condition);
		    
		    if ($this->db->errno()!=0){
		        return array('status'=>'err','msg'=>$this->db->errmsg());
		    }
		    
		    return array('status'=>'ok');
		    
		    
		}
		
		
		public function pass_shop(){
		    $table = "shop_business_enter_info";
		    
		    $condition = "shop_id={$_REQUEST['shop_id']}";
		    $data['verify_status'] = 1;
		    
		    $this->db->updateData($table,$data,$condition);
		    
		    if ($this->db->errno()!=0){
		        return array('status'=>'err','msg'=>$this->db->errmsg());
		    }
		    
		    return array('status'=>'ok');
		}
		
		
		
		
		public function refund_product(){
		    $refund_content = array();
		    $fields = array('refund_excuse','refund_proof','refund_user');
		    foreach ($fields as $f){
		        if ($_REQUEST[$f]){
		            $refund_content[$f] = $_REQUEST[$f];
		        }
		    }
		    $refund_content['refund_date'] = date("Y-m-d H:i:s");
		    
		    
		    $data = array();
		    $data['verify_status'] = $_REQUEST['verify_status'];
		    $data['refund_content'] = addslashes(json_encode($refund_content));
		    
		    $table = "shop_product_info";
		    $condition = "id={$_REQUEST['id']}";
		
		    $this->db->updateData($table,$data,$condition);
		
		    if ($this->db->errno()!=0){
		        return array('status'=>'err','msg'=>$this->db->errmsg());
		    }
		
		    return array('status'=>'ok');
		
		
		}
		
		
		public function pass_product(){
		    $table = "shop_product_info";
		
		    $condition = "id={$_REQUEST['id']}";
		    $data['verify_status'] = 1;
		
		    $this->db->updateData($table,$data,$condition);
		
		    if ($this->db->errno()!=0){
		        return array('status'=>'err','msg'=>$this->db->errmsg());
		    }
		
		    return array('status'=>'ok');
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function page($total,$page_size,$base_url,$page_current){
			$this->load_helper("Page");
			$config1['base_url'] = "?debug=&type=&keyword=&page_no=";
			if($base_url){
				$config1['base_url'] = $base_url;
			}
			$config1['total_rows'] = $total;
			$config1['per_page'] = $page_size;
			$config1['cur_page'] = $page_current;
			$config1['full_tag_open']= "<div style='text-align:center;'><ul class='pagination'>";
			$config1['full_tag_close']= "</ul>";
		
			$config1['first_tag_open'] = "<li>";
			$config1['first_tag_close'] = "</li>";
		
			$config1['last_tag_open'] = "<li>";
			$config1['last_tag_close'] = "</li>";
		
			$config1['prev_link'] = "上一页";
			$config1['next_link'] = "下一页";
		
			$config1['cur_tag_open'] = "<li  class='active'><a href='javascript:;'>";
			$config1['cur_tag_close'] = "</a></li>";
		
			$config1['next_tag_open'] =  "<li>";
			$config1['next_tag_close'] = "</li>";
		
			$config1['prev_tag_open'] = "<li>";
			$config1['prev_tag_close'] = "</li>";
		
			$config1['page_tab_open'] = "<li>";
			$config1['page_tab_close'] = "</li>";
		
			$config1['uri_segmentation'] = "";
			$config1['num_links'] = 4;
				
			$config1['num_tag_open'] = "<li><a href='javascript:;'>共";
			$config1['num_tag_close'] = "页</a></li>";
		
			$pageStr1 = new Page($config1);
		
			if(DEBUG){
				//var_dump($pageStr1);
			}

			return $pageStr1->create_links();
		}
		
		
		public function load_main_pic(){
			$sql = <<<SQL
select p.*, u.name
from app_home_page p
join shop_login_info u on (u.id=p.user_id)
where active < 9					
order by p.create_time desc
SQL;
			return $this->db->getData($sql);		
		}
		
		public function load_cate_filter($page_view, $cate){
			$where = "1=1";
			if($page_view){
				$where .= " and page_view='{$page_view}'";
			}
			if($cate){
				$where .= " and cate_type='{$cate}'";				
			}
			
			$sql = <<<SQL
select p.*, u.name
from app_cate_filter p
left join shop_login_info u on (u.id=p.user_id)
where status < 9 and {$where}
order by p.view_order asc
SQL;
			return $this->db->getData($sql);
		}
		
	}
?>	