<?php
	include_once DOCROOT . '/helper/Page.class.php';
	
	/**
	 * 管理员后台  游客管理
	 * @author lili
	 *
	 */
	
	class AdminMemberAction extends Action{
		public function __construct(){
			parent::__construct();
			$this->per_page = 10;
		}
		
		public function hook_start_request(){
			$this->app = new AppHook();
			$this->app->start_request($this);
			$this->app->check_admin_auth($this, true);
			
			$this->assign("js_group","admin");
			
			if($this->admin_user['role_id'] != 2 && $this->admin_user['role_id'] != 4){
				$this->no_admin();
				exit();	
			}
			
			Configure::load('cms');
			$cms = Configure::getItems('cms');
			$this->load_helper('TaoDian');
			$this->api = new TaoDian($cms['app_id'],$cms['app_secret']);
			
			$this->assign('nav_main', "member");
			
		}
				
		
		public function index(){
			$this->display("admin/member/user_list.php");
		}
		

		

		
	}
?>