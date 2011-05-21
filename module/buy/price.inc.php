<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$itemid or dheader($MOD['linkurl']);
$MG['price_limit'] > -1 or dalert(lang('message->without_permission'), 'goback');
include load('misc.lang');
$limit_used = $limit_free = 0;
if($MG['price_limit']) {
	$today = strtotime(timetodate($DT_TIME, 3).' 00:00:00');
	$sql = $_userid ? "fromuser='$_username'" : "ip='$DT_IP'";
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}message WHERE $sql AND addtime>$today AND typeid=2 AND status=3");
	$limit_used = $r['num'];
	$limit_used < $MG['price_limit'] or dalert(lang($L['message_limit'], array($MG['price_limit'], $limit_used)), 'goback');

	$limit_free = $MG['price_limit'] > $limit_used ? $MG['price_limit'] - $limit_used : 0;
}
$item = $db->get_one("SELECT title,tag,linkurl,totime,username,company,vip FROM {$table} WHERE itemid=$itemid AND status>2");
$item or dalert(lang('message->item_not_exists'), $MOD['linkurl']);

if($item['totime'] && $DT_TIME > $item['totime']) dalert($L['has_expired'], 'goback');
if($item['username']) {
	if($_username == $item['username']) dalert($L['price_self'], 'goback');
} else {
	dalert($L['com_not_member'], 'goback');
}

$linkurl = linkurl($MOD['linkurl'].$item['linkurl'], 1);
require DT_ROOT.'/include/post.func.php';
if($_userid) {
	$user = userinfo($_username);
	$company = $user['company'];
	$truename = $user['truename'];
	$telephone = $user['telephone'] ? $user['telephone'] : $user['mobile'];
	$email = $user['mail'] ? $user['mail'] : $user['email'];
	$qq = $user['qq'];
	$msn = $user['msn'];
}
$need_captcha = $MOD['captcha_price'] == 2 ? $MG['captcha'] : $MOD['captcha_price'];
$need_question = $MOD['question_price'] == 2 ? $MG['question'] : $MOD['question_price'];
if($submit) {
	captcha($captcha, $need_captcha);
	question($answer, $need_question);
	$title = htmlspecialchars(trim($title));
	if(!$title) message($L['msg_type_title']);
	$content = htmlspecialchars(trim($content));
	if(!$content) message($L['msg_type_content']);
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
	if(is_date($date)) $content .= '<hr size="1"/>'.lang($L['content_date'], array($date));	
	$message = $L['content_product'].'<a href="'.$linkurl.'"><strong>'.$item['title'].'</strong></a><br/>'.$content;
	//send sms
	if($DT['sms'] && $_sms && $item['username'] && isset($sendsms)) {
		$touser = memberinfo($item['username']);
		if($touser['mobile'] && $touser['vmobile']) {
			$message = lang('sms->sms_price', array($item['tag'], $itemid, $truename, $telephone));
			$message = strip_sms($message);
			$word = word_count($message);
			$sms_num = ceil($word/$DT['sms_len']);
			if($sms_num <= $_sms) {
				$sms_code = send_sms($touser['mobile'], $message, $word);
				if(strpos($sms_code, $DT['sms_ok']) !== false) {
					$tmp = explode('/', $sms_code);
					if(is_numeric($tmp[1])) $sms_num = $tmp[1];
					if($sms_num) sms_add($_username, -$sms_num);
					if($sms_num) sms_record($_username, -$sms_num, $_username, $L['sms_price'], 'ID:'.$itemid);
				}
			}
		}
	}
	//send sms
	if(send_message($item['username'], $title, $message, 2, $_username)) {
		message($L['msg_price_success'], $linkurl);
	} else {
		dalert($_userid ? $L['msg_price_member_failed'] : $L['msg_price_guest_failed'], $linkurl);
	}
} else {	
	$iask = explode('|', trim($MOD['price_ask']));
	$date = timetodate($DT_TIME + 5*86400, 3);
	$title = lang($L['price_message_title'], array($item['title']));
	$head_title = $L['price_head_title'].$DT['seo_delimiter'].$item['title'].$DT['seo_delimiter'].$MOD['name'];
	include template('price', $module);
}
?>