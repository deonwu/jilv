<?php 	
require_once DOCROOT . "common/cache.class.php";
    class UserModel extends Module {	
		var $client;   //客户端信息.	
		var $kv;
		var $db;
		
		public function __construct(){
			parent::__construct();
            $this->load_class('Db'); 
            $this->db = new Db(); 
						
			$this->cache = new SimpleCache('sae', '', 'emop_');
			
		}
		
		public function save_register_info(){
		    $data = array();
		    
		    $data['name'] = addslashes(trim($_REQUEST['name']));
		    $data['email'] = addslashes(trim($_REQUEST['email']));
		    
		    $password = trim($_REQUEST['password']);
		    $data['password'] = md5("jilv_password_{$password}");
		    
		    //检查用户名是否重复
		    
		    $sql_name=<<<SQL
select id from shop_login_info
where name = '{$data['name']}'
limit 1
SQL;
		    $var_name = $this->db->getVar($sql_name);
		    if ($var_name){
		        
		        return array(
		                'status'=>'err',
	                    'msg'=>'该用户名已被占用',
	                    'type'=>'name',
	                    'email'=>$data['email']
		                );
		    }
		    
		    
		    //检查邮箱是否重复
		    
		    $sql_email=<<<SQL
select id from shop_login_info
where email = '{$data['email']}'
limit 1
SQL;
		    $var = $this->db->getVar($sql_email);
		    
		    if ($var){
		        return array(
		                'status'=>'err',
		                'msg'=>'该邮箱已经被占用',
		                'type'=>'email',
		                'name'=>$data['name']
		                );
		    }
		    
		    $data['create_time'] = time();
		    $this->db->insertData("shop_login_info",$data);
		    $sid = $this->db->lastId();
		    
		    
		    if ($sid){
		        $data['id'] = $sid;
		        return array('status'=>'ok','shop'=>$data);
		    }else{
		        return array('status'=>'err','msg'=>'保存出错啦','type'=>'sql');
		    }
		    
		    
		}
		
		
		
		public function check_login_info(){
		    $password = trim($_REQUEST['password']);
		
		    $shop = array('email'=>addslashes(trim($_REQUEST['email'])),
		            'password'=>md5("jilv_password_{$password}")
		    );
		
		
		    $SQL=<<<END
select * from shop_login_info
where email = '{$shop['email']}'
END;
		    $login_info = $this->db->getLine($SQL);
		
		    if (!($login_info['id']>0)) {
		        return array('status'=>'err','code'=>'邮箱错误!');
		    }
		
		    if ($login_info['password'] != $shop['password']){
		        return array('status'=>'err','code'=>'密码错误!');
		    } 		
		    
		    $shop_sql = <<<END
select shop_id, verify_status 
from shop_business_enter_info 
where sid='{$login_info['id']}'
END;
		    
		    $shop_info = $this->db->getLine($shop_sql);
			if($shop_info){
				$login_info = array_merge($login_info, $shop_info);
			}
		    
		    return array('status'=>'ok','shop'=>$login_info);
		
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
    }