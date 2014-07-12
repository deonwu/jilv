<?php

	if(IN_QCLOUD == 'true'){
		$config['app_id'] = '85';
		$config['app_secret'] = '4817cd2363cf5aa828940695482528d3';
		$config['user_domain'] = 'http://m.mty5.com';
		$config['wx_api_domain'] = "wx.mty5.com";	
		$config['market_id'] = '24';
	}else {
		$config['app_id'] = '51';
		$config['app_secret'] = 'efca4eb89432d23696458ad132d43fc8';
		$config['user_domain'] = 'http://m.mty365.com';		
		$config['wx_api_domain'] = "wx.mty365.com";	
		$config['market_id'] = '23';
		$config['market_url'] = 'http://www.mty365.com';	
	}
	
	if(isset($_SERVER['HTTP_X_C_HOST']) && $_SERVER['HTTP_X_C_HOST']){
		$config['user_domain'] = "http://{$_SERVER['HTTP_X_C_HOST']}";
		$config['wx_api_domain'] = "{$_SERVER['HTTP_X_C_HOST']}";		
	}
	if(isset($_SERVER['HTTP_X_WC_HOST']) && $_SERVER['HTTP_X_WC_HOST']){
		$config['wx_api_domain'] = "{$_SERVER['HTTP_X_WC_HOST']}";
	}
	
	
	$config['api_route'] = 'http://api.zaol.cn/api/route';

	
	$config['weibo_app_id'] = '64';
	$config['weibo_app_secret'] = '722cc7f35ed32df61cf766b228a94891';
	
