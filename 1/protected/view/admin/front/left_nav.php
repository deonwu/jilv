<div class="panel panel-default navbar-panel">
    <div class="panel-heading">
      <h4 class="panel-title">
      	前端管理
      </h4>
    </div>
    <div class="panel-body">
    	<h4><a href="#">首页管理</a></h4>
		<ul class="nav nav-stacked left-menu">
		    	<li  <?php if($nav_index == 'home_page'){ echo 'class="active"'; }?>>
				<a href="/adminFront/home_page">
					<i class="icon-group"></i>
					首页配置
				</a>
			</li>
			
			<li  <?php if($nav_index == 'product_list'){ echo 'class="active"'; }?>>
				<a href="/adminFront/product_list" >
					<i class="icon-yen"></i>
					导航页面
				</a>
			</li>
			
		</ul>
	</div>
</div>