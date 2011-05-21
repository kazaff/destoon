<?php 
defined('IN_DESTOON') or exit('Access Denied');
login();
$MG['mail'] or dalert(lang('message->without_permission_and_upgrade'), 'goback');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
require DT_ROOT.'/include/post.func.php';
$TYPE = get_type('mail', 1);
$TYPE or message($L['feature_close']);
foreach($TYPE as $k=>$v) {
	$TYPE[$k]['typename'] = set_style($v['typename'], $v['style']);
}
$r = $db->get_one("SELECT * FROM {$DT_PRE}mail_list WHERE username='$_username'");
switch($action) {
	case 'cancel':
		if($r) {
			$db->query("DELETE FROM {$DT_PRE}mail_list WHERE username='$_username'");
		} else {
			message($L['mail_msg_not_add']);
		}
		dmsg($L['mail_msg_cancel'], $MOD['linkurl'].'mail.php');
	break;
	case 'show':
		$itemid or message();
		$r = $db->get_one("SELECT * FROM {$DT_PRE}mail WHERE itemid=$itemid");
		$r or message($L['mail_msg_not_item']);
		$r['editdate'] = timetodate($r['edittime'], 5);
		$r['adddate'] = timetodate($r['addtime'], 5);
	break;
	case 'list':
		$r or message($L['mail_msg_not_add']);
		$typeids = substr($r['typeids'], 1, -1);
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}mail WHERE typeid IN ($typeids)");
		$pages = pages($r['num'], $page, $pagesize);		
		$mails = array();
		$result = $db->query("SELECT * FROM {$DT_PRE}mail WHERE typeid IN ($typeids) ORDER BY itemid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['editdate'] = timetodate($r['edittime'], 5);
			$r['adddate'] = timetodate($r['addtime'], 5);
			$mails[] = $r;
		}
		$head_title = $L['mail_title_list'];
	break;
	default:
		if($submit) {
			(isset($typeids) && is_array($typeids) && $typeids) or message($L['mail_msg_choose'], $MOD['linkurl'].'mail.php');
			foreach($typeids as $t) {
				$_typeids .= intval($t).',';
			}
			$_typeids = ','.$_typeids;
			if($r) {
				$db->query("UPDATE {$DT_PRE}mail_list SET email='$_email',typeids='$_typeids',edittime='$DT_TIME' WHERE username='$_username'");
			} else {
				$db->query("INSERT INTO {$DT_PRE}mail_list (username,email,typeids,addtime,edittime) VALUES ('$_username','$_email','$_typeids','$DT_TIME','$DT_TIME')");
			}
			dmsg($L['mail_msg_update'], 'mail.php');
		} else {
			$mytypeids = array();
			if($r) {
				$r['typeids'] = substr($r['typeids'], 1, -1);
				$mytypeids = explode(',', $r['typeids']);
				$addtime = timetodate($r['addtime'], 5);
				$edittime = timetodate($r['edittime'], 5);
			}
			$_TYPE = $TYPE;
			$TYPE = array();
			foreach($_TYPE as $v) {
				$TYPE[] = $v;
			}
			$head_title = $L['mail_title'];
		}
	break;
}
include template('mail', $module);
?>