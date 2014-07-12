<?php V ('admin/header.php');?>
<?php 

$sex_array = array('1'=>'男','2'=>'女');
$status = array(0=>'未审核',1=>'审核通过',2=>'已驳回');
$subject_array = array('个体','企业','机构','组织','旅行社');


?>

<div class = "col-lg-12 clearfix" style="padding:0px;">

    <div class = "col-lg-2 col-md-2 sidebar-nav" style="padding:0px;">

             <?php V ('admin/left_nav.php');?>
     </div >
        
        
        
       <div class = "col-lg-10 col-md-10 ">
              <h3>查询商家</h3>
              <form action="?" method="get">
                                                              商家名称：
                      <input id="shop_name" name="shop_name" value="<?=$_REQUEST['shop_name']?>" placeholder="例如：淘点科技">
                                                             运营主体：
                      <select name="subject">
                              <option value="">全部</option>
                              <?php foreach ($subject_array as $subject){?>
                              <option value="<?=$subject?>" <?=$subject == $_REQUEST['subject'] ? "selected='selected'":''?>><?=$subject?></option>
                              <?php }?>
                              
                      </select>
                    
                                                            审核状态 ：
                      <select name="verify_status">
                            <option value="">全部</option>
                            <?php foreach ($status as $k=>$s){?>
                            <option value="<?=$k?>" <?=$_REQUEST['verify_status'] === "$k" ? "selected='selected'":""?>><?=$s?></option>
                            <?php }?>  
                      
                      </select>                                       
                                                                 
                      <input type="submit" name="" value="查询">
             </form>
      
      
              <h3>商家列表</h3>
              <div id="shop_list">
                      <table class="table" width="100%">
                              <tbody>
                                  <tr>
                                      <th>商家ID</th>
                                      <th>运营主体</th>
                                      <th>商家名称</th>
                                      <th>名字</th>
                                      <th>性别</th>
                                      <th>身份认证</th>
                                      <th>工商注册名称</th>
                                      <th>所在地</th>
                                      <th>营业执照</th>
                                      <th>电话</th>
                                      <th>LOGO</th>
                                      <th>提交时间</th>
                                      <th>状态</th>
                                      <th>操作</th>
                                  </tr>
                                  <?php foreach ($data as $shop){?>
                                  <tr>
                                      <td><?=$shop['shop_id']?></td>
                                      <td><?=$shop['subject']?></td>
                                      <td><span style='color:blue'><?=$shop['shop_name']?></span></td>
                                      <td><?=$shop['surname'].$shop['forename']?></td>
                                      <td><?=$sex_array[$shop['sex']]?></td>
                                      <td><a href="<?=$shop['authentication']?>" target="_blank">点击查看</a></td>
                                      <td><?=$shop['registration_name']?></td>
                                      <td>
                                          <?=$shop['continent']?><br/>
                                          <?=$shop['country']?><br/>
                                          <?=$shop['city']?><br/>
                                          <?=$shop['address']?>
                                      
                                      </td>
                                      <td><a href="<?=$shop['license']?>" target="_blank">点击查看</a></td>
                                      <td><?=$shop['tel']?></td>
                                      <td><a href="<?=$shop['logo']?>" target="_blank">点击查看</a></td>
                                      <td>
                                      	<?=$shop['create_time'] ?>
                                      </td>
                                      <td><?=$status[$shop['verify_status']]?></td>
                                      <td>
                                      
                                          <?php if (!$shop['verify_status']){?>
                                          
                                              <a class="verify btn btn-info" shop_id="<?=$shop['shop_id']?>">通过</a>
                                              <a href="/admin/shop_refund/<?=$shop['shop_id']?>" class="btn btn-danger">驳回</a>

                                          <?php }elseif ($shop['verify_status'] == 2){?>
                                          
                                              <a href="/admin/shop_refund/<?=$shop['shop_id']?>" class="btn btn-default">查看</a>
                                          
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
$("#shop_list").delegate(".verify","click",function(){
	var that = this;
    var post_data = {};

    post_data.shop_id = $(this).attr("shop_id");
    post_data.verify_status = 1;

    $.post("/admin/shop_pass_save",post_data,
    	    function(r){
                 if(r.status == 'ok'){
             	    location.href="/admin/shop_list";
                 }
        
	 },'json')

	
})





</script>



<?php V ('admin/footer.php');?>