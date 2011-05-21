<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$itemid or dheader($MOD['linkurl']);
login();
if(!check_group($_groupid, $MOD['group_talent'])) {
	$head_title = lang('message->without_permission');
	exit(include template('noright', 'message'));
}
$item = $db->get_one("SELECT * FROM {$DT_PRE}resume WHERE itemid=$itemid AND status=3");
$item or dheader($MOD['linkurl']);
if($item['open'] != 3) message($L['msg_resume_close'], $MOD['linkurl']);
if($item['username'] == $_username) message($L['msg_add_self'], $MOD['linkurl']);
$linkurl = $MOD['linkurl'].$item['linkurl'];
$item = $db->get_one("SELECT * FROM {$DT_PRE}job_talent WHERE resumeid=$itemid AND username='$_username'");
if($item) message($L['msg_talent_exist'], $linkurl);
$db->query("INSERT INTO {$DT_PRE}job_talent (resumeid,username,jointime) VALUES ('$itemid','$_username','$DT_TIME')");
message($L['msg_talent_success'], $linkurl);
?>