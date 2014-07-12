<?php
ob_start ();
define('JSROOT', realpath(dirname(__FILE__)));

if(!function_exists('memcache_init')){
	function memcache_init(){
		return memcache_connect("127.0.0.1");
	}
}

include_once "jsloader/JSLoader.php";

/*

0 -- 已经压缩过的JS文件，只需要直接输出就可以了。
1 -- 原始文件，需要进行压缩。
*/
$common = array(
	array(  "TaodianSdk.js", 
			"app_dailog.js",
			),
	array( "json2.js")
);

$group = array(
	
	'business_enter' => array(array("bootstrap/bootstrap-validation.js", "app_fileupload.plugin.js",'shop/business_enter.js')),
	'business_product' => array(array("bootstrap/bootstrap-validation.js", "app_fileupload.plugin.js",'shop/business_product.js')),
	'admin_shop' => array(array("bootstrap/bootstrap-validation.js","app_fileupload.plugin.js",'admin/shop_list.js')),
	'admin_product' => array(array("bootstrap/bootstrap-validation.js","app_fileupload.plugin.js",'admin/product_list.js')),

	'admin_home' => array(array("bootstrap/bootstrap-validation.js","app_fileupload.plugin.js", 'admin/home_page.js')),
		
		
);

$l = new JSLoader(JSROOT, $common, $group);

$app_root_path = "{$_SERVER['DOCUMENT_ROOT']}/protected/apps";

if(!is_dir($app_root_path)){
	$app_root_path = dirname(dirname(JSROOT)) . "/protected/apps";	
}

if($_REQUEST['debug'] == 'true'){
	echo "root:{$app_root_path}\n";
}

$l->set_app_root_path($app_root_path); 

if($_REQUEST['clean'] == 'y'){
	$l->clean_cache();
}else {
	$l->load();
}
?>