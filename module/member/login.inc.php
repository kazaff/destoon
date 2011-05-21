<?php 
defined('IN_DESTOON') or exit('Access Denied');
if($_userid) dheader($MOD['linkurl']);
require DT_ROOT.'/module/'.$module.'/common.inc.php';
require MD_ROOT.'/member.class.php';
require DT_ROOT.'/include/post.func.php';
$do = new member;
$forward = $forward ? linkurl($forward, 1) : $CFG['url'];
if($submit && $MOD['captcha_login'] && strlen($captcha) < 4) $submit = false;
$action = 'login';
if($submit) {
	captcha($captcha, $MOD['captcha_login']);
	if(!$username) message($L['login_msg_username']);
	if(!$password) message($L['login_msg_password']);
	if(is_email($username)) $option = 'email';
	$goto = isset($goto) ? true : false;
	if($goto) $forward = $MOD['linkurl'];
	$cookietime = isset($cookietime) ? $cookietime : 0;
	$msg_code = '';
	isset($option) or $option = 'username';
	in_array($option, array('username', 'passport', 'email', 'userid')) or $option = 'username';
	$r = $db->get_one("SELECT username,passport FROM {$DT_PRE}member WHERE `$option`='$username'");
	if($r) {
		$username = $r['username'];
		$passport = $r['passport'];
	} else {
		if($option == 'username' || $option == 'passport') {
			$passport = $username;
		} else {
			message($L['login_msg_not_member']);
		}
	}
	if($MOD['passport'] == 'uc') require DT_ROOT.'/api/'.$MOD['passport'].'.inc.php';
	$user = $do->login($username, $password, $cookietime);
	if($user) {
		if($MOD['passport'] && $MOD['passport'] != 'uc') {
			$URI = '';
			$user['password'] = is_md5($password) ? $password : md5($password);//Once MD5
			if(strtoupper($MOD['passport_charset']) != strtoupper(DT_CHARSET)) $user = convert($user, DT_CHARSET, $MOD['passport_charset']);
			extract($user);
			require DT_ROOT.'/api/'.$MOD['passport'].'.inc.php';
			if($URI) {
				if($DT['login_log'] == 2) $do->login_log($username, $password, 0);
				dheader($URI);
			}
		}
		if($msg_code) $msg_code = $L['login_msg_success'].$msg_code;
		if($DT['login_log'] == 2) $do->login_log($username, $password, 0);
		message($msg_code, $forward);
	} else {
		if($DT['login_log'] == 2) $do->login_log($username, $password, 0, $do->errmsg);
		message($do->errmsg);
	}
} else {
	isset($username) or $username = $_username;
	isset($password) or $password = '';
	$register = isset($register) && $username ? 1 : 0;
	if(!$username) $username = get_cookie('username');
	if(!check_name($username)) $username = '';
	$head_title = $register ? $L['login_title_reg'] : $L['login_title'];
	include template('login', $module);
}
?>