


<div class = "col-lg-12 col-md-12 price_detil clearfix">
        
      <div class = "col-lg-6 col-md-6 hd text-left" >
           
		<div><i class="icon-calendar"></i> <label>提前预约:</label>至少提前<?=$item['advance_day'] ?>天</div>
		<div><i class="icon-money"></i>  <label>费用说明:</label><?=$item['fee_descrip'] ?></div>
		<div><i class="icon-remove"></i> <label>退改说明:</label><?=$item['refund_rule'] ?></div>
		<div><label>其他说明:</label><?=$item['lightspot'] ?></div>
		
     </div>


     <div class = "col-lg-6 col-md-6 ">
     	<div class="panel well">
     		<div class="panel-heading">立即预定</div>
     		<div class="price_calender" id="price_calender_<?=$item['id']?>" item_id="<?=$item['id']?>">
     			<img src="/static/img/loading.gif" />
     			<script>
					$("#price_calender_<?=$item['id']?>").load("/product/load_calendar/?item_id=<?=$item['id']?>");
     			</script>
     		</div>
     		<div class="text-left price_form">
	     		<div>
	     			<div><label>活动时间：</label><span class="start_time"><?=$item['start_time']?> </span> </div> 
	     		</div>
     		
     			<div>
	     			<div><label>成人(<?=$item['adult_descrip'] ? $item['adult_descrip'] : "12周岁以上" ?>)</label></div> 
	     			<input value="1" name="adult_count" size="3" /> <span>RMB <span class="adult_price"><?=$item['base_price']?></span>/人</span>
	     		</div>
	     		<div>
	     			<div><label>儿童(<?=$item['child_descrip'] ? $item['child_descrip'] : '未满12周岁' ?>)</label></div> 
	     			<input value="0" name="child_count"  size="3" /> <span>RMB <span class="child_price"><?=$item['base_price']?></span>/人</span>
	     		</div>
	     		<div>
	     			<div><label>总价：</label> <span class="pull-right">
	     			 <span class=" total_price">0</span>元</span></div>
	     			<a class="btn btn-success"  href="#">预定活动</a> 
	     		</div>  
     		</div>   		
     		
     	</div>
     	
     </div>
     
</div>	

