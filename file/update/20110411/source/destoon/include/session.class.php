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
		@ini_set('session.gc_maxlifetime', 1800);
    	if(is_dir(DT_ROOT.'/file/session/')) {
			$dir = DT_ROOT.'/file/session/'.substr($CFG['authkey'], 2, 6).'/';
			if(is_dir($dir)) {
				session_save_path($dir);
			} else {
				dir_create($dir);
			}
		}
		session_cache_limiter('private, must-revalidate');
		session_start();
		header("cache-control: private");
    }
}
?>