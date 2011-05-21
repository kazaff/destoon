<?php 
defined('IN_DESTOON') or exit('Access Denied');
if($action == 'company') {//Company News
	include DT_ROOT.'/include/seo.inc.php';
	if($MOD['seo_index']) {
		eval("\$seo_title = \"$MOD[seo_index]\";");
	} else {
		$seo_title = $seo_modulename.$seo_delimiter.$seo_sitename;
	}
	$seo_title = $L['news_title'].$seo_delimiter.$seo_title;
	include template('news', $module);
	exit;
}
$table = $DT_PRE.'news';
$table_data = $DT_PRE.'news_data';
if($itemid) {
	$item = $db->get_one("SELECT * FROM {$table} m, {$table_data} d WHERE m.itemid=d.itemid AND m.itemid=$itemid AND m.status>2 AND m.username='$username'");
	if(!$item) dheader($MENU[$menuid]['linkurl']);
	extract($item);
	$db->query("UPDATE {$table} SET hits=hits+1 WHERE itemid=$itemid");
	$head_title = $title.$DT['seo_delimiter'].$head_title;
	$head_keywords = $title.','.$COM['company'];
	$head_description = get_intro($content, 200);
} else {
	$typeid = isset($typeid) ? intval($typeid) : 0;
	$url = "file=$file";
	$condition = "username='$username' AND status=3";
	if($kw) {
		$condition .= " AND title LIKE '%$keyword%'";
		$url .= "&kw=$kw";
		$head_title = $kw.$DT['seo_delimiter'].$head_title;
	}
	if($typeid) {
		$MTYPE = get_type('news-'.$userid);
		$condition .= " AND typeid='$typeid'";
		$url .= "&typeid=$typeid";
		$head_title = $MTYPE[$typeid]['typename'].$DT['seo_delimiter'].$head_title;
	}
	$demo_url = userurl($username, $url.'&page={destoon_page}', $domain);

	$pagesize =intval($menu_num[$menuid]);
	if(!$pagesize || $pagesize > 100) $pagesize = 30;

	$offset = ($page-1)*$pagesize;
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition", 'CACHE', $DT['cache_home']);
	$pages = home_pages($r['num'], $pagesize, $demo_url, $page);
	$lists = array();
	$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY addtime DESC LIMIT $offset,$pagesize");
	while($r = $db->fetch_array($result)) {
		$r['alt'] = $r['title'];
		$r['title'] = set_style($r['title'], $r['style']);
		$r['linkurl'] = userurl($username, "file=$file&itemid=$r[itemid]", $domain);
		if($kw) $r['title'] = str_replace($kw, '<span class="highlight">'.$kw.'</span>', $r['title']);
		$lists[] = $r;
	}
}
include template('news', $template);
?>