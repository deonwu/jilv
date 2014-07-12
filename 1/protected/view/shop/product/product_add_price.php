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
#price_info .red{color:red;padding-right: 2px;vertical-align: middle;}
#price_info img{max-width:220px;max-height:200px;overflow:hidden;}
</style>


                
         <ol class="breadcrumb">
              <li><a href="/shop/product">活动管理</a></li>
              <li class="active">新增活动</li>
        </ol>
        
        <?php
        
            if (!$price_one['id']){
        ?>        
		<div class="progress">
		  <div class="progress-bar progress-bar-success" style="width: 33%">
		  	填写基本信息
		  </div>
		  <div class="progress-bar progress-bar-success" style="width: 34%">
		    填写可售产品
		  </div>
		  <div class="progress-bar progress-bar-warning" style="width: 33%">
		   完成
		  </div>
		</div>        
		<?php } ?>        

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
     
             <div class= "form-group control-group" >
                    <label for = "exampleInputEmail1" class= "col-sm-2 control-label" > <?=$must ?>门市价 </label >
                    <div class = "col-sm-10 controls">
                       
                        <div class = "input-group " style= "width:<?=$width?> ;" >
                              <input type = "text" class= "form-control" name = "base_price" value= "<?=$price_one['base_price' ]?> " check-type = "required">
                              <span class = "input-group-addon"> 元</span>
                       </div >
                       
                       
                     </div >
              </div >
             
              
              <?php include 'price_table.php';?>
              
              
              
              <?php 
              $duration_unit = array('h'=>'小时','d'=>'天','m'=>'分钟');
              
              $time_range = array('上午','下午','晚上','一日','超值套餐');
              $suit_group = array('家庭','亲子','情侣','商务','背包','户外','奢华','新婚蜜月','团体');
              
              
              ?>
               
              
               <div class="form-group control-group">
                    <label for= "exampleInputEmail1" class="col-sm-2 control-label"><?=$must?>活动开始时间</label>
                    <div class="controls col-sm-10">
                        <input type="time" class="form-control" check-type="required" style="width:120px" name="start_time" value="<?=$price_one['start_time']?>">
                     </div >
              </div >
              
               <div class="form-group control-group">
                    <label for= "exampleInputEmail1" class="col-sm-2 control-label"><?=$must?>活动持续时间</label>
                    <div class="controls col-sm-10">
                        <input type="text" class="form-control" check-type="required" style="width: 110px; float: left; margin-right: 10px;" name="duration" value="<?=$price_one['duration']?>">
                        <select name="duration_unit" class="form-control" style="width:100px;">
                                <?php foreach ($duration_unit as $k=>$unit){?>
                                <option value="<?=$k?>" <?=$k == $price_one['duration_unit'] ? "selected='selected'":""?>><?=$unit?></option>
                                <?php }?>
                        </select>
                        
                     </div>
              </div >
              
                
              <div class="form-group control-group">
                    <label for= "exampleInputEmail1" class="col-sm-2 control-label"><?=$must?>需提前</label>
                    <div class="controls col-sm-10">
                           <div class="input-group" style="width: 150px;">
								<input class="form-control" name="advance_day" type="text"   value="<?=$price_one['advance_day']?>" check-type="required" required-message="亲，这个很重要哦！">
								<span class="input-group-addon">天预定</span>
						    </div>
                     </div >
              </div >  
              
              <div class="form-group">
                        <label for= "exampleInputEmail1" class="col-sm-2 control-label"><?=$must?>活动时间</label>
                        <div class="control col-sm-10 languange">
                            <?php foreach ($time_range as $j=>$l){?>
                            <label class="radio-inline">
                                  <input type="radio" name="time_range" value="<?=$l?>" <?=strpos("select".$price_one['time_range'],$l) || (!$price_one['time_range'] && $j == 0) ? "checked=checked":''?>> <?=$l?>
                            </label>
                            <?php }?>
                         </div >
             </div >
              
              
              
              <div class="form-group">
                        <label for= "exampleInputEmail1" class="col-sm-2 control-label"><?=$must?>适合群体</label>
                        <div class="control col-sm-10 languange">
                            <?php foreach ($suit_group as $i=>$l){?>
                            <label class="checkbox-inline">
                                  <input type="checkbox" name="suit_group" value="<?=$l?>" <?=strpos("select".$price_one['suit_group'],$l) || (!$price_one['suit_group'] && $i == 0) ? "checked=checked":''?>> <?=$l?>
                            </label>
                            <?php }?>
                         </div >
             </div >
              
              
              
              
              
                
                         
              
              <div class="form-group control-group">
                    <label for= "exampleInputEmail1" class="col-sm-2 control-label"><?=$must?>人数限制</label>
                    <div class="controls col-sm-10">
                        <input type="text" class="form-control" check-type="required" style="width:<?=$width?>" name="people_limit" value="<?=$price_one['people_limit']?>">
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

                   
<?php V ('shop/shop_common_foot.php');?>
           