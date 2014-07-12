<?php
	$begin_time = microtime();
	if($_REQUEST['debug'] == 'true'){
		define('DEBUG',TRUE);
		if(function_exists('sae_set_display_errors')){
			sae_set_display_errors(TRUE);
		}
		ini_set('display_errors', 1);		
		define('SETUP_APP', 0);
	}else {
		define('DEBUG', FALSE);
		if(function_exists('sae_set_display_errors')){
			sae_set_display_errors(FALSE);
		}
		ini_set('display_errors', 0);
	}
	
	$host = $_SERVER['HTTP_HOST'];
	$n = explode(".", $host);
	if($n[0] > 1000 && $n[0] < 9999){
		header("location: http://s8.mty5.com/m/{$n[0]}.html");
		return;
	}
	
		
	function session_start_new(){
		if(define("OPNED", 1)){
			if(isset($_GET['view']) && $_GET['view'] == 'html'){
				session_cache_limiter('');
				header("Cache-Control: max-age=600");
			}
			$host = $_SERVER['HTTP_HOST'];
			if(preg_match("/s\d+\.m\./", $host) > 0){
				ini_set("session.cookie_domain", $host);
			}
			session_start();
		}
	}
	
	//open the output buffer, otherwise can't change the header info.
	ob_start ();
	//session_start();
	
	//xhprof —— facebook 搞的一个测试php性能的扩展
	define('XHPROF', FALSE);
	if(XHPROF){
		sae_xhprof_start();
	}
	//定义YunPHP的类库的路径
	$dir_yunphp = 'YunPHP';
	$dir_protected = 'protected';
	
	//决定是否让系统使用memcache,
	define('USE_MEM',TRUE);
	
	//定义量目录，DOCROOT为项目的目录，YUNPHP为系统目录
	define('WEBROOT',realpath(dirname(__FILE__)));
	define('YUNPHP',WEBROOT.'/'.$dir_yunphp.'/');
	define('DOCROOT',WEBROOT.'/'.$dir_protected.'/');
	
	
	/* 过滤函数 */
	//整型过滤函数
	function get_int($number)
	{
		return intval($number);
	}
	//字符串型过滤函数
	function get_str($string)
	{
		if (!get_magic_quotes_gpc()) {
			return addslashes($string);
		}
		return $string;
	}
	
	/* 过滤所有GET过来变量 */
	foreach ($_GET as $get_key=>$get_var)
	{
		if (is_numeric($get_var)) {
			$_GET[$get_key] = get_int($get_var);
		} else {
			$_GET[$get_key] = get_str($get_var);
		}
	}
	
	/* 过滤所有POST过来的变量 */
	foreach ($_POST as $post_key=>$post_var)
	{
		if (is_numeric($post_var)) {
			$_POST[$post_key] = get_int($post_var);
		} else {
			$_POST[$post_key] = get_str($post_var);
		}
	}	
	
	define('RUNTIME','saemc:/');
	require_once 'YunPHP/main.php';
	if(XHPROF){
		sae_xhprof_end();
	}
	
	$end_time = microtime();
	$escaped_time = $end_time - $begin_time;
//	echo "escaped time $escaped_time";
	