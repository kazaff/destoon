<?php
defined('IN_DESTOON') or exit('Access Denied');
$v_mid = $PAY[$bank]['partnerid']; // 商户号
$v_url = $receive_url; // 返回url
$key = $PAY[$bank]['keycode']; // MD5密钥

$v_oid = $orderid; 
$v_amount = $charge; //支付金额                 
$v_moneytype = 'CNY'; //币种

$text = $v_amount.$v_moneytype.$v_oid.$v_mid.$v_url.$key; //md5加密拼凑串,注意顺序
$v_md5info = strtoupper(md5($text));

$remark1 = $DT['sitename'].' - 会员['.$_username.']帐户充值'; //备注字段1
$remark2 = isset($remark2) ? trim($remark2) : ''; //备注字段2
?>
<html>
<head>
<title>正在跳转到<?php echo $PAY[$bank]['name'];?>在线支付平台...</title>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo DT_CHARSET;?>">
</head>
<body onload="document.getElementById('pay').submit();">
<form method="post" action="https://pay.chinabank.com.cn/select_bank" id="pay">
<input type="hidden" name="v_mid"       value="<?php echo $v_mid;?>">
<input type="hidden" name="v_oid"       value="<?php echo $v_oid;?>">
<input type="hidden" name="v_amount"    value="<?php echo $v_amount;?>">
<input type="hidden" name="v_moneytype" value="<?php echo $v_moneytype;?>">
<input type="hidden" name="v_url"       value="<?php echo $v_url;?>">
<input type="hidden" name="v_md5info"   value="<?php echo $v_md5info;?>">
<input type="hidden" name="remark1"     value="<?php echo $remark1;?>">
<input type="hidden" name="remark2"     value="<?php echo $remark2;?>">
</form>
</body>
</html>