$(".price_items .show_more").click(function(e){
	event.preventDefault();
	
	var detail = $(this).parent().parent().find(".price_detail");
	if($(this).hasClass("expaned")){
		detail.hide();
		$(this).removeClass("expaned");
	}else {
		$(this).addClass("expaned");
		show_detail(detail, $(this).attr("iid"));
	}
	
});

$(".item_thumbs a").click(function(e){
	event.preventDefault();
	
	$("#main_pic").attr('src', $(this).find('img').attr("src"));
});


function show_detail(container, iid){
	container.show();
	container.load("/product/load_price_item/" + iid, {}, function(){
		container.find('.price_calender').on('mouseenter', "td", function(){
			if($(this).hasClass("t")) return;
			
			var r = $(this).find(".day");
			
			$(this).addClass("t");
			var p = r.attr("remain");
			
			var tips = p > 0 ? "成人价:" + r.attr("adult") + "，儿童价:" + r.attr("child") + "，库存:" + r.attr("remain") : "不能预订";
						
			$(this).tooltip({'placement': 'top', 
				'title': tips,
				'container':'body'}
			).tooltip('show');
		});	
		
		container.find('.price_calender').on('click', "td", function(){
			container.find('.price_calender td .cur').removeClass("cur");
			
			var day = $(this).find(".c"); 
			if(day.find(".day").attr('remain') > 0){
				day.addClass("cur");
				/**
				 * 更新输入框价格，和从新计算总价。
				 */
				
				var curDay = day.find(".day");
				
				container.find(".price_form .adult_price").text(curDay.attr("adult"));
				container.find(".price_form .child_price").text(curDay.attr("child"));
				
				computer_total_price(container);
			}
		});	
		
		container.find('.price_calender').on('click', "a", function(){
			event.preventDefault();
			var month = $(this).attr('month');
			var item_id = container.find('.price_calender').attr("item_id");
			$("#price_calender_" + item_id).load("/product/load_calendar/?item_id=" + item_id + "&start=" + month);
		});

		container.on('change', "input", function(){
			computer_total_price(container);
		});
		
	});
	
}

/**
 * 计算一个面板里面的总价。因为一个商品会展开多个价格方案。只选择一个方案计算价格。
 */
function computer_total_price(container){
	var ap = container.find(".price_form .adult_price").text();
	var cp = container.find(".price_form .child_price").text();
	
	var ac = container.find(".price_form [name=adult_count]").val();
	var cc = container.find(".price_form [name=child_count]").val();
	
	var total = ap * ac + cp * cc;
	
	container.find(".price_form .total_price").text(total + "");
}




