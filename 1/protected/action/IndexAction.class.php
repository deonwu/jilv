<?php
	include_once DOCROOT . '/helper/Page.class.php';
	include_once DOCROOT . '/common/global_func.php';
	class IndexAction extends Action{
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
			$m = new HomeModel();
			//$product = $this->select_hot_product($m);
			if (DEBUG){
				var_dump('旅游',$product);
			}
			
			$main_pic = $m->db->getVar("select url from app_home_page where active=1 limit 1");

			$dest_list = $m->db->getData("select * from app_cate_filter where status=1 and page_view='home' and cate_type='dest' order by view_order limit 9");
				
			$product_list = $m->db->getData("select * from app_cate_filter where status=1 and page_view='home' and cate_type='product_type' order by view_order limit 9");
				
			$this->assign("main_pic", $main_pic);
			$this->assign("dest_list", $dest_list);
			$this->assign("product_list", $product_list);
				
		
			$this->assign('title','极旅');
			$this->display("home/index.php");
		}		
		
		
		public function select_hot_product($m){
		    $travle = $m->select_travel_product(true);
		    $new_data = array();
		
		    $sql= <<<END
select type_select from shop_product_info
where verify_status = 1
group by type_select
order by update_time desc
limit 9
END;
		    $data = $m->db->getData($sql);
		    
		    foreach ($data as $d){
		        $new_data[$d['type_select']] = $travle[$d['type_select']];
		    }
		    
		    return $new_data;
		    

		
		}
		
		
		public function select_hot_city($m){
		
		    $sql = <<<END
select city,pic_list from shop_product_info
where verify_status = 1
group by city
order by update_time desc		            
limit 9
END;
		    $data = $m->db->getData($sql);
		    return $data;
		
		}
		
		public function welcome_shop(){
			
			$this->assign("css_path", "home/welcome_shop.css");
			
			$this->display("home/welcome_shop.php");
		}
		
		
		
	}
?>