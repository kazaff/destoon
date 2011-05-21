<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
define('DT_NONUSER', true);
require 'common.inc.php';
if(strpos($_SERVER['QUERY_STRING'], '404;') !== false) {
	$DT_URL = str_replace('404;', '', $_SERVER['QUERY_STRING']);
	$DT_URL = str_replace(':80', '', $DT_URL);
}
if($DT['log_404'] && strpos($DT_URL, '/404.php') === false) {
	$url = addslashes($DT_URL);
	$time = $DT_TIME - 86400;
	$r = $db->get_one("SELECT itemid FROM {$DT_PRE}log_404 WHERE addtime>$time AND url='$url'");
	if(!$r) $db->query("INSERT INTO {$DT_PRE}log_404 (url,agent,username,ip,addtime) VALUES ('$url','".addslashes($_SERVER['HTTP_USER_AGENT'])."','$_username','$DT_IP','$DT_TIME')");
}
$head_title = '404 Not Found';
@header("HTTP/1.1 404 Not Found");
include template('404', 'message');
?>