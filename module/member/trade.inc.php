<?php 
defined('IN_DESTOON') or exit('Access Denied');
login();
require DT_ROOT.'/module/'.$module.'/common.inc.php';
require DT_ROOT.'/include/post.func.php';
$_status = $L['trade_status'];
$dstatus = $L['trade_dstatus'];
$step = isset($step) ? trim($step) : '';
$timenow = timetodate($DT_TIME, 5);
$memberurl = linkurl($MOD['linkurl'], 1);
$myurl = userurl($_username);
if($action == 'update') {
	$itemid or message();
	$td = $db->get_one("SELECT * FROM {$DT_PRE}finance_trade WHERE itemid=$itemid");
	$td or message($L['trade_msg_null']);
	$td['adddate'] = timetodate($td['addtime'], 5);
	$td['updatedate'] = timetodate($td['updatetime'], 5);
	switch($step) {
		case 'edit_price':
			if($td['status'] != 0 || $td['seller'] != $_username) message($L['trade_msg_deny']);
			if($submit) {
				$fee = dround($fee);
				$fee or message($L['trade_price_fee_null']);
				$fee_name = htmlspecialchars(trim($fee_name));
				$fee_name or message($L['trade_price_fee_name']);
				$status = isset($confirm_order) ? 1 : 0;
				$db->query("UPDATE {$DT_PRE}finance_trade SET fee='$fee',fee_name='$fee_name',status='$status',updatetime='$DT_TIME' WHERE itemid=$itemid");
				if(isset($confirm_order)) {
					$touser = $td['buyer'];
					$title = lang($L['trade_message_t1'], array($itemid));
					$url = $memberurl.'trade.php?action=order&itemid='.$itemid;
					$content = lang($L['trade_message_c1'], array($myurl, $_username, $timenow, $url));
					$content = ob_template('messager', 'mail');
					send_message($touser, $title, $content);
					//send sms
					if($DT['sms'] && $_sms && $touser && isset($sendsms)) {
						$touser = memberinfo($touser);
						if($touser['mobile'] && $touser['vmobile']) {
							$message = lang('sms->ord_confirm', array($itemid));
							$message = strip_sms($message);
							$word = word_count($message);
							$sms_num = ceil($word/$DT['sms_len']);
							if($sms_num <= $_sms) {
								$sms_code = send_sms($touser['mobile'], $message, $word);
								if(strpos($sms_code, $DT['sms_ok']) !== false) {
									$tmp = explode('/', $sms_code);
									if(is_numeric($tmp[1])) $sms_num = $tmp[1];
									if($sms_num) sms_add($_username, -$sms_num);
									if($sms_num) sms_record($_username, -$sms_num, $_username, $L['trade_sms_confirm'], $itemid);
								}
							}
						}
					}
					//send sms
				}
				message($L['trade_price_edit_success'], $forward, 5);
			} else {
				$head_title = $L['trade_price_title'];
			}
		break;
		case 'detail':
			if($td['buyer'] != $_username && $td['seller'] != $_username) message($L['trade_msg_deny']);
			$td['total'] = $td['amount'] + $td['fee'];
			$head_title = $L['trade_detail_title'];
		break;
		case 'confirm_order':
			if($td['status'] != 0 || $td['seller'] != $_username) message($L['trade_msg_deny']);
			$db->query("UPDATE {$DT_PRE}finance_trade SET status=1,updatetime='$DT_TIME' WHERE itemid=$itemid");
			$touser = $td['buyer'];
			$title = lang($L['trade_message_t1'], array($itemid));
			$url = $memberurl.'trade.php?action=order&itemid='.$itemid;
			$content = lang($L['trade_message_c1'], array($myurl, $_username, $timenow, $url));
			$content = ob_template('messager', 'mail');
			send_message($touser, $title, $content);

			message($L['trade_confirm_success'], $forward, 5);
		break;
		case 'pay':
			if($td['status'] != 1 || $td['buyer'] != $_username) message($L['trade_msg_deny']);
			$money = $td['amount'] + $td['fee'];
			if($money > $_money) message($L['money_not_enough'], 'charge.php?action=pay&amount='.($money-$_money));
			if($submit) {
				is_payword($_username, $password) or message($L['error_payword']);
				$db->query("UPDATE {$DT_PRE}member SET money=money-$money,locking=locking+$money WHERE username='$_username'");
				$db->query("UPDATE {$DT_PRE}finance_trade SET status='2',updatetime='$DT_TIME' WHERE itemid=$itemid");

				$touser = $td['seller'];
				$title = lang($L['trade_message_t2'], array($itemid));
				$url = $memberurl.'trade.php?itemid='.$itemid;
				$content = lang($L['trade_message_c2'], array($myurl, $_username, $timenow, $url));
				$content = ob_template('messager', 'mail');
				send_message($touser, $title, $content);
			
				//send sms
				if($DT['sms'] && $_sms && $touser && isset($sendsms)) {
					$touser = memberinfo($touser);
					if($touser['mobile'] && $touser['vmobile']) {
						$message = lang('sms->ord_pay', array($itemid, $money));
						$message = strip_sms($message);
						$word = word_count($message);
						$sms_num = ceil($word/$DT['sms_len']);
						if($sms_num <= $_sms) {
							$sms_code = send_sms($touser['mobile'], $message, $word);
							if(strpos($sms_code, $DT['sms_ok']) !== false) {
								$tmp = explode('/', $sms_code);
								if(is_numeric($tmp[1])) $sms_num = $tmp[1];
								if($sms_num) sms_add($_username, -$sms_num);
								if($sms_num) sms_record($_username, -$sms_num, $_username, $L['trade_sms_pay'], $itemid);
							}
						}
					}
				}
				//send sms
				message($L['trade_pay_order_success'], $forward, 5);
			} else {
				$head_title = $L['trade_pay_order_title'];
			}
		break;
		case 'refund':
			$gone = $DT_TIME - $td['updatetime'];
			if($td['status'] != 3 || $td['buyer'] != $_username || $gone > ($MOD['trade_day']*86400 + $td['add_time']*3600)) message($L['trade_msg_deny']);
			$money = $td['amount'] + $td['fee'];
			if($submit) {
				$content or message($L['trade_refund_reason']);
				$db->query("UPDATE {$DT_PRE}finance_trade SET status='5',updatetime='$DT_TIME',buyer_reason='$content' WHERE itemid=$itemid");
				message($L['trade_refund_success'], $forward, 5);
			} else {
				$head_title = $L['trade_refund_title'];
			}
		break;
		case 'send_goods':
			if($td['status'] != 2 || $td['seller'] != $_username) message($L['trade_msg_deny']);
			if($submit) {
				$send_type = htmlspecialchars($send_type);
				$send_no = htmlspecialchars($send_no);
				$send_time = htmlspecialchars($send_time);
				$db->query("UPDATE {$DT_PRE}finance_trade SET status='3',updatetime='$DT_TIME',send_type='$send_type',send_no='$send_no',send_time='$send_time' WHERE itemid=$itemid");

				$touser = $td['buyer'];
				$title = lang($L['trade_message_t3'], array($itemid));
				$url = $memberurl.'trade.php?action=order&itemid='.$itemid;
				$content = lang($L['trade_message_c3'], array($myurl, $_username, $timenow, $url));
				$content = ob_template('messager', 'mail');
				send_message($touser, $title, $content);
			
				//send sms
				if($DT['sms'] && $_sms && $touser && isset($sendsms)) {
					$touser = memberinfo($touser);
					if($touser['mobile'] && $touser['vmobile']) {
						$message = lang('sms->ord_send', array($itemid, $send_type, $send_no, $send_time));
						$message = strip_sms($message);
						$word = word_count($message);
						$sms_num = ceil($word/$DT['sms_len']);
						if($sms_num <= $_sms) {
							$sms_code = send_sms($touser['mobile'], $message, $word);
							if(strpos($sms_code, $DT['sms_ok']) !== false) {
								$tmp = explode('/', $sms_code);
								if(is_numeric($tmp[1])) $sms_num = $tmp[1];
								if($sms_num) sms_add($_username, -$sms_num);
								if($sms_num) sms_record($_username, -$sms_num, $_username, $L['trade_sms_send'], $itemid);
							}
						}
					}
				}
				//send sms

				message($L['trade_send_success'], $forward, 5);
			} else {
				$head_title = $L['trade_send_title'];
				$send_types = explode('|', trim($MOD['send_types']));
				$send_time = timetodate($DT_TIME, 5);
			}
		break;
		case 'add_time':
			if($td['status'] != 3 || $td['seller'] != $_username) message($L['trade_msg_deny']);
			if($submit) {
				$add_time = intval($add_time);
				$add_time > 0 or message($L['trade_addtime_null']);
				$db->query("UPDATE {$DT_PRE}finance_trade SET add_time='$add_time' WHERE itemid=$itemid");
				message($L['trade_addtime_success'], $forward);
			} else {
				$head_title = $L['trade_addtime_title'];
			}
		break;
		case 'receive_goods':
			$gone = $DT_TIME - $td['updatetime'];
			if($td['status'] != 3 || $td['buyer'] != $_username || $gone > ($MOD['trade_day']*86400 + $td['add_time']*3600)) message($L['trade_msg_deny']);
			$money = $td['amount'] + $td['fee'];
			money_lock($_username, -$money);
			money_record($_username, -$money, $L['in_site'], 'system', $L['trade_record_pay'], $L['trade_order_id'].$itemid);
			money_add($td['seller'], $money);
			money_record($td['seller'], $money, $L['in_site'], 'system', $L['trade_record_pay'], $L['trade_order_id'].$itemid);
			$db->query("UPDATE {$DT_PRE}finance_trade SET status='4',updatetime='$DT_TIME' WHERE itemid=$itemid");

			$touser = $td['seller'];
			$title = lang($L['trade_message_t4'], array($itemid));
			$url = $memberurl.'trade.php?itemid='.$itemid;
			$content = lang($L['trade_message_c4'], array($myurl, $_username, $timenow, $url));
			$content = ob_template('messager', 'mail');
			send_message($touser, $title, $content);

			message($L['trade_success'], $forward, 5);
		break;
		case 'get_pay':
			$gone = $DT_TIME - $td['updatetime'];
			if($td['status'] != 3 || $td['seller'] != $_username || $gone < ($MOD['trade_day']*86400 + $td['add_time']*3600)) message($L['trade_msg_deny']);
			$money = $td['amount'] + $td['fee'];
			money_lock($td['buyer'], -$money);
			money_record($td['buyer'], -$money, $L['in_site'], 'system', $L['trade_record_pay'], lang($L['trade_buyer_timeout'], array($itemid)));
			money_add($_username, $money);
			money_record($_username, $money, $L['in_site'], 'system', $L['trade_record_pay'], lang($L['trade_buyer_timeout'], array($itemid)));
			$db->query("UPDATE {$DT_PRE}finance_trade SET status='4',updatetime='$DT_TIME' WHERE itemid=$itemid");
			message($L['trade_success'], $forward, 5);
			
		break;
		case 'close':
			if($_username == $td['seller']) {
				if($td['status'] == 0) {
					$db->query("UPDATE {$DT_PRE}finance_trade SET status='9',updatetime='$DT_TIME' WHERE itemid=$itemid");
					dmsg($L['trade_close_success'], $forward);
				} else if($td['status'] == 1) {
					$db->query("UPDATE {$DT_PRE}finance_trade SET status='9',updatetime='$DT_TIME' WHERE itemid=$itemid");
					dmsg($L['trade_close_success'], $forward);
				} else if($td['status'] == 2) {
					$money = $td['amount'] + $td['fee'];
					$db->query("UPDATE {$DT_PRE}member SET money=money+$money,locking=locking-$money WHERE username='$td[buyer]'");
					$db->query("UPDATE {$DT_PRE}finance_trade SET status='9',updatetime='$DT_TIME' WHERE itemid=$itemid");
					dmsg($L['trade_close_success'], $forward);
				} else if($td['status'] == 8) {
					$db->query("DELETE FROM {$DT_PRE}finance_trade WHERE itemid=$itemid");
					dmsg($L['trade_delete_success'], $forward);
				} else { 
					message($L['trade_msg_deny']);
				}
				message($L['trade_close_success'], $forward);
			} else if($_username == $td['buyer']) {
				if($td['status'] == 0) {
					$db->query("DELETE FROM {$DT_PRE}finance_trade WHERE itemid=$itemid");
					dmsg($L['trade_delete_success'], $forward);
				} else if($td['status'] == 1) {
					$db->query("UPDATE {$DT_PRE}finance_trade SET status='8',updatetime='$DT_TIME' WHERE itemid=$itemid");
					dmsg($L['trade_close_success'], $forward);
				} else if($td['status'] == 9) {
					$db->query("DELETE FROM {$DT_PRE}finance_trade WHERE itemid=$itemid");
					dmsg($L['trade_delete_success'], $forward);
				} else {
					message($L['trade_msg_deny']);
				}
			}
		break;
	}
} else if($action == 'pay') {
	$MG['trade_pay'] or dalert(lang('message->without_permission_and_upgrade'), 'goback');
	if($submit) {
		$seller = trim($seller);
		$seller or message($L['trade_pay_seller']);
		$seller == $_username and message($L['trade_pay_self']);
		is_user($seller) or message($L['trade_pay_seller_bad']);
		$amount = dround($amount);
		$amount > 0 or message($L['trade_pay_amount']);
		$note = htmlspecialchars($note);
		$note or message($L['trade_pay_note']);
		if($type) {
			is_payword($_username, $password) or message($L['error_payword']);
			$amount <= $_money or message($L['money_not_enough'], $MOD['linkurl'].'charge.php?action=pay&amount='.($amount-$_money));
			clear_upload($thumb);
			money_add($_username, -$amount);
			money_record($_username, -$amount, $L['in_site'], 'system', $L['trade_record_payfor'], '('.$seller.')'.$note);
			money_add($seller, $amount);
			money_record($seller, $amount, $L['in_site'], 'system', $L['trade_record_receive'], '('.$_username.')'.$note);
			$touser = $seller;
			$title = $L['trade_message_t5'];
			$content = lang($L['trade_message_c5'], array($myurl, $_username, $timenow, $amount, $note));
			$content = ob_template('messager', 'mail');
			send_message($touser, $title, $content);
			
			//send sms
			if($DT['sms'] && $_sms && $touser && isset($sendsms)) {
				$touser = memberinfo($touser);
				if($touser['mobile'] && $touser['vmobile']) {
					$message = lang('sms->ord_income', array($_username, $amount));
					$message = strip_sms($message);
					$word = word_count($message);
					$sms_num = ceil($word/$DT['sms_len']);
					if($sms_num <= $_sms) {
						$sms_code = send_sms($touser['mobile'], $message, $word);
						if(strpos($sms_code, $DT['sms_ok']) !== false) {
							$tmp = explode('/', $sms_code);
							if(is_numeric($tmp[1])) $sms_num = $tmp[1];
							if($sms_num) sms_add($_username, -$sms_num);
							if($sms_num) sms_record($_username, -$sms_num, $_username, $L['trade_sms_income'], $itemid);
						}
					}
				}
			}
			//send sms

			message(lang($L['trade_pay1_success'], array($seller)), 'record.php', 5);
		} else {
			$title = htmlspecialchars($title);
			$title or message($L['trade_pay_goods']);
			$linkurl = $linkurl && $linkurl != 'http://' ? htmlspecialchars($linkurl) : '';
			$thumb = htmlspecialchars($thumb);
			$buyer_postcode = htmlspecialchars($buyer_postcode);
			$buyer_address = htmlspecialchars($buyer_address);
			$buyer_name = htmlspecialchars($buyer_name);
			$buyer_phone = htmlspecialchars($buyer_phone);
			$buyer_receive = htmlspecialchars($buyer_receive);
			clear_upload($thumb);
			$db->query("INSERT INTO {$DT_PRE}finance_trade (buyer,seller,title,linkurl,thumb,amount,addtime,updatetime,note, buyer_postcode,buyer_address,buyer_name,buyer_phone,buyer_receive) VALUES ('$_username','$seller','$title','$linkurl','$thumb','$amount','$DT_TIME','$DT_TIME','$note','$buyer_postcode','$buyer_address','$buyer_name','$buyer_phone','$buyer_receive')");

			$itemid = $db->insert_id();
			$touser = $seller;
			$_title = $title;
			$title = lang($L['trade_message_t6'], array($itemid));
			$url = $memberurl.'trade.php?itemid='.$itemid;
			$goods = ($linkurl ? '<a href="'.$linkurl.'" target="_blank" class="t">' : '').'<strong>'.$_title.'</strong>'.($linkurl ? '</a>' : '');
			$content = lang($L['trade_message_c6'], array($myurl, $_username, $timenow, $goods, $itemid, $amount, $url));
			$content = ob_template('messager', 'mail');
			send_message($touser, $title, $content);
			
			//send sms
			if($DT['sms'] && $_sms && $touser && isset($sendsms)) {
				$touser = memberinfo($touser);
				if($touser['mobile'] && $touser['vmobile']) {
					$message = lang('sms->ord_new', array($_title, $amount, $itemid, $buyer_name, $buyer_phone));
					$message = strip_sms($message);
					$word = word_count($message);
					$sms_num = ceil($word/$DT['sms_len']);
					if($sms_num <= $_sms) {
						$sms_code = send_sms($touser['mobile'], $message, $word);
						if(strpos($sms_code, $DT['sms_ok']) !== false) {
							$tmp = explode('/', $sms_code);
							if(is_numeric($tmp[1])) $sms_num = $tmp[1];
							if($sms_num) sms_add($_username, -$sms_num);
							if($sms_num) sms_record($_username, -$sms_num, $_username, $L['trade_record_new'], $itemid);
						}
					}
				}
			}
			//send sms
			message($L['trade_pay0_success'], '?action=order', 5);
		}
	} else {
		$m = $db->get_one("SELECT m.truename,m.mobile,c.postcode,c.address FROM {$DT_PRE}member m,{$DT_PRE}company c WHERE m.userid=c.userid AND m.userid=$_userid");
		$send_types = explode('|', trim($MOD['send_types']));
		$head_title = $L['trade_pay_title'];
	}
} else if($action == 'order') {
	$MG['trade_buy'] or dalert(lang('message->without_permission_and_upgrade'), 'goback');
	$sfields = $L['trade_order_sfields'];
	$dfields = array('title', 'title ', 'amount', 'fee', 'fee_name', 'seller', 'send_type', 'send_no', 'note');
	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($fromtime) or $fromtime = '';
	isset($totime) or $totime = '';
	$status = isset($status) && isset($dstatus[$status]) ? intval($status) : '';
	$fields_select = dselect($sfields, 'fields', '', $fields);
	$status_select = dselect($dstatus, 'status', $L['status'], $status, '', 1, '', 1);
	$condition = "buyer='$_username'";
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($fromtime) $condition .= " AND addtime>".(strtotime($fromtime.' 00:00:00'));
	if($totime) $condition .= " AND addtime<".(strtotime($totime.' 23:59:59'));
	if($status !== '') $condition .= " AND status='$status'";
	if($itemid) $condition .= " AND itemid='$itemid'";
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}finance_trade WHERE $condition");
	$pages = pages($r['num'], $page, $pagesize);		
	$trades = array();
	$result = $db->query("SELECT * FROM {$DT_PRE}finance_trade WHERE $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
	$amount = $fee = $money = 0;
	while($r = $db->fetch_array($result)) {
		if($r['status'] == 3) {
			$gone = $DT_TIME - $r['updatetime'];
			if($gone > ($MOD['trade_day']*86400 + $r['add_time']*3600)) {
				$r['lefttime'] = 0;
			} else {
				$r['lefttime'] = secondstodate($MOD['trade_day']*86400 + $r['add_time']*3600 - $gone);
			}
		}
		$r['addtime'] = str_replace(' ', '<br/>', timetodate($r['addtime'], 5));
		$r['updatetime'] = str_replace(' ', '<br/>', timetodate($r['updatetime'], 5));
		$r['dstatus'] = $_status[$r['status']];
		$r['money'] = $r['amount'] + $r['fee'];
		$amount += $r['amount'];
		$fee += $r['fee'];
		$trades[] = $r;
	}
	$money = $amount + $fee;
	$forward = urlencode($DT_URL);
	$head_title = $L['trade_order_title'];
} else {
	$MG['trade_sell'] or dalert(lang('message->without_permission_and_upgrade'), 'goback');
	$sfields = $L['trade_sfields'];
	$dfields = array('title', 'title ', 'amount', 'fee', 'fee_name', 'buyer', 'buyer_name', 'buyer_address', 'buyer_postcode', 'buyer_phone', 'send_type', 'send_no', 'note');
	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($fromtime) or $fromtime = '';
	isset($totime) or $totime = '';
	$status = isset($status) && isset($dstatus[$status]) ? intval($status) : '';
	$fields_select = dselect($sfields, 'fields', '', $fields);
	$status_select = dselect($dstatus, 'status', $L['status'], $status, '', 1, '', 1);
	$condition = "seller='$_username'";
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($fromtime) $condition .= " AND addtime>".(strtotime($fromtime.' 00:00:00'));
	if($totime) $condition .= " AND addtime<".(strtotime($totime.' 23:59:59'));
	if($status !== '') $condition .= " AND status='$status'";
	if($itemid) $condition .= " AND itemid='$itemid'";
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}finance_trade WHERE $condition");
	$pages = pages($r['num'], $page, $pagesize);		
	$trades = array();
	$result = $db->query("SELECT * FROM {$DT_PRE}finance_trade WHERE $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
	$amount = $fee = $money = 0;
	while($r = $db->fetch_array($result)) {
		if($r['status'] == 3) {
			$gone = $DT_TIME - $r['updatetime'];
			if($gone > ($MOD['trade_day']*86400 + $r['add_time']*3600)) {
				$r['lefttime'] = 0;
			} else {
				$r['lefttime'] = secondstodate($MOD['trade_day']*86400 + $r['add_time']*3600 - $gone);
			}
		}
		$r['addtime'] = str_replace(' ', '<br/>', timetodate($r['addtime'], 5));
		$r['updatetime'] = str_replace(' ', '<br/>', timetodate($r['updatetime'], 5));
		$r['dstatus'] = $_status[$r['status']];
		$r['money'] = $r['amount'] + $r['fee'];
		$amount += $r['amount'];
		$fee += $r['fee'];
		$trades[] = $r;
	}
	$money = $amount + $fee;
	$forward = urlencode($DT_URL);
	$head_title = $L['trade_title'];
}
include template('trade', $module);
?>