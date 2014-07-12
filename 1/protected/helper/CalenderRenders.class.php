<?php

	class SimpleRender{
		
		private $data;
		public function __construct($data){
			$this->data = array(); // $data;
			
			foreach($data as $row){
				$this->data[$row['price_date']] = $row;
			}
		}
		
		
		/**
		 * 展示一天的价格。
		 * @param unknown_type $d
		 */
		public function show($d){
			$r = $d['n_date'];
			$row = $this->data[$r];
			
			if(!$row){
				$row['adult_price']  = 0;
				$row['child_price']  = 0;
				$row['inventory']  = 0;				
			}
			
			$view = <<<END
<div class='c' date='{$d['date']}'>
<div class='day'>{$d['day']}</div>
<div class='adult_price'><label>成人：</label><span>{$row['adult_price']}</span></div>
<div class='child_price'><label>儿童：</label><span>{$row['child_price']}</span></div>
<div class='inventory'><label>数量：</label><span>{$row['inventory']}</span></div>
</div>
END;
			return $view;			
		}
		
	}

	class UserRender{
	
		private $data;
		public function __construct($data){
			$this->data = array(); // $data;
				
			foreach($data as $row){
				$this->data[$row['price_date']] = $row;
			}
		}
	
	
		/**
		 * 展示一天的价格。
		 * @param unknown_type $d
		 */
		public function show($d){
			$r = $d['n_date'];
			$row = $this->data[$r];
				
			if(!$row){
				$row['adult_price']  = 0;
				$row['child_price']  = 0;
				$row['inventory']  = 0;
			}


			//<div class='adult_price'><label>成人：</label><span>{$row['adult_price']}</span></div>
			//<div class='child_price'><label>儿童：</label><span>{$row['child_price']}</span></div>
			//<div class='inventory'><label>数量：</label><span>{$row['inventory']}</span></div>
			$has = $row['inventory'] > 0 ? 'remain' : '';
			
			$view = <<<END
<div class='c {$has}' date='{$d['date']}'>
<div class='day' adult='{$row['adult_price']}' child='{$row['child_price']}' remain='{$row['inventory']}' >{$d['day']}</div>
</div>
END;
			return $view;
		}
	
	}	
?>