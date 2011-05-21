<?php 
defined('IN_DESTOON') or exit('Access Denied');
$moduleid = 9;
$MOD = cache_read('module-'.$moduleid.'.php');
$module = 'job';
$table = $DT_PRE.'job';
$table_data = $DT_PRE.'job_data';
if($itemid) {
	$item = $db->get_one("SELECT * FROM {$table} m, {$table_data} d WHERE m.itemid=d.itemid AND m.itemid=$itemid AND m.status>2 AND m.username='$username'");
	if(!$item) dheader($MENU[$menuid]['linkurl']);
	unset($item['template']);
	extract($item);
	//common.inc.php can't require
	$CATEGORY = cache_read('category-'.$moduleid.'.php');
	$AREA = cache_read('area.php');
	$TYPE = explode('|', trim($MOD['type']));
	$GENDER = explode('|', trim($MOD['gender']));
	$MARRIAGE = explode('|', trim($MOD['marriage']));
	$EDUCATION = explode('|', trim($MOD['education']));
	$SITUATION = explode('|', trim($MOD['situation']));

	$parentid = $CATEGORY[$catid]['parentid'] ? $CATEGORY[$catid]['parentid'] : $catid;
	$expired = $totime && $totime < $DT_TIME ? true : false;

	$db->query("UPDATE {$table} SET hits=hits+1 WHERE itemid=$itemid");
	$head_title = $title.$DT['seo_delimiter'].$head_title;
	$head_keywords = $title.','.$COM['company'];
	$head_description = dsubstr(strip_tags($content), 200, '...');
} else {
	$url = "file=$file";
	$condition = "username='$username' AND status=3";
	if($kw) {
		$condition .= " AND keyword LIKE '%$keyword%'";
		$url .= "&kw=$kw";
		$head_title = $kw.$DT['seo_delimiter'].$head_title;
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
		$r['linkurl'] = $homeurl ? $MOD['linkurl'].$r['linkurl'] : userurl($username, "file=$file&itemid=$r[itemid]", $domain);
		if($kw) {
			$r['title'] = str_replace($kw, '<span class="highlight">'.$kw.'</span>', $r['title']);
			$r['introduce'] = str_replace($kw, '<span class="highlight">'.$kw.'</span>', $r['introduce']);
		}
		$lists[] = $r;
	}
}
include template('job', $template);
?>