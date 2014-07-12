<?php include 'header.php';?>



<div class="body" style="">

    <div class="cover top_images" style="background-image: url('/static/img/location_img.jpg');">
        <div class="container" >
                <div class="register_tips text-center">
                        <h4>极旅网-在线旅游O2O平台</h4>
                        <div>免费为您敞开推广中国市场大门线上精准营销，线下汇聚客流。</div>
                        <div>
                        	<?php if($shop['id'] > 0) {?>
                        		<a href="/shop/" class="btn btn-success">&nbsp;&nbsp;进入后台&nbsp;&nbsp;</a>                        		
                        	<?php } else {?>
                        	<a href="/user/register" class="btn btn-success">&nbsp;&nbsp;免费注册&nbsp;&nbsp;</a>
                        	&nbsp;
                        	或
                        	<a href="/user/login">登录</a>
                        	<?php }?>
                        </div>                
                </div>
        </div>
    
    
    </div>
    
    <div class="container">
	    <div class="panel panel-default" style="margin-top:20px;">
	    	<div class="panel-body">
	    	<h4>为什么选择极旅</h4>
	    		<div class='row'>
		    		<div class="col-xs-6 col-md-4 clearfix">
		    			<h1>免费入住</h1>
		    			<div>为你敞开中国市场大门</div>
					</div>
		    		<div class="col-xs-6 col-md-4 clearfix">
		    			<h1>流程简便</h1>
		    			<div>入驻简便，半天即可开通账户</div>
					</div>
		    		<div class="col-xs-6 col-md-4 clearfix">
		    			<h1>简单易用</h1>
		    			<div>零技术投入，零维护成本</div>
					</div>
		    		<div class="col-xs-6 col-md-4 clearfix">
		    			<h1>功能强大</h1>
		    			<div>界面美观一分钟发布活动</div>
					</div>
		    		<div class="col-xs-6 col-md-4 clearfix">
		    			<h1>完全开放</h1>
		    			<div>推广自身品牌，树立良好口碑</div>
					</div>
		    		<div class="col-xs-6 col-md-4 clearfix">
		    			<h1>精准推广</h1>
		    			<div>轻松获取海量目标用户</div>
					</div>
				
				</div>
	    	</div>
	    </div>
	
	    <div class="panel panel-default">
	    	<div class="panel-body">
	    	
	    	<h4>入驻流程</h4>
		    	<div class="shop_follow nav-justified text-center">
		    		<div class="col-xs-6 col-md-3">
			    	<span class="label label-success">注册/登录账户</span> 	    	
			    	<i class="icon-arrow-right"></i>
			    	</div>

		    		<div class="col-xs-6 col-md-3">			    	
			    	<span class="label label-success">提交资料信息</span> 
			    	<i class="icon-arrow-right"></i>
			    	</div>

		    		<div class="col-xs-6 col-md-3">			    				    	
			    	<span class="label label-success">等待审核</span> 
			    	<i class="icon-arrow-right"></i>
			    	</div>
			    	
			    	<div class="col-xs-6 col-md-3">
			    	<span class="label label-success">通过审核，发布活动</span> 
			    	</div>
		    	</div>
	    	</div>
	    </div>
	    
	    <div class="well">
	    	<h4>谁可以加入</h4>
	    	<div>极旅网汇聚来自世界各地本地服务商</div>
	    	<div>服务活动包括，旅行度假，景点，活动，夜生活，表演及演出，城市通卡，户外探险，水上活动，票吴，租车，保险等</div>
	    	<div>如果您不能明确您是否适合极旅，尽请联系我们，我们将竭诚为您解答。联系方式: bd@jilvtrip.com</div>
	    	
	    </div>
    
    </div>
    
</div>









<?php include 'footer.php';?>		
			