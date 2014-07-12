<?php
	include_once DOCROOT . '/helper/Page.class.php';
	
	/**
	 * 商家后台。
	 * 
	 * @author deonwu
	 *
	 */
	
	class ShopQuestionAction extends Action{
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
		}
		
		
		public function business_question(){
		    $this->assign('title','问答管理-极旅');
		    $this->assign('nav_index','2_4');
		
		
		    $this->assign('js_group','business_question');
		    $this->display("shop/business/business_question.php");
		
		}
		
		
		
	}