<?php defined('YUNPHP') or exit('can not access!');
	define('USER_KEY', "emop_client_uid");

	class AppHook extends Hook{
	
		public function __construct(){
			parent::__construct();
						
			$this->menu_nav = array();
		}
		
		public function start_request($action){			
			$host_url = host_url();
			
			$action->assign("THEME_URL", "{$host_url}/static");
			$action->assign("BASE_URL", "{$host_url}");

			
		}
		
		public function check_shop_auth($action,$force_login=false){
		    session_start_new();
		    if ($_SESSION['shop']['id']>0){
		
		        $action->assign("nick",$_SESSION['shop']['name']);
		        $action->assign("shop",$_SESSION['shop']);
		
		        $action->shop = $_SESSION['shop'];
		
		
		    }elseif ($force_login){
		        $_SESSION['LOGIN_OK_NEXT'] = $_SERVER['REQUEST_URI'];
		        header("location: /user/login");
		        exit();
		    }
		
		}
		
		public function check_admin_auth($action,$force_login=false){
			session_start_new();
			if ($_SESSION['shop']['id']>0 && $_SESSION['shop']['is_admin'] == 1){
		
				
				$action->admin_user = $_SESSION['shop'];
				$action->admin_user['user_nick'] = $action->admin_user['name'];
				$action->admin_user['role_id'] = 2;
				$action->assign("admin_user", $action->admin_user);
				
				/*
				$action->assign("nick",$_SESSION['shop']['name']);
				$action->assign("shop",$_SESSION['shop']);
		
				$action->shop = $_SESSION['shop'];
				*/
		
			}elseif ($force_login){
				$_SESSION['LOGIN_OK_NEXT'] = $_SERVER['REQUEST_URI'];
				header("location: /user/login");
				exit();
			}
		
		}		
		
		
		public function check_admin_auth_emop($action){
			session_start_new();
		
			if($_SESSION['admin_uid_token']){
				Configure::load('cms');
				$cms = Configure::getItems('cms');
				$this->load_helper('TaoDian');
				$this->emop = new TaoDian($cms['app_id'], $cms['app_secret']);
					
				$u = $this->emop->emop_user_profile(array(access_token=>$_SESSION['admin_uid_token']), 10, true);
				if($u['status'] == 'err'){
					$u = $this->emop->emop_user_profile(array(access_token=>$_SESSION['admin_uid_token']), 0, true);
				}
		
		
				if($u['status'] == 'ok'){
					$action->admin_user = $u['data'];
					$action->assign("admin_user", $action->admin_user);
				}else {
					$_SESSION['LOGIN_OK_NEXT'] = $_SERVER['REQUEST_URI'];
						
					header("location: /user/admin_login");
					exit();
				}
			}else {
				$_SESSION['LOGIN_OK_NEXT'] = $_SERVER['REQUEST_URI'];
		
				header("location: /user/admin_login");
				exit();
			}
		}		
		
		
		
	}

?>