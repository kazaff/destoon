<?php
 

if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

if (file_exists(S_ROOT."./lib/inc/alipay_function.php")){
	unlink(S_ROOT."./lib/inc/alipay_function.php");
}
if (file_exists(S_ROOT."./lib/inc/alipay_notify.php")){
	unlink(S_ROOT."./lib/inc/alipay_notify.php");
}
if (file_exists(S_ROOT."./lib/inc/alipay_service.php")){
	unlink(S_ROOT."./lib/inc/alipay_service.php");
}

$_input_charset = $_K ['charset'];
$service = 'create_direct_pay_by_user';
$partner = $payment_config['partner'];
$security_code = $payment_config['safekey'];
$seller_email = $payment_config['account'];
$sign_type = 'MD5';
$out_trade_no = "charge-{$uid}-{$order_type}-{$obj_id}-{$model_id}";
				
$return_url = $_K ['siteurl'] . '/js.php?op=payment&pay_op=return&pay_m='.$payment_config['pay_dir'];
$notify_url = $_K ['siteurl'] . '/js.php?op=payment&pay_op=notify&pay_m='.$payment_config['pay_dir'];
$show_url = $_K ['siteurl'] . "/index.php?do=user&view=finance";
				
$subject = $paytitle;
$body = $show_url;
$quantity = 1;


require_once $template_obj->template ( 'payment/alipayjs/confirm' );
				