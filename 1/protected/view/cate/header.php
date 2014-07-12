<?php 
$THEME_URL = host_url()."/static";
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=1">
	
<meta name="generator" content="SAE at <?php echo date("Y-m-d h:i:s"); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title?></title>

<link rel="stylesheet" href="<?=$THEME_URL ?>/css/bootstrap.min.css" media="screen">	
<link rel="stylesheet" href="<?=$THEME_URL ?>/css/font-awesome.min.css">
<link rel="stylesheet" href="<?=$THEME_URL ?>/css/home/index.css">
<link rel="stylesheet" href="<?=$THEME_URL ?>/css/home/cate_list.css">

</head>
<body>

<script src="<?=$THEME_URL ?>/js/jquery/jquery-1.9.1.min.js"></script>
<script src="<?=$THEME_URL ?>/js/bootstrap/bootstrap.min.js"></script>
<!-- 
<script src="<?=$THEME_URL ?>/js/bootstrap/bootstrap-validation.js"></script>
 -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="container"> 
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

    <a class="navbar-brand td-logo" href="/" target="_blank">
		<img src="/static/img/logo.png">
	</a>
  </div>
  
 <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav" id='head_nav'>
       <li>
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="icon-home"></i>
				<span>目的地</span>
				<span class="caret">
			</a>
			<div class="dropdown-menu jilv-head-nav-menu">
				<div class="row">
		         	<ul class="col-xs-3 col-md-3 list-unstyled">
		               <li><a href="/shop/">亚洲：</a></li>
		               <li><a href="/shop/tourist"><i class="icon-user"></i> &nbsp;香港</a></li>
		               <li><a href="/shop/message"><i class="icon-lock"></i> &nbsp;泰国</a></li>                                  
		               <li><a href="/shop/tourist"><i class="icon-user"></i> &nbsp;香港</a></li>
		               <li><a href="/shop/message"><i class="icon-lock"></i> &nbsp;泰国</a></li>                                  
		               
		           </ul>
		         	<ul class="col-xs-3 col-md-3 list-unstyled">
		               <li><a href="/shop/">非洲：</a></li>
		               <li><a href="/shop/tourist"><i class="icon-user"></i> &nbsp;香港</a></li>
		               <li><a href="/shop/message"><i class="icon-lock"></i> &nbsp;泰国</a></li>                                  
		               
		               <li><a href="/shop/tourist"><i class="icon-user"></i> &nbsp;香港</a></li>
		               <li><a href="/shop/message"><i class="icon-lock"></i> &nbsp;泰国</a></li>                                  
		           </ul>
		         	<ul class="col-xs-3 col-md-3 list-unstyled">
		               <li><a href="/shop/">欧洲：</a></li>
		               <li><a href="/shop/tourist"><i class="icon-user"></i> &nbsp;香港</a></li>
		               <li><a href="/shop/message"><i class="icon-lock"></i> &nbsp;泰国</a></li>                                  
		           </ul>
	           </div>
           </div>
           					
	   </li>
		<li>
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="icon-comments"></i>
				<span>热门活动</span>
				<span class="caret">
			</a>
			<div class="dropdown-menu jilv-head-nav-menu">
				<div class="row">
					<a href="#" class="col-xs-3 col-md-3">潜水</a>
					<a href="#" class="col-xs-3 col-md-3">游泳</a>
					<a href="#" class="col-xs-3 col-md-3">登山</a>
					<a href="#" class="col-xs-3 col-md-3">潜水</a>
					<a href="#" class="col-xs-3 col-md-3">游泳</a>
					<a href="#" class="col-xs-3 col-md-3">登山</a>
					<a href="#" class="col-xs-3 col-md-3">潜水</a>
					<a href="#" class="col-xs-3 col-md-3">游泳</a>
					<a href="#" class="col-xs-3 col-md-3">登山</a>					
				</div>
			</div>
		</li>
	</ul>
	<script>
	$("#head_nav .dropdown-toggle").mouseenter(function(e){
		$(this).dropdown('toggle');
	});
		//$("").on("");
	</script>
  
    <ul class="user_info_nav nav navbar-nav">
	   <li>
			<a href="/index/welcome_shop">
				<i class="icon-comments"></i>
				<span>商家入驻</span>
			</a>
	   </li>
		    
       <li class="dropdown" index="2">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
               <i class="icon-user" style="font-size:1.3em;color:black"></i>帮助 <span class="caret"></span>
          </a>
          <ul class="dropdown-menu ">
               <li><a href="/shop/"><i class="icon-lock"></i> &nbsp;联系我们</a></li>
               <li><a href="/shop/tourist"><i class="icon-user"></i> &nbsp;常见问题</a></li>
               <li><a href="/shop/message"><i class="icon-lock"></i> &nbsp;客服：</a></li>                                  
           </ul>
        </li>
        <?php if($shop){?>
		<li>
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
               <i class="icon-user" style="font-size:1.3em;color:black"></i><?=$nick?> <span class="caret"></span>
          </a>
          <ul class="dropdown-menu ">
               <li><a href="/shop/"><i class="icon-lock"></i> &nbsp;我是游客</a></li>
               <li><a href="/shop/"><i class="icon-lock"></i> &nbsp;我是服务商</a></li>
               <li><a href="/shop/message"><i class="icon-lock"></i> &nbsp;退出</a></li>                                  
           </ul>		
		</li>
		<?php } else {?>
        <li>
			<a href="/user/login">
				<i class="icon-comments"></i>
				<span>登录</span>
			</a>        
        </li>
        <li>
			<a href="/user/register">
				<i class="icon-comments"></i>
				<span>注册</span>
			</a>        
        </li>        
		<?php }?>
	</ul>
    </div>
  
   
    
</div>
</nav>
<div class='clearfix' style='margin-top:50px;'></div>
