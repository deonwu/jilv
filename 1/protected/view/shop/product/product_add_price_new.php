<?php V ('shop/shop_common_head.php');?>

<link rel="stylesheet" href="<?=$THEME_URL?>/css/bootstrap-datetimepicker.min.css">
<script src="<?=$THEME_URL."/js/bootstrap/bootstrap-datetimepicker.min.js"?>"></script>
<script src="<?=$THEME_URL."/js/bootstrap/bootstrap-datetimepicker.zh-CN.js"?>"></script>

<?php 
$width = "400px";
$must = "<span class='red'>*</span>";
$product_info = $product_one;
?>

<style> 
#price_info{padding-left:0px;}
#price_info .control-label{font-weight:normal;}
#price_info h4{border-bottom:1px solid #ccc;font-weight: bold;width: 80%;padding-bottom: 10px;	}
#price_info .red{color:red;font-weight:bold;padding-right: 2px;vertical-align: middle;font-size: 1.3em;}
#price_info img{max-width:220px;max-height:200px;overflow:hidden;}
</style>
                
         <ol class="breadcrumb">
              <li><a href="/shop/product">活动管理</a></li>
              <li class="active">新增活动</li>
        </ol>

        <div role= "form" class="form-horizontal" id="price_info">
     
              <h4>2.价格类型</h4> 
             
              <input type="hidden" name="pid" value="<?=$price_one['pid'] ? $price_one['pid'] : $_REQUEST['pid']?>">
              <input type="hidden" name="id" value="<?=$price_one['id']?>">
 
              <div class="form-group control-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>价格类型名称</label>
                    <div class="col-sm-10 controls">
                      <input type="text" class="form-control" name="price_name" value="<?=$price_one['price_name']?>" check-type="required" placeholder="名称" style="width:<?=$width?>;">
                    </div>
              </div>
     
              <div class="form-group control-group">
                    <label for= "exampleInputEmail1" class="col-sm-2 control-label"> <?=$must?>门市价</label>
                    <div class="col-sm-10 controls">
                        
                        <div class="input-group " style="width:<?=$width?>;">
                              <input type="text" class="form-control" name="base_price" value="<?=$price_one['base_price']?>" check-type="required">
                              <span class="input-group-addon">元</span>
                       </div>
                        
                        
                     </div >
              </div >
              
              
              <div class="form-group control-group">
                    <label for= "exampleInputEmail1" class="col-sm-2 control-label"> <?=$must?>成人价</label>
                    <div class="controls col-sm-10">
                        
                        <div class="input-group " style="width:<?=$width?>;">
                              <input type="text" class="form-control" name="adult_price" value="<?=$price_one['adult_price']?>" check-type="required">
                              <span class="input-group-addon">元</span>
                       </div>
                        
                        
                     </div >
              </div >
              
              
              <div class="form-group control-group">
                    <label for= "exampleInputEmail1" class="col-sm-2 control-label"><?=$must?> 儿童价</label>
                    <div class="controls col-sm-10">
                        
                        <div class="input-group " style="width:<?=$width?>;">
                              <input type="text" class="form-control" name="child_price" value="<?=$price_one['child_price']?>" check-type="required">
                              <span class="input-group-addon">元</span>
                       </div>
                        
                        
                     </div >
              </div >
              
              
              <div class="form-group atime">
                	<label class="col-sm-2 control-label">指定时间段：</label>
                	<div class="col-sm-3 controls form-inline">
                		<input class="form-control" name="start_time" value="<?=date("Y-m-d",strtotime($price_one['start_time']))?>" type="datetime" readonly autocomplete="off" 
                		   style="max-width: 150px;" check-type="required" required-message="请填写活动开始时间" />
                                                                            至
                        <input class="form-control" name="end_time" value="<?=date("Y-m-d",strtotime($price_one['end_time']))?>" type="datetime" readonly autocomplete="off"
                	         style="max-width: 150px;" check-type="required"
                			required-message="请填写活动结束时间" />
                
                	</div>
                	
                	<div class="col-sm-2">
                	    <a class="btn btn-default">生成表格</a>
                	</div>

             </div>
             
             <?php 
             
                 include 'price_table.php';
             ?>
             
             
             
             
             
              <div class="form-group control-group">
                    <label for= "exampleInputEmail1" class="col-sm-2 control-label"><?=$must?>库存</label>
                    <div class="controls col-sm-10">
                        <input type="text" class="form-control" check-type="required" value="<?=$price_one['inventory']?>" style="width:<?=$width?>" name="inventory" >
                        
                        <a href=""></a>
                     </div >
              </div >

              
               <div class="form-group">
                    <label for= "exampleInputEmail1" class="col-sm-2 control-label"><?=$must?>接送服务</label>
                    <div class="col-sm-10">
                                 <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="pickup" <?=$price_one['pickup'] ? "checked=checked":''?>> 是
                                    </label>
                                  </div>
                     </div >
              </div >
              
              
              <div class="form-group control-group">
                    <label for= "exampleInputEmail1" class="col-sm-2 control-label"><?=$must?>活动亮点</label>
                    <div class="controls col-sm-10">
                        <textarea class="form-control" check-type="required" name="lightspot" style="width:<?=$width?>"><?=$price_one['lightspot']?></textarea>
                     </div >
              </div >
              
              
              <div class="form-group control-group">
                    <label for= "exampleInputEmail1" class="col-sm-2 control-label"><?=$must?>费用说明</label>
                    <div class="controls col-sm-10">
                        <textarea class="form-control" check-type="required" name="fee_descrip" style="width:<?=$width?>"><?=$price_one['fee_descrip']?></textarea>
                     </div >
              </div >
              
              <div class="form-group control-group">
                    <label for= "exampleInputEmail1" class="col-sm-2 control-label"><?=$must?>退改规则</label>
                    <div class="controls col-sm-10">
                        <textarea class="form-control" check-type="required" name="refund_rule" style="width:<?=$width?>"><?=$price_one['refund_rule']?></textarea>
                     </div >
              </div >
              
             

              <div class="mt50" style="text-align:center">
    			<input type="button" class="btn btn-primary btn-lg"
    				id="to_act_third" value="下一步">
    	       </div>

       
    	       
         </div ><!-- form-horizontal -->


             
             
             
             
             
             
<script>

//价格保存验证
function check_second(){
    var price_flag = false;

    if(!$("#price_info").validation()){

    	price_flag = true;
    }
    
    if(price_flag){
        return false;
    }

    return true;
}

</script>

<script>
$("#price_info [name=start_time]").datetimepicker({
    format: 'yyyy-mm-dd',
    language: 'zh-CN',
    todayBtn:  1,
	autoclose: 1,
	showMeridian: true



});

$("#price_info [name=end_time]").datetimepicker({
    format: 'yyyy-mm-dd',
	language: 'zh-CN',
	todayBtn:  1,
	autoclose: 1,
	showMeridian: true,
	
	
 });

</script>              
             
             
             
             
             
             
             
             
<?php V ('shop/shop_common_foot.php');?>
           