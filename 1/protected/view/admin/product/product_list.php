<?php V ('admin/header.php');?>

<?php 

$status = array(0=>'未审核',1=>'审核通过',2=>'已驳回');

?>
<div class = "col-lg-12 clearfix" style="padding:0px;">

    <div class = "col-lg-2 col-md-2 sidebar-nav" style="padding:0px;">
             <?php V ('admin/left_nav.php');?>
     </div >
         
     <div class = "col-lg-10 col-md-10 ">
     
      
            <h3>查询产品</h3>
              <form action="?" method="get">
                                                              产品名称：
                      <input id="name" name="name" value="<?=$_REQUEST['name']?>" placeholder="例如：济州岛三日游">
                                                            
                                                             审核状态 ：
                      <select name="verify_status">
                            <option value="">全部</option>
                            <?php foreach ($status as $k=>$s){?>
                            <option value="<?=$k?>" <?=$_REQUEST['verify_status'] === "$k" ? "selected='selected'":""?>><?=$s?></option>
                            <?php }?>  
                      
                      </select>                                       
                                                                 
                      <input type="submit" name="" value="查询">
             </form>
      
      
              <h3>产品列表</h3>
              <div id="product_list">
                      <table class="table" width="100%">
                              <tbody>
                                  <tr>
                                      <th>产品编号</th>
                                      <th>产品图片</th>
                                      <th>产品名称</th>
                                      <th>产品介绍</th>
                                      <th>产品分类</th>
                                      <th>城市</th>
                                      <th>更新时间</th>
                                      <th>状态</th>
                                      <th>操作</th>
                                  </tr>
                                  <?php foreach ($data as $product){
                                      $pic_arr = explode(";",$product['pic_list']);
                                      
                                  ?>
                                  <tr>
                                      <td><?=$product['id']?></td>
                                      <td>
                                      	<a target="_blank" href="/product/preview/<?=$product['id']?>"><img src="<?=$pic_arr[0] ?>!190" />
                                      	</a>
                                      </td>
                                      <td><a  target="_blank" href="/product/preview/<?=$product['id']?>"><?=$product['name']?></a> </td>
                                      <td><?=strlen($product['description']) > 10 ? sub_string($product['description'],10) : $product['description']?></td>
                                      <td>
                                          <?=$product['type_name'].'/'.$product['topic_name'].'/'.$product['category_name']?>
                                      </td>                
                                      <td>
                                          <?=$product['continent']?><br/>
                                          <?=$product['country']?><br/>
                                          <?=$product['city']?><br/>
                                          <?=$product['address']?>
                                      
                                      </td>
									  <td><?=$product['update_time']?></td>
                                      <td><?=$status[$product['verify_status']]?></td>
                                      <td>
                                      
                                          <?php if (!$product['verify_status']){?>
                                          
                                              <a class="verify btn btn-info" id="<?=$product['id']?>">通过</a>
                                              <a href="/admin/product_refund/<?=$product['id']?>" class="btn btn-danger">驳回</a>

                                          <?php }elseif ($product['verify_status'] == 2){?>
                                          
                                              <a href="/admin/product_refund/<?=$product['id']?>" class="btn btn-default">查看</a>
                                          
                                          <?php }?>

                                      </td>
                                  </tr>
                                  <?php }?>
                              </tbody>
                      
                      </table>
                      
                      <div class="page"><?=$page?></div>
              </div>
      
      
      
     </div>
      
      
      
</div>

<script>
//审核通过
$("#product_list").delegate(".verify","click",function(){
	var that = this;
    var post_data = {};

    post_data.id = $(this).attr("id");
    post_data.verify_status = 1;

    $.post("/admin/product_pass_save",post_data,
    	    function(r){
                 if(r.status == 'ok'){
             	    location.href="/admin/product_list";
                 }
        
	 },'json')

	
})





</script>



















<?php V ('admin/footer.php');?>