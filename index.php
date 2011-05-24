<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
//配置文件
require 'common.inc.php';

/*
 * 这段代码的作用是为了实现后台的公司二级域名功能，如果开通了该功能，那么这段代码就会按要求定位到指定公司的首页
 */
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
	if(strpos(DT_URL, $host) === false) {	//如果满足，则证明$host为二级域名格式(公司启用域名),如果请求的域名和后台定义的网站地址不同，那就说明该请求目的是查看某个公司信息
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


if($username) {		//如果存在，就要打开指定公司页面
	$moduleid = 4;
	$module = 'company';
	$MOD = cache_read('module-'.$moduleid.'.php');
	require DT_ROOT.'/module/'.$module.'/common.inc.php';
	include DT_ROOT.'/module/'.$module.'/init.inc.php';
} else {	//系统首页
	if($DT['safe_domain']) {
		$safe_domain = explode('|', $DT['safe_domain']);
		$pass_domain = false;
		foreach($safe_domain as $v) {
			if(strpos($DT_URL, $v) !== false) { $pass_domain = true; break; }
		}
		$pass_domain or exit(header("HTTP/1.1 404 Not Found"));
	}
	if($DT['index_html']) {		//是否读取首页缓存
		$html_file = $CFG['com_dir'] ? DT_ROOT.'/'.$DT['index'].'.'.$DT['file_ext'] : DT_CACHE.'/index.inc.html';
		if(!is_file($html_file)) tohtml('index');
		include($html_file);
		exit;
	}
	$destoon_task = '';
	$AREA = cache_read('area.php');
	$LETTER = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
	$seo_title = $DT['seo_title'];
	$head_keywords = $DT['seo_keywords'];
	$head_description = $DT['seo_description'];
	include template('index');
}
?>