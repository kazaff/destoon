<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$head_title = $head_keywords = $head_description = $L['view_title'];
$pass = $img;
if(strpos($img, DT_URL) !== false) {
	$pass = true;
} else {
	if($DT['remote_url'] && strpos($img, $DT['remote_url']) !== false) {
		$pass = true;
	} else {
		$pass = false;
	}
}
$pass or dheader($img);
$ext = file_ext($img);
in_array($ext, array('jpg', 'jpeg', 'gif', 'png', 'bmp')) or dheader(DT_PATH);
$img = str_replace(array('.thumb.'.$ext, '.middle.'.$ext), array('', ''), $img);
include template('view', $module);
?>