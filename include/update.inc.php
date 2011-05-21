<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
if($update) $db->query("UPDATE {$table} SET ".(substr($update, 1))." WHERE itemid=$itemid");
if($page == 1) {
	if($DT['cache_hits']) {
		 cache_hits($moduleid, $itemid);
	} else {
		$db->query("UPDATE LOW_PRIORITY {$table} SET hits=hits+1 WHERE itemid=$itemid", 'UNBUFFERED');
	}
}	
?>