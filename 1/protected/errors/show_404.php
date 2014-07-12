<?php if(!DEBUG) {
	//header("location: /");
	//return;
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<h1 style="text-align: center">对不起，您访问的页面不存在！</h1>
	<div style=" background: #f7f7f7; border:#666; padding:15px; text-align:center;">
		<a href="#" onclick="history.back()">返回</a> <a href="/">回到首页</a>
	</div>	
<script>
document.write(location.href);
</script>
</body>
</html>
