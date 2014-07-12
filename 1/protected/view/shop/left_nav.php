
<div class="panel panel-default navbar-panel">
    <div class="panel-heading">
      <h4 class="panel-title">
      	我是商家
      </h4>
    </div>
    <div class="panel-body">
    	<h4><a href="#">商家信息</a></h4>
    	<ul class="nav nav-stacked left-menu">
	
			<li <?=($nav_index == 'shop_enter') ? 'class="active"' : '' ?>>
				<a href="/shopEnter/" >
					<i class="icon-yen"></i>
					商家资料
				</a>
			</li>
			<li  <?=($nav_index == 'shop_home') ? 'class="active"' : '' ?>>
				<a href="/shop/product" >
					<i class="icon-yen"></i>
					商家首页
				</a>
			</li>
		</ul>
    
    	<h4><a href="#">活动管理</a></h4>
    	<ul class="nav nav-stacked left-menu">
	
			<li <?php if($nav_index == 'product_add'){ echo 'class="active"'; }?> >
				<a href="/shop/product_add" >
					<i class="icon-yen"></i>
					新增活动
				</a>
			</li>
			<li  <?php if($nav_index == 'product_list'){ echo 'class="active"'; }?>>
				<a href="/shop/product" >
					<i class="icon-yen"></i>
					已发布活动
				</a>
			</li>
			<li  <?php if($nav_index == 'product_pending'){ echo 'class="active"'; }?>>
				<a href="/shop/product_pending" >
					<i class="icon-yen"></i>
					审核中活动
				</a>
			</li>		
			
		</ul>
    	<h4><a href="#">订单管理</a></h4>
    	<ul class="nav nav-stacked left-menu">
	
			<li  <?php if($nav_index == '2_2'){ echo 'class="active"'; }?>>
				<a href="/shop/product" >
					<i class="icon-yen"></i>
					新增订单
				</a>
			</li>
			<li  <?php if($nav_index == '2_2'){ echo 'class="active"'; }?>>
				<a href="/shop/product" >
					<i class="icon-yen"></i>
					交易中订单
				</a>
			</li>
			<li  <?php if($nav_index == '2_2'){ echo 'class="active"'; }?>>
				<a href="/shop/product" >
					<i class="icon-yen"></i>
					完成订单
				</a>
			</li>			
			
		</ul>	
		<h4><a href="#">我的消息</a></h4>
    	<ul class="nav nav-stacked left-menu">	
			<li  <?php if($nav_index == '2_2'){ echo 'class="active"'; }?>>
				<a href="/shop/product" >
					<i class="icon-yen"></i>
					消息列表
				</a>
			</li>			
			
		</ul>			
		
    </div>
</div>  

