<?php
 

if(!defined('IN_KEKE')) {
	exit('Access Denied');
}
require 'PayRequestHandler.php';

$v_mid = $payment_config['seller_id'];
$v_url = $_K ['siteurl'] . '/js.php?op=payment&pay_op=return&pay_m='.$payment_config['pay_dir'];;
$key = $payment_config['tenpay_ckey'];
$v_oid = "charge-{$uid}-{$order_type}-{$obj_id}-{$res}-{$model_id}";
$v_amount = intval ( $total_money * 100 );
$v_moneytype = 'CNY';

$sp_billno = $v_oid;
$transaction_id = $v_mid . date ( 'Ymd' ) . date ( 'His' ) . rand ( 1000, 9999 );
$desc = $paytitle;

$reqHandler = new PayRequestHandler ( );
$reqHandler->init ();
$reqHandler->setKey ( $key );
$reqHandler->setParameter ( "bargainor_id", $v_mid );
$reqHandler->setParameter ( "cs", $_K ['charset'] );
$reqHandler->setParameter ( "sp_billno", $sp_billno );
$reqHandler->setParameter ( "transaction_id", $transaction_id );
$reqHandler->setParameter ( "total_fee", $v_amount );
$reqHandler->setParameter ( "return_url", $v_url );
$reqHandler->setParameter ( "desc", $desc );
$reqHandler->setParameter ( "spbill_create_ip", Func_comm_class::getIP () );
$url = $reqUrl = $reqHandler->getRequestURL ();




