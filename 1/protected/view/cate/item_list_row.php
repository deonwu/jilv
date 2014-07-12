<?php foreach($item_list as $item) {?>

<div class="item clearfix">
	<div class = "col-lg-12 col-md-12">
        
	     <div class = "col-lg-9 col-md-9">
	     	<h4><?=$item['name']?></h4>
	     	<div class="product">
	     		<div class="pic pull-left">
	     			<a href="/i/<?=$item['id']?><?=HTML_VIEW ? ".html" : "" ?>">
	     				<img src="<?=$item['imgs'][0]?>" />
	     			</a>
	     		</div>
	     		<div class="product_info">
	     			<div><label>简介:</label><span><?=$item['short_description']?></span></div>
          			<div><label>城市:</label><span><?=$item['city']?></span></div>
          			<!-- <div><label>活动:</label><span>xx</span></div> -->
          			<div><label>语言:</label><span><?=$item['language']?></span></div>
	     			
	     		</div>
	     	</div>
	     	<div class='shop'>商家: <?=$item['shop_name']?></div>
	     </div >
		
	     <div class = "col-lg-3 col-md-3" style="background:#eeeeee;height:160px;">
	     	<div>
	     	低值： <?=$item['min_price']?> 元
	     	</div>
	     	<a class="btn btn-success" href="/i/<?=$item['id']?><?=HTML_VIEW ? ".html" : "" ?>">查看详情</a>
	     </div >
     
     </div>

</div>

<?php }?>