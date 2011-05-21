<?php 
defined('IN_DESTOON') or exit('Access Denied');
login();
require DT_ROOT.'/module/'.$module.'/common.inc.php';
require DT_ROOT.'/include/post.func.php';
$PAY = cache_read('pay.php');
$amount = isset($amount) ? dround($amount) : '';
switch($action) {
	case 'record':
		$PAY = cache_read('pay.php');	
		$PAY['card']['name'] = $L['charge_card_name'];
		$_status = $L['charge_status'];
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($bank) or $bank = '';
		$condition = "username='$_username'";
		if($bank) $condition .= " AND bank='$bank'";
		if($fromtime) $condition .= " AND sendtime>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND sendtime<".(strtotime($totime.' 23:59:59'));
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}finance_charge WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$charges = array();
		$amount = $fee = $money = 0;
		$result = $db->query("SELECT * FROM {$DT_PRE}finance_charge WHERE $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['sendtime'] = timetodate($r['sendtime'], 5);
			$r['receivetime'] = $r['receivetime'] ? timetodate($r['receivetime'], 5) : '--';
			$r['dstatus'] = $_status[$r['status']];
			$amount += $r['amount'];
			$fee += $r['fee'];
			$money += $r['money'];
			$charges[] = $r;
		}
		$head_title = $L['charge_title_record'];
	break;
	case 'card':
		if($submit) {
			if(!preg_match("/^[0-9a-zA-z]{6,}$/", $number)) message($L['charge_pass_card_number']);
			if(!preg_match("/^[0-9]{6,}$/", $password)) message($L['charge_pass_card_password']);
			$card = $db->get_one("SELECT * FROM {$DT_PRE}finance_card WHERE number='$number'");
			if($card) {
				if($card['updatetime']) message($L['charge_pass_card_used']);
				if($card['totime'] < $DT_TIME) message($L['charge_pass_card_expired']);
				if($card['password'] != $password) message($L['charge_pass_card_error_password']);
				$db->query("INSERT INTO {$DT_PRE}finance_charge (username,bank,amount,money,sendtime,receivetime,editor,status,note) VALUES ('$_username','card', '$card[amount]','$card[amount]','$DT_TIME','$DT_TIME','system','3','$number')");
				$db->query("UPDATE {$DT_PRE}finance_card SET username='$_username',updatetime='$DT_TIME',ip='$DT_IP' WHERE itemid='$card[itemid]'");
				money_add($_username, $card['amount']);
				money_record($_username, $card['amount'], $L['charge_card_name'], 'system', $L['charge_card'], $L['charge_card_number'].':'.$number);
				message($L['charge_msg_card_success'], $MOD['linkurl'].'charge.php?action=record');
			} else {
				message($L['charge_pass_card_error_number']);
			}
		}
	break;
	case 'confirm':
		$amount = dround($amount);
		if($MOD['mincharge']) {
			if(strpos($MOD['mincharge'], '|') !== false) {
				in_array($amount, explode('|', $MOD['mincharge'])) or message($L['charge_pass_choose_amount']);
			} else {
				$amount >= intval($MOD['mincharge']) or message($L['charge_pass_amount_min'].$MOD['mincharge']);
			}
		} else {			
			$amount > 0 or message($L['charge_pass_type_amount']);
		}
		isset($PAY[$bank]) or message($L['charge_pass_bank']);
		$PAY[$bank]['enable'] or message($L['charge_pass_bank_close']);
		$fee = $PAY[$bank]['percent'] ? dround($amount*$PAY[$bank]['percent']/100) : 0;
		$charge = $fee + $amount;
		if($submit) {
			$db->query("INSERT INTO {$DT_PRE}finance_charge (username,bank,amount,fee,sendtime) VALUES ('$_username','$bank','$amount','$fee','$DT_TIME')");
			$orderid = $db->insert_id();
			$receive_url = linkurl($MOD['linkurl'], 1).'charge.php';
			include DT_ROOT.'/api/'.$bank.'/send.inc.php';
			exit;
		} else {
			$head_title = $L['charge_title_confirm'];
		}
	break;
	case 'pay':
		$MOD['pay_online'] or dheader('?action=card');
		if($MOD['mincharge']) {
			if(strpos($MOD['mincharge'], '|') !== false) {				
				$mincharge = 0;
				$charges = explode('|', $MOD['mincharge']);
			} else {
				$mincharge = intval($MOD['mincharge']);
				$charges = array();
			}
		} else {
			$mincharge = 0;
			$charges = array();
		}
		$head_title = $L['charge_title_pay'];
	break;
	default:
		$_POST = $_DPOST;
		$_GET = $_DGET;
		$head_title = $L['charge_title'];
		//$passed = true;
		$charge_errcode = '';
		$charge_status = 0;
		/*
		0 fail
		1 success
		2 unknow
		*/
		$r = $db->get_one("SELECT * FROM {$DT_PRE}finance_charge WHERE username='$_username' ORDER BY itemid DESC");
		if($r) {
			$charge_orderid = $r['itemid'];
			$charge_money = $r['amount'] + $r['fee'];
			$charge_amount = $r['amount'];
			if($r['status'] == 0) {
				$receive_url = '';
				$bank = $r['bank'];
				$editor = 'R'.$bank;
				$note = '';
				include DT_ROOT.'/api/'.$bank.'/receive.inc.php';
				if($charge_status == 1) {
					$db->query("UPDATE {$DT_PRE}finance_charge SET status=3,money=$charge_money,receivetime='$DT_TIME',editor='$editor' WHERE itemid=$charge_orderid");
					money_add($r['username'], $r['amount']);
					money_record($r['username'], $r['amount'], $PAY[$bank]['name'], 'system', $L['charge_online'], 'ID:'.$charge_orderid);
					if($MOD['credit_charge'] > 0) {
						$credit = intval($r['amount']*$MOD['credit_charge']);
						if($credit > 0) {
							credit_add($r['username'], $credit);
							credit_record($r['username'], $credit, 'system', $L['charge_reward'], $L['charge'].$r['amount'].$DT['money_unit']);
						}
					}
				} else {
					$db->query("UPDATE {$DT_PRE}finance_charge SET status=1,receivetime='$DT_TIME',editor='$editor',note='$note' WHERE itemid=$charge_orderid");
				}
			} else if($r['status'] == 1) {
				$charge_status = 2;		
				$charge_errcode = $L['charge_msg_order_fail'].$charge_orderid;
			} else if($r['status'] == 2) {
				$charge_status = 2;		
				$charge_errcode = $L['charge_msg_order_cancel'].$charge_orderid;
			} else {
				$charge_status = 1;
			}
		} else {
			$charge_status = 2;		
			$charge_errcode = $L['charge_msg_not_order'];
		}
	break;
}
include template('charge', $module);
?>