<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
function sql_split($sql) {
	global $CFG, $db;
	if($CFG['db_charset']) $sql = $db->version() > '4.1' ? preg_replace("/TYPE=(InnoDB|MyISAM)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=".$CFG['db_charset'], $sql) : preg_replace("/( DEFAULT CHARSET=[^; ]+)?/", '', $sql);
	if($CFG['tb_pre'] != 'destoon_') $sql = str_replace('destoon_', $CFG['tb_pre'], $sql);
	$sql = str_replace("\r", "\n", $sql);
	$ret = array();
	$num = 0;
	$queriesarray = explode(";\n", trim($sql));
	unset($sql);
	foreach($queriesarray as $query) {
		$ret[$num] = '';
		$queries = explode("\n", trim($query));
		$queries = array_filter($queries);
		foreach($queries as $query) {
			$str1 = substr($query, 0, 1);
			if($str1 != '#' && $str1 != '-') $ret[$num] .= $query;
		}
		$num++;
	}
	return $ret;
}

function sql_execute($sql) {
	global $db;
    $sqls = sql_split($sql);
	if(is_array($sqls)) {
		foreach($sqls as $sql) {
			if(trim($sql) != '') $db->query($sql);
		}
	} else {
		$db->query($sqls);
	}
	return true;
}

function sql_dumptable($table, $startfrom = 0, $currsize = 0) {
	global $db, $sizelimit, $startrow, $sqlcompat, $sqlcharset, $dumpcharset, $DT_PRE;
	if(!isset($tabledump)) $tabledump = '';
	$offset = 100;
	if(!$startfrom) {
		$tabledump = "DROP TABLE IF EXISTS $table;\n";
		$createtable = $db->query("SHOW CREATE TABLE $table");
		$create = $db->fetch_row($createtable);
		$tabledump .= $create[1].";\n\n";
		if($sqlcompat == 'MYSQL41' && $db->version() < '4.1') $tabledump = preg_replace("/TYPE\=([a-zA-Z0-9]+)/", "ENGINE=\\1 DEFAULT CHARSET=".$dumpcharset, $tabledump);
		if($db->version() > '4.1' && $sqlcharset) $tabledump = preg_replace("/(DEFAULT)*\s*CHARSET=[a-zA-Z0-9]+/", "DEFAULT CHARSET=".$sqlcharset, $tabledump);
	}
	$tabledumped = 0;
	$numrows = $offset;
	while($currsize + strlen($tabledump) < $sizelimit * 1000 && $numrows == $offset) {
		$tabledumped = 1;
		$rows = $db->query("SELECT * FROM $table LIMIT $startfrom, $offset");
		$numfields = $db->num_fields($rows);
		$numrows = $db->num_rows($rows);
		while($row = $db->fetch_row($rows)) {
			$comma = "";
			$tabledump .= "INSERT INTO $table VALUES(";
			for($i = 0; $i < $numfields; $i++) {
				$tabledump .= $comma."'".mysql_escape_string($row[$i])."'";
				$comma = ",";
			}
			$tabledump .= ");\n";
		}
		$startfrom += $offset;
	}
	$startrow = $startfrom;
	$tabledump .= "\n";
	return $tabledump;
}
?>