<?php 
defined('IN_DESTOON') or exit('Access Denied');
login();
require DT_ROOT.'/module/'.$module.'/common.inc.php';
require DT_ROOT.'/include/post.func.php';
require MD_ROOT.'/member.class.php';
$do = new member;
$do->userid = $_userid;
$user = $do->get_one();
if(!$MG['vip'] || !$MG['fee'] || $user['totime'] < $DT_TIME) dheader($MOD['linkurl']);
if($submit) {
	is_payword($_username, $password) or message($L['error_payword']);
	in_array($year, array(1, 2, 3)) or $year = 1;
	$fee = dround($MG['fee']*$year);
	$fee > 0 or message($L['renew_msg_fee']);
	$fee <= $_money or message($L['money_not_enough'], $MOD['linkurl'].'charge.php?action=pay&amount='.($fee-$_money));
	$totime = $user['totime'] + 365*86400*$year;
	money_add($_username, -$fee);
	money_record($_username, -$fee, $L['in_site'], 'system', $L['renew_title'], lang($L['renew_record'], array($year, timetodate($totime, 3))));
	$db->query("UPDATE {$DT_PRE}company SET totime=$totime WHERE userid=$_userid");
	dmsg($L['renew_msg_success'], $MOD['linkurl']);
} else {
	$head_title = $L['renew_title'];
	$havedays = ceil(($user['totime']-$DT_TIME)/86400);
	$todate = timetodate($user['totime'], 3);
	include template('renew', $module);
}
?>