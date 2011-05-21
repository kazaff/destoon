<?php

require_once ('DataBase.php');

final class mysql_drver extends DataBase {
	
    private $_dbhost;
	private $_dbname;
	private $_dbuser;
	private $_dbpass;
	private $_dbcharset;
	private $_link;
	function __construct() {
		$this->_dbhost = DataBase::$dbhost;
		$this->_dbname = DataBase::$dbname;
		$this->_dbuser = DataBase::$dbuser;
		$this->_dbpass = DataBase::$dbpass;
		$this->_dbcharset = DataBase::$dbcharset;
		$this->_link = mysql_connect ( $this->_dbhost, $this->_dbuser, $this->_dbpass );
	}

	public function dbConnection() {
		if (! $this->_link) {
			  $this->halt("数据连接错误") ;
		} else {
			@mysql_select_db ( $this->_dbname, $this->_link );
			@mysql_query ( "set NAMES  {$this->_dbcharset}", $this->_link );
			return $this->_link;
		}
	
	}

	public function query($sql) {
		$query = mysql_query ( $sql, $this->dbConnection () );
		if ($query) {
			$result = array ();
			while ( $row = mysql_fetch_assoc ( $query ) ) {
				$result [] = $row;
			}
			return $result;
		} else {
			$this->halt("数据库查询错误",$sql);
		}
	
	}

	public function getCount($sql, $row = 0, $field = null) {
		$query = mysql_query ( $sql, $this->dbConnection () );
		if ($query) {
			$result = mysql_result ( $query, $row, $field );
			return $result;
		} else {
			$this->halt("数据库查询错误",$sql);
		}
	}

	public function insert_id($insertSql) {
		
		$flags = mysql_query ( $insertSql, $this->dbConnection () );
		if ($flags) {
			return ($id = mysql_insert_id ( $this->_link )) >= 0 ? $id : $this->getCount ( "select last_insert_id();", 0 );
		} else {
			$this->halt("数据库查询错误",$insertSql);
		}
	}

	public function execute($updatesql) {
		 
		$query = mysql_query ( $updatesql, $this->dbConnection () );
		if ($query) {
			return  @mysql_affected_rows($this->_link);
		} else {
			$this->halt("数据库查询错误",$updatesql);
		}
	}

	public function close() {
		return mysql_close ( $this->_link );
	}

	public function getError() {
		return ($this->_link) ? mysql_error ( $this->_link ) : mysql_errno ();
	}

	public function getErrno() {
		return ($this->_link) ? mysql_errno ( $this->_link ) : mysql_errno ();
	}
	function halt($message = '', $sql = '') {
		global $_K; 
		$dberror = $this->getError();
		$dberrno = $this->getErrno();
		if($_K['is_debug'])
		{
		echo "<div style=\"position:absolute;font-size:11px;font-family:verdana,arial;background:#EBEBEB;padding:0.5em;\">
				<b>MySQL Error</b><br>
				<b>Message</b>: $message<br>
				<b>SQL</b>: $sql<br>
				<b>Error</b>: $dberror<br>
				<b>Errno.</b>: $dberrno<br>
				 
				</div>";
		}
		else
		{
			echo "<div style=\"position:absolute;font-size:11px;font-family:verdana,arial;background:#EBEBEB;padding:0.5em;\">
				<b>MySQL Error</b><br>
				<b>Message</b>: $message<br>
				 </div>";
		}
		exit();
	}
   public function __destruct()
	{
		is_resource($this->_link) and mysql_close($this->_link);
	}

}

?>