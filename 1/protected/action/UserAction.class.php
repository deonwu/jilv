<?php
	include_once DOCROOT . '/helper/Page.class.php';
	require_once DOCROOT . "/common/global_func.php";
	
	/**
	 * 还没有登录时用户页面。
	 * 
	 * @author deonwu
	 *
	 */
	
	class UserAction extends Action{
		public function __construct(){
			parent::__construct();
			$this->per_page = 10;
		}
		
		public function hook_start_request(){
			$this->app = new AppHook();
			$this->app->start_request($this);
			
			$this->assign("HOST",host_url()."/home/");

			Configure::load('cms');
			$this->cms = Configure::getItems('cms');				
		}
				
		public function admin_login(){
				
			$callback = host_url() . "/user/auth_emop";
			$url = "http://www.emop.cn/user/sso?client_id={$this->cms['app_id']}&redirect_uri={$callback}";
			
			header("location: {$url}");
		}
		
		public function auth_emop(){
			$session = $_REQUEST['session'];
			$sign = $_REQUEST['sign'];
				
			$user = $this->get_emop_user(urldecode($session), $sign);
			//exit();
			if($user['access_token']){
				if(DEBUG){
					echo "user:" . var_export($_SESSION['user'], true);
				}
				session_start();
				$_SESSION['admin_uid_token'] = $user['access_token'];
				
				$next = $_SESSION['LOGIN_OK_NEXT'] ? $_SESSION['LOGIN_OK_NEXT'] : "/admin/index";
				if(strpos($next, 'admin') === false){
					$next = "/admin/index";
				}
								
				$_SESSION['LOGIN_OK_NEXT'] = false;
				if(DEBUG){
					echo "next:{$next}";
					exit();
				}else {
					header("location: {$next}");
				}
			}else {
				//header("location: /user/admin_login");
				echo "Error no access token.";
			}
		}

		private function get_emop_user($param, $sign){
			$param = urldecode(str_replace(" ", "+", $param));
			//$data = base64_decode($param);
		
			$user = parse_url_data($param);
				
			//5e969f648a49364841936ad6da0b18a9
			$key = "{$param},{$this->cms['app_secret']}";
				
			$new_sign = md5($key);
			$sign = str_replace(" ", "+", $sign);
			if($new_sign != $sign){
				echo "param:{$param}, sign key:{$key}";
				echo "sign error:{$new_sign} != {$sign}\n";
				exit();
			}
					
			return $user;
		}	
		

		public function logout(){
			session_start();
			$_SESSION['shop'] = array();
			$_SESSION['admin_uid_token'] = false;
			
			session_destroy();
			header("location: /user/login");
		}

		
		public function register(){
		    $this->assign('title','注册-极旅');
		    $this->display("home/register.php");
		}
		
		
		public function save_register_info(){
		
		    $uModel = new UserModel();
		
		    $result = $uModel->save_register_info();
		
		    if ($result['status'] == 'ok'){
		
		        $_SESSION['shop'] = $result['shop'];
		    }
		
		    $this->json($result);
		}
		
		
		
		
		public function login(){
		
		    session_start();
		
		    $login_ok_text = $_SESSION['LOGIN_OK_NEXT'];
		    if (!$login_ok_text) $login_ok_text = "/shopEnter/my";
		
		
		    if($_SESSION['shop']['id']>0){
		        header("location: $login_ok_text");
		        return;
		    }
		
		    if (($_REQUEST['email'] && $_REQUEST['password'])){
		
		        $model = new UserModel();
		
		        $return = $model->check_login_info();
		        
		        if($return['shop']['is_admin'] == 1){
		        	$_SESSION['admin_user_id'] = $return['shop']['id'];
		        }
		
		        if ($return['status'] == 'ok'){
		
		            $_SESSION['shop'] = $return['shop'];
		            header("location: $login_ok_text");
		        }else{
		            $this->assign("msg",$return['code']);
		            $this->assign("email",$_REQUEST['email']);
		        }
		    }
		
		    $this->assign('title','登录-极旅');
		    $this->display("home/login.php");
		
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>