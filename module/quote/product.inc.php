<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
if($itemid) {
	$item = $db->get_one("SELECT linkurl FROM {$DT_PRE}sell WHERE itemid='$itemid' AND status=3");
	if($item) {
		dheader($MODULE[5]['linkurl'].$item['linkurl']);
	} else {
		$head_title = lang('message->item_not_exists');
		exit(include template('show-notfound', 'message'));
	}
} else {
	$head_title = $L['product_type'].$DT['seo_delimiter'].$MOD['name'];
	$head_keywords = $MOD['seo_keywords'];
	$head_description = $MOD['seo_description'];
	$template = 'product';
	include template($template, $module);
}
?>