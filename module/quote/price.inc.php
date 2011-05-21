<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
if(!check_group($_groupid, $MOD['group_search_price'])) {
	$head_title = lang('message->without_permission');
	include template('noright', 'message');
	exit;
}
if($DT['rewrite'] && $DT['search_rewrite'] && $_SERVER["REQUEST_URI"] && $_SERVER['QUERY_STRING']) {
	$url = rewrite($_SERVER["REQUEST_URI"]);
	if($url != $_SERVER["REQUEST_URI"]) dheader($url);;
}
require DT_ROOT.'/include/post.func.php';
$CATEGORY = cache_read('category-5.php');
$AREA = cache_read('area.php');
$thumb = isset($thumb) ? intval($thumb) : 0;
$vip = isset($vip) ? intval($vip) : 0;
$minprice = isset($minprice) ? dround($minprice) : '';
$minprice or $minprice = '';
$maxprice = isset($maxprice) ? dround($maxprice) : '';
$maxprice or $maxprice = '';
$typeid = isset($typeid) ? ($typeid === '' ? -1 : intval($typeid)) : -1;
$areaid = isset($areaid) ? intval($areaid) : 0;
$fromdate = isset($fromdate) && preg_match("/^([0-9]{8})$/", $fromdate) ? $fromdate : '';
$fromtime = $fromdate ? strtotime($fromdate.' 0:0:0') : 0;
$todate = isset($todate) && preg_match("/^([0-9]{8})$/", $todate) ? $todate : '';
$totime = $todate ? strtotime($todate.' 23:59:59') : 0;
$mode = isset($mode) && $mode ? 1 : 0;
$tb = $DT_PRE.'sell';
$items = 0;
$tags = array();
if($DT_QST) {
	if($kw) {
		if(strlen($kw) < $DT['min_kw'] || strlen($kw) > $DT['max_kw']) message(lang($L['word_limit'], array($DT['min_kw'], $DT['max_kw'])), $MOD['linkurl'].'search.php');
		if($DT['search_limit'] && $page == 1) {
			if(($DT_TIME - $DT['search_limit']) < get_cookie('last_search')) message(lang($L['time_limit'], array($DT['search_limit'])), $MOD['linkurl'].'search.php');
			set_cookie('last_search', $DT_TIME);
		}
	}
	$showpage = 1;
	$condition = "status=3 AND price>0 AND unit<>'' AND tag<>''";
	if($keyword) $condition .= $mode ? " AND tag='$kw'" : " AND keyword LIKE '%$keyword%'";
	if($catid) $condition .= ($CATEGORY[$catid]['child']) ? " AND catid IN (".$CATEGORY[$catid]['arrchildid'].")" : " AND catid=$catid";
	if($areaid) $condition .= ($AREA[$areaid]['child']) ? " AND areaid IN (".$AREA[$areaid]['arrchildid'].")" : " AND areaid=$areaid";
	if($thumb) $condition .= " AND thumb<>''";
	if($vip) $condition .= " AND vip>0";
	if($minprice)  $condition .= " AND price>$minprice";
	if($maxprice)  $condition .= " AND price<$maxprice";
	if($typeid >=0) $condition .= " AND typeid=$typeid";
	if($fromtime) $condition .= " AND edittime>=$fromtime";
	if($totime) $condition .= " AND edittime<=$totime";
	$items = $db->count($tb, $condition, $DT['cache_search']);
	$pages = pages($items, $page, $pagesize);
	$tags = array();
	$result = $db->query("SELECT title,linkurl,tag,model,standard,brand,price,unit,areaid,company,username,edittime FROM {$tb} WHERE $condition ORDER BY edittime DESC LIMIT $offset,$pagesize", $DT['cache_search'] && $page == 1 ? 'CACHE' : '', $DT['cache_search']);
	while($r = $db->fetch_array($result)) {
		$r['linkurl'] = $MODULE[5]['linkurl'].$r['linkurl'];
		$tags[] = $r;
	}
	if($page == 1 && $kw) keyword($kw, $items, -$moduleid);
}
$head_title = $L['price_title'];
if($kw) $head_title = $kw.$DT['seo_delimiter'].$head_title;
$head_keywords = $MOD['seo_keywords'] ? $MOD['seo_keywords'] : $DT['seo_keywords'];
$head_description = $MOD['seo_description'] ? $MOD['seo_description'] : $DT['seo_description'];
include template('price', $module);
if($MOD['quote_auto'] && $kw && $items) {
	$QP = cache_read('quote_product.php');
	require MD_ROOT.'/quote.class.php';
	$do = new quote($moduleid);
	$quotes = array();
	update_quote();
}
?>