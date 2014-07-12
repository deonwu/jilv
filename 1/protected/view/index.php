<?php 
$THEME_URL = host_url()."/static";
?>

<!DOCTYPE html>
<html>
<head>
<meta name="generator" content="SAE at <?php echo date("Y-m-d h:i:s"); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>极旅</title>

<link href="<?=$THEME_URL ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">	
<link rel="stylesheet" href="<?=$THEME_URL ?>/css/font-awesome.min.css">
		
<script src="<?=$THEME_URL ?>/js/jquery/jquery-1.9.1.min.js"></script>

</head>
<body>



<div class="container" style="text-align:center">
    <h3>this is yunPHP framwork and Html template</h3>
    
    <div>
        <h5>上传图片测试</h5>
        <input type="file" name="file" style="display: block;margin-left: auto;margin-right: auto;width:90px">
        <img src="" title=""/>
        <p class="err"></p>        
    </div>
</div>


<script src="<?=$THEME_URL ?>/js/app_fileupload.plugin.js"></script>
<script>
$("input[name=file]").uploadfile({
	callback: function(data){


		if(typeof(data) == 'object'){
			 if(data.code == '200'){
			        $("img").attr("src",data.url+"!190");
			        $("img").attr("title",data.url);
			 }else{
				    $(".err").text(data.message);
			 }
		}
		
	}
})
</script>












<script type="text/javascript" language="javascript" src="<?=$THEME_URL ?>/js/js_loader.php?ver=<?=$_REQUEST['ver'] ?>&group=<?=$js_group ?>&no_cache=<?=$_REQUEST['no_cache']?>&zl=<?=$_REQUEST['zl']?>&br=<?=$_REQUEST['br']?>"></script>

<style>
.footer{
	text-align: center;
    margin: 5px 0;
}

.footer a{
	font-size: 14px;
    color: #ccc;
    padding-bottom: 10px;
    text-align: center;
    display: block;
    text-shadow: 0 1px 0 #fff;
    font-family: Helvetica,Arial,sans-serif;
    line-height: 15px;
    text-decoration: none;
}

</style>

<div class="footer">
    <a href="http://m.mty5.com/app/code/4001178~serve" title="猫头鹰移动营销">
    由 猫头鹰 提供技术支持
    </a>
</div>


</body>
</html>





</body>
</html>			
			