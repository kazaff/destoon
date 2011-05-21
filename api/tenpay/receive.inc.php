<?php
defined('IN_DESTOON') or exit('Access Denied');
//---------------------------------------------------------
//财付通即时到帐支付应答（处理回调）示例，商户按照此文档进行开发即可
//---------------------------------------------------------

require_once (DT_ROOT."/api/tenpay/classes/PayResponseHandler.class.php");

/* 密钥 */
$key = $PAY[$bank]['keycode'];

/* 创建支付应答对象 */
$resHandler = new PayResponseHandler();
$resHandler->setKey($key);

//判断签名
if($resHandler->isTenpaySign()) {
	
	//交易单号
	$transaction_id = $resHandler->getParameter("transaction_id");
	
	//金额,以分为单位
	$total_fee = $resHandler->getParameter("total_fee");
	
	//支付结果
	$pay_result = $resHandler->getParameter("pay_result");

	$out_trade_no = $resHandler->getParameter("sp_billno");
	$total_fee = $total_fee/100;
	
	if( "0" == $pay_result ) {
	
		//------------------------------
		//处理业务开始
		//------------------------------
		
		//注意交易单不要重复处理
		//注意判断返回金额
		
		//------------------------------
		//处理业务完毕
		//------------------------------
		if($out_trade_no != $charge_orderid) {
		$charge_status = 2;
		$charge_errcode = '订单号不匹配';
		$note = $charge_errcode.'S:'.$charge_orderid.'R:'.$out_trade_no;
		log_write($note, 'rtenpay');
	} else if($total_fee != $charge_money) {
		$charge_status = 2;
		$charge_errcode = '充值金额不匹配';
		$note = $charge_errcode.'S:'.$charge_money.'R:'.$total_fee;
		log_write($note, 'rtenpay');
	} else {
		$charge_status = 1;
		$db->query("UPDATE {$DT_PRE}finance_charge SET status=3,money=$charge_money,receivetime='$DT_TIME',editor='$editor' WHERE itemid=$charge_orderid");
		money_add($r['username'], $r['amount']);
		money_record($r['username'], $r['amount'], $PAY[$bank]['name'], 'system', '在线充值', '订单ID:'.$charge_orderid);
		$show = linkurl($MOD['linkurl'], 1).'charge.php';
		$resHandler->doShow($show);
	}
		
		//调用doShow, 打印meta值跟js代码,告诉财付通处理成功,并在用户浏览器显示$show页面.
	
	} else {
		//当做不成功处理
		//echo "<br/>" . "支付失败" . "<br/>";
	}
	
} else {
	//echo "<br/>" . "认证签名失败" . "<br/>";
}

//echo $resHandler->getDebugInfo();

?>