<?php

class SimpleCache {
    var $backend = 'mysql';
    var $c = null;
    var $prefix = '';
    function __construct($backend='mysql', $table='cache_table', $prefix='') {
        if($backend == 'mysql'){
            $this->c = new MysqlCache($table);
        }else if($backend == 'sae'){
		    $this->c = new SAECache($table);
		}
		
		/*
		if($_SERVER['HTTP_APPVERSION'] > 0){
			$prefix = "{$prefix}_{$_SERVER['HTTP_APPVERSION']}";
		}
		*/
		$this->prefix = $prefix;
    }
    
    /**
    * 从缓存中取一个数据, 如果数据过期或没有找到返回null;
    */
    function get($key){
        $key = $this->prefix . $key;
        return $this->c->get_cache($key);
    }
     
    /**
    * 保存数据到缓存。
    * @param $key -- 数据保存的key
    * @param data -- php 能够序列化的array，或简单数据。
    * @param expire -- 缓存时间， 单位秒.
    */
    function set($key, $data, $expire=86400){
        $key = $this->prefix . $key;
        return $this->c->set_cache($key, $data, $expire);
    }
	
    function add($key, $data, $expire=86400){
        $key = $this->prefix . $key;
        return $this->c->add_cache($key, $data, $expire);
    }	

    /**
    */
    function set_file($key, $data){
        $path = SITE_ROOT . "/_st/$key";   
        file_put_contents($path, $data);
        $url = "http://" . $_SERVER ["HTTP_HOST"] . "/apps/_st/" .$key;
        return $url;
    }

    function get_file($key){
        $path = SITE_ROOT . "/_st/$key";
        return file_get_contents($path);
    }

    function remove_file($key){
        $path = SITE_ROOT . "/_st/$key";
        unlink($fileName);
    }

}

/**
* 使用Mysql数据库作为缓存的后端。
* 表结构:
* 1.  cache_id varchar(64)
* 2.  data longtext()
* 3.  expired_date datetime();
*/
class MysqlCache {
    var $mysql;
    var $cache_table;
    function __construct($table) {
        $this->mysql = new db_mysql();
        $this->mysql->connect(DB_HOST, DB_USER, DB_PW, DB_NAME, DB_PCONNECT, DB_CHARSET);
        $this->cache_table = $table;
        if(!SETUP_APP){
            $this->_create_app_table();
        }
    }

    function get_cache($key){
        $sql = "select data, UNIX_TIMESTAMP(expired_date) as expired_stamp from " . $this->cache_table . " where cache_id='$key'";
        $obj = $this->mysql->get_one($sql);
        $data = '';
        if($obj && is_array($obj)){
            if($obj['expired_stamp'] < time()){
                return null;
            }else {
                $data = unserialize($obj['data']);            
            }
        }
        return $data;
    }
    
    
    function set_cache($key, $data, $expire){
        $sql = 'delete from ' . $this->cache_table . " where cache_id='$key'";
        $re = $this->mysql->query($sql);
        #$this->mysql->free_result($re);
        
        $s_data = serialize($data);
        $expired_time = time() + $expire;
        $expired = "FROM_UNIXTIME('$expired_time')";
        
        $sql = "insert into " . $this->cache_table . "(cache_id, data, expired_date) values('$key', '$s_data', $expired)";
        $re = $this->mysql->query($sql);

        return $data;
    } 

    private function _create_app_table(){
            $table_list = $this->mysql->table_list();
            if(!in_array($this->cache_table, $table_list)){
                $table_name = $this->cache_table;
                $create_sql = <<<END
CREATE TABLE `$table_name` (
  `cache_id` varchar(64) NOT NULL,
  `data` text,
  `expired_date` datetime DEFAULT NULL,
   PRIMARY KEY (`cache_id`),
   index(expired_date)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
END;
                $re = $this->mysql->query($create_sql);
                if(!$re){
                    die("failed to execute sql '${create_sql}'\n" . mysql_error());
                }
            }
   }
}

?>
