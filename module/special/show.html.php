<?php 
defined('IN_DESTOON') or exit('Access Denied');
if(!$MOD['show_html'] || !$itemid) return false;
$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid AND status=3");
if(!$item) return false;
extract($item);
$CAT = get_cat($catid);
$content_table = content_table($moduleid, $itemid, $MOD['split'], $table_data);
$content = $db->get_one("SELECT content FROM {$content_table} WHERE itemid=$itemid");
$content = $content['content'];
$TYPE = array();
foreach(get_type('special-'.$itemid) as $v) {
	$v['linkurl'] = $MOD['linkurl'].rewrite('type.php?tid='.$v['typeid']);
	$TYPE[] = $v;
}
$adddate = timetodate($addtime, 3);
$editdate = timetodate($edittime, 3);
$fileurl = $domain ? $filepath : $linkurl;
$linkurl = linkurl($MOD['linkurl'].$linkurl, 1);
$user_status = 3;
include DT_ROOT.'/include/seo.inc.php';
if($seo_title) {
	$seo_title = $seo_title.$seo_delimiter.$seo_sitename;
} else {
	if($MOD['seo_show']) {
		eval("\$seo_title = \"$MOD[seo_show]\";");
	} else {
		$seo_title = $seo_showtitle.$seo_delimiter.$seo_catname.$seo_modulename.$seo_delimiter.$seo_sitename;
	}
}
$head_keywords = $keyword;
$head_description = $introduce ? $introduce : $title;
$template = $item['template'] ? $item['template'] : ($CAT['show_template'] ? $CAT['show_template'] : 'show');
$destoon_task = "moduleid=$moduleid&html=show&itemid=$itemid";
ob_start();
include template($template, $module);
$data = ob_get_contents();
ob_clean();
$filename = DT_ROOT.'/'.$MOD['moduledir'].'/'.$fileurl;
if($DT['pcharset']) $filename = convert($filename, DT_CHARSET, $DT['pcharset']);
file_put($filename, $data);
return true;
?>