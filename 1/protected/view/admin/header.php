<!DOCTYPE html>
<html>
<head>
<meta name="generator" content="SAE at <?php echo date("Y-m-d h:i:s"); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title?></title>
<link href="<?=$THEME_URL ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="/static/css/font-awesome.min.css">
<link rel="stylesheet" href="/static/css/shop/base.css">

<script src="<?=$THEME_URL ?>/js/jquery/jquery-1.9.1.min.js"></script>
<script src="<?=$THEME_URL ?>/js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript">
<?php
echo "var S='" . json_encode ( $admin_user ) . "';";
?>

$('.header-user .dropdown-toggle').dropdown();
</script>

</head>
<body>


<div class="header">


<nav class="navbar navbar-default" role="navigation">
  <div class="collapse navbar-collapse navbar-ex1-collapse">
  
  <div class="container">
    <ul class="nav navbar-nav">
              <li>
					<a href="/">
						<i class="icon-bar-chart"></i>
						<span>首页</span>
					</a>
				</li>
				
				<li <?=$nav_main == 'shop'? "class='active'":""?>>
					<a href="/admin/shop_list">
						<i class="icon-comments"></i>
						<span>商家管理</span>
					</a>
				</li>
				
				<li <?=$nav_main == 'member'? "class='active'":""?>>
					<a href="/adminMember/">
						<i class="icon-book"></i>
						<span>游客管理</span>
					</a>
				</li>
				
				
				<li <?=$nav_main == 'front'? "class='active'":""?>>
					<a href="/adminFront/">
						<i class="icon-globe"></i>
						<span>前端管理</span>
					</a>
				</li>
				
				<li class="nav-separator"></li>
				<li>
					<a href="/weixin/help">
						<i class="icon-question-sign"></i> 
					</a>
				</li>
				<li>
					<a href="#feedback" data-toggle="modal">
						<i class="icon-envelope"></i>
					</a>
				</li>
				<li class="nav-separator"></li>
				

       
    </ul>
    </div>
    
    
    
    <div class="pull-right btn-group header-user">
			<a class="btn btn-success" href="#">
				<i class="icon-user"></i> <?=$admin_user['user_nick'] ? $admin_user['user_nick'] :"未登录" ?></a>
			<a class="btn btn-success dropdown-toggle" data-toggle="dropdown"
				href="#">
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li>
					<a href="/user/logout">
						<i class="icon-off"></i>
						退出
					</a>
				</li>
			</ul>

		</div>
    
  </div>
</nav>

<div id="feedback" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width: 700px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">×</button>
				<h4>联系我们</h4>
			</div>
			<div class="modal-body">
				
			</div>
		</div>
	</div>
</div>



</div>