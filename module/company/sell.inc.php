<?php 
defined('IN_DESTOON') or exit('Access Denied');
$could_inquiry = check_group($_groupid, $MOD['group_inquiry']);
if($username == $_username || $domain) $could_inquiry = true;
$module = 'sell';
$moduleid = 5;
$MOD = cache_read('module-'.$moduleid.'.php');
$table = $DT_PRE.'sell';
$table_data = $DT_PRE.'sell_data';
if($itemid) {
	$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid AND status>2 AND username='$username'");
	if(!$item) dheader($MENU[$menuid]['linkurl']);
	unset($item['template']);
	extract($item);
	$CAT = get_cat($catid);
	$content_table = content_table($moduleid, $itemid, $MOD['split'], $table_data);
	$content = $db->get_one("SELECT content FROM {$content_table} WHERE itemid=$itemid");
	$content = $content['content'];
	if($MOD['product_option']) {
		$options = $pid ? cache_read('option-'.$pid.'.php') : array();
		$values = array();
		$result = $db->query("SELECT * FROM {$DT_PRE}sell_value WHERE itemid=$itemid");
		while($r = $db->fetch_array($result)) {
			$values[$r['oid']] = $r['value'];
		}
	}
	$adddate = timetodate($addtime, 3);
	$editdate = timetodate($edittime, 3);
	$todate = $totime ? timetodate($totime, 3) : 0;
	$expired = $totime && $totime < $DT_TIME ? true : false;
	$linkurl = linkurl($MOD['linkurl'].$linkurl, 1);
	$thumbs = get_albums($item);
	$albums =  get_albums($item, 1);
	$amount = number_format($amount, 0, '.', '');
	$inquiry_url = $MODULE[4]['linkurl'].'home.php?action=message&job=inquiry&&itemid='.$itemid.'&template='.$template.'&skin='.$skin.'&title='.rawurlencode($title).'&username='.$username.'&sign='.crypt_sign($itemid.$template.$skin.$title.$username);
	$order_url = $MODULE[4]['linkurl'].'home.php?action=message&job=order&&itemid='.$itemid.'&template='.$template.'&skin='.$skin.'&title='.rawurlencode($title).'&username='.$username.'&sign='.crypt_sign($itemid.$template.$skin.$title.$username);
	$update = '';
	include DT_ROOT.'/include/update.inc.php';
	$head_title = $title.$DT['seo_delimiter'].$head_title;
	$head_keywords = $keyword;
	$head_description = $introduce ? $introduce : $title;
} else {
	$typeid = isset($typeid) ? intval($typeid) : 0;
	$view = isset($view) ? 1 : 0;
	$url = "file=$file";
	$condition = "username='$username' AND status=3";
	if($typeid) {
		$MTYPE = get_type('product-'.$userid);
		$condition .= " AND mycatid='$typeid'";
		$url .= "&typeid=$typeid";
		$head_title = $MTYPE[$typeid]['typename'].$DT['seo_delimiter'].$head_title;
	}
	if($kw) {
		$condition .= " AND keyword LIKE '%$keyword%'";
		$url .= "&kw=$kw";
		$head_title = $kw.$DT['seo_delimiter'].$head_title;
	}
	if($view) {
		$url .= "&view=$view";
	}
	$demo_url = userurl($username, $url.'&page={destoon_page}', $domain);
	$pagesize =intval($menu_num[$menuid]);
	if(!$pagesize || $pagesize > 100) $pagesize = 16;
	if($view) $pagesize = ceil($pagesize/2);
	$offset = ($page-1)*$pagesize;
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition", 'CACHE', $DT['cache_home']);
	$pages = home_pages($r['num'], $pagesize, $demo_url, $page);
	$lists = array();
	$result = $db->query("SELECT ".$MOD['fields']." FROM {$table} WHERE $condition ORDER BY edittime DESC LIMIT $offset,$pagesize");
	while($r = $db->fetch_array($result)) {
		$r['alt'] = $r['title'];
		$r['title'] = set_style($r['title'], $r['style']);
		$r['linkurl'] = $homeurl ? $MOD['linkurl'].$r['linkurl'] : userurl($username, "file=$file&itemid=$r[itemid]", $domain);
		if($kw) {
			$r['title'] = str_replace($kw, '<span class="highlight">'.$kw.'</span>', $r['title']);
			$r['introduce'] = str_replace($kw, '<span class="highlight">'.$kw.'</span>', $r['introduce']);
		}
		$lists[] = $r;
	}
}
include template('sell', $template);
?>