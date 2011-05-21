<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$itemid or dheader($MOD['linkurl']);
$table = $DT_PRE.'resume';
$table_data = $DT_PRE.'resume_data';
$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid AND status=3");
if($item) {
	if($item['open'] != 3) {
		$head_title = $L['msg_resume_close'];
		exit(include template('show-notfound', 'message'));
	}
	extract($item);
} else {
	$head_title = lang('message->item_not_exists');
	@header("HTTP/1.1 404 Not Found");
	exit(include template('show-notfound', 'message'));
}
$content = $db->get_one("SELECT content FROM {$table_data} WHERE itemid=$itemid");
$content = $content['content'];
$print = isset($print) ? 1 : 0;
$CAT = get_cat($catid);
if(!check_group($_groupid, $MOD['group_show_resume']) || !check_group($_groupid, $CAT['group_show'])) {
	$head_title = lang('message->without_permission');
	exit(include template('noright', 'message'));
}
$parentid = $CATEGORY[$catid]['parentid'] ? $CATEGORY[$catid]['parentid'] : $catid;
$adddate = timetodate($addtime, 3);
$editdate = timetodate($edittime, 3);
$linkurl = linkurl($MOD['linkurl'].$linkurl, 1);
$user_status = 4;
$fee = get_fee($item['fee'], $MOD['fee_view_resume']);
$currency = $MOD['fee_currency'];
$unit = $currency == 'money' ? $DT['money_unit'] : $DT['credit_unit'];
$name = $currency == 'money' ? $DT['money_name'] : $DT['credit_name'];
if(check_group($_groupid, $MOD['group_contact_resume'])) {
	if($MG['fee_mode'] && $MOD['fee_mode']) {
		$user_status = 3;
	} else {
		if($fee) {
			$mid = -$moduleid;
			if($_userid) {
				if(check_pay($mid, $itemid)) {
					$user_status = 3;
				} else {
					$user_status = 2;
					$item['title'] = lang($L['resume_title'], array($truename));
					$pay_url = linkurl($MODULE[2]['linkurl'], 1).'pay.php?mid='.$mid.'&itemid='.$itemid.'&fee='.$fee.'&currency='.$currency.'&sign='.crypt_sign($_username.$mid.$itemid.$fee.$currency.$linkurl.$item['title']).'&title='.rawurlencode($item['title']).'&forward='.urlencode($linkurl);
				}
			} else {
				$user_status = 0;
			}
		} else {
			$user_status = 3;
		}
	}
} else {
	$user_status = $_userid ? 1 : 0;
}
if($_username && $_username == $item['username']) $user_status = 3;
$description = '';
if($print) {
	if($user_status != 3) dheader($linkurl);
	include template('print_resume', $module);
} else {
	$db->query("UPDATE {$table} SET hits=hits+1 WHERE itemid=$itemid");
	include DT_ROOT.'/include/seo.inc.php';
	$seo_title = lang($L['resume_title'], array($truename)).$seo_delimiter.$seo_catname.$seo_modulename.$seo_delimiter.$seo_sitename;
	$head_keywords = $keyword;
	$head_description = $introduce ? $introduce : $title;
	$template = $item['template'] ? $item['template'] : 'resume';
	include template($template, $module);
}
?>