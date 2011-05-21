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
	if($url != $_SERVER["REQUEST_URI"]) dheader($url);;
}
require DT_ROOT.'/include/post.func.php';
include load('search.lang');
$thumb = isset($thumb) ? intval($thumb) : 0;
$price = isset($price) ? intval($price) : 0;
$vip = isset($vip) ? intval($vip) : 0;
$day = isset($day) ? intval($day) : 0;
$list = isset($list) && in_array($list, array(0, 1, 2)) ? $list : 0;
$minprice = isset($minprice) ? dround($minprice) : '';
$minprice or $minprice = '';
$maxprice = isset($maxprice) ? dround($maxprice) : '';
$maxprice or $maxprice = '';
$typeid = isset($typeid) && isset($TYPE[$typeid]) ? intval($typeid) : 99;
$areaid = isset($areaid) ? intval($areaid) : 0;
if($day) $fromdate = timetodate($DT_TIME-$day*86400, 'Ymd');
$fromdate = isset($fromdate) && preg_match("/^([0-9]{8})$/", $fromdate) ? $fromdate : '';
$fromtime = $fromdate ? strtotime($fromdate.' 0:0:0') : 0;
$todate = isset($todate) && preg_match("/^([0-9]{8})$/", $todate) ? $todate : '';
$totime = $todate ? strtotime($todate.' 23:59:59') : 0;
$sfields = array($L['by_auto'], $L['by_title'], $L['by_content'], $L['by_introduce'], $L['by_company'], $L['by_brand']);
$dfields = array('keyword', 'title', 'content', 'introduce', 'company', 'brand');
$sorder  = array($L['order'], $L['order_auto'], $L['price_dsc'], $L['price_asc'], $L['vip_dsc'], $L['vip_asc'], $L['amount_dsc'], $L['amount_asc'], $L['minamount_dsc'], $L['minamount_asc']);
$dorder  = array($MOD['order'], '', 'price DESC', 'price ASC', 'vip DESC', 'vip ASC', 'amount DESC', 'amount ASC', 'minamount DESC', 'minamount ASC');
if(!$MOD['fulltext']) unset($sfields[2], $dfields[2]);
isset($fields) && isset($dfields[$fields]) or $fields = 0;
isset($order) && isset($dorder[$order]) or $order = 0;
$order_select  = dselect($sorder, 'order', '', $order);
$category_select = ajax_category_select('catid', $L['all_category'], $catid, $moduleid);
$area_select = ajax_area_select('areaid', $L['all_area'], $areaid);
$type_select = dselect($TYPE, 'typeid', $L['all_type'], $typeid);
$tags = array();
$pid = 0;
if($DT_QST) {
	if($kw) {
		if(strlen($kw) < $DT['min_kw'] || strlen($kw) > $DT['max_kw']) message(lang($L['word_limit'], array($DT['min_kw'], $DT['max_kw'])), $MOD['linkurl'].'search.php');
		if($DT['search_limit'] && $page == 1) {
			if(($DT_TIME - $DT['search_limit']) < get_cookie('last_search')) message(lang($L['time_limit'], array($DT['search_limit'])), $MOD['linkurl'].'search.php');
			set_cookie('last_search', $DT_TIME);
		}
	}
	$property = $MOD['product_option'];
	$opsql = '';
	if($property) {
		$condition = "title='$kw'";
		if($catid) $condition .= " AND catid=$catid";
		$p = $db->get_one("SELECT pid FROM {$DT_PRE}sell_product WHERE $condition ORDER BY listorder DESC,pid DESC");
		if($p) $pid = $p['pid'];
		if($pid) {
			$OP = array();
			foreach(cache_read('option-'.$pid.'.php') as $v) {
				if($v['type'] > 2 && $v['required']) {
					$r = array();
					$oid = $v['oid'];
					$r['oid'] = $oid;
					$r['name'] = $v['name'];
					$r['select'] = '';
					$tmp = 'option_'.$oid;
					if(isset($$tmp)) {
						$tmp = $$tmp;
						$r['select'] = $tmp;
						if($tmp) {
							$tmp = htmlspecialchars(str_replace(array("\'"), array(''), trim(urldecode($tmp))));
							$tmp = str_replace(array(' ', '*'), array('%', '%'), $tmp);
							$tmp = 'O'.$oid.$tmp;
							$opsql .= " AND pptword LIKE '%$tmp%'";
						}
					}
					$r['value'] = explode('|', str_replace('(*)', '', $v['value']));
					$OP[] = $r;
				}
			}
		}
	}
	$fds = $MOD['fields'];
	$condition = '';
	if($catid) $condition .= ($CATEGORY[$catid]['child']) ? " AND catid IN (".$CATEGORY[$catid]['arrchildid'].")" : " AND catid=$catid";
	if($areaid) $condition .= ($AREA[$areaid]['child']) ? " AND areaid IN (".$AREA[$areaid]['arrchildid'].")" : " AND areaid=$areaid";
	if($thumb) $condition .= " AND thumb<>''";
	if($vip) $condition .= " AND vip>0";
	if($price) $condition .= " AND price>0 AND unit<>''";
	if($minprice)  $condition .= " AND price>=$minprice";
	if($maxprice)  $condition .= " AND price<=$maxprice";
	if($typeid != 99) $condition .= " AND typeid=$typeid";
	if($fromtime) $condition .= " AND edittime>=$fromtime";
	if($totime) $condition .= " AND edittime<=$totime";
	if($dfields[$fields] == 'content') {
		if($keyword && $MOD['fulltext'] == 1) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		$condition = str_replace('AND ', 'AND i.', $condition);
		$condition = str_replace('i.content', 'd.content', $condition);
		$condition = "i.status=3 AND i.itemid=d.itemid".$condition;
		if($keyword && $MOD['fulltext'] == 2) $condition .= " AND MATCH(`content`) AGAINST('$kw'".(preg_match("/[+-<>()~*]/", $kw) ? ' IN BOOLEAN MODE' : '').")";
		$table = $table.' i,'.$table_data.' d';
		$fds = 'i.'.str_replace(',', ',i.', $fds);
	} else {
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";	
		if($opsql) {
			if($pid) $condition .= " AND pid=$pid";
			$condition .= $opsql;
		}	
		$condition = "status=3".$condition;
	}
	if($MOD['group']) $condition .= ' GROUP BY '.$MOD['group'];
	$pagesize = $MOD['pagesize'];
	$offset = ($page-1)*$pagesize;
	$items = $db->count($table, $condition, $DT['cache_search']);
	$pages = pages($items, $page, $pagesize);
	$order = $dorder[$order] ? " ORDER BY $dorder[$order]" : '';
	$result = $db->query("SELECT $fds FROM {$table} WHERE {$condition}{$order} LIMIT {$offset},{$pagesize}", $DT['cache_search'] && $page == 1 ? 'CACHE' : '', $DT['cache_search']);
	if($kw) {
		$replacef = explode(' ', $kw);
		$replacet = array_map('highlight', $replacef);
	}
	while($r = $db->fetch_array($result)) {
		$r['adddate'] = timetodate($r['addtime'], 5);
		$r['editdate'] = timetodate($r['edittime'], 5);
		$r['alt'] = $r['title'];
		$r['title'] = set_style($r['title'], $r['style']);
		if($kw) $r['title'] = str_replace($replacef, $replacet, $r['title']);
		if($kw) $r['introduce'] = str_replace($replacef, $replacet, $r['introduce']);
		$r['linkurl'] = $MOD['linkurl'].$r['linkurl'];
		$tags[] = $r;
	}
	if($page == 1 && $items && $kw) keyword($kw, $items, $moduleid);
}
$showpage = 1;
$path = $MOD['linkurl'];
$datetype = 5;
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