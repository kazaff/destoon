<?php 
defined('IN_DESTOON') or exit('Access Denied');
?>
<html>
<head>
<title>正在跳转到<?php echo $PAY[$bank]['name'];?>在线支付平台...</title>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo DT_CHARSET;?>">
</head>
<body onload="document.getElementById('pay').submit();">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="pay">
<input type="hidden" name="return" value="<?php echo $receive_url;?>" />
<input type="hidden" name="notify_url" value="<?php echo DT_URL;?>'api/paypal.php" />
<input type="hidden" name="cancel_return" value="<?php echo DT_URL;?>" />
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?php echo $PAY[$bank]['partnerid'];?>">
<input type="hidden" name="item_name" value="<?php echo $DT['sitename'];?> - 会员[<?php echo $_username;?>]帐户充值" />
<input type="hidden" name="item_number" value="<?php echo $orderid;?>" />
<input type="hidden" name="charset" value="<?php echo DT_CHARSET;?>" />
<input type="hidden" name="currency_code" value="<?php echo $PAY[$bank]['currency'];?>">
<input type="hidden" name="amount" value="<?php echo $charge;?>">
<input type="hidden" name="image_url" value="<?php echo linkurl(DT_SKIN, 1);?>image/logo.gif" />
<input type="hidden" name="email" value="<?php echo $_email;?>" />
<input type="hidden" name="custom" value="<?php echo $_email;?>" />
</form>
</body>
</html>