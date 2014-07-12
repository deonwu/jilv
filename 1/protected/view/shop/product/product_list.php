<?php V ('shop/shop_common_head.php');?>


<style>
.panel-heading{height:42px;border-bottom:none;padding-top: 2px;padding-left: 10px;}
#product_list ul li{border:1px solid #ccc;border-bottom:none;width: 120px;text-align: center;margin-right: 10px;height:40px;}
#product_list ul li.active{background-color:white;}
#product_list ul li.active a{background-color:#f5f5f5;font-size:14px;}
#product_list ul li a{width:70%;height:26px;margin:8px auto;padding-top:5px;font-size:16px;font-weight:bold;color:#494444;	}
</style>           

            <div class="panel panel-default" id="product_list">
                  <div class="panel-heading">
                 	<h4>已发布活动列表</h4>
                  	
                           <a class="btn btn-default pull-right"  href="/shop/product_add" style="margin-bottom: 10px;"> 	
                                  <i class="icon-plus"></i> 新增活动
                            </a>
                 	
                    </div>
              
              
                  <div class="panel-body">
                              <table class="table table-bordered box-content">
                        			<thead>
                        		        <tr>
                        		                <th>产品ID</th>      
                        		                <th>图片</th>  		        
                        		                <th>产品名称</th>
                        		                <th>地址</th>
                        		                <th>状态</th>
                        		                <th>操作</th>        		        
                        		        </tr>        			
                        			</thead>
                        			
                        	         <tbody>
                                        <?php foreach($product_list as $t) {?> 
                      		                <tr>
                        		                <td><?=$t['id']?> </td>
                        		                <td><?php 
                        		                	$p = explode(";", $t['pic_list']);                        		                	
                        		                	echo "<img src='{$p[0]}!190' />";
                        		                ?>
                        		                
                        		                </td>                        		                
                        		                <td><a href="/i/<?=$t['id']?>" target="_blank"><?=$t['name']?></a></td>
                        		                <td><?=$t['city']?>, <?=$t['address']?></td>
                        		                <td>
                        		                <?php 
                        		                if (!$t['verify_status']){
                        		                    echo "审核中";
                        		                }elseif ($t['verify_status'] === '2'){
                        		                    echo "已驳回, 点击【修改】查看";
                        		                }elseif ($t['verify_status'] === '1'){
                        		                    echo "已发布";
                        		                }
                        		                
                        		                
                        		                ?></td>
                        		                <td>
                        		                    <a href="/shop/product_add?id=<?=$t['id']?>">修改</a>
                        		                    &nbsp;&nbsp;<a href="/shop/price_list?pid=<?=$t['id']?>">价格类型</a>
                        		                    &nbsp;&nbsp;<a href="javascript:;" class="del" pid="<?=$t['id']?>">删除</a>
                        		                    
                        		                
                        		                </td>        		                
                        		            </tr>  
                                        <?php } ?>       		        
                        			</tbody>
                            </table>  
                   </div>
              
            </div> <!-- panel -->

                
<script src="<?=$THEME_URL ?>/js/app_dailog.js"></script> 
<script>
$("#product_list").delegate(".del","click",function(e){

    $.show_confirm("该删除操作不可恢复，您确定删除吗?",function(){
            var pid = $(e.currentTarget).attr('pid');
            $.post("/shop/product_remove",{pid:pid},
                    function(r){
                       if(r.status == 'ok'){
                   	        $(e.currentTarget).parent().parent().fadeOut();
                       }else{
                   	      $.show_error('删除出错!'+r.msg);
                       }
                
            },'json')

    })


	
})
</script>


<?php V ('shop/shop_common_foot.php');?>
