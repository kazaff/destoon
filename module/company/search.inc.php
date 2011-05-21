<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
if(!check_group($_groupid, $MOD['group_search'])) {
	$head_title = lang('message->without_permission');
	include template('noright', 'message');
	exit;
}

if($DT['rewrite'] && $DT['search_rewrite'] && $_SERVER["REQUEST_URI"] && $_SERVER['QUERY_STRING']) {
	$url = rewrite($_SERVER["REQUEST_URI"]);
	if($url != $_SERVER["REQUEST_URI"]) dheader($url);
}
require DT_ROOT.'/include/post.func.php';
include load('search.lang');
$MS = cache_read('module-2.php');
$modes = explode('|', $L['choose'].'|'.$MS['com_mode']);
$types = explode('|', $L['choose'].'|'.$MS['com_type']);
$sizes = explode('|', $L['choose'].'|'.$MS['com_size']);
$vips = array($L['vip_level'], VIP, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
$thumb = isset($thumb) ? intval($thumb) : 0;
//$vip = isset($vip) ? intval($vip) : 0;
$mincapital = isset($mincapital) ? dround($mincapital) : '';
$mincapital or $mincapital = '';
$maxcapital = isset($maxcapital) ? dround($maxcapital) : '';
$maxcapital or $maxcapital = '';
$areaid = isset($areaid) ? intval($areaid) : 0;
isset($mode) && isset($modes[$mode]) or $mode = 0;
isset($type) && isset($types[$type]) or $type = 0;
isset($size) && isset($sizes[$size]) or $size = 0;
isset($vip) && isset($vips[$vip]) or $vip = 0;
$category_select = ajax_category_select('catid', $L['all_category'], $catid, $moduleid);
$area_select = ajax_area_select('areaid', $L['all_area'], $areaid);
$mode_select = dselect($modes, 'mode', '', $mode);
$type_select = dselect($types, 'type', '', $type);
$size_select = dselect($sizes, 'size', '', $size);
$vip_select = dselect($vips, 'vip', '', $vip);
$tags = array();
if($DT_QST) {
	if($kw) {
		if(strlen($kw) < $DT['min_kw'] || strlen($kw) > $DT['max_kw']) message(lang($L['word_limit'], array($DT['min_kw'], $DT['max_kw'])), $MOD['linkurl'].'search.php');
		if($DT['search_limit'] && $page == 1) {
			if(($DT_TIME - $DT['search_limit']) < get_cookie('last_search')) message(lang($L['time_limit'], array($DT['search_limit'])), $MOD['linkurl'].'search.php');
			set_cookie('last_search', $DT_TIME);
		}
	}
	$fds = $MOD['fields'];
	$condition = "groupid>5 AND catids<>''";
	if($keyword) $condition .= " AND keyword LIKE '%$keyword%'";
	if($mode) $condition .= " AND mode LIKE '%$modes[$mode]%'";
	if($type) $condition .= " AND type='$types[$type]'";
	if($size) $condition .= " AND size='$sizes[$size]'";
	if($catid) $condition .= " AND catids LIKE '%,".$catid.",%'";
	if($areaid) $condition .= ($AREA[$areaid]['child']) ? " AND areaid IN (".$AREA[$areaid]['arrchildid'].")" : " AND areaid=$areaid";
	if($thumb) $condition .= " AND thumb!=''";
	if($vip) $condition .= $vip == 1 ? " AND vip>0" : " AND vip=$vip-1";
	if($mincapital)  $condition .= " AND capital>$mincapital";
	if($maxcapital)  $condition .= " AND capital<$maxcapital";
	$pagesize = $MOD['pagesize'];
	$offset = ($page-1)*$pagesize;
	$items = $db->count($table, $condition, $DT['cache_search']);
	$pages = pages($items, $page, $pagesize);
	$order = $MOD['order'] ? " ORDER BY ".$MOD['order'] : '';
	$result = $db->query("SELECT $fds FROM {$table} WHERE {$condition}{$order} LIMIT {$offset},{$pagesize}", $DT['cache_search'] && $page == 1 ? 'CACHE' : '', $DT['cache_search']);
	if($kw) {
		$replacef = explode(' ', $kw);
		$replacet = array_map('highlight', $replacef);
	}
	while($r = $db->fetch_array($result)) {
		if($kw) $r['company'] = str_replace($replacef, $replacet, $r['company']);
		if($kw) $r['introduce'] = str_replace($replacef, $replacet, $r['introduce']);
		$tags[] = $r;
	}
	if($page == 1 && $items && $kw) keyword($kw, $items, $moduleid);
}
$showpage = 1;
$path = $MOD['linkurl'];
$maincat = get_maincat(0, $CATEGORY);
if($catid) $CAT = get_cat($catid);

include DT_ROOT.'/include/seo.inc.php';
$seo_kw = $kw ? $kw.$seo_delimiter : '';
if($MOD['seo_search']) {
	eval("\$seo_title = \"$MOD[seo_search]\";");
} else {
	$seo_title = $seo_modulename.$L['search'].$seo_delimiter.$seo_page.$seo_sitename;
	if($catid) $seo_title = $seo_catname.$seo_title;
	if($areaid) $seo_title = $seo_areaname.$seo_title;
	if($kw) $seo_title = $kw.$seo_delimiter.$seo_title;
}

include template('search', $module);
?>