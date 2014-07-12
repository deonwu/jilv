function businessEnter(){
	var that = this;
	that.init();
}

Bn = businessEnter.prototype;

Bn.init = function(){
	
	var that = this;
	
	that.up_auth();
	that.up_license();
	that.up_logo();
	
	that.enter_event();
		
}

Bn.enter_event = function(){
	
	var that = this;
	
	$("#confirm-enter").click(function(){
		
		if($("#business-enter").validation()){
				
			var post_data = that.get_enter_info();
			if(!post_data){
				return false;
			}
			
			$(this).text('数据正在保存中……');
			
			$.post("/ShopEnter/save_enter_info",post_data,
					function(r){
						
						if(r.status == 'ok'){
							$.show_ok('保存成功!');
							setTimeout(function(){
								location.href = "/shop/product";
							},1000)
						}else{
							$.show_error('保存出错：'+r.msg);
						}
			},'json')
			
			
			
		}
		
		
		
	})
	
}

Bn.get_enter_info = function(){
	var that = this;
	
	if($("[name=authentication]").val() == ''){
		$.show_error('请上传身份认证!');
		return false;
	}
	if($("[name=license]").val() == ''){
		$.show_error('请上传营业执照!');
		return false;
	}
	if($("[name=logo]").val() == ''){
		$.show_error('请上传logo!');
		return false;
	}
	
	
	
	
	if($("[name=continent] option:selected").val() == '-1'){
		$.show_error('请选择洲!');
		return false;
	}
	
	if($("[name=country] option:selected").val() == '-1'){
		$.show_error('请选择国家!');
		return false;		
	}
	
	if($("[name=city] option:selected").val() == '-1'){
		$.show_error('请选择城市!');
		return false;		
	}
	
	if(!$("[name=clause]").prop("checked")){
        var err = "<span style='color:red'>请同意条款!</span>";
    	$("[name=clause]").parent().append(err);
        return false;
    }
	

	var post_data = {
			id : $("[name=id]").val(),
			shop_name : $("[name=shop_name]").val(),
			surname : $("[name=surname]").val(),
			forename : $("[name=forename]").val(),
			sex : $("[name=sex] option:selected").val(),
			authentication : $("[name=authentication]").val(),
			registration_name : $("[name=registration_name]").val(),
			postcode : $("[name=postcode]").val(),
			continent : $("[name=continent] option:selected").text(),
			city : $("[name=city] option:selected").text(),
			country : $("[name=country] option:selected").text(),
			address : $("[name=address]").val(),
			web_url : $("[name=web_url]").val(),
			license : $("[name=license]").val(),
			tel : $("[name=tel]").val(),
			qq : $("[name=qq]").val(),
			wx : $("[name=wx]").val(),
			wb : $("[name=wb]").val(),
			logo : $("[name=logo]").val(),
			description : $("[name=description]").val(),				
	};
	
	$("[name=subject]").each(function(){
		if($(this).is(":checked")){
			post_data.subject = $(this).val()
			return;
		}
	})
	
	
	return post_data;
	
	
}






Bn.up_auth = function(){
	var that = this;
	var file = $(".up-auth");
	
	file.uploadfile({
		bucket: 'jishop',
		return_url: 'http://'+window.location.host+'/api/upload_callback/jishop',
		save_key: "/jilv/authentication/{year}_{mon}_{day}/jilv_{hour}{min}{sec}{.suffix}",
		callback: function(data){

			if(typeof(data) == 'object'){
				
				if(data.code == '200'){

				        $("[name=authentication]").parent().find("img").attr("src",data.url+"!190");
				        $("[name=authentication]").val(data.url);
				        file.val(data.url);
				        
				 }else{
					    var ERR = "<span style='red'>"+data.message+"</span>";
					    $("[name=authentication]").after(ERR);
				 }
			}
			
			
			
		}
	});
	
	
}

Bn.up_license = function(){
	var that = this;
	var file = $(".up-license");
	
	file.uploadfile({
		bucket: 'jishop',
		return_url: 'http://'+window.location.host+'/api/upload_callback/jishop',
		
		save_key: "/jilv/license/{year}_{mon}_{day}/jilv_{hour}{min}{sec}{.suffix}",
		callback: function(data){

			if(typeof(data) == 'object'){
				
				if(data.code == '200'){

				        $("[name=license]").parent().find("img").attr("src",data.url+"!190");
				        $("[name=license]").val(data.url);
				        file.val(data.url);
				        
				 }else{
					    var ERR = "<span style='red'>"+data.message+"</span>";
					    $("[name=license]").after(ERR);
				 }
			}
			
			
			
		}
	});
	
	
}


Bn.up_logo = function(){
	var that = this;
	var file = $(".up-logo");
	
	file.uploadfile({
		//bucket: 'jishop',
		//return_url: 'http://'+window.location.host+'/api/upload_callback/jishop',
		
		save_key: "/jilv/logo/{year}_{mon}_{day}/jilv_{hour}{min}{sec}{.suffix}",
		callback: function(data){

			if(typeof(data) == 'object'){
				
				if(data.code == '200'){

				        $("[name=logo]").parent().find("img").attr("src",data.url+"!w348");
				        $("[name=logo]").val(data.url);
				        file.val(data.url);
				        
				 }else{
					    var ERR = "<span style='red'>"+data.message+"</span>";
					    $("[name=logo]").after(ERR);
				 }
			}
			
			
			
		}
	});
	
	
}










var App = {};
$(function(){
	
	App.benter = new businessEnter();
})