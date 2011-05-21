<?php
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$username = $domain = '';
if(isset($homepage) && check_name($homepage)) {
	$username = $homepage;
} else {
	$host = $_SERVER['HTTP_HOST'];
	if(substr($host, 0, 4) == 'www.') {
		$whost = $host;
		$host = substr($host, 4);
	} else {
		$whost = $host;
	}
	if(strpos($MODULE[4]['linkurl'], $host) === false) {
		$www = str_replace($CFG['com_domain'], '', $host);
		if(check_name($www)) {
			$username = $homepage = $www;
		} else {
			$c = $db->get_one("SELECT username,domain FROM {$DT_PRE}company WHERE domain='$whost'".($host == $whost ? '' : " OR domain='$host'"));
			if($c) {
				$username = $homepage = $c['username'];
				$domain = $c['domain'];
			}
		}
	}
}
if($username) {
	include DT_ROOT.'/module/'.$module.'/init.inc.php';
} else {
	if(strpos($MODULE[4]['linkurl'], $_SERVER['HTTP_HOST']) === false) exit(header("HTTP/1.1 404 Not Found"));
	if($DT['safe_domain']) {
		$safe_domain = explode('|', $DT['safe_domain']);
		$pass_domain = false;
		foreach($safe_domain as $v) {
			if(strpos($DT_URL, $v) !== false) { $pass_domain = true; break; }
		}
		$pass_domain or exit(header("HTTP/1.1 404 Not Found"));
	}
	if(!check_group($_groupid, $MOD['group_index'])) {
		$head_title = lang('message->without_permission');
		exit(include template('noright', 'message'));
	}
	if($MOD['index_html']) {	
		$html_file = DT_ROOT.'/'.$MOD['moduledir'].'/index.inc.html';
		if(!is_file($html_file)) tohtml('index', $module);
		exit(include($html_file));
	}
	include DT_ROOT.'/include/seo.inc.php';
	if($MOD['seo_index']) {
		eval("\$seo_title = \"$MOD[seo_index]\";");
	} else {
		$seo_title = $seo_modulename.$seo_delimiter.$seo_sitename;
	}	
	$destoon_task = "moduleid=$moduleid&html=index";
	include template('index', $module);
}
?>