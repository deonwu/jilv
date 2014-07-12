<?php 	
require_once DOCROOT . "common/cache.class.php";
    class ShopEnterModel extends Module {	
		var $client;   //客户端信息.	
		var $kv;
		var $db;
		
		public function __construct(){
			parent::__construct();
            $this->load_class('Db'); 
            $this->db = new Db(); 
						
			$this->cache = new SimpleCache('sae', '', 'emop_');
			
		}
		
		
		public function select_enter_info($sid){
		    
		    $condition = "sid=$sid";
		    
		    $data = $this->db->selectData("shop_business_enter_info",$condition);
		    
		    return $data[0];
		       
		}
		
		public function save_enter_info(){
		    
		    $fields = array('id','sid','subject','shop_name','surname','forename','sex',
		                    'authentication','registration_name','postcode','continent',
		                    'country','city','address','web_url','license','tel','qq',
		                    'wx','wb','logo','description');
		    
		    
		    $data = array();
		    foreach ($fields as $f){
		        if ($_REQUEST[$f]){
		            $data[$f] = addslashes(trim($_REQUEST[$f]));
		        }
		    }
		    
		    $data['create_time'] = time();
		    $data['update_time'] = time();
            $data['verify_status'] = 0;
		    
		    $this->db->insertOrUpdate('shop_business_enter_info',$data);
		    
		    if ($this->db->errno()!=0){
		          return array('status'=>'err','msg'=>$this->db->errmsg());  
		    }
		    
		    return array('status'=>'ok');
		    
		    
		}
		
    }