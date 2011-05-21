<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$itemid or exit;
$item = $db->get_one("SELECT title,islink,linkurl,totime,username,company,vip FROM {$table} WHERE itemid=$itemid AND status>2");
$item or exit;
$linkurl = $item['islink'] ? $item['linkurl'] : linkurl($MOD['linkurl'].$item['linkurl'], 1);
require DT_ROOT.'/include/post.func.php';
include load('misc.lang');
$error = '';
if($_userid) {
	$user = userinfo($_username);
	$company = $user['company'];
	$truename = $user['truename'];
	$telephone = $user['telephone'] ? $user['telephone'] : $user['mobile'];
	$email = $user['mail'] ? $user['mail'] : $user['email'];
	$qq = $user['qq'];
	$msn = $user['msn'];
}
$MG['message_limit'] > -1 or $error = lang('message->without_permission');
$limit_used = $limit_free = 0;
if($MG['message_limit']) {
	$today = strtotime(timetodate($DT_TIME, 3).' 00:00:00');
	$sql = $_userid ? "fromuser='$_username'" : "ip='$DT_IP'";
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}message WHERE $sql AND addtime>$today AND status=3");
	$limit_used = $r['num'];
	$limit_used < $MG['message_limit'] or $error = lang($L['message_limit'], array($MG['message_limit'], $limit_used));
	$limit_free = $MG['message_limit'] > $limit_used ? $MG['message_limit'] - $limit_used : 0;
}
if($item['totime'] && $DT_TIME > $item['totime']) $error = $L['has_expired'];
if(!$item['username']) $error = $L['com_not_member'];
$need_captcha = $MOD['captcha_message'] == 2 ? $MG['captcha'] : $MOD['captcha_message'];
$need_question = $MOD['question_message'] == 2 ? $MG['question'] : $MOD['question_message'];
if($submit) {
	if($error) dalert($error);
	if($_username && $_username == $item['username']) dalert($L['send_self']);
	$msg = captcha($captcha, $need_captcha, true);
	if($msg) dalert($msg);
	$msg = question($answer, $need_question, true);
	if($msg) dalert($msg);
	$title = htmlspecialchars(trim($title));
	if(!$title) dalert($L['msg_type_title']);
	$content = htmlspecialchars(trim($content));
	if(!$content) dalert($L['msg_type_content']);
	if(!$_userid) {
		$truename = htmlspecialchars(trim($truename));
		if(!$truename) message($L['msg_type_truename']);
		$telephone = htmlspecialchars(trim($telephone));
		if(!$telephone) message($L['msg_type_telephone']);
		$email = htmlspecialchars(trim($email));
		$company = htmlspecialchars(trim($company));
		$qq = htmlspecialchars(trim($qq));
		$msn = htmlspecialchars(trim($msn));
	}
	$content = nl2br($content);
	if($company) $content .= '<br/>'.$L['content_company'].$company;
	if($truename) $content .= '<br/>'.$L['content_truename'].$truename;
	if($telephone) $content .= '<br/>'.$L['content_telephone'].$telephone;
	if(is_email($email)) $content .= '<br/>'.$L['content_email'].$email;
	if(is_numeric($qq)) $content .= '<br/>'.$L['content_qq'].' '.im_qq($qq).' '.$qq;
	if($ali) $content .= '<br/>'.$L['content_ali'].' '.im_ali($ali).' '.$ali;
	if(is_email($msn)) $content .= '<br/>'.$L['content_msn'].' '.im_msn($msn).' '.$msn;
	if($skype) $content .= '<br/>'.$L['content_skype'].' '.im_skype($skype).' '.$skype;
	if(is_date($date)) $content .= '<br/>'.lang($L['content_date'], array($date));	
	$message = $L['content_info'].'<a href="'.$linkurl.'"><strong>'.$item['title'].'</strong></a><br/>'.$content;
	//send sms
	if($DT['sms'] && $_sms && $item['username'] && isset($sendsms)) {
		$touser = memberinfo($item['username']);
		if($touser['mobile'] && $touser['vmobile']) {
			$message = lang('sms->sms_message', array($item['title'], $itemid, $truename, $telephone));
			$message = strip_sms($message);
			$word = word_count($message);
			$sms_num = ceil($word/$DT['sms_len']);
			if($sms_num <= $_sms) {
				$sms_code = send_sms($touser['mobile'], $message, $word);
				if(strpos($sms_code, $DT['sms_ok']) !== false) {
					$tmp = explode('/', $sms_code);
					if(is_numeric($tmp[1])) $sms_num = $tmp[1];
					if($sms_num) sms_add($_username, -$sms_num);
					if($sms_num) sms_record($_username, -$sms_num, $_username, $MOD['name'].$L['sms_message'], 'ID:'.$itemid);
				}
			}
		}
	}
	//send sms
	if(send_message($item['username'], $title, $message, 3, $_username)) {
		dalert($L['msg_message_success'], '', 'parent.window.location=parent.window.location;');
	} else {
		dalert($_userid ? $L['msg_member_failed'] : $L['msg_guest_failed']);
	}
} else {	
	$iask = explode('|', trim($MOD['message_ask']));
	isset($content) or $content = '';
	$date = timetodate($DT_TIME + 5*86400, 3);
	$title = lang($L['info_message_title'], array($item['title']));
	$head_title = $L['info_head_title'].$DT['seo_delimiter'].$item['title'].$DT['seo_delimiter'].$MOD['name'];
	$template = $MOD['template_message'] ? $MOD['template_message'] : 'message';
	include template($template, $module);
}
?>