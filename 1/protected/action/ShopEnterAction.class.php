<?php
	include_once DOCROOT . '/helper/Page.class.php';
	
	/**
	 * 商家后台。商家信息
	 * 
	 * @author deonwu
	 *
	 */
	
	class ShopEnterAction extends Action{
		public function __construct(){
			parent::__construct();
			$this->per_page = 10;
		}
		
		public function hook_start_request(){
		    $this->app = new AppHook();
		    $this->app->start_request($this);
		    $this->app->check_shop_auth($this,true);
		    
		    $this->assign('main_nav','shop');
		    
		}
		
		public function index(){
			$this->enter();
		}
		
		public function enter(){
		    
		    $model = new ShopEnterModel();
		    $enter = $model->select_enter_info($this->shop['id']);
		    $this->assign('enter',$enter);
		    
		    if (DEBUG){
		        var_dump($enter);
		    }
		    
		    
		    $this->assign('title','商家入驻-极旅');
		    $this->assign('nav_index','shop_enter');
		    
		    $this->assign('js_group','business_enter');
		    $this->display("shop/enter/enter.php");
		    
		}
		

		
		public function save_enter_info(){
		    $shopModel = new ShopEnterModel();
		    
		    $_REQUEST['sid'] = $this->shop['id'];
		    $data = $shopModel->save_enter_info();

		    if(!($this->shop['shop_id'] > 0)){
		    	$shop_info = $shopModel->db->getVar("select shop_id,verify_status from shop_business_enter_info where sid='{$this->shop['id']}'");
				$_SESSION['shop']['shop_id'] = $shop_info['shop_id'];
				$_SESSION['shop']['verify_status'] = $shop_info['verify_status'];
		    }
 		    
		    $this->json($data);
		}
		
		
		public function my(){
			if(!($this->shop['shop_id'] > 0)){
				header("location: /shopEnter/");
				return;
			}else {
				header("location: /shop/product/");
				return;				
			}
					
			$this->assign('title','首页-极旅');
			$this->assign('nav_index','1');
		
			$this->display("shop/enter/my.php");
		}
		
		
		public function tourist(){
		    $this->assign('title','游客-极旅');
		    $this->assign('nav_index','3');
		
		
		
		    $this->display("shop/enter/tourist.php");
		}
		
		
		public function message(){
		    $this->assign('title','消息中心-极旅');
		    $this->assign('nav_index','4');
		
		
		
		    $this->display("shop/enter/message.php");
		}
		
		public function setting(){
		    $this->assign('title','设置-极旅');
		    $this->assign('nav_index','5');
		    $this->assign('sub_nav_index','1');
		
		
		    $this->display("shop/enter/setting.php");
		}
		
		public function setting_password(){
			$this->assign('title','设置-极旅');
			$this->assign('nav_index','5');
			$this->assign('sub_nav_index','2');
		
		
			$this->display("shop/enter/setting_password.php");
		}		
		
		
	}