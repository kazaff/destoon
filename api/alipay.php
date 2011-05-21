<?php
$_DPOST = $_POST;
require '../common.inc.php';
$_POST = $_DPOST;
if(!$_POST) exit('fail');
$bank = 'alipay';
$PAY = cache_read('pay.php');
if(!$PAY[$bank]['enable']) exit('fail');
if(!$PAY[$bank]['partnerid']) exit('fail');
if(!$PAY[$bank]['keycode']) exit('fail');
require DT_ROOT.'/include/module.func.php';
$receive_url = '';
function log_result($word) {
	log_write($word, 'nalipay');
}
require DT_ROOT.'/api/alipay/notify.class.php';
require DT_ROOT.'/api/alipay/config.inc.php';
$alipay = new alipay_notify($partner,$security_code,$sign_type,$_input_charset,$transport);
$verify_result = $alipay->notify_verify();
if($verify_result) {
	$r = $db->get_one("SELECT * FROM {$DT_PRE}finance_charge WHERE itemid='$out_trade_no'");
	if($r) {
		if($r['status'] == 0) {
			$charge_orderid = $r['itemid'];
			$charge_money = $r['amount'] + $r['fee'];
			$charge_amount = $r['amount'];
			$editor = 'N'.$bank;
			if($total_fee == $charge_money) {
				$db->query("UPDATE {$DT_PRE}finance_charge SET status=3,money=$charge_money,receivetime='$DT_TIME',editor='$editor' WHERE itemid=$charge_orderid");
				money_add($r['username'], $r['amount']);
				money_record($r['username'], $r['amount'], $PAY[$bank]['name'], 'system', '在线充值', '订单ID:'.$charge_orderid);
				exit('success');
			} else {
				$note = '充值金额不匹配S:'.$charge_money.'R:'.$total_fee;
				$db->query("UPDATE {$DT_PRE}finance_charge SET status=1,receivetime='$DT_TIME',editor='$editor',note='$note' WHERE itemid=$charge_orderid");//支付失败
				log_result($note);
				exit('fail');
			}
		} else if($r['status'] == 1) {
			exit('fail');
		} else if($r['status'] == 2) {
			exit('fail');
		} else {
			exit('success');
		}
	} else {
		log_result('通知订单号不存在R:'.$out_trade_no);
		exit('fail');
	}
} 
exit('fail');
?>