<?php
require_once ('DataBase.php');

class odbc_driver extends DataBase  {
	
    private $_dbhost;
	private $_dbname;
	private $_dbuser;
	private $_dbpass;
	private $_dbcharset;
	private $_link;
	function __construct() {
		
		$this->_dbhost = "Driver={Microsoft Access Driver (*.mdb)};Dbq=".S_ROOT."data\aaaa.mdb";
		$this->_dbuser = "";
		$this->_dbpass = "";
		 
		if(function_exists("odbc_connect")){
			$this->_link = odbc_connect( $this->_dbhost, $this->_dbuser, $this->_dbpass );
		}else {
			$this->_link = FALSE;
			$this->halt("环境不支持odbc数据库连接");
		}
	}

	public function dbConnection() {
		if (! $this->_link) {
			  $this->halt("数据连接错误") ;
		} else {
			return $this->_link;
		}
	
	}

	public function query($sql) {
		$rs = odbc_exec($this->dbConnection(),$sql);
		if(is_resource($rs)){
			while ($result[] = odbc_fetch_array($rs));
			odbc_free_result($rs);
			$this->close();
			return $result;
		}else{
			$this->halt("数据库查询出错",$sql);	
		}	
		
	}

	public function getCount($sql, $row = 0, $field = null) {
		$query = odbc_exec( $this->dbConnection (),$sql );
		if ($query) {
			$result = odbc_result ( $query, $row, $field );
			return $result;
		} else {
			$this->halt("数据库查询错误",$sql);
		}
	}

	public function insert_id($insertSql) {
		$query = odbc_execute($this->dbConnection(),$insertSql);
		if($query){
			return $query;
		}else {
			$this->halt("数据库查询错误",$insertSql);
		}
	}

	public function execute($sql) {
		 
		$query = odbc_do($this->dbConnection(),$sql);
		if ($query) {
			return  $query;
		} else {
			$this->halt("数据库查询错误",$updatesql);
		}
	}

	public function close() {
		return odbc_close ( $this->_link );
	}

	public function getError() {
		return ($this->_link) ? odbc_error ( $this->dbConnection()) : odbc_errormsg($this->dbConnection());
		
	}
	public function getErrno(){
		return ($this->_link) ? odbc_errormsg ( $this->dbConnection()) : odbc_error($this->dbConnection());
	}
	 
	function halt($message = '', $sql = '') {
		global $_K; 
		$dberror = $this->getError();
		$dberrno = $this->getErrno();
		
		if(1)
		{
		 echo "<div style=\"position:absolute;font-size:11px;font-family:verdana,arial;background:#EBEBEB;padding:0.5em;\">
				<b>ODBCSQL Error</b><br>
				<b>Message</b>: $message<br>
				<b>SQL</b>: $sql<br>
				<b>Error</b>: $dberror<br>
				<b>Error</b>: $dberrno<br> 
				</div>";
		}
		else
		{
			echo "<div style=\"position:absolute;font-size:11px;font-family:verdana,arial;background:#EBEBEB;padding:0.5em;\">
				<b>ODBCSQL	 Error</b><br>
				<b>Message</b>: $message<br>
				 </div>";
		}
		exit();
	}
   public function __destruct()
	{
		is_resource($this->_link) and odbc_close($this->_link);
	}
}

?>