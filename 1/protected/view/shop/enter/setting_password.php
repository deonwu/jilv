<?php V ('shop/header.php');?>


<div class="body">

	<div class = "col-lg-12">
	    <div class = "col-lg-1 col-md-1 sidebar-nav">
	            <?php include 'setting_left_nav.php';?>
	    </div >
	                
	    <div class = "col-lg-11 col-md-11 hd" style="padding-left: 30px;">
	    
			<div class="form-horizontal" role="form" id="base_info">
                   <h4>修改密码</h4>
                   
                   
                      <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">旧密码</label>
                            <div class="col-sm-10">
                            	<input type="text" class="form-control" name="name" value="" placeholder="旧密码" >
                            </div>
                      </div>
                   
                  <div class="form-group control-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"><span class="red">*</span>新密码</label>
                    <div class="col-sm-10 controls">
                      <input type="text" class="form-control" name="name" value="" placeholder="新密码" >
                    </div>
                  </div>
                  <div class="form-group control-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"><span class="red">*</span>确认密码</label>
                    <div class="col-sm-10 controls">
                      <input type="text" class="form-control" name="name" value="" placeholder="确认密码" >
                    </div>
                  </div>                 
              
                   
                	<div class="mt50" style="text-align:center">
                			<input type="button" class="btn btn-primary btn-lg" id="to_act_second" value="修改密码">
                	</div>					

       		 </div>	    
	    </div>
	    
	</div>

</div>

<?php V ('shop/footer.php');?>