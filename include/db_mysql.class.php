<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
class db_mysql {
	var $connid;	//保存建立的数据库连接
	var $pre;		//表前缀
	var $querynum = 0;	//query次数
	var $expiresnum = 0;	//???
	var $expires;	//默认缓存生存期 
	var $cursor = 0;		//???
	var $cache_id = ''; 	//本次query的cache_id，用来生成缓存文件名和一些方法的缓存标志位
	var $cache_file = '';
	var $cache_expires = '';
	var $halt = 0;	//报错标志位
	var $cids = 0;
	var $result = array();
	var $cache_ids = array();	//缓存文件数组

	function connect($dbhost, $dbuser, $dbpw, $dbname, $dbexpires, $dbcharset, $pconnect = 0) {
		$this->expires = $dbexpires;
		$func = $pconnect == 1 ? 'mysql_pconnect' : 'mysql_connect';
		if(!$this->connid = $func($dbhost, $dbuser, $dbpw)) $this->halt('Can not connect to MySQL server');
		$version = $this->version();
		if($version > '4.1' && $dbcharset) mysql_query("SET NAMES '".$dbcharset."'" , $this->connid);
		if($version > '5.0') mysql_query("SET sql_mode=''", $this->connid);
		if($dbname && !mysql_select_db($dbname, $this->connid)) $this->halt('Cannot use database '.$dbname);
		return $this->connid;
	}

	function select_db($dbname) {
		return mysql_select_db($dbname, $this->connid);
	}

	function query($sql, $type = '', $expires = 0, $save_id = false) {
		if($this->expires > 0 && $type == 'CACHE' && strpos($sql, 'SELECT ') !== false) {	//创建缓存的条件
			$this->cursor = 0;
			$this->cache_id = md5($sql);
			if($this->cids) $this->cache_ids[] = $this->cache_id;
			$this->result = array();
			$this->cache_expires = ($expires ? $expires : $this->expires) + mt_rand(-10, 30);
			return $this->_query($sql);
		}
		//echo $sql.'<br/>';
		if(!$save_id) $this->cache_id = 0;
		$func = $type == 'UNBUFFERED' ? 'mysql_unbuffered_query' : 'mysql_query';
		if(!($query = $func($sql, $this->connid))) $this->halt('MySQL Query Error', $sql);
		$this->querynum++;
		return $query;
	}

	function get_one($sql, $type = '', $expires = 0) {
		$sql = str_replace(array('select ', ' limit '), array('SELECT ', ' LIMIT '), $sql);
		if(strpos($sql, 'SELECT ') !== false && strpos($sql, ' LIMIT ') === false) $sql .= ' LIMIT 0,1';
		$query = $this->query($sql, $type, $expires);
		$r = $this->fetch_array($query);
		$this->free_result($query);
		return $r ;
	}
	
	function count($table, $condition = '', $expires = 0) {
		global $DT_TIME;
		$sql = 'SELECT COUNT(*) as amount FROM '.$table;
		if($condition) $sql .= ' WHERE '.$condition;
		if($expires) {
			$cacheid = md5($sql);
			$r = $this->get_one("SELECT `amount`,`totime` FROM `".$this->pre."count` WHERE `cacheid`='$cacheid'");
			if(!$r || $r['totime'] < $DT_TIME) {
				$r = $this->get_one($sql);
				$totime = $DT_TIME + $expires;
				$this->query("REPLACE INTO `".$this->pre."count` (`cacheid`,`amount`,`totime`) VALUES('$cacheid','".$r['amount']."','$totime')");
			}
		} else {
			$r = $this->get_one($sql);
		}
		return $r ? $r['amount'] : 0;
	}

	function fetch_array($query, $result_type = MYSQL_ASSOC) {
		return $this->cache_id ? $this->_fetch_array($query) : mysql_fetch_array($query, $result_type);
	}

	function affected_rows() {
		return mysql_affected_rows($this->connid);
	}

	function num_rows($query) {
		return mysql_num_rows($query);
	}

	function num_fields($query) {
		return mysql_num_fields($query);
	}

	function result($query, $row) {
		return @mysql_result($query, $row);
	}

	function free_result($query) {
		return @mysql_free_result($query);
	}

	function insert_id() {
		return mysql_insert_id($this->connid);
	}

	function fetch_row($query) {
		return mysql_fetch_row($query);
	}

	function version() {
		return mysql_get_server_info($this->connid);
	}

	function close() {
		return mysql_close($this->connid);
	}

	function error() {
		return @mysql_error($this->connid);
	}

	function errno() {
		return intval(@mysql_errno($this->connid)) ;
	}

	function halt($message = '', $sql = '')	{
		if(strpos($this->error(), 'crashed and should be repaired') !== false) {
			if(preg_match("/FROM(.*)WHERE/i", $sql, $m)) {
				$table = trim($m[1]);
				$this->query("REPAIR TABLE {$table}");
				dalert('', '', 'window.reload();');
			}
		}
		if($message && DT_DEBUG) log_write("\t\t<query>".$sql."</query>\n\t\t<errno>".$this->errno()."</errno>\n\t\t<error>".$this->error()."</error>\n\t\t<errmsg>".$message."</errmsg>\n", 'sql');
		if($this->halt) message('MySQL Query:'.$sql.' <br/> MySQL Error:'.$this->error().' MySQL Errno:'.$this->errno().' <br/>Message:'.$message);
	}

	function _query($sql) {
		global $DT_TIME;
		$this->cache_file = DT_CACHE.'/sql/'.substr($this->cache_id, 0, 2).'/'.$this->cache_id.'.php';
		$iscache = is_file($this->cache_file);
		if(!$iscache || ($DT_TIME - filemtime($this->cache_file) > $this->cache_expires)) {
			if($iscache && $this->expiresnum > 5 && !defined('TOHTML')) {
				$this->result = include $this->cache_file;
			} else {
				$this->expiresnum++;
				$tmp = array(); 
				$result = $this->query($sql, '', '', true);
				while($r = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$tmp[] = $r; 
				}
				$this->result = $tmp;
				$this->free_result($sql);
				file_put($this->cache_file, "<?php /*".( $DT_TIME+$this->cache_expires)."*/ return ".var_export($this->result, true).";\n?>");
			}
		} else {
		    $this->result = include $this->cache_file;
		}
		return $this->result;
	}

	function _fetch_array($query = array()) {
		if($query) $this->result = $query; 
		if(isset($this->result[$this->cursor])) {
			return $this->result[$this->cursor++];
		} else {
			$this->cursor = $this->cache_id = 0;
			return array();
		}
	}
}
?>