<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
class dsession {
    function dsession() {
		global $CFG;
		if($CFG['cookie_domain']) @ini_set('session.cookie_domain', $CFG['cookie_domain']);
    	if(is_dir(DT_ROOT.'/file/session/')) session_save_path(DT_ROOT.'/file/session/');	//设置专用session保存文件夹，杜绝PHPBUG
		session_cache_limiter('private, must-revalidate');	//支持浏览器上一步保留用户输入内容
		session_start();
		header("cache-control: private");	//同上
    }
}
?>