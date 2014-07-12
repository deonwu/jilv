	<div class="product_info">
    
         <ul class="nav nav-tabs" id="mytab">
                  <li class="active"><a href="#detail" data-toggle="tab">详细信息</a></li>
                  <li><a href="#user_discuss" data-toggle="tab">顾客讨论</a></li>
         </ul>
         
         
         <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="detail">
            	<div> 
            		<?=$item['description']?>
            	</div>
            </div>
            
            <div class="tab-pane fade" id="user_discuss">
            	<div>
            		用户讨论信息
            	</div>
            </div>
            <script>
		$('#myTab a').click(function (e) {
			  e.preventDefault()
			  $(this).tab('show')
		})
		</script>
      </div>
           
                
   </div>