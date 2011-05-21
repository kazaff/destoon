<?php 
defined('IN_DESTOON') or exit('Access Denied');
login();
require DT_ROOT.'/module/'.$module.'/common.inc.php';
require MD_ROOT.'/member.class.php';
require DT_ROOT.'/include/post.func.php';
$do = new member;
$do->userid = $_userid;
$user = $do->get_one();
$CATEGORY = cache_read('category-4.php');

$MFD = cache_read('fields-member.php');
$CFD = cache_read('fields-company.php');
isset($post_fields) or $post_fields = array();
if($MFD || $CFD) require DT_ROOT.'/include/fields.func.php';

$tab = isset($tab) ? intval($tab) : 0;
if($submit) {
	if($post['password'] && $user['password'] != md5(md5($post['oldpassword']))) message($L['error_password']);
	if($post['payword'] && $user['payword'] != md5(md5($post['oldpayword']))) message($L['error_payword']);
	$post['groupid'] = $user['groupid'];
	$post['email'] = $user['email'];
	$post['passport'] = $user['passport'];
	$post['company'] = $user['company'];
	$post['domain'] = $user['domain'];
	$post['icp'] = $user['icp'];
	$post['banner'] = $user['banner'];
	$post['skin'] = $user['skin'];
	$post['template'] = $user['template'];
	$post['edittime'] = $DT_TIME;
	$post['bank'] = $user['bank'];
	$post['account'] = $user['account'];
	$post['validated'] = $user['validated'];
	$post['validator'] = $user['validator'];
	$post['validtime'] = $user['validtime'];
	$post['vemail'] = $user['vemail'];
	$post['vmobile'] = $user['vmobile'];
	$post['vtruename'] = $user['vtruename'];
	$post['vbank'] = $user['vbank'];
	$post['vcompany'] = $user['vcompany'];
	if($post['vmobile']) $post['mobile'] = $user['mobile'];
	if($post['vtruename']) $post['truename'] = $user['truename'];
	if($MFD) fields_check($post_fields, $MFD);
	if($CFD) fields_check($post_fields, $CFD);
	if($do->edit($post)) {
		if($MFD) fields_update($post_fields, $do->tb_member, $do->userid, 'userid', $MFD);
		if($CFD) fields_update($post_fields, $do->tb_company, $do->userid, 'userid', $CFD);
		if($user['edittime'] == 0 && $user['inviter'] && $MOD['credit_user']) {
			$inviter = $user['inviter'];
			$r = $db->get_one("SELECT itemid FROM {$DT_PRE}finance_credit WHERE note='$_username' AND username='$inviter'");
			if(!$r) {
				credit_add($inviter, $MOD['credit_user']);
				credit_record($inviter, $MOD['credit_user'], 'system', $L['edit_invite'], $_username);
			}
		}
		if($user['edittime'] == 0 && $MOD['credit_edit']) {
			credit_add($_username, $MOD['credit_edit']);
			credit_record($_username, $MOD['credit_edit'], 'system', $L['edit_profile'], $DT_IP);
		}
		message($L['edit_msg_success'], '?tab='.$tab);
	} else {
		message($do->errmsg);
	}
} else {
	$COM_TYPE = explode('|', $MOD['com_type']);
	$COM_SIZE = explode('|', $MOD['com_size']);
	$COM_MODE = explode('|', $MOD['com_mode']);
	$MONEY_UNIT = explode('|', $MOD['money_unit']);
	$head_title = $L['edit_title'];
	extract($user);
	$mode_check = dcheckbox($COM_MODE, 'post[mode][]', $mode, 'onclick="check_mode(this, '.$MOD['mode_max'].');"', 0);
	$content_table = content_table(4, $userid, is_file(DT_CACHE.'/4.part'), $DT_PRE.'company_data');
	$d = $db->get_one("SELECT content FROM {$content_table} WHERE userid=$userid");
	$introduce = $d['content'];
	$cates = $catid ? explode(',', substr($catid, 1, -1)) : array();
	$tab = isset($tab) ? intval($tab) : -1;
	if($tab == 2 && $_groupid < 6) $tab = 0;
	include template('edit', $module);
}
?>