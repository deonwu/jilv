<?php
	include_once DOCROOT . '/helper/Page.class.php';
	include_once DOCROOT . '/common/global_func.php';
	
	/**
	 * 管理员 后台  商家列表，产品列表
	 * role 角色为2和4的管理员  
	 * @author lili
	 *
	 */
	
	
	class AdminAction extends Action{
		public function __construct(){
			parent::__construct();
			$this->per_page = 10;
		}
		
		public function hook_start_request(){
			$this->app = new AppHook();
			$this->app->start_request($this);
			$this->app->check_admin_auth($this, true);
			
// 			$this->assign("js_group","admin");
			
			if($this->admin_user['role_id'] != 2 && $this->admin_user['role_id'] != 4){
				$this->no_admin();
				exit();	
			}
			
			Configure::load('cms');
			$cms = Configure::getItems('cms');
			$this->load_helper('TaoDian');
			$this->api = new TaoDian($cms['app_id'],$cms['app_secret']);
			
			$this->assign("nav_main", "shop");
		}
		
		public function no_admin(){
			echo "不是管理员。";
		}
				
		
		public function index(){	
			$this->shop_list();
		}
		
		public function shop_list(){
		    
		    $admin = new AdminModel();
		    list($data,$page) = $admin->all_shop_list($_REQUEST);
		    $this->assign('data',$data);
		    $this->assign('page',$page);

		    
		    $this->assign('nav_index','shop_list');
			$this->display("admin/shop/shop_list.php");
		}
		
		public function shop_refund($shop_id){
		    
		    $admin = new AdminModel();
		    
		    $shop = $admin->one_shop($shop_id);
		    $this->assign('shop',$shop);
		    
		    $this->assign('nav_index','shop_list');
		    $this->assign('js_group','admin_shop');
		    
		    $this->display("admin/shop/shop_refund.php");
		    
		}
		
		public function shop_refund_save(){
		    $admin = new AdminModel();
		    
		    //驳回处理
		    
		    $_REQUEST['refund_user'] = $this->admin_user['user_id'];
		    $_REQUEST['verify_status'] = 2;
		    
		    $return = $admin->refund_shop();
		    $this->json($return);
		}
		
		public function shop_pass_save(){
		    $admin = new AdminModel();
		    
		    $return = $admin->pass_shop();
		    $this->json($return);
		    
		}
		
		
		
		
		
		public function product_list(){
		    
		    $admin = new AdminModel();
		    list($data,$page) = $admin->all_product_list($_REQUEST);
		    $this->assign('data',$data);
		    $this->assign('page',$page);
		    
		    $this->assign('nav_index','product_list');
		    $this->display("admin/product/product_list.php");
		}
		
		public function product_price($product_id){
		    $admin = new AdminModel();
		    
		    list($product,$price_list) = $admin->one_product_price($product_id);
		    $this->assign('product',$product);
		    $this->assign('price_list',$price_list);
		    
		    $this->assign('nav_index','product_list');
		    $this->display("admin/product/product_price.php");
		    
		}
		
		
		public function product_refund($product_id){
		
		    $admin = new AdminModel();
		
		    $product = $admin->one_product($product_id);
		    $this->assign('product',$product);
		
		    $this->assign('nav_index','product_list');
		    $this->assign('js_group','admin_product');
		
		    $this->display("admin/product/product_refund.php");
		
		}
		
		public function product_refund_save(){
		    $admin = new AdminModel();
		
		    //驳回处理
		
		    $_REQUEST['refund_user'] = $this->admin_user['user_id'];
		    $_REQUEST['verify_status'] = 2;
		
		    $return = $admin->refund_product();
		    $this->json($return);
		}
		
		public function product_pass_save(){
		    $admin = new AdminModel();
		
		    $return = $admin->pass_product();
		    $this->json($return);
		
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		

		
	}
?>