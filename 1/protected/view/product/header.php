<?php 
$THEME_URL = host_url()."/static";
?>

<!DOCTYPE html>
<html>
<head>
<meta name="generator" content="SAE at <?php echo date("Y-m-d h:i:s"); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title?></title>


<link href="<?=$THEME_URL ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">	
<link rel="stylesheet" href="<?=$THEME_URL ?>/css/font-awesome.min.css">
<link rel="stylesheet" href="<?=$THEME_URL ?>/css/home/item.css">

</head>
<body>

<script src="<?=$THEME_URL ?>/js/jquery/jquery-1.9.1.min.js"></script>
<script src="<?=$THEME_URL ?>/js/bootstrap/bootstrap.min.js"></script>
<script src="<?=$THEME_URL ?>/js/bootstrap/bootstrap-validation.js"></script>
<script>
$('.dropdown-toggle').dropdown();
</script>

<div class="header">
    <div class="container">
            
                <ul class="nav nav-pills">
                  <li><a href="/">首页</a></li>  
                
                  <li><a href="/shopEnter">商家入驻</a></li>  
                  
                  
                  <li class="dropdown" index="1">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                           <i class="icon-question-sign" style="font-size:1.3em;color:black"></i>&nbsp;帮助 <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu pull-right">
                              <li><a href="#"><i class="icon-user"></i> &nbsp;联系我们</a></li>
                              <li><a href="#"><i class="icon-question-sign"></i> &nbsp;常见问题</a></li>
                              <li style="border:none"><a href="#"><i class="icon-phone"></i> &nbsp;客服</a></li>
                        </ul>
                  </li>
                  
                  <?php 
                      if ($shop){
                  ?>
                           <li class="dropdown" index="2">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                               <i class="icon-user" style="font-size:1.3em;color:black"></i>&nbsp;<?=$nick?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                  <li><a href="/shop/"><i class="icon-lock"></i> &nbsp;商家</a></li>
                                  <li><a href="/shop/tourist"><i class="icon-user"></i> &nbsp;游客</a></li>
                                  <li><a href="/shop/message"><i class="icon-lock"></i> &nbsp;消息</a></li>
                                  <li><a href="/shop/setting"><i class="icon-user"></i> &nbsp;设置</a></li>
                                  <li><a href="/user/logout"><i class="icon-user"></i> &nbsp;退出</a></li>
                                  
                            </ul>
                         </li>
                  

                  
                  <?php 
                      }else{
                  ?>  
                  
                  
                        <li class="dropdown" index="2">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                               <i class="icon-user" style="font-size:1.3em;color:black"></i>&nbsp;注册 <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                  <li><a href="/user/login"><i class="icon-lock"></i> &nbsp;登录</a></li>
                                  <li><a href="/user/register"><i class="icon-user"></i> &nbsp;注册</a></li>
    
                            </ul>
                         </li>
                 <?php } ?> 
                  
                </ul>
    </div>
    
</div>