<?php 
defined('IN_DESTOON') or exit('Access Denied');
login();
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$MG['homepage'] && $MG['link_limit'] > -1 or dalert(lang('message->without_permission_and_upgrade'), 'goback');
require DT_ROOT.'/include/post.func.php';
require MD_ROOT.'/link.class.php';
$do = new dlink();
switch($action) {
	case 'add':
		if($MG['link_limit']) {
			$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}link WHERE username='$_username' AND status>0");
			if($r['num'] >= $MG['link_limit']) dalert(lang($L['limit_add'], array($MG['link_limit'], $r['num'])), 'goback');
		}
		if($submit) {
			$post['username'] = $_username;
			if($do->pass($post)) {
				$need_check =  $MOD['link_check'] == 2 ? $MG['check'] : $MOD['link_check'];
				$post['status'] = get_status(3, $need_check);
				$do->add($post);
				dmsg($L['op_add_success'], $MOD['linkurl'].'link.php?status='.$post['status']);
			} else {
				message($do->errmsg);
			}
		} else {		
			$addtime = timetodate($DT_TIME);
			$head_title = $L['link_title_add'];
		}
	break;
	case 'edit':
		$itemid or message();
		$do->itemid = $itemid;
		$r = $do->get_one();
		if(!$r || $r['username'] != $_username) message();
		if($submit) {
			$post['username'] = $_username;
			if($do->pass($post)) {
				$need_check =  $MOD['link_check'] == 2 ? $MG['check'] : $MOD['link_check'];
				$post['status'] = get_status($r['status'], $need_check);
				$do->edit($post);
				dmsg($L['op_edit_success'], $MOD['linkurl'].'link.php?status='.$post['status']);
			} else {
				message($do->errmsg);
			}
		} else {
			extract($r);
			$head_title = $L['link_title_edit'];
		}
	break;
	case 'delete':
		$itemid or message($L['link_msg_choose']);
		$do->itemid = $itemid;
		$r = $do->get_one();
		if(!$r || $r['username'] != $_username) message();
		$do->delete($itemid);
		dmsg($L['op_del_success'], $forward);
	break;
	default:
		$status = isset($status) ? intval($status) : 3;
		in_array($status, array(2, 3)) or $status = 3;
		$condition = "username='$_username'";
		$condition .= " AND status=$status";
		if($keyword) $condition .= " AND title LIKE '%$keyword%'";
		$lists = $do->get_list($condition);
		$head_title = $L['link_title'];
	break;
}
$nums = array();
$limit_used = 0;
for($i = 2; $i < 4; $i++) {
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}link WHERE username='$_username' AND status=$i");
	$nums[$i] = $r['num'];
	$limit_used += $r['num'];
}
$limit_free = $MG['link_limit'] && $MG['link_limit'] > $limit_used ? $MG['link_limit'] - $limit_used : 0;
include template('link', $module);
?>