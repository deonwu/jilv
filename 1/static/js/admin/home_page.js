function save_home_page_file(url){
	
}

$("#main_file").uploadfile({
		bucket:'jilv-ad', 
		return_url: 'http://'+window.location.host+'/api/upload_callback/jilv-ad',
		callback: function(data, file){
			if(typeof(data) == 'object'){
				if(data.code == '200'){
					$.post("/adminFront/save_home_pic", data, function(d){
						$.show_ok("文件保存成功，刷新页面后显示。");
					}, 'json');
				}
			}
}});

$("#main_pic_table .action a").click(function(){
	var active = 0; 
	if($(this).hasClass("active")){
		active = 1;
	}else if($(this).hasClass("remove")){
		active = 9;		
	}
	var row = $(this).parents('tr')[0];
	
	$.post("/adminFront/update_home_pic", {'active': active, 'pid': $(this).parent().attr('pid')},
			function(e){
		$.show_ok("操作成功");
		if(row && active == 9){
			$(row).hide();
		}		
	}, 'json');
	
});


function CateFilterEditor(container, data_list, add_btn, settings){
	var that = this;
	
	that.editor = $(container);
	that.settings = settings;
	
	$(add_btn).click(function(){
		that.editor.modal('show');
	});
	
	$(data_list).on("click", ".action a", function(data){
		var row = $($(this).parents('tr')[0]);
		
		var btn = $(this);
		if($(this).hasClass('edit')){		
			that.edit_item(row);
		}else if($(this).hasClass('item_show')){		
			$.post("/adminFront/update_cate_status", {'active': 1, 'pid':row.attr("pid")}, 
					function(data){
					if(data.status == 'ok'){
						row.addClass("success");
						btn.removeClass("item_show");
						btn.removeClass("item_hide");
						btn.text("暂停发布");
					}else {
						$.show_err("数据操作错误");
					}
				}, 'json');			
		}else if($(this).hasClass('item_hide')){		
			$.post("/adminFront/update_cate_status", {'active': 0, 'pid':row.attr("pid")}, 
					function(data){
					if(data.status == 'ok'){
						row.removeClass("success");
						btn.removeClass("item_hide");
						btn.removeClass("item_show");
						btn.text("发布");
					}else {
						$.show_err("数据操作错误");
					}
				}, 'json');			
		}
		else if($(this).hasClass('remove')){
			$.post("/adminFront/update_cate_status", {'active': 9, 'pid':row.attr("pid")}, 
				function(data){
				if(data.status == 'ok'){
					row.hide();
				}else {
					$.show_err("数据操作错误");
				}
			}, 'json');
		}
	});
	
	container.find("[name=file]").uploadfile({
		bucket:'jilv1', 
		return_url: 'http://'+window.location.host+'/api/upload_callback/jilv1',
		callback: function(data, file){
			if(typeof(data) == 'object'){
				if(data.code == '200'){
					that.upload_file(data);
				}
			}
	}});
	
	container.find(".save_btn").click(function(){
		that.save_item();
	});
	
}


CateFilterEditor.prototype.add_new = function(){
	this.cur_id = 0;
	
	this.editor.find("[name=cate_label]").val();
	this.editor.find("[name=cate_value]").val();
	this.editor.find("[name=view_order]").val('1');
	
	this.editor.find(".preview").hide();	
}

CateFilterEditor.prototype.save_item = function(){
	
	var param = {cate_label:this.editor.find("[name=cate_label]").val(),
				 cate_value:this.editor.find("[name=cate_value]").val(),
				 view_order:this.editor.find("[name=view_order]").val(),
				 pic_url:this.editor.find(".preview").attr("src"),
				 cid: this.cur_id
			    };
	param.page_view = this.settings.page_view;
	param.cate_type = this.settings.cate_type;
	
	var that = this;
	$.post("/adminFront/save_cate_filter", param, function(data){
		//console.log(data);
		if(data.status == 'ok'){
			that.editor.modal("hide");
			$.show_ok("文件保存成功，刷新页面后显示。");
		}
	}, 'json');
	
}

CateFilterEditor.prototype.edit_item = function(row){
	this.cur_id = row.attr("pid");
	this.editor.modal('show');	
	
	this.editor.find("[name=cate_label]").val(row.find('td:eq(2)').text().trim());
	this.editor.find("[name=cate_value]").val(row.find('td:eq(3)').text().trim());

	this.editor.find("[name=view_order]").val(row.attr('view_order'));

	this.editor.find(".preview").attr("src", row.find('img').attr("src"));
	this.editor.find(".preview").show();
}

CateFilterEditor.prototype.upload_file = function(data){
	this.editor.find(".preview").attr("src", data.url);
	this.editor.find(".preview").show();
}

var a = new CateFilterEditor($("#myDestEditor"), $("#dest_list_table"), $("#add_dest_filter"),
		{'page_view': 'home', 'cate_type': 'dest'});

var b = new CateFilterEditor($("#myTopicEditor"), $("#topic_list_table"), $("#add_topic_filter"),
		{'page_view': 'home', 'cate_type': 'product_type'});



