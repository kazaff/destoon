<?php
$_DPOST = $_POST;
require '../common.inc.php';
$_POST = $_DPOST;
if(!$_POST) exit('fail');
$bank = 'paypal';
$PAY = cache_read('pay.php');
if(!$PAY[$bank]['enable']) exit('fail');
if(!$PAY[$bank]['partnerid']) exit('fail');
$editor = 'N'.$bank;
$header = "";
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) {
	// Handle escape characters, which depends on setting of magic quotes
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
}
// Post back to PayPal to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen('www.paypal.com', 80, $errno, $errstr, 30);

// assign posted variables to local variables
$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$payment_amount = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$payer_email = $_POST['payer_email'];
$charge_status = 0;
$r = $db->get_one("SELECT * FROM {$DT_PRE}finance_charge WHERE itemid='$item_number' AND status=0");
if($r) {
	$charge_orderid = $r['itemid'];
	$charge_money = $r['amount'] + $r['fee'];
	$charge_amount = $r['amount'];
	// Process validation from PayPal
	if (!$fp) { 
		// HTTP ERROR
		$charge_status = 2;
		$charge_errcode = 'PayPal HTTP ERROR';
	} else {
		// NO HTTP ERROR
		fputs ($fp, $header.$req);
		while(!feof($fp)) {
			$res = fgets ($fp, 1024);
			if (strcmp ($res, "VERIFIED") == 0) {
				// TODO:
				// Check the payment_status is Completed
				// Check that txn_id has not been previously processed
				// Check that receiver_email is your Primary PayPal email
				// Check that payment_amount/payment_currency are correct
				// Process payment
				if($payment_amount != $charge_money) {
					$charge_status = 2;
					$charge_errcode = '充值金额不匹配';
				} else if($payment_currency != $PAY[$bank]['currency']) {
					$charge_status = 2;
					$charge_errcode = '充值币种不匹配';
				} else if($receiver_email != $PAY[$bank]['partnerid']) {
					$charge_status = 2;
					$charge_errcode = '收款帐号不匹配';
				} else if($payment_status == 'Completed') {
					$charge_status = 1;
				}
			} else if (strcmp ($res, "INVALID") == 0) {
				// If 'INVALID', send an email. TODO: Log for manual investigation.			
				$charge_status = 2;
				$charge_errcode = '支付失败';
			}

		}
	}
	fclose($fp);
	if($charge_status == 1) {
		$db->query("UPDATE {$DT_PRE}finance_charge SET status=3,money=$charge_money,receivetime='$DT_TIME',editor='$editor' WHERE itemid=$charge_orderid");
		require DT_ROOT.'/include/module.func.php';
		money_add($r['username'], $r['amount']);
		money_record($r['username'], $r['amount'], $PAY[$bank]['name'], 'system', '在线充值', '订单ID:'.$charge_orderid);
		exit('success');
	} else {
		$note = $charge_errcode;
		$db->query("UPDATE {$DT_PRE}finance_charge SET status=1,receivetime='$DT_TIME',editor='$editor',note='$note' WHERE itemid=$charge_orderid");//支付失败
		exit('fail');
	}
} else {
	exit('fail');
}
?>