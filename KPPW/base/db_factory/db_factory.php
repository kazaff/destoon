<?php

class db {
	  private $_db_provider;
	  private $_dbtype;
	  private $_mydb;	
	  function __construct($dbtype="mysql"){
	  	 $this->_mydb = $this->create($dbtype);
	  }
	  public function &create($dbtype) {
		static  $dbs;
		switch ($dbtype) {
			case "odbc" :
			 	$this->_dbtype = $dbtype;
				if(empty($dbs[$dbtype]))
				{
				    include_once 'odbc_driver.php';
					return $dbs[$dbtype]  =new odbc_driver ();
				}
				else 
				{
					return $dbs[$dbtype];
				}
				break;
			case "pdo_sqlite" :
				$this->_dbtype = "pdo_sqlite";
				include_once 'pdo_sqlite_driver.php';
				return $dbs[$dbtype]  = new pdo_sqlite_driver ( );
				break;
			default :
				$this->_dbtype = $dbtype;
		        if(empty($dbs[$dbtype]))
				{
				    include_once  'mysql_driver.php';
				    return $dbs[$dbtype] = new mysql_drver ( );
				}
				else 
				{
					return $dbs[$dbtype];
				}
				
				break;
		}
		
	
	}


	 public function inserttable($tablename, $insertsqlarr, $returnid = 0, $replace = false) {
			
		$insertkeysql = $insertvaluesql = $comma = '';
		foreach ( $insertsqlarr as $insert_key => $insert_value ) {
			$insertkeysql .= $comma . '`' . $insert_key . '`';
			$insertvaluesql .= $comma . '\'' . $insert_value . '\'';
			$comma = ', ';
		}
		$method = $replace ? 'REPLACE' : 'INSERT';
		$iid = $this->_mydb->insert_id ( $method . ' INTO ' . $tablename  . ' (' . $insertkeysql . ') VALUES (' . $insertvaluesql . ')' );

		if ($returnid && ! $replace) {
			return $iid;
		} else {
			return true;
		}
	}

	 public function updatetable($tablename, $setsqlarr, $wheresqlarr) {

		$setsql = $comma = '';
		foreach ( $setsqlarr as $set_key => $set_value ) {
			if (is_array ( $set_value )) {
				$setsql .= $comma . '`' . $set_key . '`' . '=' . $set_value [0];
			} else {
				$setsql .= $comma . '`' . $set_key . '`' . '=\'' . $set_value . '\'';
			}
			$comma = ', ';
		}
		$where = $comma = '';
		if (empty ( $wheresqlarr )) {
			$where = '1';
		} elseif (is_array ( $wheresqlarr )) {
			foreach ( $wheresqlarr as $key => $value ) {
				$where .= $comma . '`' . $key . '`' . '=\'' . $value . '\'';
				$comma = ' AND ';
			}
		} else {
			$where = $wheresqlarr;
		}
		 
		return $affectrows = $this->_mydb->execute ( 'UPDATE ' .  $tablename  . ' SET ' . $setsql . ' WHERE ' . $where );
	}

    public function execute($sql)
	{
		return $this->_mydb->execute($sql); 
	}

	public  function  query($sql)
	{
		return $this->_mydb->query($sql);
	}
 
}
class db_factory {
   public  static function 	execute($sql,$dbtype="mysql"){
   	    $db= new db($dbtype);
   	   return $db->execute($sql);
   }
   public static function  query($sql,$dbtype="mysql"){
   	   $db= new db($dbtype);
   	   return $db->query($sql);
   }
   public static function inserttable($tablename, $insertsqlarr, $returnid = 0, $replace = false){
   	   $db = new db();
   	   return  $db->inserttable($tablename, $insertsqlarr, $returnid , $replace );
   }
   public static function updatetable($tablename, $setsqlarr, $wheresqlarr){
   	   $db = new db();
   	   return $db->updatetable($tablename, $setsqlarr, $wheresqlarr);
   }
   public static function create($dbtype="mysql"){
   	    $db = new db();
   	    return $db->create($dbtype);
   	   
   }
}

?>