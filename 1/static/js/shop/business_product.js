function CalenderEditor(){
	var that = this;
	$("#price_calender").on("click", "td", function(event){
		var td = $(this);
		if(td.hasClass("editing")) return;
		if(td.find(".c").length == 0) return;

		
		event.preventDefault();
		
		var cur = $("#price_calender").find(".editing");
		cur.removeClass("editing");
		if(cur.length > 0){
			that.cancel_edit(cur);
		}
		td.addClass("editing");
		
		
		that.show_edit(td);		
	});
	
	$("#calender_editor .save").click(function(){
		that.save_cur_edit();
	});
	
}

CalenderEditor.prototype.show_edit = function(td){
	td.find(".c").hide();	
	
	$("#calender_editor").show();
	td.append($("#calender_editor"));
	var editor = $("#calender_editor");
	
	editor.find('input[name=adult_price]').val(td.find(".adult_price span").text());
	editor.find('input[name=child_price]').val(td.find(".child_price span").text());
	editor.find('input[name=inventory]').val(td.find(".inventory span").text());
	
}

CalenderEditor.prototype.save_cur_edit = function(){
	var cur = $("#price_calender").find(".editing");
	
	//console.log("saving, " + cur.find(".c").attr("date"));
	
	var editor = $("#calender_editor");
	var p = {};
	p.adult_price = editor.find('input[name=adult_price]').val();
	p.child_price = editor.find('input[name=child_price]').val();
	p.inventory = editor.find('input[name=inventory]').val(); 
	p.price_date = cur.find(".c").attr("date");
	p.item_id = CUR_ITEM_ID;
	
	var that = this;
	$.post("/shop/save_date_price", p, function(data){
		if(data.status == 'ok'){
			cur.find(".c .adult_price span").text(p.adult_price);
			cur.find(".c .child_price span").text(p.child_price);
			cur.find(".c .inventory span").text(p.inventory);	
			that.cancel_edit(cur);
		}else {
			$.show_ok("修改失败。");			
		}
		
	}, "json");
	
}


CalenderEditor.prototype.cancel_edit = function(td){
	td.find(".c").show();	
	$("#calender_editor").hide();
	td.removeClass("editing");
}


function businessProduct(){
	var that = this;
	that.init();
}

Bp = businessProduct.prototype;

Bp.init = function(){
	
	var that = this;
	
	that.uploadPic();
	
	that.base_save();
	that.price_save();	
	
	that.load_base_data();
	$("#generate_price").click(function(){
		
		that.price_item_save(this);		
		
	});
	
	$(".control-group").on("change", "input", function(e){
		$(this).parents('.control-group').removeClass("has-error");
	});
	

}

Bp.load_base_data = function(){
	var that = this;
	
	var id = $("[name=id]").val();
	var start_date = $("[name=start_date]").val();
	
	if(id){
		that.load_price_calender(start_date, id);		
	}
	
	$("#price_calender").delegate(".prev","click",function(){
		
		that.load_price_calender(that.get_date('minus'), CUR_ITEM_ID);
		
	})
	
	$("#price_calender").delegate(".next","click",function(){
		
		that.load_price_calender(that.get_date('plus'), CUR_ITEM_ID);
	})
	
	
}

Bp.get_date = function(cal){
	var that = this;
	var date = $("#price_calender").find("h1 span").text();
		
	var date_arr = date.split('-');
	
	var year = date_arr[0];
	var month = Number(parseInt(date_arr[1]));
	
	var new_month = 0;
	if(cal == 'minus'){
		new_month = month-1;
	}
	
	if(cal == 'plus'){
		new_month = month+1;
	}
	
	if(new_month < 10){
		new_month = '0'+new_month;
	}
	
	return year+'-'+new_month;
}




Bp.load_price_calender = function(date,item_id){
	var post_data = {
			start : date,
			item_id : item_id
	}
	
	$("#calender_editor").hide().appendTo("body");
	$("#calender").show();
	$("#price_calender").load("/shop/load_calendar",post_data);
}



Bp.price_item_save = function(e){
	
	var that = this;
	
	$(e).parent().find(".red").remove();
	
	var $_name = $("[name=price_name]");
	if($_name.val() == ""){
		$($_name).parents(".form-group").addClass("has-error");
		return false;
	}
	
	var $_base = $("[name=base_price]");
	if($_base.val() == ""){
		$($_base).parents(".form-group").addClass("has-error");
		return false;
	}
	
	var $_start = $("[name=start_date]"); 	
	var $_end = $("[name=end_date]"); 
	var $_adult = $("[name=adult_price]"); 
	var $_child = $("[name=child_price]"); 
	var $_inventory = $("[name=inventory]"); 
	
	
	
	if ($_start.val() == "" || $_end.val() == "" || 
		$_adult.val() == "" || $_child.val() == "" || $_inventory.val() == ""){
		$(e).after("<span class='red'>请完善信息！</span>");
		return false;
	}
	
	

	var post_data = {
			id : $("[name=id]").val(),
			pid : $("[name=pid]").val(),
			price_name : $_name.val(),
			base_price : $_base.val(),
			start_date : $_start.val(),
			end_date : $_end.val(),
			adult_price : $_adult.val(),
			child_price : $_child.val(),
			adult_descrip : $("[name=adult_descrip]").val(),
			child_descrip : $("[name=child_descrip]").val(),
			inventory : $_inventory.val(),		
	};
	
	post_data.save_type = 'price_item';
	
	$.post("/shop/product_price_save",post_data,
			function(r){
				if(r.status == 'ok'){
					
					$("[name=id]").val(r.item_id);
					that.load_price_calender(post_data.start_date,r.item_id);
				}
	},'json')
	
}





Bp.price_save = function(){
	var that = this;
	
	$("#to_act_third").click(function(){
		
		if(check_second()){
			var post_data = that.get_price_info();
			
			$.post("/shop/product_price_save",post_data,
					function(r){
						if(r.status == 'ok'){							
							
							location.href = "/shop/price_list?pid="+r.pid;

						}else{
							$.show_error('保存出错:'+r.msg);
						}
			},'json')
			
			
			
		}
		
	})
}

Bp.get_price_info = function(){
	
	var that = this;
	
	var post_data = {
			id : $("[name=id]").val(),
			pid : $("[name=pid]").val(),
			price_name : $("[name=price_name]").val(),
			base_price : $("[name=base_price]").val(),
			adult_descrip : $("[name=adult_descrip]").val(),
			child_descrip : $("[name=child_descrip]").val(),
			people_limit : $("[name=people_limit]").val(),
			start_time : $("[name=start_time]").val(),
			duration : $("[name=duration]").val(),
			duration_unit : $("[name=duration_unit] option:selected").val(),
			advance_day : $("[name=advance_day]").val(),
			lightspot : $("[name=lightspot]").val(),
			fee_descrip : $("[name=fee_descrip]").val(),
			refund_rule : $("[name=refund_rule]").val()			
	};
	
	if(!$("[name=pickup]").prop("checked")){
		post_data.pickup = 1;
    }
	
	var $_time_range = $("[name=time_range]");
    for(var i=0;i<$_time_range.length;i++){
        
        if($($_time_range[i]).prop("checked")){
        	
        		post_data.time_range = $($_time_range[i]).val();

        } 
    }

	
    var $_suit_group = $("[name=suit_group]");
    for(var i=0;i<$_suit_group.length;i++){
        
        if($($_suit_group[i]).prop("checked")){
        	
        	if(i === 0){
        		post_data.suit_group = $($_suit_group[i]).val();
        	}else{
        		post_data.suit_group = post_data.suit_group + ";"+$($_suit_group[i]).val();
        	}
        } 
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	post_data.save_type = 'base_price';
	
	return post_data;

}







Bp.base_save = function(){
	
	var that = this;
	
	$("#to_act_second").click(function(){
		if(check_start()){
			
			var post_data = that.get_base_info();
			
			var url = "/shop/product_add_price";
			if(post_data.id){
				url = "/shop/price_list";
			}
			
			$.post("/shop/product_base_save"+DEBUG,post_data,
					function(r){
						if(r.status == 'ok'){
							
								location.href = url+"?pid="+r.pid;
							
						}else{
							$.show_error('保存出错:'+r.msg);
							return false;
						}
				
			},'json')
			
		}

		
	})
	
	
}

Bp.get_base_info = function(){
	
	var that = this;
	var post_data = {
			id : $("[name=id]").val(),
			name : $("[name=name]").val(),
			description : $("[name=description]").val(),
			type_select : $("[name=type_select] option:selected").val(),
			topic_select : $("[name=topic_select] option:selected").val(),
			detail_select : $("[name=detail_select] option:selected").val(),
			continent : $("[name=continent] option:selected").text(),
			country : $("[name=country] option:selected").text(),
			city : $("[name=city] option:selected").text(),
			address : $("[name=address]").val(),
			arrive_way : $("[name=arrive_way]").val(),
			tips : $("[name=tips]").val()
		
	};
	
	var checkbox = $("[name=lan]");
    var temp = "";
    for(var i=0;i<checkbox.length;i++){
        
        if($(checkbox[i]).prop("checked")){
        	
        	if(i === 0){
        		temp = $(checkbox[i]).val();
        	}else{
        		temp = temp + ";"+$(checkbox[i]).val();
        	}
 
        	
        	
        } 
    }
    
    post_data.language = temp;
    
    post_data.pic_list = "";
    var pic_item = $("#pic_list .item");
    for(var j = 0;j < pic_item.length;j++){
    	if(j === 0){
    		post_data.pic_list = $(pic_item[j]).find("[name=img]").val();
    	}else{
    		post_data.pic_list = post_data.pic_list + ";"+$(pic_item[j]).find("[name=img]").val();
    	}
    }
    
    return post_data;
		
}






Bp.uploadPic = function(){
	
	var that = this;
	var file = $(".product_pic");
	
	file.uploadfile({
		save_key: "/jilv/product/{year}_{mon}_{day}/jilv_{hour}{min}{sec}{.suffix}",
		callback: function(data){

			if(typeof(data) == 'object'){
				
				if(data.code == '200'){

					var template = "<div class='item'>"+
								   "<img src='"+data.url+"!190"+"'>"+
								   "<input type='hidden' name='img' value='"+data.url+"'>"+
								   "<span class='del'><i class='icon-remove-sign' style='font-size:2em;'></i></span>"+
								   "</div>";
					
					$("#pic_list").append(template);
					      
				 }else{
					    var ERR = "<span class='red'>"+data.message+"</span>";
					    $("[name=pic_list]").after(ERR);
				 }
			}
			
			
			
		}
	})
	
	
	
	
	
}














var App = {};
$(function(){
	
	App.bproduct= new businessProduct();
	
	App.ce = new CalenderEditor();
})