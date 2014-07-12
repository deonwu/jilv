<?php
	include_once DOCROOT . '/helper/Page.class.php';
	
	/**
	 * 商家后台。商品管理
	 * 
	 * @author deonwu
	 *
	 */
	
	class ShopAction extends Action{
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
		
		public function index(){
			
			$this->product();
		}
		
		public function product(){
		    
		    $model = new ShopModel();
		    $product_list = $model->product_list($this->shop['shop_id']);
		    $this->assign('product_list',$product_list);
		  
		    $this->assign('title','活动管理-极旅');
		    $this->assign('nav_index','product_list');
		
		    $this->display("shop/product/product_list.php");
		
		}
		
		public function product_done($pid){
			
			$m = new ProductModel();
			
			$p = $m->get_product($pid);

			$this->assign("product", $p);
			
			$this->assign('title','活动管理-极旅');
			$this->assign('nav_index','product_add');
			
			$this->display("shop/product/product_done.php");
		}
		
		public function product_pending(){
					
			$model = new ShopModel();
			$product_list = $model->product_list($this->shop['shop_id'], "0, 2");
			$this->assign('product_list',$product_list);
		
			$this->assign('title','活动管理-极旅');
			$this->assign('nav_index','product_pending');
		
			$this->display("shop/product/product_pending_list.php");
		
		}		
		
		public function product_remove(){
		    
		    $model = new ShopModel();
		    
		    $this->json($model->product_remove());
		}
		
		
		
		public function product_add(){
		    
		    $model = new ShopModel();
		    
		    $languange = array('中国语','俄语','印度语','孟加拉语','希腊语','德语','意大利语',
		            '日语','法语','英语','荷兰语','葡萄牙语','西班牙语','阿拉伯语','韩语');
		    $this->assign('lan',$languange);
		    
		    $travel_type = $model->product_travel_type();
		    $this->assign('travel_type',$travel_type);
		    
		    if ($_REQUEST['id']){
		        $product_info = $model->product_one($_REQUEST['id']);
		        $this->assign('product_one',$product_info);
		        
		        $travel_topic = $model->product_travel_topic();
		        $this->assign('travel_topic',$travel_topic);
		        
		        $travel_category = $model->product_travel_category();
		        $this->assign('travel_category',$travel_category);
		    }
		    

		    $this->assign('title','活动管理-极旅');
		    $this->assign('nav_index','product_add');
		    
		    $this->assign('js_group','business_product');
		    $this->display("shop/product/product_add_base.php");
		}
		
		public function product_travel_topic(){
		    $model = new ShopModel();
		    
		    $data = $model->product_travel_topic();
		    
		    $this->json(array('status'=>'ok','data'=>$data));
		}
		
		public function product_travel_category(){
		    $model = new ShopModel();
		
		    $data = $model->product_travel_category();
		
		    $this->json(array('status'=>'ok','data'=>$data));
		}
		
		
		public function product_add_price(){
		    $model = new ShopModel();
		    
		    if ($_REQUEST['pid']){
		        $product_info = $model->product_one($_REQUEST['pid']);
		        $this->assign('product_one',$product_info);
		    }
		    
		    if ($_REQUEST['id']){
		        $price_one = $model->product_price_one($_REQUEST['id']);
		    }else {
		    	$price_one['start_date'] = date("Y-m-d");
		    	$price_one['end_date'] = date("Y-m-d", time() + 30 * 24 * 60 * 60);
		    	$price_one['adult_descrip'] = "超过12岁";
		    	$price_one['child_descrip'] = "12岁以下儿童";
		    	
		    	$price_one['start_time'] = "09:00";
		    	$price_one['advance_day'] = "3";
		    }

		    $this->assign('price_one',$price_one);
		    		
		    $this->assign('title','活动管理-极旅');
		    $this->assign('nav_index','product_add');
		
		    $this->assign('js_group','business_product');
		    
		    $this->display("shop/product/product_add_price.php");
		    
		}
		
		
		public function price_list(){
		    $model = new ShopModel();
            
		    if ($_REQUEST['pid']){		    
		        $price_list = $model->product_price_list($_REQUEST['pid']);
		        
		        $product_info = $model->product_one($_REQUEST['pid']);
		        
		        $this->assign("product_info", product_info);
		        $this->assign('price_list',$price_list);
		    }
		    
		    //商家自家不是
		    if($product_info['shop_id'] != $this->shop['shop_id']){
		    	header("location: /shop/");
		    	return;
		    }
		
		    $this->assign('title','活动管理-极旅');
		    $this->assign('nav_index','product_add');
		
		    $this->assign('js_group','business_product');
		    $this->display("shop/product/price_list.php");
		}

		
		public function product_base_save(){
		    $shopModel = new ShopModel();
		    $_REQUEST['shop_id'] = $this->shop['shop_id'];
		    
		    $data = $shopModel->product_base_save();
		    $this->json($data); 
		}
		
		
		public function product_price_save(){
		    $shopModel = new ShopModel();
		    $_REQUEST['shop_id'] = $this->shop['shop_id'];
		    
		    $return = $shopModel->product_price_save();
		    
		    if ($_REQUEST['save_type'] == 'base_price'){
		        $this->json($return);
		    }else{
		        
		        if ($return['status'] == 'err'){
		            $this->json($return);
		        }else{
		            $_REQUEST['item_id'] = $return['item_id'];
		            $this->generate_price();
		        }
		        
		        
		    }
   
		}
		
		
		
		public function generate_price(){
			$item_id = $_REQUEST['item_id'] + 0;
				
			
			$st = $_REQUEST['start_date'];
			$et = $_REQUEST['end_date'];
			
			$m = new ShopModel();
			
			$sql = "select 1 from shop_product_price_item where `id`='{$item_id}' and shop_id='{$this->shop['shop_id']}'";
			$is_own = $m->db->getVar($sql);
			if(DEBUG){
				echo "check onwer:{$sql}";
			}
			
			if($is_own > 0){
				$data= $m->generate_item_price($this->shop['shop_id'], $item_id, $st, $et, $_REQUEST['adult_price'],
						$_REQUEST['child_price'],  $_REQUEST['inventory']);
			}else {
				$data = array('status'=>'err', "code"=>'not_onwer');
			}
			
			$this->json($data);
		}
		
		public function save_date_price(){
			$item_id = $_REQUEST['item_id'] + 0;
			
				
			$st = $_REQUEST['price_date'];
				
			$m = new ShopModel();
				
			$sql = "select 1 from shop_product_price_item where `id`='{$item_id}' and shop_id='{$this->shop['shop_id']}'";
			$is_own = $m->db->getVar($sql);
			if(DEBUG){
				echo "check onwer:{$sql}";
			}
					
			if($is_own > 0){
				$data= $m->save_item_date_price($this->shop['shop_id'], $item_id, $st, $_REQUEST['adult_price'],
						$_REQUEST['child_price'],  $_REQUEST['inventory']);
			}else {
				$data = array('status'=>'err', "code"=>'not_onwer');
			}
		
			$this->json($data);
		}
		
		public function load_calendar(){
			$this->load_helper("Calender");
			$this->load_helper("CalenderRenders");
				
			
			$c = new Calendar();
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
			
			$c->render = new SimpleRender($data);
			
			$this->assign("c", $c);
			
			$this->display("common/calender.php");
		}
		
		
	}