<?php V("product/header.php");  ?>


<div class="row">

<div class = "col-lg-12 col-md-12">

		<h1><?=$item['name']?></h1>
</div>

<div class = "col-lg-12 col-md-12">
        
        
        
      <div class = "col-lg-9 col-md-9 hd" >
           
		<div class="pics">
			<div class="thumbnail">
		      <img src="<?=$item['imgs'][0] ?>" id="main_pic" >
		     </div>
			<div class="row item_thumbs">
				<div class = "col-lg-12 col-md-12">
			        <?php foreach($item['imgs'] as $p){ ?>
					  <div class="col-xs-2 col-md-2">
					    <a href="#" class="thumbnail">
					      <img src="<?=$p ?>" >
					    </a>
					  </div>
			    	<?php } ?>
			    </div>
			</div>		     
		</div>
		
		<div class = "price_items">
			<div>
				选择活动时间：
			</div>
			
			<?php foreach($item['price_items'] as $price) {?>
				<div class="well clearfix">
					<div><?=$price['price_name']?></div>
					
					<div class="pull-right">
						<div>RMB <span class='item_price_val'><?=$price['base_price'] ?></span> 每人起</div>
						<a class="btn btn-success" href="">预订</a>
					</div>
					<div>
						<div><i class="icon-comments-alt"></i>
							<label>服务语言:</label> <?=$item['language'] ?>
						</div>
						<?php if($price['duration'] > 0) {?>
						<div><i class="icon-time"></i> 
						<label>持续时间:</label> <?=$price['duration_label'] ?>
						</div>
						<?php }?>						
					</div>
				
					<div class="center-block clearfix"><a class="show_more" href="#" iid="<?=$price['id'] ?>">查看详细信息</a></div>
					<div class="price_detail center-block" style="display:none;">
						<img src="/static/img/loading.gif" />
					</div>
				</div>
			<?php }?>
			
		</div>
		
		<?php V("product/product_detail_info.php"); ?>
		
		
		<div style="margin-top:20px;margin-bottom:20px;">
			产品编号: <?=$item['id'] ?>
		</div>
   
     </div><!-- col-lg-11 -->


     <div class = "col-lg-3 col-md-3 sidebar-nav">
            <?php V ('product/nav_bar.php');?>
     </div >
     
</div>	

</div>

<script src="/static/js/product/item_detail.js"></script>


<?php V("product/footer.php"); ?>