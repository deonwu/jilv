<?php include 'header.php';?>

<script src="http://jilv.sinaapp.com/static/js/bootstrap/bootstrap-validation.js"></script>

<div class="body" style="margin-top:120px;">

    <div class="content">
        <div class="container">
        
                <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">登录</h3>
                      </div>
                      
                      <div class="panel-body">
                                 <form class="form-horizontal login-form" role="form" style="width:50%;" method="POST" action="?">
                
                                     
                                      <div class="form-group control-group">
                                          
                                            <div class="col-sm-10 controls">
                                              <input type="email" class="form-control" id="inputEmail3" placeholder="邮箱" name="email" value="<?=$email?>" check-type="required" required-message="邮箱不能为空！">
                                            </div>
                                      </div>
                                      
                                      <div class="form-group control-group">
                                        <div class="col-sm-10 controls">
                                          <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="密码" check-type="required" required-message="密码不能为空！">
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <div class=" col-sm-10">
                                          <div class="checkbox">
                                            <label>
                                              <input type="checkbox" name="remeber"> 记住帐号
                                            </label>
                                          </div>
                                        </div>
                                     </div>
                                     
                                      <div class="form-group">
                                        <div class=" col-sm-10">
                                          <button type="submit" id="login" class="btn btn-info btn-block">登录</button>
                                        </div>
                                      </div>
                                      
                                      <div class="control-group help" style="<?=$msg ? "":'display: none;'?>">
                                      
                                            <label>
                                               <p style="color:red;"><?=$msg?></p>
                                            </label>
                                            
                                        </div>
                                </form>
                                
                      </div>
                </div>
       
        </div>

    </div>


</div>

<script>
var CLICK = false;
$("#login").click(function(){

	$(".help").hide();

    if($("[name=email]").val() && $("[name=password]").val() && !CLICK){
        
        $("#login-form").submit();
        
        
    }else{

        $(".help").show();
        $(".help").find("p").text('请输入邮箱和密码!');

        return false;

    }


	
})



</script>











<?php include 'footer.php';?>