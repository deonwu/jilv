<?php
	include_once DOCROOT . '/helper/Page.class.php';
	
	/**
	 * 商家后台。
	 * 
	 * @author deonwu
	 *
	 */
	
	class ShopComplaintAction extends Action{
		public function __construct(){
			parent::__construct();
			$this->per_page = 10;
		}
		
		public function hook_start_request(){
		    $this->app = new AppHook();
		    $this->app->start_request($this);
		    $this->app->check_shop_auth($this,true);
		    
		    if(!($this->shop['shop_id'] > 0) || $this->shop['verify_status'] !== '1'){
		    	header("location: /shopEnter/index");
		    	return false;
		    }		

		    $this->assign('main_nav','shop');		    
		}
		
		
		public function business_complaint(){
		    $this->assign('title','投诉管理-极旅');
		    $this->assign('nav_index','2_5');
		
		
		    $this->assign('js_group','business_complaint');
		    $this->display("shop/business/business_complaint.php");
		
		}
		
		
		
	}