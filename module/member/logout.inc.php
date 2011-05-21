<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
require MD_ROOT.'/member.class.php';
$do = new member;
$do->logout();
$forward = $forward ? linkurl($forward, 1) : DT_URL;
$msg_code = $URI = '';
if($MOD['passport']) {
	$action = 'logout';
	require DT_ROOT.'/api/'.$MOD['passport'].'.inc.php';
	if($URI) dheader($URI);
}
if($msg_code) $msg_code = $L['logout_msg_success'].$msg_code;
message($msg_code, $forward);
?>