<?php
defined('IN_DESTOON') or exit('Access Denied');
if(!$MOD['list_html'] || !$catid || !isset($CATEGORY[$catid])) return false;
$CAT = get_cat($catid);
unset($CAT['moduleid']);
extract($CAT);
$maincat = get_maincat($child ? $catid : $parentid, $CATEGORY);
$total = $ITEMS[$catid];
$childcat = array();
$caturl = '';
if($child && $page == 1) {
	$childcat = get_maincat($catid, $CATEGORY, 1);
	if($total > $MOD['pagesize']) $caturl = $MOD['linkurl'].listurl($moduleid, $catid, 2, $CATEGORY, $MOD);
}
if($CAT['seo_keywords']) $head_keywords = $CAT['seo_keywords'];
if($CAT['seo_description']) $head_description = $CAT['seo_description'];
$template = $CAT['template'] ? $CAT['template'] : 'list';
$total = max(ceil($total/$MOD['pagesize']), 1);
if(isset($fid) && isset($num)) {
	$page = $fid;
	$topage = $fid + $num - 1;
	$total = $topage < $total ? $topage : $total;
}
for(; $page <= $total; $page++) {
	include DT_ROOT.'/include/seo.inc.php';
	if($MOD['seo_list']) {
		eval("\$seo_title = \"$MOD[seo_list]\";");
	} else {
		$seo_title = $seo_cattitle.$seo_page.$seo_modulename.$seo_delimiter.$seo_sitename;
	}
	$destoon_task = "moduleid=$moduleid&html=list&catid=$catid&page=$page";
	$filename = DT_ROOT.'/'.$MOD['moduledir'].'/'.listurl($moduleid, $catid, $page, $CATEGORY, $MOD);
	ob_start();
	include template($template, $module);
	$data = ob_get_contents();
	ob_clean();
	if($DT['pcharset']) $filename = convert($filename, DT_CHARSET, $DT['pcharset']);
	file_put($filename, $data);
	if($page == 1) {
		$indexname = DT_ROOT.'/'.$MOD['moduledir'].'/'.listurl($moduleid, $catid, 0, $CATEGORY, $MOD);
		if($DT['pcharset']) $indexname = convert($indexname, DT_CHARSET, $DT['pcharset']);
		file_copy($filename, $indexname);
	}
}
return true;
?>