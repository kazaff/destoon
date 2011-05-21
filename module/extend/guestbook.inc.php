<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$MOD['guestbook_enable'] or dheader(DT_PATH);
require DT_ROOT.'/include/post.func.php';
require MD_ROOT.'/guestbook.class.php';
$do = new guestbook();
if($submit) {
	captcha($captcha);
	if($do->pass($post)) {
		$do->add($post);
		message($L['gbook_success'], $forward);
	} else {
		message($do->errmsg);
	}
} else {
	$condition = "status=3 AND reply<>''";
	if($keyword) $condition .= " AND title LIKE '%$keyword%'";
	$lists = $do->get_list($condition);
	$head_title = $L['gbook_title'];
	isset($title) or $title = '';
	isset($content) or $content = '';
	$truename = $telephone = $email = $qq = $msn = $ali = $skype = '';
	if($_userid) {
		$user = userinfo($_username);
		$truename = $user['truename'];
		$telephone = $user['telephone'] ? $user['telephone'] : $user['mobile'];
		$email = $user['mail'] ? $user['mail'] : $user['email'];
		$qq = $user['qq'];
		$msn = $user['msn'];
		$ali = $user['ali'];
		$skype = $user['skype'];
	}
	include template('guestbook', $module);
}
?>