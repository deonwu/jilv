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
	class Db extends SaeMysql {
		
		public function __construct($do_replicaton=true){
			parent::__construct(false);
		}
		
		/**
		 * 通过主键获取数据
		 *
		 * @param unknown_type $table
		 * @param unknown_type $id
		 * @return unknown
		 */
		public function getById($table,$id){
			if($table == ''|| $id == ''){
				if(DEBUG){
					throw new Exception("Error == > Parameter Error!");
				}
				@Log::write_log('ERROR',"Table $table  is empty or $id is null");
				return false;
			}
			$sql = "select * from $table where id = $id";
			
			$res = $this->get_line($sql);
			return $res;
		}
		/**
		 * 删除单条记录
		 *
		 * @param 表名 $table
		 * @param 主键 $id
		 * @return 
		 */
		public function delById($table,$id){
			if($table == ''|| $id == ''){
				if(DEBUG){
					throw new Exception("Error ==> Parameter Error!");
				}
				@Log::write_log('ERROR',"Table $table  not empty or $id is null");
				return false;
			}
			$sql = "delete from $table where id = $id";
			$this->run_sql($sql);
			if($this->errno() != 0){
				if(DEBUG){
					throw new Exception("Sql Error ==> $sql");
				}
				@Log::write_log("Sql Error ==> $sql ");
				return false;
			}else{
				return true; 
			}
		}
		/**
		 * 插入一条数据
		 *
		 * @param 表名 $table
		 * @param 要插入的数组 $data
		 * @return unknown
		 */
		public function insertData($table, $data=array(), $debug=false){
			if($table == '' || !is_array($data)){
				if(DEBUG){
					throw new Exception("Error ==> Paramter Error!");
				}
				@Log::write_log('ERROR',"Parameter error!");
				return false;
			}		
			
			$keys = '';
			$values = '';
			foreach ($data as $k => $v){
				$keys .=" `$k` ,";
				if(strpos($k, "_time") && is_numeric($v) && !strpos($k,"_times")){ #;$k == 'update_time'
 					$values .= " FROM_UNIXTIME($v) ,";
				}else if("{$v}" == 'timestamp'){
					$values .= " UNIX_TIMESTAMP() ,";
				}else {
					$values .= " '$v' ,";	
				}				
			}
			$keys = substr($keys,0,-1);
			$values = substr($values,0,-1);
		
			$sql = "INSERT INTO `$table` ($keys) VALUES ($values)";
			
			if(DEBUG || $_REQUEST['state'] == 'test'|| $debug){
				//var_dump(""$sql);
				echo "sql:" . $sql;
			}
			$this->run_sql($sql);
			
			$errno = $this->errno();
			if($errno != 0){
				if(DEBUG){
					throw new Exception("error:($errno)" . $this->error () . "\nSql Error ==> $sql");
				}
				@Log::write_log("Sql Error == >$sql");
				return false;
			}else{
				return true;
			}
			
		}
		
		/**
		 * 插入一条数据
		 *
		 * @param 表名 $table
		 * @param 要插入的数组 $data
		 * @return unknown
		 */
		public function insertOrUpdate($table, $data = array(), $ignore = array(), $extra='') {
			if ($table == '' || ! is_array ( $data )) {
				if (DEBUG) {
					throw new Exception ( "Error ==> Paramter Error!" );
				}
				@Log::write_log ( 'ERROR', "Parameter error!" );
				return false;
			}
		
			$keys = '';
			$values = '';
		
			$fields = array ();
			foreach ( $data as $k => $v ) {
				$keys .= " `$k` ,";
				if (strpos ( $k, "_time" ) && is_numeric($v)) { // $k == 'update_time'
					$values .= " FROM_UNIXTIME($v) ,";
				} else {
					$values .= " '$v' ,";
				}
				if (! in_array ( $k, $ignore )) {
					$fields [] = "`$k` = VALUES(`$k`)";
				}
			}
		
			$keys = substr ( $keys, 0, - 1 );
			$values = substr ( $values, 0, - 1 );
		
			$sql = "INSERT INTO `$table` ($keys) VALUES ($values)";
			$sql = $sql . " ON DUPLICATE KEY UPDATE " . join ( ",", $fields ) . $extra;
		
			$this->run_sql ( $sql );
					
			if(DEBUG){
				echo "sql=>$sql\n";
			}
			if ($this->errno () != 0) {
				if (DEBUG ) {
					throw new Exception ( "Sql Error ==> $sql" . " error:" . $this->errmsg () );
				}
				@Log::write_log ( "Sql Error == >$sql" );
				return false;
			} else {
				$last_id = $this->lastId ();
				return $last_id > 0 ? $last_id : 1;
			}
		}		
		
		public function updateData($table,$data,$condition = ''){
			if($table == '' || !is_array($data)){
				if(DEBUG){
					throw new Exception("Error ==> Paramter Error!");
				}
				@Log::write_log('ERROR',"$table $data Parameter error!");
				return false;
			}
			$str = '';
			foreach ($data as $k => $v) {
				if(strpos($k, "_time") && is_numeric($v) && !strpos($k,"_times")){ #;$k == 'update_time'
					$str .= " `$k` = FROM_UNIXTIME($v),";
				}else {
					$str .= " `$k` = '$v',";
				}
			}
			$str = substr($str,0,-1);
			if($condition != ''){
				$str .= "WHERE $condition";
			}
			$sql = "UPDATE $table SET $str";
			$this->run_sql($sql);
			
			if(DEBUG || $_REQUEST['state'] == 'test'){
				echo "sql: $sql \n";
			}
	
			if($this->errno() != 0){
				if(DEBUG){
					throw new Exception("Sql Error ==> $sql");
				}
				@Log::write_log('ERROR',"Sql Error ==> $sql");
				return false;
			}else{
				return true;
			}
		}
		/**
		 * 删除记录
		 *
		 * @param unknown_type $table
		 * @param unknown_type $condition
		 * @return unknown
		 */
		public function deleteData($table,$condition){
			if($table == '' ||$condition == ''){
				if(DEBUG){
					throw new Exception("Error ==> Paramter Error!");
				}
				@Log::write_log('ERROR',"$table $data Parameter error!");
				return false;
			}
			
			$sql = "delete from $table WHERE $condition";
			$this->run_sql($sql);
			if($this->errno() != 0 ){
				if(DEBUG){
					throw new Exception("Sql Error ==>$sql");
				}
				@Log::write_log('ERROR',"Sql Error ==> $sql");
				return false;
			}else{
				return true;
			}
		}
		/**
		 * 读取数据
		 *
		 * @param unknown_type $table
		 * @param unknown_type $condition
		 */
		public function selectData($table,$condition=''){
			if($table == ''){
				@Log::write_log('ERROR',"$table $data Parameter error!");
				return false;
			}
			$sql = "select * from $table ";
			if($condition !=''){
				$sql .= " WHERE $condition";
			}
			$res = $this->get_data($sql);
			if($this->errno() != 0){
				@Log::write_log('ERROR',"Sql Error ==>$sql");
				return false;		
			}else{
				return $res;	
			}
		}
		
		public function __destruct(){
			$this->close_db();
		}
	
	}
?>