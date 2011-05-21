<?php
defined('IN_DESTOON') or exit('Access Denied');
//---------------------------------------------------------
//财付通即时到帐支付请求示例，商户按照此文档进行开发即可
//---------------------------------------------------------
define('CS', DT_CHARSET);
require_once (DT_ROOT."/api/tenpay/classes/PayRequestHandler.class.php");

/* 商户号 */
$bargainor_id = $PAY[$bank]['partnerid'];

/* 密钥 */
$key = $PAY[$bank]['keycode'];

/* 返回处理地址 */
$return_url = $receive_url;

//date_default_timezone_set(PRC);
$strDate = date("Ymd");
$strTime = date("His");

//4位随机数
$randNum = rand(1000, 9999);

//10位序列号,可以自行调整。
$strReq = $strTime . $randNum;

/* 商家订单号,长度若超过32位，取前32位。财付通只记录商家订单号，不保证唯一。 */
$sp_billno = $orderid;

/* 财付通交易单号，规则为：10位商户号+8位时间（YYYYmmdd)+10位流水号 */
$transaction_id = $bargainor_id . $strDate . $strReq;

/* 商品价格（包含运费），以分为单位 */
$total_fee = $charge*100;

/* 商品名称 */
$desc = '会员('.$_username.')帐户充值(订单号:'.$orderid.')';

/* 创建支付请求对象 */
$reqHandler = new PayRequestHandler();
$reqHandler->init();
$reqHandler->setKey($key);

//----------------------------------------
//设置支付参数
//----------------------------------------
$reqHandler->setParameter("bargainor_id", $bargainor_id);			//商户号
$reqHandler->setParameter("sp_billno", $sp_billno);					//商户订单号
$reqHandler->setParameter("transaction_id", $transaction_id);		//财付通交易单号
$reqHandler->setParameter("total_fee", $total_fee);					//商品总金额,以分为单位
$reqHandler->setParameter("return_url", $return_url);				//返回处理地址
$reqHandler->setParameter("desc", $desc);	//商品名称

//用户ip,测试环境时不要加这个ip参数，正式环境再加此参数
$reqHandler->setParameter("spbill_create_ip", $DT_IP);

//请求的URL
$reqUrl = $reqHandler->getRequestURL();

//debug信息
//$debugInfo = $reqHandler->getDebugInfo();

//echo "<br/>" . $reqUrl . "<br/>";
//echo "<br/>" . $debugInfo . "<br/>";

//重定向到财付通支付
//$reqHandler->doSend();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo DT_CHARSET;?>">
<title>正在跳转到<?php echo $PAY[$bank]['name'];?>在线支付平台...</title>
</head>
<body onload="document.getElementById('pay').submit();">
<?php
$tmp = parse_url($reqUrl);
parse_str($tmp['query'], $par);
$act = $tmp['scheme'].'://'.$tmp['host'].$tmp['path'];
echo '<form method="post" action="'.$act.'" id="pay">';
foreach($par as $k=>$v) {
	echo '<input type="hidden" name="'.$k.'" value="'.$v.'"/>';
}
echo '</form>';
?>
</body>
</html>