<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');

//系统负载系数
if($DT['defend_cc']) {
	if(substr(PHP_OS, 0, 3) != 'WIN' && file_exists('/proc/loadavg')) {
		if($fp = @fopen('/proc/loadavg', 'r')) {
			list($loadaverage) = explode(' ', fread($fp, 6));
			fclose($fp);
			if($loadaverage > $DT['defend_cc']) {
				if(defined('DT_TASK')) exit;
				header("HTTP/1.0 503 Service Unavailable");
				exit(include(DT_ROOT.'/api/503.php'));
			}
		}
	}
}

//防止页面刷新
if($DT['defend_reload']) {
	$lastvisit = intval(decrypt(get_cookie('lastvisit')));
	set_cookie('lastvisit', encrypt("$DT_TIME"));
	if($DT_TIME - $lastvisit < $DT['defend_reload']) {
		if(defined('DT_TASK')) exit;
		message(lang('include->defend_reload', array($DT['defend_reload'])).'<script>setTimeout("this.location.reload();", '.($DT['defend_reload']*3000).');</script>');
	}
}

//限制代理访问
if($DT['defend_proxy']) {
	if($_SERVER['HTTP_X_FORWARDED_FOR'] || $_SERVER['HTTP_VIA'] || $_SERVER['HTTP_PROXY_CONNECTION'] || $_SERVER['HTTP_USER_AGENT_VIA'] || $_SERVER['HTTP_CACHE_INFO'] || $_SERVER['HTTP_PROXY_CONNECTION']) {
		if(defined('DT_TASK')) exit;
		message(lang('include->defend_proxy'));
	}
}
?>