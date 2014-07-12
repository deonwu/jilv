 <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>活动报价</label>
    <div class="col-sm-10">
    
         <ul class="nav nav-tabs" id="mytab">
                  <li class="active"><a href="#lot" data-toggle="tab">批量添加价格</a></li>
                  <li><a href="#appoint" data-toggle="tab">添加指定时间段价格</a></li>
                  <li><a href="#quick" data-toggle="tab">快速编辑模式</a></li>
         </ul>
         
         
         <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="lot">
                  <?php include 'price_table_lot.php';?>
            </div>
            
            <div class="tab-pane fade" id="appoint">
                  <?php include 'price_table_appoint.php';?>
            </div>
            
            <div class="tab-pane fade" id="quick">
                  <?php include 'price_table_quick.php';?>
            </div>
        
      </div>
           
                
   </div>
</div>




<script>
$('#myTab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
})
</script>