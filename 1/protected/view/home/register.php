<?php include 'header.php';?>

<script src="http://jilv.sinaapp.com/static/js/bootstrap/bootstrap-validation.js"></script>

<div class="body" style="margin-top:120px;">




    <div class="content">
        <div class="container">
        
                <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">注册</h3>
                      </div>
                      
                      <div class="panel-body">
                                 <form class="form-horizontal register-form" role="form" style="width:50%;">
                
                                       <div class="form-group control-group">
                                        <label for="inputName3" class="col-sm-2 control-label">用户名</label>
                                        
                                        <div class="col-sm-10 controls">
                                          <input type="text" class="form-control" id="inputName3" placeholder="名字" name="name" check-type="required" required-message="名字不能为空！">
                                        </div>
                                      </div>
                                
                                
                                      <div class="form-group control-group">
                                          <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                                          
                                            <div class="col-sm-10 controls">
                                              <input type="email" class="form-control" id="inputEmail3" placeholder="邮箱" name="email" check-type="required" required-message="邮箱不能为空！">
                                            </div>
                                      </div>
                                      
                                      <div class="form-group control-group">
                                          <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
                                        <div class="col-sm-10 controls">
                                          <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="密码" check-type="required" required-message="密码不能为空！">
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                          <div class="checkbox">
                                            <label>
                                              <input type="checkbox" name="clause"> 同意极旅用户使用条款和隐私政策
                                            </label>
                                          </div>
                                        </div>
                                     </div>
                                     
                                      <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                          <button type="button" id="register" class="btn btn-default btn-block">注册</button>
                                        </div>
                                      </div>
                                </form>
                                
                      </div>
                </div>
       
        </div>

    </div>


</div>

<script>

window.HOST = "<?=host_url()?>";
window.LOGIN_OK = HOST+"/shopEnter/my";

var click = false;

$("#register").click(function(){
    if(click) return false;

    if($(".register-form").validation()){
        if(!$("[name=clause]").prop("checked")){
            var err = "<span style='color:red'>请同意条款!</span>";
        	$("[name=clause]").parent().append(err);
            return false;
        }

        $("[name=name]").css('border-color','#ccc');
        $("[name=email]").css('border-color','#ccc');
        $("form span.error").remove();

        $(this).text("数据正在保存中……");
        click = true;
		var btn = $(this);
		
        $.post(HOST+"/user/save_register_info",$(".register-form").serialize(),
                function(r){
                      if(r.status == 'ok'){
                  	     location.href = LOGIN_OK;
                      }else{
                    	  btn.text("注册");
                    	     click = false;
                    	     
              	            if (r.type == 'name') {

                	              $("[name=email]").val(r.email);
                	              $("[name=name]").css('border-color','red');
                	              $("[name=name]").parent().append("<span class='error' style='color:red'>"+r.msg+"</span>");
                	              
                  	        } else if(r.type == 'email'){

                 	        	  $("[name=name]").val(r.name);
                  	              $("[name=email]").css('border-color','red');
                  	              $("[name=email]").parent().append("<span class='error' style='color:red'>"+r.msg+"</span>");
                  	              
                      	    } else{

                        	      $(this).append("<p style='color:red'>"+r.msg+"</p>");
                          	}

                  	    
                      }


        },'json')

        

    }

	
})

</script>











<?php include 'footer.php';?>