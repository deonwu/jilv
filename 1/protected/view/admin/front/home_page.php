<?php V('admin/header.php');?>

	<div class = "col-lg-12 clearfix" style="padding:0px;">

		 <div class = "col-lg-2 col-md-2 sidebar-nav" style="padding:0px;">
		            <?php V('admin/front/left_nav.php');?>
		 </div >
		        		        
	      <div class = "col-lg-10 col-md-10" >
			<ul class="nav nav-tabs" id="mytab">
			  <li class="active"><a href="#main_pic" data-toggle="tab">首页焦点图</a></li>
			  <li><a href="#topic" data-toggle="tab">热门主题</a></li>
			  <li><a href="#dest" data-toggle="tab">热门目的地</a></li>
			</ul>		      
	         <div id="myTabContent" class="tab-content">
	            <div class="tab-pane fade active in" id="main_pic">
	                  <?php include 'home_page_tab_main.php';?>
	            </div>
	            
	            <div class="tab-pane fade" id="topic">
	                  <?php include 'home_page_tab_topic.php';?>
	            </div>
	            
	            <div class="tab-pane fade" id="dest">
	                  <?php include 'home_page_tab_dest.php';?>
	            </div>
	        
	      	</div>			
			
	      </div>
<script>
$('#myTab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
})
</script>
	      		      
	</div>

<?php V('admin/footer.php');?>