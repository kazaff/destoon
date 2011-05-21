<?php
 
require_once (dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/app_comm.php');
require_once("alipay_notify.php");

$_input_charset = $_K['charset'];
$payment_config = Cache_ext_Class::getPaymentConfig('alipayjs');
if (!$payment_config){
	echo "支付配置错误，支付无法完成，请联系管理员。";
}


$partner = $payment_config['partner'];
$security_code = $payment_config['safekey'];
$seller_email    = $payment_config['account'];			 
$sign_type       = "MD5";
$transport       = "http";			
 
$alipay = new alipay_notify($partner,$security_code,$sign_type,$_input_charset,$transport);   
$verify_result = $alipay->notify_verify();   

if($verify_result) {
 
    $dingdan           = $_POST['out_trade_no'];	  
    $total             = $_POST['total_fee'];	 
    $sOld_trade_status = "1";		    
 
    if($_POST['trade_status'] == 'TRADE_FINISHED' ||$_POST['trade_status'] == 'TRADE_SUCCESS') {     
 		@list($_, $uid,$order_type,$obj_id,$order_id,$model_id) = explode('-', $out_trade_no, 6);
    	
     
        if($sOld_trade_status < 1) {
         
        }
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
		echo "success";

       
    }
    else {
        echo "success";	 

    }
}
else {
    echo "fail";

}
?>