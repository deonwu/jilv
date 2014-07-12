!function ($) {
	function Toast(){
		var that = this;
		$("#msgbox").remove();
		//<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		var box="<div id='msgbox' class='modal succeed fade in'><div class='modal-dialog'><div class='modal-content'>" +
			"<div class='modal-body'>" +		
			"	<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>" +
			"	<p class='info'>内容</p>" +
			"</div></div></div></div>";
		$('body').append($(box));		
		this.model = $("#msgbox");
	};

	Toast.prototype.show = function(msg_type, title, msg, time, callback){
		this.model.removeClass("succeed");
		this.model.removeClass("error");
		this.model.addClass(msg_type);
		
		this.model.find(".info").html(msg);
		this.model.modal({});
		
		if(time > 0){
			var that = this;
			setTimeout(function(){
				that.model.modal('hide');
				if(callback){callback();}
			}, time);
		}
	};
	
	Toast.prototype.setConfirmBox = function(msg){
		var box="<div id='msgbox' class='modal notice fade'><div class='modal-dialog'><div class='modal-content'>" +
		"<div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>" +
		"<h4>提示</h4></div>" +
		"<div class='modal-body'>" +
		"<p class='info'>"+msg+"</p>" +
		"</div><div class='modal-footer'>" +
		"<a href='javascript:;' class='btn btn-default cancel_choose' data-dismiss='modal' aria-hidden='true' >取消</a>" +
		"<a href='javascript:;' class='btn btn-primary confirm_choose' >确定</a>" +
		"</div></div></div></div>";
		
		this.init_box(box);
	}
	
	Toast.prototype.init_box = function(box){
		$("#msgbox").remove();
		$('body').append($(box));		
		this.model = $("#msgbox");
	}
	
	var toast = null; 
	$.show_error = function(msg, time, callback){
		if(!toast){toast = new Toast();}
		return toast.show("error", '', msg, time, callback);
	};
	
	$.show_ok = function(msg, time, callback){
		if(!toast){toast = new Toast();}
		return toast.show("succeed", '', msg, time, callback);
	};
	
	$.show_confirm = function(msg, callback){
		if(!toast){toast = new Toast();}
		
		toast.setConfirmBox(msg);
		
		toast.model.modal("show");
		
		$("#msgbox").on("click", ".confirm_choose", function(){
			toast.model.modal("hide");
			$("#msgbox").remove();
			$(".modal-backdrop").hide();
			callback();
			
		});

	}
	

	
}(window.jQuery);
