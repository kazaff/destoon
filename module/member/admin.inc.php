<?php 
defined('IN_DESTOON') or exit('Access Denied');
$admin_user = false;
if($_groupid == 1) {
	$admin_user = decrypt(get_cookie('admin_user'));
	if($admin_user) {
		$user = explode('|', $admin_user);
		if($_username = $user[1]) {
			$userid = $user[0];
			$user = $db->get_one("SELECT username,passport,company,truename,password,groupid,email,message,sms,credit,money,loginip,admin,edittime FROM {$DT_PRE}member WHERE userid=$userid");
			if($user) {
				$_userid = $userid;
				extract($user, EXTR_PREFIX_ALL, '');
				$MG = cache_read('group-'.$_groupid.'.php');
				$admin_user = true;
			}
		}
	}
}
?>