<?php
	

	if (! defined ( 'IN_KEKE' )) {
		exit ( 'Access Denied' );
	}
	
	if (! $uid)
	die ( Func_comm_class::showmessage ( '错误提示!', 'index.php', 3, '当请没有登录', 'error' ) );
	
	
	
	$pay_arr = Cache_ext_Class::getConfig ( 'paypal' );
	extract ( $pay_arr );
	
	$payment_list = Cache_ext_Class::getPaymentConfig();
	
	$obj_id = $obj_id ? $obj_id : 0;
	$model_id = $model_id?$model_id:1;
	$order_type = $type ? $type : 'online';
	
	$total_money = trim ( sprintf ( "%10.2f", abs ( floatval ( ($cash) ) ) ) );
	$now = time ();
	$randno = rand ( 1000, 9999 );
	$user_info = Func_comm_class::getuserinfo ( $uid );
	$paytitle = $user_info ['email'] . "(" . $_K ['website_name'] . "充值" . trim ( sprintf ( "%10.2f", $total_money ) ) . "元)";
	if (isset ( $ajax ) && $ajax == 'confirm') {
		$payment_config = Cache_ext_Class::getPaymentConfig($pay_m);
		if (!$payment_config){
			Func_comm_class::showmessage("支付配置错误，支付无法完成，请联系管理员。");
		}
		$title = "在线支付确认信息";
		require S_ROOT."./payment/".$payment_config['pay_dir']."/confirm.php";
		
	}
	
	if (isset ( $ajax ) && $ajax == 'order') {
		$payment_config = Cache_ext_Class::getPaymentConfig($pay_m);
		if (!$payment_config){
			Func_comm_class::showmessage("支付配置错误，支付无法完成，请联系管理员。");
		}
		$order_obj = new Keke_witkey_pay_class ( );
		$order_obj->setOrder_type ( $order_type );
		$order_obj->setPay_type ( $pay_m );
		$order_obj->setObj_id ( $obj_id );
		$order_obj->setUid ( $uid );
		$order_obj->setUsername ( $username );
		$order_obj->setPay_money ( $cash );
		$order_obj->setPay_time ( time () );
		$order_obj->setOrder_status ( 2 );
		$res = $order_obj->create_keke_witkey_pay ();
		$url = '';

		require S_ROOT."./payment/".$payment_config['pay_dir']."/order.php";
		
		if ($res) {
			Func_comm_class::echojson ( $res, 1, array ('url' => $url ) );
		} else {
			Func_comm_class::echojson ( '', 0 );
		}
		die ();
	
	}
	
	require_once $template_obj->template ( $do . "_" . $view );