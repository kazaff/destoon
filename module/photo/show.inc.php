<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$itemid or dheader($MOD['linkurl']);
$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid AND status=3");
if($item) {
	if($MOD['show_html'] && is_file(DT_ROOT.'/'.$MOD['moduledir'].'/'.$item['linkurl'])) {
		@header("HTTP/1.1 301 Moved Permanently");
		dheader($MOD['linkurl'].$item['linkurl']);
	}
	extract($item);
} else {
	$head_title = lang('message->item_not_exists');
	@header("HTTP/1.1 404 Not Found");
	exit(include template('show-notfound', 'message'));
}
$CAT = get_cat($catid);
if(!check_group($_groupid, $MOD['group_show']) || !check_group($_groupid, $CAT['group_show'])) {
	$head_title = lang('message->without_permission');
	exit(include template('noright', 'message'));
}
if($open < 3) {
	$_key = $open == 2 ? $password : $answer;
	$str = get_cookie('photo_'.$itemid);
	$pass = $str == md5(md5($DT_IP.$open.$_key.DT_KEY));	
	if($_username && $_username == $username) $pass = true;
} else {
	$pass = true;
}
if($page > $items) $page = 1;
$content_table = content_table($moduleid, $itemid, $MOD['split'], $table_data);
$content = $db->get_one("SELECT content FROM {$content_table} WHERE itemid=$itemid");
$content = $content['content'];
if($MOD['keylink']) $content = keylink($content, $moduleid);
$adddate = timetodate($addtime, 3);
$editdate = timetodate($edittime, 3);
$linkurl = linkurl($MOD['linkurl'].$linkurl, 1);
$T = array();
$result = $db->query("SELECT itemid,thumb,introduce FROM {$table_item} WHERE item=$itemid ORDER BY listorder ASC,itemid ASC");
while($r = $db->fetch_array($result)) {
	$T[] = $r;
}
$demo_url = $MOD['linkurl'].itemurl($item, '{destoon_page}');
$next_photo = $items > 1 ? next_photo($page, $items, $demo_url) : $linkurl;
$prev_photo = $items > 1 ? prev_photo($page, $items, $demo_url) : $linkurl;
if($T) {
	$S = side_photo($T, $page, $demo_url);
} else {
	$S = array();
	$T[0]['thumb'] = DT_SKIN.'image/spacer.gif';
	$T[0]['introduce'] = $L['no_picture'];
}
$P = $T[$page-1];
$P['src'] = str_replace('.thumb.'.file_ext($P['thumb']), '', $P['thumb']);
$user_status = 3;
$update = '';
$fee = get_fee($item['fee'], $MOD['fee_view']);
if($fee) {
	$user_status = 4;
	$destoon_task = "moduleid=$moduleid&html=show&itemid=$itemid&page=$page";
	$description = '';
} else {
	$user_status = 3;
}
include DT_ROOT.'/include/update.inc.php';
include DT_ROOT.'/include/seo.inc.php';
if($MOD['seo_show']) {
	eval("\$seo_title = \"$MOD[seo_show]\";");
} else {
	$seo_title = $seo_showtitle.$seo_delimiter.$seo_catname.$seo_modulename.$seo_delimiter.$seo_sitename;
}
$head_keywords = $keyword;
$head_description = $introduce ? $introduce : $title;
$template = $item['template'] ? $item['template'] : ($CAT['show_template'] ? $CAT['show_template'] : 'show');
include template($template, $module);
?>