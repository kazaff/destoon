<?php 
defined('IN_DESTOON') or exit('Access Denied');
$table = $DT_PRE.'link';
$url = "file=$file";
$condition = "username='$username' AND status=3";
$demo_url = userurl($username, $url.'&page={destoon_page}', $domain);
$pagesize =intval($menu_num[$menuid]);
if(!$pagesize || $pagesize > 100) $pagesize = 33;
$offset = ($page-1)*$pagesize;
$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition", 'CACHE', $DT['cache_home']);
$pages = home_pages($r['num'], $pagesize, $demo_url, $page);
$lists = array();
$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY listorder DESC,addtime DESC LIMIT $offset,$pagesize");
while($r = $db->fetch_array($result)) {
	$r['alt'] = $r['title'];
	$r['title'] = set_style($r['title'], $r['style']);
	$lists[] = $r;
}
include template('link', $template);
?>