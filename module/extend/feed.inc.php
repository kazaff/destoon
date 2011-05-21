<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$MOD['feed_enable'] or dheader(DT_PATH);
require DT_ROOT.'/include/post.func.php';
$extendurl = extendurl('feed');
$FD = array();
foreach($MODULE as $m) {
	if($m['islink'] || !$m['ismenu'] || $m['moduleid'] < 5) continue;
	$m['rssurl'] = $extendurl.'rss.php?mid='.$m['moduleid'];
	$FD[] = $m;
}
$mid = isset($mid) ? intval($mid) : 0;
$areaid = isset($areaid) ? intval($areaid) : 0;
$feed_code = '';
$category_select = '';
$area_select = '';
if($mid && $mid > 4 && isset($MODULE[$mid]) && !$MODULE[$mid]['islink']) {
	$feed_code .= $extendurl.'rss.php?mid='.$mid;
	if($kw == $L['keyword']) $kw = '';
	if($kw && strlen($kw) > 2 && strlen($kw) < 30) $feed_code .= '&kw='.urlencode($kw);
	if($catid) $feed_code .= '&catid='.urlencode($catid);
	if($areaid) $feed_code .= '&areaid='.urlencode($areaid);
	$category_select = category_select('catid', $L['category'], $catid, $moduleid);
	if(in_array($MODULE[$mid]['module'], array('sell','buy', 'exhibit', 'info', 'job'))) $area_select = ajax_area_select('areaid', $L['rss_area'], $areaid);
}
$head_title = $L['rss_title'];
$head_keywords = $head_description = '';
include template('feed', $module);
?>