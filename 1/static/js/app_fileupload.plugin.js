/**调用方式
 * file:上传按钮
 * settings:参数对象
 * 		bucket,return_url
 * 		callback(status,file){}
 * $(file).uploadfile(settings)
 * 
 * 
 */

function TaodianCMS(proxy_url){
    this.proxy_url = proxy_url;
}

TaodianCMS.prototype.call = function(param, cb){
    $.post(this.proxy_url, param, cb);
}

var TC = new TaodianCMS("/api/get_upyun_key");

!function ($,TC){
	$.fn.uploadfile = function(settings) {
		// 传进来的settings对象与已知的对象合并成新的settings
		settings = jQuery.extend( 
				   {
						bucket: 'jilv1',
						allow_file_type : "jpg,jpeg,gif,png",
						content_length_range:'1024,5120000',
						image_width_range:'0,5600',
						image_height_range:'0,10240',
						save_key: "/jilv/{year}_{mon}_{day}/jilv_{hour}{min}{sec}{.suffix}",
						return_url: 'http://'+window.location.host+'/api/upload_callback/jilv1',
						callback: function(e){} 
				    }, settings
		);
		
		//当前上传按钮对象
		var jQueryMatchedObj = this;
		
		function _upload_callback(status, file){
			$(file.parents("form")[0]).find(".uploading").hide();
			settings.callback(status, file);
		};
		
		if(!$.__file_upload_iframe_index){
			$.__file_upload_iframe_index = 100;
		}
	
		jQueryMatchedObj.each(function(){
			if(!$(this).attr("name")){
				$(this).attr("name", "file01");
			}
			var file = $(this);
			$.__file_upload_iframe_index++;
			var _form = $("<form target='upload_frame_" + $.__file_upload_iframe_index + "' action='http://v0.api.upyun.com/" + 
				settings.bucket + "/'" +
				"method='post' enctype='multipart/form-data'>" + 
				"<input class='policy' type='hidden' name='policy' value=''>" + 
				"<input class='signature' type='hidden' name='signature' value=''>" +
				"<div class='help-inline uploading' style='display:none;color:red'>上传中...</div>"+
				"</form>");
			var tmp = $(this).replaceWith(_form);
			_form.append(tmp);
			
			var _iframe = $("<iframe class='upload_frame' name='upload_frame_" + $.__file_upload_iframe_index
				+  "' src='' style='display: none'></iframe>");
			_iframe.load(function(){
				var s = $(this).contents().find('body').text();
				var status = $.parseJSON(s);
				//
				var aa = typeof(status);
				//console.log("xx:" + aa);
				if(status){
					_upload_callback(status, file);
				}				
			});
			
			$("body").append(_iframe);
		});
	
		/*
			修改一个文件内容。
		*/
		function _start(){
			start_upload($(this));
		};
		
		function start_upload(file){
			var form = $(file.parents("form")[0]);		
			if(file.val()){
				form.find(".uploading").text("图片上传中……");
				form.find(".uploading").show();

				
				TC.call(settings,function(data){
					
					if(data.status == 'ok'){
						form.find(".policy").val(data.policy);
						form.find(".signature").val(data.sign);
						form.submit();
					}else {
						form.find(".uploading").text("上传图片出错。没有得到上传授权码。");
					}
				})
			}
		};
	
		//先取消上个change绑定事件，再执行新的change事件
		return this.unbind('change').change(_start);
	};
}(window.jQuery,TC);