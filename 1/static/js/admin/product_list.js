function productList(){
	var that = this;
	that.init();
	
}

productList.prototype.init = function(){
	
	var that = this;
	that.refund();
	
	
}

productList.prototype.refund = function(){
	var that = this;
	
	$("#refund_product").delegate(".save","click",function(){
		
		if($("#refund_product").validation()){
			
			var post_data = {};
			post_data.id = $("[name=id]").val();
			post_data.refund_excuse = $("[name=refund_excuse]").val();
			
			post_data.refund_proof = "";
		    var pic_item = $(".pic_list .item");
		    for(var j = 0;j < pic_item.length;j++){
		    	if(j === 0){
		    		post_data.refund_proof = $(pic_item[j]).find("[name=img]").val();
		    	}else{
		    		post_data.refund_proof = post_data.refund_proof + ";"+$(pic_item[j]).find("[name=img]").val();
		    	}
		    }
		    
		    $.post("/admin/product_refund_save",post_data,
		    		function(r){
		    			if(r.status == 'ok'){
		    				location.href = "/admin/product_list";
		    			}else{
		    				$.show_error('出错了:'+r.msg);
		    			}
		    },'json')
		    
			
			
		}
		
		
		
	})
	
	that.refund_up();
	
	$(".pic_list").delegate(".del","click",function(){
		$(this).parent(".item").remove();
	})
	
	
	
	
	
}

productList.prototype.refund_up = function(){
	var that = this;
	var file = $(".up_excuse");
	
	file.uploadfile({
		save_key: "/jilv/verify/{year}_{mon}_{day}/jilv_{hour}{min}{sec}{.suffix}",
		callback: function(data){

			if(typeof(data) == 'object'){
				
				if(data.code == '200'){

					var template = "<div class='item'>"+
								   "<img src='"+data.url+"!190"+"'>"+
								   "<input type='hidden' name='img' value='"+data.url+"'>"+
								   "<span class='del'><i class='icon-remove-sign' style='font-size:2em;'></i></span>"+
								   "</div>";
					
					$(".pic_list").append(template);
					      
				 }else{
					    var ERR = "<span class='red'>"+data.message+"</span>";
					    $("[name=refund_proof]").after(ERR);
				 }
			}
			
			
			
		}
	})
	
}









var App = {};
$(function(){
	App.pl = new productList();
})