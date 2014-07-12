<?php
class TaoDian{
    private $api_route = 'http://fmei.sinaapp.com/api/route';
    private $app_id = 0;
    private $app_secret = 0;

	public function __construct($app_id, $app_secret, $api_route=null) {
		$this->app_id = $app_id;
		$this->app_secret = $app_secret;
		$this->mmc = memcache_init();
		$this->mm_cache = array();
		
		if($api_route){
			$this->api_route = $api_route;
		}
	}   
    
    public function __call($name, $arguments){
		$api_args = $arguments[0];
		$cache_time = $arguments[1];
		$as_array = $arguments[2];
		
		if(DEBUG){
			echo "api:{$name} cache time:{$cache_time}\n";
		}
		
		if($cache_time > 0){
			$cache_key = $this->_cache_keys($name, $arguments);

			$data = $this->get_cache($cache_key);
			if(!$data || $_REQUEST['no_cache'] == 'y'){
				$data = $this->_api_call($name, $api_args, $as_array);
				$this->set_cache($cache_key, $data, $cache_time * 60);
			}else{
				if(DEBUG){
					echo "hit api result from cache, key:{$cache_key}\n";
				}
			}
		}else {
			$data = $this->_api_call($name, $api_args, $as_array);
		}
		
		return $data;
		
    }
	
	private function _cache_keys($name, $arguments){
		$arg = md5(var_export($arguments, true));
		return "ck_{$name}_{$arg}";
	}

	function get_cache($key){
		$v = $this->mm_cache[$key];
		if($v) return $v;
		
		if($this->mmc){
			$v = memcache_get($this->mmc, $key);
			$this->mm_cache[$key] = $v;
		}else {
			return false;
		}
		return $v;		
	}
	
	function set_cache($key, $data, $expire){
		$this->mm_cache[$key] = $data;
		
		if($this->mmc){
			memcache_set($this->mmc, $key, $data, 0, $expire);
		}
	}	
		
	
	private function _api_call($name, $args, $as_array){
        $post_data = array(name=>$name, app_id=>$this->app_id, );
        
        $stamp = date("YmdHis");
        $sign = md5("{$this->app_id},{$stamp},{$this->app_secret}");
        $param = json_encode($args);
        
        $post_data['time'] = $stamp;
        $post_data['sign'] = $sign;
        $post_data['params'] = $param;
        
        try{
            $reps = $this->curl_fetch($this->api_route, $post_data);
            if(DEBUG){
                echo "remote api, name:$name, api: $name\n param:{$param}\n cache key:{$cache_key} \n response:$reps";
            }
        }catch(Exception $e){
            if(DEBUG){
                echo "remote api error:\n" . $e;
            }
            $reps = '""';
        }
        $data = json_decode($reps, $as_array==true);
        
        return $data;		
	}

    private function curl_fetch($url, $postFields = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        

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
            throw new Exception(curl_error($ch),0);
        }
        else
        {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode)
            {
                throw new Exception($reponse,$httpStatusCode);
            }
        }
        curl_close($ch);
        return $reponse;
    }
}

?>