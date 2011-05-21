<?php

define('IN_DISCUZ', TRUE);

define('UC_CLIENT_VERSION', '1.5.0');	
define('UC_CLIENT_RELEASE', '20081031');

define('API_DELETEUSER', 1);		
define('API_RENAMEUSER', 1);		
define('API_GETTAG', 1);	
define('API_SYNLOGIN', 1);		
define('API_SYNLOGOUT', 1);		
define('API_UPDATEPW', 1);		
define('API_UPDATEBADWORDS', 1);	
define('API_UPDATEHOSTS', 1);		
define('API_UPDATEAPPS', 1);		
define('API_UPDATECLIENT', 1);	
define('API_UPDATECREDIT', 1);		
define('API_GETCREDITSETTINGS', 1);	
define('API_GETCREDIT', 1);		
define('API_UPDATECREDITSETTINGS', 1);	

define('API_RETURN_SUCCEED', '1');
define('API_RETURN_FAILED', '-1');
define('API_RETURN_FORBIDDEN', '-2');

define('DISCUZ_ROOT', '../');




if(!defined('IN_UC')) {

	error_reporting(0);
	set_magic_quotes_runtime(0);
	
	defined('MAGIC_QUOTES_GPC') || define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	require_once DISCUZ_ROOT.'./config/config_ucenter.php';
	extract($_UC);

	$_DCACHE = $get = $post = array();

	$code = @$_GET['code'];
	parse_str(_authcode($code, 'DECODE', $uc_key), $get);
	if(MAGIC_QUOTES_GPC) {
		$get = _stripslashes($get);
	}

	$timestamp = time();
	
	if($timestamp - $get['time'] > 3600) {
		exit('Authracation has expiried');
	}
	if(empty($get)) {
		exit('Invalid Request');
	}
	$action = $get['action'];

	require_once DISCUZ_ROOT.'./keke_client/ucenter/lib/xml.class.php';
	$post = xml_unserialize(file_get_contents('php://input'));

	if(in_array($get['action'], array('test', 'deleteuser', 'renameuser', 'gettag', 'synlogin', 'synlogout', 'updatepw', 'updatebadwords', 'updatehosts', 'updateapps', 'updateclient', 'updatecredit', 'getcreditsettings', 'updatecreditsettings'))) {
		require_once DISCUZ_ROOT.'./keke_client/ucenter/include/db_mysql.class.php';
		$GLOBALS['db'] = new dbstuff;
		$GLOBALS['db']->connect($uc_dbhost, $uc_dbuser, $uc_dbpw, $uc_dbname, $uc_connect, true, $uc_dbcharset);
		$GLOBALS['tablepre'] = $uc_dbtablepre;
		unset($uc_dbhost, $uc_dbuser, $uc_dbpw, $uc_dbname, $uc_connect);
		$uc_note = new uc_note();
		exit($uc_note->$get['action']($get, $post));
	} else {
		exit(API_RETURN_FAILED);
	}


} else {

	require_once DISCUZ_ROOT.'./connfig/config_ucenter.php';
	require_once DISCUZ_ROOT.'./keke_client/ucenter/include/db_mysql.class.php';
	$GLOBALS['db'] = new dbstuff;
	$GLOBALS['db']->connect($uc_dbhost, $uc_dbuser, $uc_dbpw, $uc_dbname, $uc_connect, true, $uc_dbcharset);
	$GLOBALS['tablepre'] = $uc_dbtablepre;
	unset($uc_dbhost, $uc_dbuser, $uc_dbpw, $uc_dbname, $uc_connect);
}

class uc_note {

	var $dbconfig = '';
	var $db = '';
	var $tablepre = '';
	var $appdir = '';

	function _serialize($arr, $htmlon = 0) {
		if(!function_exists('xml_serialize')) {
			include_once DISCUZ_ROOT.'./keke_client/ucenter/lib/xml.class.php';
		}
		return xml_serialize($arr, $htmlon);
	}

	function uc_note() {
		$this->appdir = DISCUZ_ROOT;
		$this->dbconfig = $this->appdir.'./config/config_ucenter.php';
		$this->db = $GLOBALS['db'];
		$this->tablepre = $uc_dbtablepre;
	}

	function test($get, $post) {
		return API_RETURN_SUCCEED;
	}

	function deleteuser($get, $post) {
		$uids = $get['ids'];
		!API_DELETEUSER && exit(API_RETURN_FORBIDDEN);
		
		$db = $this->db;
		$tablepre = $this->tablepre;
		$db->query("delete from ".$tablepre."witkey_member where uid in($uids)");
		$db->query("delete from ".$tablepre."witkey_space where uid in($uids)");
		return API_RETURN_SUCCEED;
	}

	function renameuser($get, $post) {
		$uid = $get['uid'];
		$usernameold = $get['oldusername'];
		$usernamenew = $get['newusername'];
		if(!API_RENAMEUSER) {
			return API_RETURN_FORBIDDEN;
		}
		
		$db = $this->db;
		$tablepre = $this->tablepre;
		$db->query("update ".$tablepre."witkey_member set username='$usernamenew''' where uid=$uid and username='$usernameold'");
		$db->query("update ".$tablepre."witkey_space set username='$usernamenew' where uid=$uid and username='$usernameold'");

		return API_RETURN_SUCCEED;
	}

	function gettag($get, $post) {
		$name = $get['id'];
		if(!API_GETTAG) {
			return API_RETURN_FORBIDDEN;
		}
		
		$return = array();
		return $this->_serialize($return, 1);
	}

	function synlogin($get, $post) {
		$syn_uid = $get['uid'];
		$syn_username = $get['username'];
		if(!API_SYNLOGIN) {
			return API_RETURN_FORBIDDEN;
		}
		
		require '../app_comm.php';
		$_SESSION['uid'] = $syn_uid;
		$_SESSION['username'] = $syn_username;
		Func_comm_class::prom_check();
		header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');

	}

	function synlogout($get, $post) {
		if(!API_SYNLOGOUT) {
			return API_RETURN_FORBIDDEN;
		}

	
		header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
		session_start();
		$_SESSION['uid'] = '';
		$_SESSION['username'] = '';
	}

	function updatepw($get, $post) {
		if(!API_UPDATEPW) {
			return API_RETURN_FORBIDDEN;
		}
		$username = $get['username'];
		$password = $get['password'];
		
		$db = $this->db;
		$tablepre = $this->tablepre;
		$db->query("update ".$tablepre."witkey_space set password = '$password' where username = '$username'");
		$db->query("update ".$tablepre."witkey_member set password = '$password' where username = '$username'");
		
		return API_RETURN_SUCCEED;
	}

	function updatebadwords($get, $post) {
		if(!API_UPDATEBADWORDS) {
			return API_RETURN_FORBIDDEN;
		}

		return API_RETURN_SUCCEED;
	}

	function updatehosts($get, $post) {
		if(!API_UPDATEHOSTS) {
			return API_RETURN_FORBIDDEN;
		}

		return API_RETURN_SUCCEED;
	}

	function updateapps($get, $post) {
		if(!API_UPDATEAPPS) {
			return API_RETURN_FORBIDDEN;
		}

	
		return API_RETURN_SUCCEED;
	}

	function updateclient($get, $post) {
		if(!API_UPDATECLIENT) {
			return API_RETURN_FORBIDDEN;
		}

		return API_RETURN_SUCCEED;
	}

	function updatecredit($get, $post) {
		if(!API_UPDATECREDIT) {
			return API_RETURN_FORBIDDEN;
		}

		return API_RETURN_SUCCEED;
	}

	function getcredit($get, $post) {

	}

	function getcreditsettings($get, $post) {
		if(!API_GETCREDITSETTINGS) {
			return API_RETURN_FORBIDDEN;
		}
		$credits = array();
		return $this->_serialize($credits);
	}

	function updatecreditsettings($get, $post) {
		if(!API_UPDATECREDITSETTINGS) {
			return API_RETURN_FORBIDDEN;
		}
		return API_RETURN_SUCCEED;
	}
}


function _setcookie($var, $value, $life = 0, $prefix = 1) {
	global $cookiepre, $cookiedomain, $cookiepath, $timestamp, $_SERVER;
	setcookie(($prefix ? $cookiepre : '').$var, $value,
		$life ? $timestamp + $life : 0, $cookiepath,
		$cookiedomain, $_SERVER['SERVER_PORT'] == 443 ? 1 : 0);
}

function _authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
	$ckey_length = 4;

	$key = md5($key ? $key : UC_KEY);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
				return '';
			}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}

}

function _stripslashes($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = _stripslashes($val);
		}
	} else {
		$string = stripslashes($string);
	}
	return $string;
}