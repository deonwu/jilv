<?php V ('shop/shop_common_head.php');?>
<style> 
#price_list{padding-left:0px;}
#price_list h4{border-bottom:1px solid #ccc;font-weight: bold;width: 80%;padding-bottom: 10px;	}
</style>


                      
         <ol class="breadcrumb">
              <li><a href="/shop/product">活动管理</a></li>
              <li class="active">新增活动</li>
        </ol>
    

        <div id="price_list" >
           
            <input type="hidden" name="pid" value="<?=$_REQUEST['pid']?>">         
                <h4>2.价格类型</h4>
                
            <table class ="table table-bordered">
                           <thead >
                                <tr >
                                       <th >类型名称 </th >
                                       <th >门市价 </th >
                                       <th >开始时间</th >
                                       <th >结束时间</th >
                                       <th >操作 </th >
                                      
                                </tr >      
                           </thead >
                          
                           <tbody >
                               <?php foreach ($price_list as $price){?>
                               <tr>
                                      <td><?=$price['price_name']?></td >
                                      <td><?=$price['base_price']?></td >
                                      <td><?=$price['start_date']?></td >
                                      <td><?=$price['end_date']?></td >
                                      <td>
                                          <a href="/shop/product_add_price?id=<?=$price['id']?>">修改价格</a>
                                      </td >
                              </tr >
                               <?php }?>
                           
                           
                           
                              <tr>
                                  <td colspan="7" style="text-align:center">
                                      <a class="btn btn-info add_price" href="/shop/product_add_price?pid=<?=$_REQUEST['pid']?>">
                                      <i class="icon-plus"></i>&nbsp;增加价格类型</a>
                                  
                                  </td>
                              </tr>
                           </tbody >
                                                        
                                                    
            </table >
			<?php if($product_info['verify_status'] == 0) {?>
			    <a class="btn btn-info" href="/shop/product_done/<?=$_GET['pid'] ?>">发布完成</a>
			    
			<?php }else {?>
	            <a class="btn btn-info" href="/shop/product">完成</a>
            <?php }?>
            
        </div>




<?php V ('shop/shop_common_foot.php');?>






