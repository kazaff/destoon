<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
if(!$catid || !isset($CATEGORY[$catid])) {
	$head_title = lang('message->cate_not_exists');
	@header("HTTP/1.1 404 Not Found");
	exit(include template('list-notfound', 'message'));
}
if($MOD['list_html']) {
	$html_file = listurl($moduleid, $catid, $page, $CATEGORY, $MOD);
	if(is_file(DT_ROOT.'/'.$MOD['moduledir'].'/'.$html_file)) {
		@header("HTTP/1.1 301 Moved Permanently");
		dheader($MOD['linkurl'].$html_file);
	}
}
$CAT = get_cat($catid);
if(!check_group($_groupid, $MOD['group_list']) || !check_group($_groupid, $CAT['group_list'])) {
	$head_title = lang('message->without_permission');
	exit(include template('noright', 'message'));
}
unset($CAT['moduleid']);
extract($CAT);
$maincat = get_maincat($child ? $catid : $parentid, $CATEGORY);
include DT_ROOT.'/include/seo.inc.php';
if($MOD['seo_list']) {
	eval("\$seo_title = \"$MOD[seo_list]\";");
} else {
	$seo_title = $seo_cattitle.$seo_page.$seo_modulename.$seo_delimiter.$seo_sitename;
}
if($CAT['seo_keywords']) $head_keywords = $CAT['seo_keywords'];
if($CAT['seo_description']) $head_description = $CAT['seo_description'];
$template = $CAT['template'] ? $CAT['template'] : ($MOD['template_list'] ? $MOD['template_list'] : 'list');
include template($template, $module);
?>