
<div class="panel panel-default navbar-panel">
    <div class="panel-heading">
      <h4 class="panel-title">
      	商家管理
      </h4>
    </div>
    <div class="panel-body">
    	<h4><a href="#">商家审核</a></h4>
		<ul class="nav nav-stacked left-menu">
		    	<li  <?php if($nav_index == 'shop_list'){ echo 'class="active"'; }?>>
				<a href="/admin/shop_list">
					<i class="icon-group"></i>
					商家列表
				</a>
			</li>
			
			<li  <?php if($nav_index == 'product_list'){ echo 'class="active"'; }?>>
				<a href="/admin/product_list" >
					<i class="icon-yen"></i>
					产品列表
				</a>
			</li>
			
		</ul>
	</div>
</div>	
