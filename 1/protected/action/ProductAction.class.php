<?php
	include_once DOCROOT . '/helper/Page.class.php';
	
	/**
	 * 前端，产品展示
	 * @author deonwu
	 *
	 */
	
	class ProductAction extends Action{

		public function __construct(){
			parent::__construct();
			$this->per_page = 10;
		}
		
		public function hook_start_request(){
			$this->app = new AppHook();
			$this->app->start_request($this);
			
					
		}
		
		
		public function item_view($pid){
			
			$m = new ProductModel();
			
			$p = $m->get_product($pid);
			
			if($p['shop_id'] > 0 && $p['verify_status'] == 1){

				$this->assign("item", $p);
				
				$this->display("product/product_item.php");			
			}else if($p['shop_id'] > 0 && $p['verify_status'] != 1){
				$this->no_sale();				
			}else {
				$this->not_found();
			}
		}
		
		public function preview($pid){
			$m = new ProductModel();
				
			$p = $m->get_product($pid);
			
			$this->app->check_shop_auth($this, true);
			
			if($p['shop_id'] == $this->shop['shop_id'] || $_SESSION['admin_user_id'] > 0){
				$this->assign("item", $p);
					
				$this->display("product/product_item.php");				
			}else {
				$this->not_found();
			}			
		}
		
		public function not_found(){
			echo "没有找到商品";
		}

		public function no_sale(){
			echo "商品不在销售中";
		}		
		
		public function load_price_item($iid){
			
			$m = new ProductModel();
				
			$p = $m->get_product_price_item($iid);
				
			if($p['shop_id'] > 0){
			
				$this->assign("item", $p);
			
				$this->display("product/product_price_item.php");
			}else {
				$this->not_found_price();
			}
							
		}
		
		public function not_found_price(){
			echo "没有找到价格详情";
		}

		public function load_calendar(){
			$this->load_helper("Calender");
			$this->load_helper("CalenderRenders");
		
				
			$c = new Calendar();
			
			$c->weeks = $c->weeks2;
			$start = $_REQUEST['start'];
				
			if(strlen($start) >= 7){
				$c->year = substr($start, 0, 4);
				$c->month = substr($start, 5,2);
			}else {
				$c->year = date('Y');
				$c->month = date('m');
			}
				
				
			$m = new ShopModel();
			$item_id = $_REQUEST['item_id'];
			$s = "{$c->year}{$c->month}00";
			$e = "{$c->year}{$c->month}32";
				
			$sql = <<<SQL
select *
from shop_product_price_detail
where item_id='{$item_id}' and price_date >= {$s} and price_date <= {$e}
SQL;
			
			$data = $m->db->getData($sql);
			if(DEBUG){
				echo "sql:{$sql}, data:" . var_export($data);
			}
		
			$c->render = new UserRender($data);
		
			$this->assign("c", $c);
		
			$this->display("product/calender.php");
		}		
		//p
		
	}
?>