<?php 
defined('IN_DESTOON') or exit('Access Denied');
if($_userid) dheader(DT_PATH);	//如果已经是登陆身份，就直接跳转到首页

require DT_ROOT.'/module/'.$module.'/common.inc.php';	//会员模块下的配置文件

if(isset($print)) exit(include template('agreement', $module));	//打印版本的服务条款

if(!$MOD['enable_register']) message($L['register_msg_close'], DT_PATH);	//是否允许注册

if($MOD['defend_proxy']) {		//是否禁止代理服务器注册
	if($_SERVER['HTTP_X_FORWARDED_FOR'] || $_SERVER['HTTP_VIA'] || $_SERVER['HTTP_PROXY_CONNECTION'] || $_SERVER['HTTP_USER_AGENT_VIA'] || $_SERVER['HTTP_CACHE_INFO'] || $_SERVER['HTTP_PROXY_CONNECTION']) {
		message(lang('include->defend_proxy'));
	}
}

if($MOD['banagent']) {	//群发软件客户端屏蔽
	$banagent = explode('|', $MOD['banagent']);
	foreach($banagent as $v) {
		if(strpos($_SERVER['HTTP_USER_AGENT'], $v) !== false) message($L['register_msg_agent'], DT_PATH, 5);
	}
}

if($MOD['iptimeout']) {		//IP注册间隔限制(小时)
	$timeout = $DT_TIME - $MOD['iptimeout']*3600;
	$r = $db->get_one("SELECT userid FROM {$DT_PRE}member WHERE regip='$DT_IP' AND regtime>'$timeout'");
	if($r) message(lang($L['register_msg_ip'], array($MOD['iptimeout'])), DT_PATH);
}

//如果网站关闭了邮件发送功能，那么如果新用户注册选择的是邮件验证，那么将失效
if($DT['mail_type'] == 'close' && $MOD['checkuser'] == 2) $MOD['checkuser'] = 0;

require DT_ROOT.'/include/post.func.php';

require MD_ROOT.'/member.class.php';
$do = new member;

//是否开启注册邮件验证码
$could_emailcode = ($MOD['emailcode_register'] && $DT['mail_type'] != 'close');		
if($could_emailcode) {
	$session = new dsession();
	if($MOD['checkuser'] == 2) $MOD['checkuser'] = 0;
}

//AJAX发送邮件验证码？
$action_sendcode = crypt_action('sendcode');	//请求口令
if($action == $action_sendcode) {	//如果本次请求的$action==banagent，证明该请求目的是为了发送EMAILL验证码
	$email = isset($value) ? trim($value) : '';
	if(!is_email($email)) exit('2');	//如果是无效邮箱，则返回2
	if($do->email_exists($email)) exit('3');	//如果邮箱已存在，则返回3
	$_SESSION['email'] = $email;
	$_SESSION['emailcode'] = $emailcode = random(6, '0123456789');
	$title = $L['register_msg_emailcode'];
	$content = ob_template('emailcode', 'mail');
	send_mail($email, $title, stripslashes($content));
	exit('1');	//成功返回1
}

//自定义字段（后台）
$FD = $MFD = cache_read('fields-member.php');
$CFD = cache_read('fields-company.php');
isset($post_fields) or $post_fields = array();
if($MFD || $CFD) require DT_ROOT.'/include/fields.func.php';

$GROUP = cache_read('group.php');
if($submit) {
	//如果本次请求的$action不等于crypt_action('register')，则直接弹错
	if($action != crypt_action('register')) dalert($L['check_sign']);
	
	//会员整合
	$post['passport'] = isset($post['passport']) && $post['passport'] ? $post['passport'] : $post['username'];
	if($MOD['passport'] == 'uc') {
		require DT_ROOT.'/api/uc.inc.php';
		list($uid, $rt_username, $rt_password, $rt_email) = uc_user_login($post['passport'], $post['password']);
		if($uid == -2) dalert($L['register_msg_passport'], '', 'parent.$("passport").focus();');
	}
	
	//验证码审核
	$msg = captcha($captcha, $MOD['captcha_register'], true);
	if($msg) dalert($msg);
	
	//安全问题审核
	$msg = question($answer, $MOD['question_register'], true);
	if($msg) dalert($msg);
	
	//??
	$RG = array();
	foreach($GROUP as $k=>$v) {
		if($k > 4 && $v['vip'] == 0) $RG[] = $k;
	}
	
	$reload_captcha = $MOD['captcha_register'] ? reload_captcha() : '';
	$reload_question = $MOD['question_register'] ? reload_question() : '';
	
	
	in_array($post['regid'], $RG) or dalert($L['register_pass_groupid'], '', $reload_captcha.$reload_question);
	if($could_emailcode) {
		if(!preg_match("/[0-9]{6}/", $post['emailcode']) || $post['emailcode'] != $_SESSION['emailcode'] || $post['email'] != $_SESSION['email']) dalert($L['register_pass_emailcode'], '', $reload_captcha.$reload_question);
	}
	
	//如果是个人，则公司名为：真实姓名.(个人)
	if($post['regid'] == 5) $post['company'] = $post['truename'].$L['individual_sign'];
	//如果设置需要审核，则groupid=4（表示待审核会员组）
	$post['groupid'] = $MOD['checkuser'] ? 4 : $post['regid'];
	
	$post['content'] = $post['introduce'] = $post['thumb'] = $post['banner'] = $post['catid'] = $post['catids'] = '';
	$post['edittime'] = 0;
	$inviter = get_cookie('inviter');
	if($inviter) $post['inviter'] = decrypt($inviter);
	if($do->add($post)) {
		if($MFD) fields_update($post_fields, $do->tb_member, $do->userid, 'userid', $MFD);
		if($CFD) fields_update($post_fields, $do->tb_company, $do->userid, 'userid', $CFD);
		if($MOD['passport'] == 'uc') uc_user_register($post['passport'], $post['password'], $post['email']);
		$username = $post['username'];
		$email = $post['email'];
		if($MOD['checkuser'] == 2) {
			$auth = make_auth($username);
			$db->query("UPDATE {$DT_PRE}member SET auth='$auth',authvalue='$email',authtime='$DT_TIME' WHERE username='$username'");
			$authurl = linkurl($MOD['linkurl'], 1).'send.php?action=check&auth='.$auth;
			$title = $L['register_msg_activate'];
			$content = ob_template('check', 'mail');
			send_mail($email, $title, $content);
			$goto = $MOD['linkurl'].'goto.php?action=register&email='.$email;
			dalert('', '', 'top.window.location="'.$goto.'";');
		} else if($MOD['checkuser'] == 0) {
			if($MOD['welcome'] > 0) {
				$title = $L['register_msg_welcome'];
				$content = ob_template('welcome', 'mail');
				if($MOD['welcome'] == 1 || $MOD['welcome'] == 3) send_message($username, $title, $content);
				if(($MOD['welcome'] == 2 || $MOD['welcome'] == 3) && $DT['mail_type'] != 'close') send_mail($post['email'], $title, $content);
			}
		}
		if($could_emailcode) {
			$db->query("UPDATE {$DT_PRE}member SET vemail='1' WHERE username='$username'");
			$_SESSION['email'] = $_SESSION['emailcode'] = '';
		}
		$do->login($username, '', 0, true);
		dalert('', '', 'top.window.location="'.$MOD['linkurl'].'";');
	} else {
		$reload_captcha = $MOD['captcha_register'] ? reload_captcha() : '';
		$reload_question = $MOD['question_register'] ? reload_question() : '';
		dalert($do->errmsg, '', $reload_captcha.$reload_question);
	}
} else {	//处理注册选项
	
	$COM_TYPE = explode('|', $MOD['com_type']);		//公司类型
	$COM_SIZE = explode('|', $MOD['com_size']);		//公司规模
	$COM_MODE = explode('|', $MOD['com_mode']);		//经营模式
	$MONEY_UNIT = explode('|', $MOD['money_unit']);	//公司注册资本货币类型
	
	$mode_check = dcheckbox($COM_MODE, 'post[mode][]', '', 'onclick="check_mode(this);"', 0);
	
	$auth = isset($auth) ? urldecode($auth) : '';	//??? 只知道$auth肯定是url传参
	$username = $password = $email = $passport = '';
	if($auth) {
		$auth = decrypt($auth);
		$auth = explode('|', $auth);
		$passport = $auth[0];
		if(check_name($passport)) $username = $passport;
		$password = $auth[1];
		$email = is_email($auth[2]) ? $auth[2] : '';
	}
	$head_title = $L['register_title'];
	include template('register', $module);
}
?>