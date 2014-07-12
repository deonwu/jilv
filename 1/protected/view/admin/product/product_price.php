<?php V ('admin/header.php');?>

<div class = "col-lg-12">

     <div class = "col-lg-1 col-md-1 sidebar-nav">
             <?php V ('admin/left_nav.php');?>
     </div >
         
     <div class = "col-lg-11 col-md-11 hd">
            
          <div class="alert alert-default">
          <strong>产品名称:</strong>
          &nbsp;&nbsp;<?=$product['name']?>
          </div>

                        
            <table class="table">
            
                <tbody>
                    <tr><th colspan="12">价格类型</th></tr>
                    <tr>
                        <th>名称</th>
                        <th>门市价</th>
                        <th>儿童价</th>
                        <th>成人价</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>库存</th>
                        <th>人数限制</th>
                        <th>接送服务</th>
                        <th>亮点</th>
                        <th>费用说明</th>
                        <th>改退规则</th>                    
                    </tr>
                
                
                
                <?php foreach ($price_list as $price){?>
                        <tr>
                            <td><?=$price['price_name']?></td>
                            <td><?=$price['base_price']?></td>
                            <td><?=$price['child_price']?></td>
                            <td><?=$price['adult_price']?></td>
                            <td><?=$price['start_time']?></td>
                            <td><?=$price['end_time']?></td>
                            <td><?=$price['inventory']?></td>
                            <td><?=$price['people_limit']?></td>
                            <td><?=$price['pickup'] ? '有':'没有'?></td>
                            <td><?=$price['lightspot']?></td>
                            <td><?=$price['fee_descrip']?></td>
                            <td><?=$price['refund_rule']?></td>

                        </tr>
                
                <?php }?>
                </tbody>
            
            
            
            
            
            
            
            
            </table>

      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
     </div>
      
      
      
</div>

<?php V ('admin/footer.php');?>