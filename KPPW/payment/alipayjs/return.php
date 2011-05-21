<?php
require_once (dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/app_comm.php');
require_once ('alipay_notify.php');


 

$_input_charset = $_K['charset'];
$payment_config = Cache_ext_Class::getPaymentConfig('alipayjs');
if (!$payment_config){
	echo "支付配置错误，支付无法完成，请联系管理员。";
}


$partner = $payment_config['partner'];
$security_code = $payment_config['safekey'];
$sign_type = 'MD5';
$transport = 'http';



 
$alipay = new alipay_notify($partner,$security_code,$sign_type,$_input_charset,$transport);
 
$verify_result = $alipay->return_verify();


$out_trade_no = $_GET['out_trade_no'];    
$total_fee  = $_GET['total_fee'];      
@list($_, $uid,$order_type,$obj_id,$order_id,$model_id) = explode('-', $out_trade_no, 6);
if($verify_result) {
	if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
		$order_obj = new Keke_witkey_pay_class();
		$order_obj->setWhere(" order_id=$order_id ");
		$order_info = $order_obj->query_keke_witkey_pay();
		if($order_info[0]['order_status']==2){
		   $order_obj->setOrder_status(1);
		   $order_obj->setOrder_id($order_id);
		   $res = $order_obj->edit_keke_witkey_pay();
		   if($res){
		   	 $fac_obj = new Pay_return_fac_class($model_id,$uid,$obj_id,$order_type,$order_id,$total_fee,1);
		   	 $fac_obj->load();
	 
		   }
		}
		$title = "支付成功";
		$time = 3;
		$msgtype = 'info';
		$content = '支付宝在线支付'.$total_fee.'元成功！';
		$url = $_K['siteurl']."/index.php?do=user&view=finance";
		require Template_Class::template ( 'payment/alipayjs/showmessage' );
		die ();
		
	}
}else {

echo '支付失败';
}
