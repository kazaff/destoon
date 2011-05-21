<?php 
defined('IN_DESTOON') or exit('Access Denied');
define("UC_DBHOST", $MOD['uc_dbhost']) ;
define("UC_DBUSER", $MOD['uc_dbuser']) ;
define("UC_DBPW", $MOD['uc_dbpwd']) ;
define("UC_DBNAME", $MOD['uc_dbname']) ;
define("UC_DBPRE", $MOD['uc_dbpre']) ;
define("UC_KEY", $MOD['uc_key']) ;
define('UC_APPID', $MOD['uc_appid']) ;
define("UC_API", $MOD['uc_api']) ;
define("UC_IP", $MOD['uc_ip']) ;
define("UC_DBTABLEPRE", $MOD['uc_dbpre']);
define("UC_CONNECT", $MOD['uc_mysql'] ? 'mysql' : '');
define('API_RETURN_SUCCEED', 1);
define('UC_DBCHARSET', $MOD['uc_charset']); 
define('API_UPDATECREDIT', 0);
define('API_GETCREDITSETTINGS', 0);
define('API_UPDATECREDITSETTINGS', 0);
require_once DT_ROOT.'/api/ucenter/client.php';
switch($action) {
	case 'login':
		$uc_username = $passport;
		list($uid, $rt_username, $rt_password, $rt_email) = uc_user_login($uc_username, $password);
		$user = $db->get_one("SELECT username,passport,password,groupid,email FROM {$DT_PRE}member WHERE username='$username'");
		if($uid == -1 ) {/* Ucenter 用户不存在或被删除 */
			if($user) {
				$vpassword = preg_match('/^\w{32}$/', $password) ? md5($password) : md5(md5($password));
				if($user['password'] !=  $vpassword) message('密码错误，请重试');
				if($user['groupid'] == 2) message('该帐号已被禁止访问');
				//if($user['groupid'] == 4) message('该帐号尚在审核中');
				/* 尝试注册一个UC帐户 */
				$uid = uc_user_register($uc_username, $password, $user['email']);
				if($uid > 0) $msg_code = uc_user_synlogin($uid);
			} else {
				message('用户不存在或被删除');
			}
		} else if($uid == -2) {/* Ucenter 密码错误 */
			if($user) {
				if($user['password'] == (preg_match('/^\w{32}$/', $password) ? md5($password) : md5(md5($password)))) { /* 更新UC密码 */
					uc_user_edit($uc_username, '', $password, '', 1);
					$uc_get_user = uc_get_user($uc_username);
					if($uc_get_user[0]) $msg_code = uc_user_synlogin($uc_get_user[0]);
				} else {
					message('密码错误，请重试');
				}
			} else {
				message('Ucenter密码错误，请用Ucenter密码登录');
			}
		} else if($uid == -3) {/* Ucenter 安全提问错 */
			message('如果需要同步登录Ucenter，请取消Ucenter安全提问');
		} else if($uid > 0) {/* Ucenter 验证成功 */
			$msg_code = uc_user_synlogin($uid);
			if($user) {
				$vpassword = preg_match('/^\w{32}$/', $password) ? md5($password) : md5(md5($password));/* 同步DT密码 */
				if($user['password'] != $vpassword) $db->query("UPDATE {$DT_PRE}member SET password='$vpassword' WHERE username='$username'");
			} else {/* 会员不存在 */
				$auth = urlencode(encrypt($username.'|'.$rt_password.'|'.$rt_email));
				message('请激活您的通行证账号', $MOD['linkurl'].$DT['file_register'].'?auth='.$auth);
			}
		}
	break;
	case 'logout':
		$msg_code = uc_user_synlogout();
	break;
	case 'passport':
		$could_passport = false;
		$uc_username = $passport;
		list($uid, $rt_username, $rt_password, $rt_email) = uc_user_login($uc_username, md5(random(8)));
		if($uid == -1) $could_passport = true;
	break;
}
?>