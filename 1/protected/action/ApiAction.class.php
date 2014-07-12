<?php
	
	class ApiAction extends Action{
		public function __construct(){
			parent::__construct();

		}

		
		/**
		 * bucket变化时,return-url变化,form-api_secret也要变化
		 * upyun使用：接口地址:http://v0.api.upyun.com  获取签名的地址
		 * @param bucket  空间名称
		 *        save-key 图片路径 ...
		 *    空间唯一对应的表单API验证密钥格式：    
		 *    $signature = md5($policy.'&'.$form_api_secret); 
		 */
				
		public function get_upyun_key() {
		    $result = array (
		            status => 'ok'
		    );
		    
		    $policyfileds = array(
		         'bucket',
		         'save-key',
		         'allow­file­type',
		         'return-url',
		         'content­length­range',
		         'image-width-range',
		         'image-height-range'                    
		     );
		    $policydoc = array();
		    foreach ($policyfileds as $field){
		        
		        $post_field = str_replace("-","_",$field);
		        if ($_REQUEST[$post_field]){
		            $policydoc[$field] = $_REQUEST[$post_field];
		        }
		    }
		    
		    $policydoc[expiration] = time () + 60 * 5;	
		    
		    if (DEBUG){
		        var_dump("policydoc:",$policydoc);
		    }
		    
		    
		    $json = json_encode($policydoc);
		    $policy = base64_encode($json);	    
		    
		    //该form_secret为bucket名称为tdcms的密钥
		    
		    //'mobile01'=>'I0JDwnOqh2XDexNSbopvcQjwv+I=',
		    $keys = array(
		    			  'jilv-ad'=>'CMzI/chbxO8IOAZre6xCF9JPujM=',
		    			  'jilv1'=>'7mxUKjTbY+raXpjSytLSyjN6obU=',
		    			  'jishop'=>'5kwwnhvxYv+ocjs8iZUcMMvcgKc='
		    		);
		    
		    $form_api_secret =  $keys[$_POST['bucket']];
		    
		    $sign = md5 ( "{$policy}&{$form_api_secret}" );
		
		    $result['json'] = $json;
		    $result ['policy'] = $policy;
		    $result ['sign'] = $sign;
		
		    header ( 'Content-type: application/json' );
		    $this->json ( $result );
		}
		
		
		
		public function upload_callback($bucket) {
		    header ( 'Content-type: text/plain; chartset=utf8' );
		
		    $data = array (
		            code => $_REQUEST ['code'],
		            message => $_REQUEST ['message'],
		            url => "http://{$bucket}.b0.upaiyun.com" . $_REQUEST ['url'],
		            image_width => $_REQUEST ['image-width'],
		            image_height => $_REQUEST ['image-height']
		    );
		
		    $this->json ( $data );
		}
		
		
		
	}
?>