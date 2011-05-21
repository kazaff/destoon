<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
login();
$itemid or dheader($MOD['linkurl']);
include load('misc.lang');
$MG['trade_buy'] or dalert(lang('message->without_permission'), 'goback');
$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid AND status>2");
$item or dalert(lang('message->item_not_exists'), $MOD['linkurl']);
extract($item);
if($totime && $DT_TIME > $totime) dalert($L['has_expired'], 'goback');
$price > 0 or dalert($L['order_condition'], 'goback');
if(!$unit || !$minamount) dalert($L['order_condition'], 'goback');
if($username) {
	if($_username == $username) dalert($L['order_self'], 'goback');
} else {
	dalert($L['order_guest'], 'goback');
}
$linkurl = linkurl($MOD['linkurl'].$linkurl, 1);
$userurl = userurl($username);
$thumb = $thumb ? imgurl($thumb, 1) : '';
$linkurl = linkurl($linkurl, 1);
$amount = number_format($amount, 0, '.', '');
if($submit) {
	if(!$number) message($L['order_type_amount']);
	if($minamount && $number < $minamount) message($L['order_min_amount']);
	if($amount && $number > $amount) message($L['order_max_amount']);
	$order_amount = dround($number*$price);
	$user = userinfo($_username);
	$_MOD = cache_read('module-2.php');
	$send_types = explode('|', trim($_MOD['send_types']));
	$head_title = $L['order_confirm'].$DT['seo_delimiter'].$title;
} else {
	$head_title = $L['order_goods'].$DT['seo_delimiter'].$title;
}
include template('order', $module);
?>