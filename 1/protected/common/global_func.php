<?php

/**
 *对字符串中需要加转义的字符加"\" 
 * 
 */
function new_addslashes($string) {
	if (! is_array ( $string ))
		return addslashes ( $string );
	foreach ( $string as $key => $val )
		$string [$key] = new_addslashes ( $val );
	return $string;
}
/**
 * 去掉转义字符
 * 例："abc\'efg" 会被处理成 "abc'efg"
 */
function new_stripslashes($string) {
	if (! is_array ( $string ))
		return stripslashes ( $string );
	foreach ( $string as $key => $val )
		$string [$key] = new_stripslashes ( $val );
	return $string;
}

/**
 * 
 * 中文截取字符串
 * @param unknown_type $start 开始位置 0 
 * @param unknown_type $length 结束位置  0：表示到字符串结尾
 * @param unknown_type $string 需要被截取的字符串
 */
function cn_substr($start, $length, $string) {
	$str_length = strlen ( $string ); //字符串的字节数
	$string = str_replace ( array ('&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;' ), array (' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…' ), $string );
//	if ($str_length <= $length) {
//		return $string;
//	}
	$s = cn_strpos($string, $start);
	$e = cn_strpos($string, $start+$length);
	return substr($string, $s,$e-$s);
}

/**
 * 
 * 定位中文字符串位置
 * @param unknown_type $string
 * @param unknown_type $pos
 */
function cn_strpos($string,$pos){
	$i = 0;
	$n = 0;
	$str_length = strlen ( $string ); 
	if (strtolower ( CHARSET ) == 'utf-8') {
		while ( ($n < $pos) and ($i <= $str_length) ) {
			$temp_str = substr ( $string, $i, 1 );
			$ascnum = Ord ( $temp_str ); //得到字符串中第$i位字符的ascii码
			if ($ascnum == 252 || $ascnum == 253) {
				$i = $i + 6; //实际Byte计为6
				$n ++; //字串长度计1
			} else if (248 <= $ascnum && $ascnum <= 251) {
				$i = $i + 5; //实际Byte计为5
				$n ++; //字串长度计1
			} else if (240 <= $ascnum && $ascnum <= 247) {
				$i = $i + 4; //实际Byte计为4
				$n ++; //字串长度计1
			} else if ($ascnum >= 224) //如果ASCII位高与224，
			{
				$i = $i + 3; //实际Byte计为3
				$n ++; //字串长度计1
			} elseif ($ascnum >= 192) //如果ASCII位高与192，
			{
				$i = $i + 2; //实际Byte计为2
				$n ++; //字串长度计1
			} elseif ($ascnum >= 65 && $ascnum <= 90) //如果是大写字母，
			{
				$i = $i + 1; //实际的Byte数仍计1个
				$n ++; //但考虑整体美观，大写字母计成一个高位字符
			} else //其他情况下，包括小写字母和半角标点符号，
			{
				$i = $i + 1; //实际的Byte数计1个
				$n = $n + 1; //
			}
		}
		return $i;
	} else {
		return $pos;
	}
}


function fixed_length($msg, $length){
	$start = 0;
	$labelArr = array();
	do{
		unset($tmp);
		$tmp = cn_substr($start, $length, $msg);
		$labelArr[] = $tmp;
		$start+=$length;
	}while($tmp);
    return join("\n", $labelArr);
}


function writeover($filename, $data, $method = "rb+", $iflock = 1, $check = 1, $chmod = 1) {
	$check && strpos ( $filename, '..' ) !== false && exit ( 'Forbidden' );
	touch ( $filename );
	$handle = fopen ( $filename, $method );
	if ($iflock) {
		flock ( $handle, LOCK_EX );
	}
	fwrite ( $handle, $data );
	if ($method == "rb+")
		ftruncate ( $handle, strlen ( $data ) );
	fclose ( $handle );
	$chmod && @chmod ( $filename, 0777 );
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function get_post_data(){
	$raw_data = file_get_contents('php://input');
	$data = array();
	
	#explode("\n", $this->get('app_keys'))
	foreach(explode("&", $raw_data) as $item){
		list($k, $v) = explode("=", $item, 2);
		$v = urldecode($v);
		if(!isset($data[$k])){
			$data[$k] = $v;
		}else if(is_array($data[$k])){
			array_push($data[$k], $v);
		}else {
			$tmp = array($data[$k], $v);
			$data[$k] = $tmp;
		}
	}
	
	return $data;
}

function parse_url_data($raw_data){
	$data = array();
	
	#explode("\n", $this->get('app_keys'))
	foreach(explode("&", $raw_data) as $item){
		list($k, $v) = explode("=", $item, 2);
		if(!isset($data[$k])){
			$data[$k] = $v;
		}else if(is_array($data[$k])){
			array_push($data[$k], $v);
		}else {
			$tmp = array($data[$k], $v);
			$data[$k] = $tmp;
		}
	}
	
	return $data;
}


function curl_fetch($url, $postFields = null)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FAILONERROR, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	if (is_array($postFields) && 0 < count($postFields))
	{
		$postBodyString = "";
		$postMultipart = false;
		foreach ($postFields as $k => $v)
		{
			if("@" != substr($v, 0, 1))//判断是不是文件上传
			{
				$postBodyString .= "$k=" . urlencode($v) . "&"; 
			}
			else//文件上传用multipart/form-data，否则用www-form-urlencoded
			{
				$postMultipart = true;
			}
		}
		unset($k, $v);
		curl_setopt($ch, CURLOPT_POST, true);
		if ($postMultipart)
		{
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		}
		else
		{
			curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
		}
	}
	$reponse = curl_exec($ch);
	
	if (curl_errno($ch))
	{
		//throw new Exception(curl_error($ch),0);
        if(DEBUG){
            echo "error curl code:" . curl_error($ch);
        }
	}
	else
	{
		$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if (200 !== $httpStatusCode)
		{
            if(DEBUG){
                echo "error http code:{$httpStatusCode}";
            }
			//throw new Exception($reponse,$httpStatusCode);
		}
	}
	curl_close($ch);
	return $reponse;
}

function getip() {
	if (isset ( $_SERVER )) {
		if (isset ( $_SERVER ['HTTP_X_FORWARDED_FOR'] )) {
			$aIps = explode ( ',', $_SERVER ['HTTP_X_FORWARDED_FOR'] );
			foreach ( $aIps as $sIp ) {
				$sIp = trim ( $sIp );
				if ($sIp != 'unknown') {
					$sRealIp = $sIp;
					break;
				}
			}
		} elseif (isset ( $_SERVER ['HTTP_CLIENT_IP'] )) {
			$sRealIp = $_SERVER ['HTTP_CLIENT_IP'];
		} else {
			if (isset ( $_SERVER ['REMOTE_ADDR'] )) {
				$sRealIp = $_SERVER ['REMOTE_ADDR'];
			} else {
				$sRealIp = '0.0.0.0';
			}
		}
	} else {
		if (getenv ( 'HTTP_X_FORWARDED_FOR' )) {
			$sRealIp = getenv ( 'HTTP_X_FORWARDED_FOR' );
		} elseif (getenv ( 'HTTP_CLIENT_IP' )) {
			$sRealIp = getenv ( 'HTTP_CLIENT_IP' );
		} else {
			$sRealIp = getenv ( 'REMOTE_ADDR' );
		}
	}
	return $sRealIp;
}

function sub_string($str, $len, $charset="utf-8"){
	//如果截取长度小于等于0，则返回空
	if( !is_numeric($len) or $len <= 0 ){
		return "";
	}
	//如果截取长度大于总字符串长度，则直接返回当前字符串
	$sLen = strlen($str);
	if( $len >= $sLen ){
		return $str;
	}
	//判断使用什么编码，默认为utf-8
	if ( strtolower($charset) == "utf-8" ){
		$len_step = 3; //如果是utf-8编码，则中文字符长度为3
	}else{
		$len_step = 2; //如果是gb2312或big5编码，则中文字符长度为2
	}
	//执行截取操作
	$len_i = 0; //初始化计数当前已截取的字符串个数，此值为字符串的个数值（非字节数）
	$substr_len = 0; //初始化应该要截取的总字节数
	for( $i=0; $i < $sLen; $i++ ){
		if ( $len_i >= $len ) break; //总截取$len个字符串后，停止循环
		//判断，如果是中文字符串，则当前总字节数加上相应编码的中文字符长度
		if( ord(substr($str,$i,1)) > 0xa0 ){
			$i += $len_step - 1;
			$substr_len += $len_step;
		}else{ //否则，为英文字符，加1个字节
			$substr_len ++;
		}
		$len_i ++;
	}
	$result_str = substr($str,0,$substr_len );
	return $result_str;
}


function get_header_html($notice){

    $header_html=<<<END
<div id='output' 
style='min-height:200px;display:block;background-color: ivory;
padding:10px;position:absolute;top:50%;'><br/><br/>
<p style='color:red'>*****************
*********************$notice******************
*********************</p><br/>
END;
    
    return $header_html;
    
}


function get_footer_html($notice){
    $footer_html=<<<HTML
<br/><p style='color:red'>*****************
*********************$notice***************
************************</p>
HTML;
    return $footer_html;
}


function get_content_html($array){
    $content_html = get_content_string_html($array);
    
    if (!$content_html){
        $content_html = get_content_array_html($array);
    }
    
    return $content_html;
    
}

function get_content_string_html($array){
    
    if (!$array){
        $content_html=<<<HTML
<p style='color:green'>**************当前数组为空**************</p></div>
HTML;
        return $content_html;
    }
    
    $type_out = (is_array($array) || is_object($array)) ? 1:0;
   
    if (!$type_out){
        $content_html=<<<HTML
<p style='color:red'>String</p><p style='color:red'>
(</p><p style='color:green;margin-left:30px;'>$array</p><p style='color:red'>)</p>
HTML;
        return $content_html;
    }
    
    return false;
    
}

function get_content_array_html($array){

    $type_name = is_array($array) ? '二维数组':'';
    $type_name = is_object($array) ? '二维对象数组':'';

    $content1 = "<h5>$type_name</h5><p style='color:red'>Array</p><p style='color:red'>(</p>";
            
    foreach ($array as $k=>$field){
    
         if (!is_array($field)){
    
            $content2 = "<p style='color:blank;margin-left:70px;'>";
            $content2.="<strong>[$k]</strong>";
            $content2.="&nbsp;&nbsp;=> &nbsp;&nbsp;$field</p>";

         } else {

            $content2 = "<p style='color:green'>";
            $content2.= "<strong style='margin-left:20px;'>[$k]=> Array</strong>";
            $content2.= "</p><p style='color:green;margin-left:70px;'>(</p>";

            foreach ($field as $f=>$n){
    
                if (is_array($n)){

                    $data = array();
                    foreach($n as $key=>$value)
                    {
                        if (is_array($value)){
                            $data[$key] = $value;
                        }else{
                            $data[$key] = urlencode($value);
                        }

                    }

                    $n = urldecode(json_encode($data));
                }
    
                $content2.="<p style='color:black;margin-left:90px;'>";
                $content2.="<strong>[$f]&nbsp;&nbsp;=> &nbsp;&nbsp;$n";
                $content2.="<span style='color:red'>";
                $content2.="(此字段是被json_encode之后的打印信息,其实是数组)</span>";
                $content2.="</strong></p>";
    
             }
    
             $content2.="<p style='color:green;margin-left:70px;'>)</p>";
    
         }
            
    }
    
    $content_html = $content1.$content2;
    return $content_html;
    
}

function print_array($notice,$array,$is_exit = true){
    
    header("Content-type: text/html; charset=utf-8");
    $notice = $notice ? $notice :'数组信息';
   
    $header_html = get_header_html($notice);
    $footer_html = get_footer_html($notice);
    
    $content_html = get_content_html($array);
    
    echo $header_html;
    echo $content_html;
    echo $footer_html;
   
    if ($is_exit){
        exit();
    }

}
    
/**
 * 
 * @param  $setting
 * 此方法需要phpinfo配置里面 xmlwriter enable
 * 
 */
function load_PHPExcel($setting = array()){
    header("Content-Type: text/html; charset=utf-8");
    $root = WEBROOT.'/protected/helper/';
    
    require_once $root.'PHPExcel/PHPExcel.php';
    $objPHPExcel = new PHPExcel();
//     //设置文档基本属性
//     if ($setting){
        
//         $objProps = $objPHPExcel->getProperties();
//         $objProps->setCreator($setting['creator']);//创建者
//         $objProps->setLastModifiedBy($setting['modifyer']);//修改者
//         $objProps->setTitle($setting['title']);//标题
//         $objProps->setSubject($setting['subject']);//主题
//         $objProps->setDescription($setting['description']);//备注
//         $objProps->setKeywords($setting['keywords']);//标记
//         $objProps->setCategory($setting['Category']);  //类别     
        
//     }
    
    //报错，找不到XMLWriter
    require_once $root.'PHPExcel/PHPExcel/IOFactory.php';
    //指定版本为Excel 2007
//     require_once $root.'PHPExcel/PHPExcel/Reader/Excel2007.php';

    return $objPHPExcel;
    
    
}

/**
 * 写入数据
 * @param $data Array
 * 单元格Column是以0开始的,row是以1开始的
 * $setting['save_dir']保存目录
 * $setting['excel_name'] 保存文件名
 */    
function import_excel($setting,$data){
    $name = isset($setting['name']) ? $setting['name'] :'未命名';
    
    $objPHPExcel = load_PHPExcel($setting);
    $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(16);//設置單元格寬度
//     $objPHPExcel->getActiveSheet()->setTitle($name);//設置當前工作表的名
    //创建新的工作表
    $objPHPExcel->createSheet();
    //设置第一个内置表（一个xls文件里可以有多个表）为活动的
    $objPHPExcel->setActiveSheetIndex(0); 
    
    $i = 0;
    $r = 2;
    foreach ($data as $key=>$item){

         if (is_array($item)){
             
             if ($key == 0){
                 foreach ($item as $k=>$v){
                     $keyfields[] = $k;
                 }
                 
                 for ($j=0;$j<count($item);$j++){
                     //第一行
                     $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j, 1, $keyfields[$j]);
                 }
                 
             }
             
             foreach ($item as $t=>$m){
                 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($t, $r, $m);
             }
             
             $r++;

         } else {

             if (!is_numeric($key)){
                 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, 1, $key);
                 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, 2, $item);
                 
                 $i++;
             }else{
                 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $key+1, $item);
             }
        }
        
    }
    
    $excelName = 'Excel_'.date("YmdHis").'.xls';//設置導出excel的文件名
    $excelName = $setting['excel_name'] ? $setting['excel_name']:$excelName;
    $dir = WEBROOT.'/static/excel/';
    $dir = $setting['save_dir']?$setting['save_dir']:$dir;
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
    $objWriter->save($dir.$excelName);//保存文件

//     $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//     $objWriter->save($dir.$excelName);//保存文件
}

/**
 * 读出数据
 * @param $setting['file_path']
 * 
 */
function export_excel($setting){
    $objReader = PHPExcel_IOFactory::createReader ( 'Excel2007' );
    $objReader->setReadDataOnly ( true );
    
    if (!$setting['file_path']){
        return false;
    }
    
    $objPHPExcel = $objReader->load ($setting['file_path']);
    /**读取excel文件中的第一个工作表*/
    $objWorksheet = $objPHPExcel->getSheet (0);
    
    //取得excel的总行数
    $highestRow = $objWorksheet->getHighestRow ();
    //取得excel的总列数
    $highestColumn = $objWorksheet->getHighestColumn ();
    
    //格式化列,转换为数字索引
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString ( $highestColumn );
    $excelData = array ();
           
    if ($highestColumn == 1){
        for ($row = 1;$row<=$highestRow;$row++){
            $excelData[] = $objWorksheet->getCellByColumnAndRow ( 0, $row )->getValue ();
        }
        
        return $excelData;
    }
    
    //获取第一行作为key
    
    $keyfields = array();
    for ($col = 0;$col<=$highestColumn;$col++){
        $keyfields[] = $objWorksheet->getCellByColumnAndRow ( $col, 1 )->getValue ();
    }
    

    for($row = 2; $row <= $highestRow; $row++) {
        for($col = 0; $col < $highestColumnIndex; $col++) {
            $excelData[$row-2][$keyfields[$col]] = $objWorksheet->getCellByColumnAndRow ( $col, $row )->getValue ();
        }
    }
    
    return $excelData;
    
}

/**
 * 转换字符串内容
 */
function convertUTF8($string){
    if(empty($string)) return '';
    return  iconv('gb2312', 'utf-8', $str);
}



?>
