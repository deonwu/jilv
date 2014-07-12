<?php V ('shop/shop_common_head.php');?>

<?php 
$width = "400px";
$must = "<span class='red'>*</span>";
$product_info = $product_one;
?>

<style> 
#base_info{padding-left:0px;}
#base_info .control-label{font-weight:normal;}
#base_info h4{border-bottom:1px solid #ccc;font-weight: bold;width: 80%;padding-bottom: 10px;	}
#base_info .red{color:red;font-weight:bold;padding-right: 2px;vertical-align: middle;font-size: 1.3em;}
#base_info img{max-width:220px;max-height:200px;overflow:hidden;margin:5px;}
#base_info .del{cursor:pointer;} 
</style>

      
         <ol class="breadcrumb">
              <li><a href="/shop/product">活动管理</a></li>
              <li class="active"><?=$product_info['id'] ? '修改活动':'新增活动'?></li>
        </ol>
        
        <?php
        
            if ($product_info['id']){
                   include 'product_alert.php';
            }
        ?>

        <?php
        
            if (!$product_info['id']){
        ?>        
		<div class="progress">
		  <div class="progress-bar progress-bar-success" style="width: 33%">
		  	填写基本信息
		  </div>
		  <div class="progress-bar progress-bar-warning" style="width: 34%">
		    填写可售产品
		  </div>
		  <div class="progress-bar progress-bar-warning" style="width: 33%">
		   完成
		  </div>
		</div>        
		<?php } ?>
		
        <div class="form-horizontal" role="form" id="base_info">
                   <h4>1.基本信息</h4>
                   
                   <input name="id" type="hidden" value="<?=$product_info['id']?>">
                   
                   <?php if ($product_info){?>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">活动编号</label>
                            <div class="col-sm-10">
                             <p class="form-control-static"><strong><?=$product_info['id']?></strong></p>
                            </div>
                      </div>
                   <?php }?>

                  <div class="form-group control-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>活动名称</label>
                    <div class="col-sm-10 controls">
                      <input type="text" class="form-control" name="name" value="<?=$product_info['name']?>" placeholder="名称" style="width:<?=$width?>;" check-type="required" required-message="名称不能为空！">
                    </div>
                  </div>
                  
                  <div class="form-group control-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>活动介绍</label>
                    <div class="col-sm-10 controls">
                      <textarea name="description" class="form-control" check-type="required" required-message="介绍不能为空！" style="width:<?=$width?>;min-height:100px;"><?=$product_info['description']?></textarea>
                    </div>
                  </div>
                      
                        
                   <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>分类选择</label>
                    <div class="col-sm-10" style="padding-left: 30px;">
                          <div class="form-group">  
                                  <select name="type_select" class="form-control" style="width:300px;">
                                          <option value="-1">--大类--</option>
                                          <?php foreach ($travel_type as $type){?>
                                              <option value="<?=$type['id']?>" <?=$type['id'] == $product_info['type_select'] ? "selected='selected'":''?>><?=$type['name']?></option>
                                          <?php }?>
                                         
                                  </select>
                          </div>
                          
                          <div class="form-group">  
                                  <select name="topic_select" class="form-control" style="width:300px;">
                                          <option value="-1">--中类--</option>
                                          
                                          <?php foreach ($travel_topic as $topic){?>
                                                  <option value="<?=$topic['id']?>" <?=$topic['id'] == $product_info['topic_select'] ? "selected='selected'":''?>><?=$topic['name']?></option>
                                          <?php }?>
                                         
                                  </select>
                          </div>
                          
                          
                          <div class="form-group">  
                                  <select name="detail_select" class="form-control" style="width:300px;">
                                          <option value="-1">--小类--</option>
                                         
                                          <?php foreach ($travel_category as $category){?>
                                                  <option value="<?=$category['id']?>" <?=$category['id'] == $product_info['detail_select'] ? "selected='selected'":''?>><?=$category['name']?></option>
                                          <?php }?>
                                  </select>
                          </div>
                          
                          
                    </div>
                  </div>
                          
                    
                   <div class="form-group ">
                    <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>城市</label>
                    <div class="col-sm-10 controls"  style="padding-left: 30px;">
                          
                                  <div class="form-group address_p rel control-group">
                                		    <select id="continent" name="continent" check-type="required" class=" form-control" style="max-width: 300px;" tabindex="3">
                                                  <option value="-1">--洲--</option>
                                            </select>    
                                            
            		              </div>
            		  
            		  
                        		   <div class="form-group address_p rel">
                                          <select id="country" name="country" check-type="required" class=" form-control" style="max-width: 300px;" tabindex="4">
                                              <option value="-1">--国家--</option>
                                           </select>
                                        
                        		  </div>
            		  
            		  
                        		   <div class="form-group address_p rel">
                                        <select id="city" name="city" check-type="required" class=" form-control" style="max-width: 300px;" tabindex="5">
                                          <option value="-1">--城市--</option>
                                        </select> 
                                        
                        		  </div>
                          
                    </div>
                  </div> 
                    
                  <div class="form-group control-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>地址</label>
                    <div class="col-sm-10 controls">
                      <input type="text" class="form-control" value="<?=$product_info['address']?>" name="address" placeholder="地址" style="width:<?=$width?>;" check-type="required" required-message="地址不能为空！">
                    </div>
                  </div>
                  
                  
                   

                    <div class="form-group">
                        <label for= "exampleInputEmail1" class="col-sm-2 control-label"><?=$must?>支持语言</label>
                        <div class="control col-sm-10 languange">
                            <?php foreach ($lan as $l){?>
                            <label class="checkbox-inline">
                                  <input type="checkbox" name="lan" value="<?=$l?>" <?=strpos("select".$product_info['language'],$l) ? "checked=checked":''?>> <?=$l?>
                            </label>
                            <?php }?>
                         </div >
                    </div >
                    
                    
                  <div class="form-group control-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>如何抵达</label>
                    <div class="col-sm-10 controls">
                          <textarea name="arrive_way" class="form-control" style="width:340px;min-height:100px;" check-type="required"><?=$product_info['arrive_way']?></textarea>
                    </div>
                  </div>
                    
                    
                    
                   <div class="form-group control-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>温馨提示</label>
                    <div class="col-sm-10 controls">
                          <textarea name="tips" class="form-control" style="width:340px;min-height:100px;" check-type="required"><?=$product_info['tips']?></textarea>
                    </div>
                  </div>
                    
                    
                    <div class="form-group up-pic">
                        <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>图片列表</label>
                        <div class="col-sm-10">
                          <input type="file" name="file" style="width:<?=$width?>;" class="product_pic">
                          <input type="hidden" name="pic_list" value="<?=$product_info['pic_list']?>">
                        </div>
                    </div> 
                   
                   
                   <div class="form-group">
                       <lable class="col-sm-2 control-label"></lable>
                       <div id="pic_list" class="col-sm-10">
                                 <?php 
                                     if ($product_info['pic_list']){
                                          $pic_array = explode(";",$product_info['pic_list']);  
                                         foreach ($pic_array as $pic){?>
                                     
                                     <div class="item">
                                         <img src="<?=$pic?>!190">
                                         <input type='hidden' name='img' value='<?=$pic?>'>
                                         <span class="del"> <i class='icon-remove-sign' style='font-size:2em;'></i></span>
                                     </div>
                                         
                                     <?php 
                                         }
                                    }
                                 
                                 ?>  
                       
                        </div>
            
                   </div> 
                   
                	<div class="mt50" style="text-align:center">
                			<input type="button" class="btn btn-primary btn-lg"
                				id="to_act_second" value="下一步">
                	</div>					

        </div><!-- form-horizontal -->

<!-- 此部分为加载分类 -->
<script>
var PRODUCT_ID = "<?=$_REQUEST['id']?>";


                                 
$("[name=type_select]").change(function(e){
	load_trvale_topic(e.currentTarget);	
})


function load_trvale_topic(e){
	var type_id = $(e).find("option:selected").val();
    $.get("/shop/product_travel_topic",{type_id:type_id},
    	    function(r){
                  if(r.status == 'ok' && r.data){
              	      var $_topic = $("[name=topic_select]");
              	      
                	  $_topic.empty();
                	  $_topic.append("<option value='-1'>--中类--</option>"); 
              	      $.each(r.data,function(i,item){
                	        
                	    	$_topic.append("<option value='"+item.id+"'>"+item.name+"</option>"); 
              	      })
                  }
	    
	    },'json')
}


$("[name=topic_select]").change(function(e){
   
	load_travle_cateory(e.currentTarget);
	
})



function load_travle_cateory(e){
	 var topic_id = $(e).find("option:selected").val();
	    $.get("/shop/product_travel_category",{topic_id:topic_id},
	    	    function(r){
	                  if(r.status == 'ok' && r.data){
	              	      var $_detail = $("[name=detail_select]"); 

	                	  $_detail.empty();
	                	  $_detail.append("<option value='-1'>--小类--</option>"); 
	              	      $.each(r.data,function(i,item){
	                	        
	                	    	$_detail.append("<option value='"+item.id+"'>"+item.name+"</option>"); 
	              	      })
	                  }
		    
		    },'json')
}                                 
</script>







<!-- 此部分为js加载地区控件 -->
<script src="<?=$THEME_URL?>/js/continent.js"></script>
<script>
       
//几大洲长度
var a_l=continents.length;

var continent = document.getElementById("continent");
var country = document.getElementById("country");
var city = document.getElementById("city");


for_add(continent,continents,a_l);


continent.addEventListener("change",function(){
	var that = this;
	var _index = that.selectedIndex;
	country.length = 1;
	city.length = 1;
	if(_index != 0){
		that.setAttribute("data-continent-id",continents[_index-1]);
		var children_l = continents[_index-1]["countries"].length;
		for_add(country,continents[_index-1]["countries"],children_l);
	}
},false)

country.addEventListener("change",function(){
	var _parent_index = continent.selectedIndex;
	var that = this;
	var _index = that.selectedIndex;
	city.length = 1;
	if(_index != 0){
		that.setAttribute("data-country-id",continents[_parent_index-1]["countries"][_index-1]);
		var children_l = continents[_parent_index-1]["countries"][_index-1]["cities"].length;
		for_add(city,continents[_parent_index-1]["countries"][_index-1]["cities"],children_l);
	}
},false)

city.addEventListener("change",function(){
	var _parent_index = continent.selectedIndex;
	var _country_index = country.selectedIndex;
	var that = this;
	var _index = that.selectedIndex;
	if(_index != 0){
		that.setAttribute("data-city-id",continents[_parent_index-1]["countries"][_country_index-1]["cities"][_index-1]);
	}
},false)	


function for_add(obj,arr,l){

		for(var i = 0; i < l; i++){
			var newOption = new Option(arr[i].name,i);
			obj.add(newOption,undefined);
		}
	
}

</script>

<!-- 此部分为根据数据库里的地址显示到界面上 -->
<script>

<?php if ($product_info){?>

render_continents("<?=$product_info['continent']?>","<?=$product_info['country']?>","<?=$product_info['city']?>");

<?php }?>

function render_continents(param1,param2,param3){
	var CURRENT = {
			continent : param1,
			country : param2,
			city : param3,
	};

	//注册 continent
	var c = continents;
	var i = register(c,$("#continent"),CURRENT.continent);
	for_add(country,c[i].countries,c[i].countries.length);

	//注册coutry
	var t = c[i].countries;
	var j = register(t,$("#country"),CURRENT.country);
	for_add(city,t[j].cities,t[j].cities.length);

	//注册city
	var y = t[j].cities;
	var h = register(y,$("#city"),CURRENT.city);
}


function register(obj,$_new,current){

    for(var $i=0;$i<obj.length;$i++){

        if (obj[$i].name == current){

        	$_new.find("option").each(function($j,item){          
                 if($(item).text() == obj[$i].name){
                       item.selected=true;
                 }
             })             

            return $i;
            
        }
    }    
	
}


</script>                            
                
<script>

//图片删除

$("#pic_list").delegate(".del","click",function(){
	$(this).parent('.item').remove();
})



//基本验证             

function check_start(){
    var select = new Array();

    select.push($("[name=type_select]"));
    select.push($("[name=topic_select]"));
    select.push($("[name=detail_select]"));

    select.push($("[name=continent]"));
    select.push($("[name=country]"));
    select.push($("[name=city]"));

    var sel_falg = false;
    $.each(select,function(i,item){
        if($(item).find("option:selected").val()=='-1'){
            $(item).css("border","1px solid #b94a48");
            sel_falg = true;
         }
        
    })
    

    var checkbox = $("[name=lan]");
    var temp = true;
    for(var i=0;i<checkbox.length;i++){
        
        if($(checkbox[i]).prop("checked")){
        	temp = false;
        } 
    }

    var err = "";
    if(temp){
        err = "<span style='color:#b94a48'>请选择支持语言</span>";
        $(".languange").append(err);
    }

    var pic_flag = false;
    if($("#pic_list .item").length ===0){
    	pic_flag = true;
    	err = "<span style='color:#b94a48'>请上传产品图片！</span>";
	    $("[name=pic_list]").after(err);
	    
    }

    var base_falg = false;
    if(!$("#base_info").validation()){
    	base_falg = true;
     }
    

    
    if(sel_falg || temp || pic_flag || base_falg){
        return false;
    }


    return true;
    	
}

</script>





<?php V ('shop/shop_common_foot.php');?>                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

