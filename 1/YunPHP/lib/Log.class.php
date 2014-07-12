<?php defined('YUNPHP') or exit('can not access!');
	/**
	 * YunPHP4SAE php framework designed for SAE
	 *
	 * @author heyue <heyue@foxmail.com>
	 * @copyright Copyright(C)2010, heyue
	 * @link http://code.google.com/p/yunphp4sae/
	 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
	 * @version YunPHP4SAE version 1.0.2
	 */
	class Log {
		public static $log_place ='';
		public static $log_table = '';
		public static $log_write_level = '';
		public static $level = array();
		
		/**
		 * 打日志的函数，静态函数，可以直接调用
		 * system app debug
		 * @param unknown_type $level
		 * @param unknown_type $message
		 */
		public static function write_log($level='ERROR',$message){
			self::$level = array('ERROR' => '1', 'INFO' => '2', 'DEBUG' => '3',   'ALL' => '4');
			self::$log_write_level = Configure::getItem('log_write_level','config');
			if(self::$log_write_level >= self::$level[$level]){
		
				self::$log_place = Configure::getItem('log_place','config');
				if(self::$log_place == 'sae'){
					sae_debug("$message");
				}else if (self::$log_place == 'mysql'){
				
					self::$log_table = Configure::getItem('log_table','config');
					$log_time = date('Y-m-d H:i:s');
					$log_table = self::$log_table;
			
					import_class('Db');
					$db = new Db();
					
					$sql = "INSERT INTO `$log_table` (`id` ,`level` ,`log_time` ,`msg`)VALUES (NULL , '$level', '$log_time', '$message')";
					if($db->run_sql($sql)){
						return true;
					}else{
						throw new Exception("Log ==>can't write log in mysql,please create a table <b>self::$log_table</b> in your database !");
					}
				}else{
					throw new Exception("Log ==>".self::$log_place."can only be 'sae' or 'mysql'!");
				}
			}else{
				return false;
			}
		}
		
		/**
		 * 显示日志
		 */
		public static function show_log(){
			$log_table = Configure::getItem('log_table');
			$sql = "select * from $log_table order by id desc";
			import_class('Db');
			$db = new Db();
			$data = $db->get_data($sql);
			$i = 1;
			foreach ($data as $val) {
				echo $val['id'].'    '.$val['level'].'   '.$val['log_time'].'    '.$val['msg']."<br/>";
				if($i%5 == 0){
					echo "<hr style='color:#f7f7f7;margin:10px;'/>";
				}
				$i++;
			}
			
		}
	}
	
?>