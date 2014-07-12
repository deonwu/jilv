<?php
	include_once DOCROOT . '/helper/Page.class.php';
	
	/**
	 * 管理员后台   前端管理
	 * @author lili
	 *
	 */
	
	
	class AdminFrontAction extends Action{
		public function __construct(){
			parent::__construct();
			$this->per_page = 10;
		}
		
		public function hook_start_request(){
			$this->app = new AppHook();
			$this->app->start_request($this);
			$this->app->check_admin_auth($this, true);
			
			$this->assign("js_group","admin_home");
			
			if($this->admin_user['role_id'] != 2 && $this->admin_user['role_id'] != 4){
				$this->no_admin();
				exit();	
			}
			
			Configure::load('cms');
			$cms = Configure::getItems('cms');
			$this->load_helper('TaoDian');
			$this->api = new TaoDian($cms['app_id'],$cms['app_secret']);
			
			$this->assign("nav_main", "front");
				
		}
				
		
		public function index(){

			$this->home_page();
		}
		
		public function home_page(){
			
			
			$m = new AdminModel();
			
			$pic = $m->load_main_pic();
			
			$this->assign("dest_list", $m->load_cate_filter("home", "dest"));
			$this->assign("product_list", $m->load_cate_filter("home", "product_type"));
				
			$this->assign("main_pics", $pic);
			
			$this->assign("nav_index", "home_page");
			$this->display("admin/front/home_page.php");
				
		}
		
		/*
		public function load_main_pic(){
			$m = new AdminModel();
				
			$pic = $m->load_main_pic();
				
			$this->assign("main_pics", $pic);
				
			$this->assign("nav_index", "home_page");
			$this->display("admin/front/home_page.php");				
		}
		*/
		
		public function save_cate_filter(){
			
			$m = new AdminModel();
			
			$cid = $_REQUEST['cid'];
			
			$data = array('page_view'=>$_REQUEST['page_view'],
						  'cate_type'=>$_REQUEST['cate_type'],
						  'cate_label'=>$_REQUEST['cate_label'],
						  'cate_value'=>$_REQUEST['cate_value'],
						  'pic_url'=>$_REQUEST['pic_url'],
		  				  'view_order'=>$_REQUEST['view_order'],
						  'status'=>$_REQUEST['status'],
						  'user_id'=>$this->admin_user['id']						
					);
			
			if($cid > 0){
				$m->db->updateData("app_cate_filter", $data, "`id`='{$cid}'");
			}else {
				$m->db->insertData("app_cate_filter", $data);
			}
			
			$r = array('status'=>'ok');
			if($m->db->errno != 0){
				$r['status'] = 'err';
			}
			
			$this->json($r);
		}
		
		public function update_cate_status(){
			$m = new AdminModel();
			$st = $_REQUEST['active'];
				
			$m->db->runSql("update app_cate_filter set status = '{$st}' where `id`='{$_REQUEST['pid']}'");
		
			$this->json(array('status'=>'ok'));
		}		
		
		public function save_home_pic(){
			$m = new AdminModel();
			
			$m->db->insertData("app_home_page", array('url'=>$_REQUEST['url'],
					'active'=>0,
					'user_id'=>$this->admin_user['id'],
					'create_time'=>time()));
			
			$this->json(array('status'=>'ok'));
		}

		public function update_home_pic(){
			$m = new AdminModel();
			$st = $_REQUEST['active'];
			
			if($st == 1){
				$m->db->runSql("update app_home_page set active = 0 where active=1");				
			}
			$m->db->runSql("update app_home_page set active = '{$st}' where `id`='{$_REQUEST['pid']}'");
				
			$this->json(array('status'=>'ok'));
		}		
		
	}
?>