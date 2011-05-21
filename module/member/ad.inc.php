<?php 
defined('IN_DESTOON') or exit('Access Denied');
login();
require DT_ROOT.'/module/'.$module.'/common.inc.php';
require DT_ROOT.'/include/post.func.php';
$MG['ad'] or dalert(lang('message->without_permission_and_upgrade'), 'goback');
include load('extend.lang');
$adurl = extendurl('ad');
$TYPE = $L['ad_type'];
if($action == 'add') {
	$pid = isset($pid) ? intval($pid) : 0;
	if($pid) {
		$_MOD = cache_read('module-3.php');
		$_MOD['ad_buy'] or dheader($MOD['linkurl'].'ad.php');
		$currency = $_MOD['ad_currency'];
		$unit = $currency == 'money' ? $DT['money_unit'] : $DT['credit_unit'];
		$p = $db->get_one("SELECT * FROM {$DT_PRE}ad_place WHERE pid=$pid");
		$p or message($L['not_ad_place'], $adurl);
		$months = array(1, 2, 3, 6, 12, 24);
		$t = $db->get_one("SELECT MAX(totime) AS totime FROM {$DT_PRE}ad WHERE pid=$pid AND totime>$DT_TIME");
		$fromtime = $t['totime'] ? $t['totime'] : $DT_TIME + 86400;
		$fromdate = timetodate($fromtime, 3);
		$typeid = $p['typeid'];
		$price = $p['price'];
		if($submit) {
			(is_date($post['fromtime']) && $post['fromtime'] >= $fromdate) or message($L['pass_ad_from']);
			in_array($month, $months) or message($L['pass_ad_month']);
			$amount = $price*$month;
			if($amount) {
				if($currency == 'money') {
					if($amount > $_money) message($L['money_not_enough'], $MODULE[2]['linkurl'].'charge.php?action=pay&amount='.($amount-$_money));
					is_payword($_username, $password) or message($L['error_payword']);
				} else {
					if($amount > $_credit) message($L['credit_not_enough'], $MODULE[2]['linkurl'].'credits.php?action=buy&amount='.($amount-$_credit));
				}
			}
			$ad = array();
			$ad['image_src'] = $ad['flash_src'] = $ad['code'] = '';
			if($typeid == 1 || $typeid == 7) {
				if(strlen($post['code']) < 10) message($L['pass_ad_code']);
				$ad['code'] = $post['code'];
			} else if($typeid == 2) {
				if(strlen($post['text_name']) < 2) message($L['pass_ad_text_name']);
				if(strlen($post['text_url']) < 10) message($L['pass_ad_text_url']);
				$ad['text_name'] = $post['text_name'];
				$ad['text_url'] = fix_link($post['text_url']);
				$ad['text_title'] = $post['text_title'];
			} else if($typeid == 3 || $typeid == 5) {
				if(strlen($post['image_src']) < 15) message($L['pass_ad_image_src']);
				$ad['image_src'] = $post['image_src'];
				$ad['image_url'] = fix_link($post['image_url']);
				$ad['image_alt'] = $post['image_alt'];
			} else if($typeid == 4) {
				if(strlen($post['flash_src']) < 15 || strpos($post['flash_src'], '.swf') === false) message($L['pass_ad_flash_src']);
				$ad['flash_src'] = $post['flash_src'];
				$ad['flash_url'] = fix_link($post['flash_url']);
			} else if($typeid == 6) {
				$post['keyid'] = intval($post['keyid']);
				$post['key_id'] or message($L['pass_ad_infoid']);
				$ad['key_id'] = $post['keyid'];
			}
			if($typeid == 6 || $typeid == 7) {
				$ad['key_moduleid'] = $p['moduleid'];
				$ad['key_catid'] = $post['catid'];
				$ad['key_word'] = $post['word'];
			}
			$ad['fromtime'] = strtotime($post['fromtime']);
			$ad['totime'] = strtotime($post['fromtime']) + 86400*30*$month;
			$ad['pid'] = $pid;
			$ad['typeid'] = $typeid;
			$ad['amount'] = $amount;
			$ad['currency'] = $currency;
			$ad['title'] = $post['fromtime'].'('.$_username.')';
			$ad['introduce'] = timetodate($DT_TIME, 5).' '.$L['ad_buy_paid'].$amount.$unit;
			$ad['note'] = $L['ad_buy_note'].'('.$DT_IP.')';
			$ad['status'] = 2;
			$ad['username'] = $_username;
			if($amount) {
				if($currency == 'money') {
					money_add($_username, -$amount);
					money_record($_username, -$amount, $L['in_site'], 'system', $L['pay_in_site'], $p['name'].$L['ad_buy_title'].$month.$L['month']);
				} else {
					credit_add($_username, -$amount);
					credit_record($_username, -$amount, 'system', $p['name'].$L['ad_buy_title'], $month.$L['month']);
				}
			}
			$sqlk = $sqlv = '';
			foreach($ad as $k=>$v) {
				$sqlk .= ','.$k; $sqlv .= ",'$v'";
			}
			$sqlk = substr($sqlk, 1);
			$sqlv = substr($sqlv, 1);
			$db->query("INSERT INTO {$DT_PRE}ad ($sqlk) VALUES ($sqlv)");
			$db->query("UPDATE {$DT_PRE}ad_place SET ads=ads+1 WHERE pid=$pid");
			message($L['ad_buy_success'], '?status=2');
		}
	} else {
		dheader($adurl);
	}
} else {
	$status = isset($status) ? intval($status) : 3;
	in_array($status, array(2, 3)) or $status = 3;
	$condition = "username='$_username' AND status=$status";
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}ad WHERE $condition");
	$pages = pages($r['num'], $page, $pagesize);
	$lists = array();
	$result = $db->query("SELECT * FROM {$DT_PRE}ad WHERE $condition ORDER BY aid DESC LIMIT $offset,$pagesize");
	while($r = $db->fetch_array($result)) {
		if($r['totime'] < $DT_TIME) {
			$r['process'] = $L['status_expired'];
		} else if($r['fromtime'] > $DT_TIME) {
			$r['process'] = $L['status_not_start'];
		} else {
			$r['process'] = $L['status_displaying'];
		}
		$r['days'] = $r['totime'] > $DT_TIME ? intval(($r['totime']-$DT_TIME)/86400) : 0;
		$lists[] = $r;
	}
}
$head_title = $L['ad_buy_title'];
include template('ad', $module);
?>