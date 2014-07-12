<?php
	include_once DOCROOT . '/helper/Page.class.php';
	
	/**
	 * 旅客订单管理
	 * @author deonwu
	 *
	 */
	
	class MemberOrderAction extends Action{

		public function __construct(){
			parent::__construct();
			$this->per_page = 10;
		}
		
		public function hook_start_request(){
			$this->app = new AppHook();
			$this->app->start_request($this);
			
			$this->assign("HOST",host_url()."/home/");
					
		}
				

		
		
	}
?>