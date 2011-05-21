<?php 
defined('IN_DESTOON') or exit('Access Denied');
if(!$MOD['baidunews']) {
	file_del(DT_ROOT.'/baidunews.xml');
	return false;
}
$news = array();
foreach($MODULE as $m) {
	if($m['module'] == 'article') $news[] = $m; 
}
$mods_num = count($news);
if($mods_num < 1) return false;
if($MOD['baidunews_items'] > 100) $MOD['baidunews_items'] = 100;
$news_num = intval($MOD['baidunews_items']/$mods_num);
if($news_num < 1) return false;
$data = '<?xml version="1.0" encoding="'.DT_CHARSET.'"?>';
$data .= '<document>';
$data .= '<webSite>'.DT_URL.'</webSite>';
$data .= '<webMaster>'.$MOD['baidunews_email'].'</webMaster>';
$data .= '<updatePeri>'.$MOD['baidunews_update'].'</updatePeri>';
foreach($news as $v) {
	$mid = $v['moduleid'];
	$url = linkurl($v['linkurl']);
	$CATEGORY = cache_read('category-'.$mid.'.php');
	$result = $db->query("SELECT * FROM {$DT_PRE}article_{$mid} a,{$DT_PRE}article_data_{$mid} d WHERE a.itemid=d.itemid ORDER BY a.addtime DESC LIMIT $news_num");
	while($r = $db->fetch_array($result)) {
		$data .= '<item>';
		$data .= '<title>'.$r['title'].'</title>';
		$data .= '<link>'.xml_linkurl($r['linkurl'], $url).'</link>';
		$data .= '<description><![CDATA['.strip_tags($r['introduce']).']]></description>';
		$data .= '<text><![CDATA['.strip_tags($r['content']).']]></text>';
		$data .= '<image>'.$r['thumb'].'</image>';
		$data .= '<keywords>'.$r['tag'].'</keywords>';
		$data .= '<category>'.$CATEGORY[$r['catid']]['catname'].'</category>';
		$data .= '<author>'.$r['author'].'</author>';
		$data .= '<source>'.$r['copyfrom'].'</source>';
		$data .= '<pubDate>'.timetodate($r['addtime'], 5).'</pubDate>';
		$data .= '</item>';
	}
}
$data .= '</document>';
$data = str_replace('><', ">\n<", $data);
file_put(DT_ROOT.'/baidunews.xml', $data);
return true;
?>