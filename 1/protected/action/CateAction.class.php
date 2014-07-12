<?php
	include_once DOCROOT . '/helper/Page.class.php';
	class CateAction extends Action{
		public function __construct(){
			parent::__construct();
			$this->per_page = 10;
		}
		
		public function hook_start_request(){
			$this->app = new AppHook();
			$this->app->start_request($this);
			$this->app->check_shop_auth($this);
					
		}
				
		public function index(){
			$this->search_by_cate();
		}
		
		public function filter($args){
			//echo ""
			if(DEBUG){
				echo "args:{$args}";
			}
			//$args =
			$m = new CateModel();
			
			$segs = explode("-", $args); 
			
			$num_ids = array(0);
			foreach ($segs as $s){
				if($s > 0){
					$num_ids[] = $s;
				}
			}
			$segs = join(",", $num_ids);
			
			$params = $m->db->getData("select * from app_cate_filter where `id` in ($segs)");
			foreach($params as $p){
				if($p['cate_value']){
					$_REQUEST[$p['cate_type']] = $p['cate_value'];
				}else {
					$_REQUEST[$p['cate_type']] = $p['cate_label'];						
				}
				$this->assign($p['cate_type'], $p['id']);
			}
			
			$this->search_by_cate();
		}
		
		public function search_by_cate(){
			$this->assign('title','极旅');
			
			$m = new ProductModel();
			
			$item_list = $m->search_products($_REQUEST);
			
			$cm = new CateModel();
			
			$cats = $cm->get_cate_list();
			
			
			$this->assign("cats_group", $cats);
			$this->assign("item_list", $item_list);
			
			$v = $_REQUEST['view'] ? $_REQUEST['view'] : "row";
			
			$this->assign("view", $v);
			
			$this->display("cate/product_item_list.php");		
		}
		
		
	}
?>