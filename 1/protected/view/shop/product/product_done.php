<?php V ('shop/shop_common_head.php');?>


                      
         <ol class="breadcrumb">
              <li><a href="/shop/product">活动管理</a></li>
              <li class="active">新增活动</li>
        </ol>

		<div class="progress">
		  <div class="progress-bar progress-bar-success" style="width: 33%">
		  	填写基本信息
		  </div>
		  <div class="progress-bar progress-bar-success" style="width: 34%">
		    填写可售产品
		  </div>
		  <div class="progress-bar progress-bar-success" style="width: 33%">
		   完成
		  </div>
		</div>         

        <div id="price_list" >
                <h4>发布完成</h4>
                
                <div class="alert alert-success">
                	活动发布完成，等待管理员审核。审核通过后，会在前端展示推广。
                </div>
              
             <a class="btn btn-info" href="/product/preview/<?=$product['id']?>">预览发布效果</a>    
                
             <a class="btn btn-info" href="/shop/product">返回商品列表</a>    
            
        </div>




<?php V ('shop/shop_common_foot.php');?>






