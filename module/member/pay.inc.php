<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
require DT_ROOT.'/include/post.func.php';
if(!$_userid) dheader($MOD['linkurl']);
if(!$mid || !$itemid || !$fee || !$currency || !$sign || !$title || !$forward) dheader($MOD['linkurl']);
$title = rawurldecode($title);
check_sign($_username.$mid.$itemid.$fee.$currency.$forward.$title, $sign) or dalert($L['check_sign'], $forward);
$note = ($mid == -9 ? $L['resume_name'] : $MODULE[$mid]['name']).'/'.$itemid;
if($currency == 'credit') {
	if($_credit >= $fee) {
		$db->query("INSERT INTO {$DT_PRE}finance_pay (moduleid,itemid,username,fee,currency,paytime,ip,title) VALUES ('$mid','$itemid','$_username','$fee','$currency','$DT_TIME','$DT_IP','".addslashes($title)."')");
		credit_add($_username, -$fee);
		credit_record($_username, -$fee, 'system', $L['pay_record_view'], $note);
		dheader($forward);
	} else {
		dheader($MOD['linkurl'].'credits.php?action=buy');
	}
}
$discount = $MG['discount'] > 0 && $MG['discount'] < 100 ? $MG['discount'] : 100;
$discount = dround($discount/100);
if($submit) {
	is_payword($_username, $password) or message($L['error_payword']);
	$fee = dround($fee*$discount);
	$fee > 0 or message($L['pay_msg_fee']);
	$fee <= $_money or dheader($MOD['linkurl'].'charge.php?action=pay&amount='.($fee-$_money));
	$db->query("INSERT INTO {$DT_PRE}finance_pay (moduleid,itemid,username,fee,currency,paytime,ip,title) VALUES ('$mid','$itemid','$_username','$fee','$currency','$DT_TIME','$DT_IP','".addslashes($title)."')");
	money_add($_username, -$fee);
	money_record($_username, -$fee, $L['in_site'], 'system', $L['pay_record_view'], $note);
	dheader($forward);
} else {
	$head_title = $L['pay_title'];
	$amount = 100;
	$member_fee = dround($fee*$discount);
	if($member_fee > $_money) $amount = dround($member_fee - $_money);
	include template('pay', $module);
}
?>