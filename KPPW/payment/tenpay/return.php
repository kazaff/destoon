<?php
if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

require_once ("PayResponseHandler.php");
$pay_arr =$pay_arr?$pay_arr:Cache_ext_Class::getPaymentConfig("tenpay");
@extract ( $pay_arr );

$key = $tenpay_ckey;

$resHandler = new PayResponseHandler ( );
$resHandler->setKey ( $key );
if ($resHandler->isTenpaySign ()) {
	$v_oid = $resHandler->getParameter ( "sp_billno" );
	$v_amount = $resHandler->getParameter ( "total_fee" );
	$v_amount = $v_amount*0.01;

	$pay_result = $resHandler->getParameter ( "pay_result" );

	@list ( $_, $uid, $order_type, $obj_id, $order_id,$model_id ) = explode ( '-', $v_oid, 6 );
	if ("0" == $pay_result) {
		
		/* charge */
		if ($_ == 'charge') {
			
			$order_obj = new Keke_witkey_pay_class ( );
			$order_obj->setWhere ( " order_id=$order_id " );
			$order_info = $order_obj->query_keke_witkey_pay ();
			if ($order_info [0] ['order_status'] == 2) {
				$order_obj->setOrder_status ( 1 );
				$order_obj->setOrder_id ( $order_id );
				$res = $order_obj->edit_keke_witkey_pay ();
				if ($res) {
					$fac_obj = new Pay_return_fac_class($model_id,$uid, $obj_id, $order_type, $order_id, $v_amount, 2);
					$fac_obj->load();
				 
				}
			}
			Func_comm_class::showmessage('',$_K['siteurl'].'/index.php?do=user&view=finance',3,'财富通在线支付'.$v_amount.'元成功！');
			
		}
 
	
	}
}
Func_comm_class::showmessage('支付失败',$_K['siteurl'].'/index.php?do=user&view=finance',3,'','error'); 
?>
