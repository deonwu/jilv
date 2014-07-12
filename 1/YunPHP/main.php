<?php defined('YUNPHP') or exit('can not access!');

	$uri = explode("?", $_SERVER['REQUEST_URI']);
	$uri = $uri[0];
	#$uri = explode('.', $uri);
	#$uri = $uri[0];
	
	$uri = str_replace(".html", "", $uri);
	if(preg_match("/\.html/", $_SERVER['REQUEST_URI']) > 0){
		define('HTML_VIEW', 1);
		header("Cache-Control: max-age=600");
	}else {
		define('HTML_VIEW', 0);
	}	

	if(isset($_SERVER['HTTP_X_WX_UUID']) && $_SERVER['HTTP_X_WX_UUID']){
		$extra_uri = $_SERVER['HTTP_X_WX_UUID'];
	}else {
		list($uri, $extra_uri) = explode("~", $uri, 2);
		if($extra_uri){
			setcookie("YUN_THEMES", $extra_uri, null, "/");
		}else {
			//$extra_uri = $_COOKIE['YUN_THEMES'];
		}
	}		
		
	include_once (YUNPHP.'core/Autoloader.class.php');
	include_once (YUNPHP.'core/YunPHP.class.php');
	include_once (YUNPHP.'core/Hook.class.php');	
	include_once (YUNPHP.'core/Action.class.php');
	include_once (YUNPHP.'core/Module.class.php');
	include_once (YUNPHP.'core/common.php');
	
	require_once(YUNPHP.'lib/Configure.class.php');
	require_once(YUNPHP.'lib/Log.class.php');
	require_once(YUNPHP.'lib/Db.class.php');
	require_once(YUNPHP.'lib/SAECache.class.php');
	require_once(YUNPHP.'lib/Router.class.php');
	
	define('DIR_ACTION',DOCROOT.'action/');
	define('DIR_MODULE',DOCROOT.'module/');
	define('DIR_VIEW',DOCROOT.'view/');
	
	set_exception_handler('my_exception_handler');
	
	$autoloader = new Autoloader();
	$autoloader->init();
	
	Configure::load('config');
	
	$RTR = new Router($uri);
	
	
	$uri_argvs = $RTR->getUriArgvs();
	$class  = $RTR->getClass();
	$method = $RTR->getMethod();
	$action = ucfirst($class);
	$action = $action.'Action';
		
	include_once (DIR_ACTION."$action.class.php");

	if(!class_exists($action)){
		throw new Exception("404 $action not exist!");
	}
	
	$app = new $action();
	if($extra_uri){
		$extra_uri = explode(".", $extra_uri);
		$extra_uri = $extra_uri[0];
		list($platform, $style) = explode("-", $extra_uri, 2);
	}
	
	$platform = isset($platform) ? $platform:'';
	$style = isset($style) ? $style:'';
	
	
	$app->platform = $platform ? $platform : "common";
	$app->style = $style ? $style : "default";
	define('PLATFORM', $app->platform);
	define('STYLE', $app->style);
// 	if(DEBUG){
// 		echo "platform:{$app->platform}, style:{$app->style}\n";
// 	}
    
    if(method_exists($app, "hook_start_request")){
        $r = call_user_func_array(array($app, "hook_start_request"), array($method));
        if($r === false){
        	return;
        }
    }
    
// 	$pm = "${method}_${platform}";
    if (isset($platform) && $platform){
        $pm = $method."_".$platform;
    }
	
	if(isset($pm) && method_exists($app, $pm)){
		call_user_func_array(array($app, $pm), array_slice($uri_argvs,2));
	}else {
		call_user_func_array(array($app, $method), array_slice($uri_argvs,2));
	}
	
//this is the end of the main.php