<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
require_once DT_ROOT.'/include/post.func.php';
$currency = $MOD['fee_currency'];
$mid = isset($resume) ? -$moduleid : $moduleid;
$note = ($mid == -9 ? $L['resume'] : $MODULE[$mid]['name']).'/'.$itemid;
if($currency == 'money') {
	$password or wap_msg($L['type_payword']);
	is_payword($_username, $password) or wap_msg($L['not_payword']);
	$discount = $MG['discount'] > 0 && $MG['discount'] < 100 ? $MG['discount'] : 100;
	$discount = dround($discount/100);
	$_fee = dround($fee*$discount);
	$_money >= $_fee or wap_msg($L['need_charge']);	
	$db->query("INSERT INTO {$DT_PRE}finance_pay (moduleid,itemid,username,fee,currency,paytime,ip,title) VALUES ('$mid','$itemid','$_username','$fee','$currency','$DT_TIME','$DT_IP','".addslashes($title)."')");
	money_add($_username, -$fee);
	money_record($_username, -$fee, $L['pay_by_site'], 'system', $L['pay_info'], $note);
} else {
	if($_credit >= $fee) {
		$db->query("INSERT INTO {$DT_PRE}finance_pay (moduleid,itemid,username,fee,currency,paytime,ip,title) VALUES ('$mid','$itemid','$_username','$fee','$currency','$DT_TIME','$DT_IP','".addslashes($title)."')");
		credit_add($_username, -$fee);
		credit_record($_username, -$fee, 'system', $L['pay_info'], $note);
	} else {
		wap_msg($L['need_credit']);
	}
}
wap_msg($L['pay_success'], 'index.php?moduleid='.$moduleid.'&amp;itemid='.$itemid.((isset($resume) && $resume) ? '&amp;resume=1' : ''));
?>