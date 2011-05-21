<?php
 

if(!defined('IN_KEKE')) {
	exit('Access Denied');
}
require 'alipay_function.php';
require 'alipay_service.php';



$_input_charset = $_K ['charset'];
$service = 'create_direct_pay_by_user';
$partner = $payment_config['partner'];;
$security_code = $payment_config['safekey'];
$seller_email = $payment_config['account'];

 
$sign_type = 'MD5';
$out_trade_no = "charge-{$uid}-{$order_type}-{$obj_id}-{$res}-{$model_id}";

$return_url = $_K ['siteurl'] . '/payment/alipayjs/return.php';
$notify_url = $_K ['siteurl'] . '/payment/alipayjs/notify.php';
$show_url = $_K ['siteurl'] . "/index.php?do=user&view=finance";
			
$subject = $paytitle;
$body = $show_url;
$quantity = 1;
			
$parameter = array ("service" => $service, "partner" => $partner, "return_url" => $return_url, "notify_url" => $notify_url, "_input_charset" => $_input_charset, "subject" => $subject, "body" => $body, "out_trade_no" => $out_trade_no, "total_fee" => $total_money, "payment_type" => "1", "show_url" => $show_url, "seller_email" => $seller_email );
$alipay = new alipay_service ( $parameter, $security_code, $sign_type );
$url = $alipay->create_url();




