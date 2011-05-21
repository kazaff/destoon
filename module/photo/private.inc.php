<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$itemid or dheader($MOD['linkurl']);
$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid AND status=3");
$item or dheader($MOD['linkurl']);
if($item['open'] == 3) dheader($MOD['linkurl'].$item['linkurl']);
extract($item);
$pass = false;
$_key = $open == 2 ? $password : $answer;
$error = '';
if($submit) {
	if($key && $key == $_key) {
		$pass = true;
		set_cookie('photo_'.$itemid, md5(md5($DT_IP.$open.$_key.DT_KEY)), $DT_TIME + 86400);
	} else {
		$error = $open == 2 ? $L['error_password'] : $L['error_answer'];
	}
} else {
	$str = get_cookie('photo_'.$itemid);
	if($str && $str == md5(md5($DT_IP.$open.$_key.DT_KEY))) $pass = true;
	if($_username && $_username == $username) $pass = true;
}
if($pass == true) dheader($MOD['linkurl'].rewrite('show.php?itemid='.$itemid.'&page='.$page));
include DT_ROOT.'/include/seo.inc.php';
if($MOD['seo_show']) {
	eval("\$seo_title = \"$MOD[seo_show]\";");
} else {
	$seo_title = $seo_showtitle.$seo_delimiter.$seo_catname.$seo_modulename.$seo_delimiter.$seo_sitename;
}
$seo_title = $L['private_title'].$seo_delimiter.$seo_title;
$head_keywords = $keyword;
$head_description = $introduce ? $introduce : $title;
include template('private', $module);
?>