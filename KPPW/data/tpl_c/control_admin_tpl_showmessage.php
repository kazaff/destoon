<?php Template_Class::subtplcheck('control/admin/tpl/showmessage', '1303866353', 'control/admin/tpl/showmessage');?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_K['charset']?>">
<meta http-equiv="refresh" content="<?=$time?>;url=<?=$url?>">
<title>消息提示</title>
</head>
<link href="tpl/css/style.css" rel="stylesheet" type="text/css" />
<body>
<div class="tip_page">
<dl><dt><?=$title?></dt>
<dd>
<span class="red"> <?=$time?> </span> <a href="<?=$url?>" class="f60">秒后将自动跳转；如您的浏览器不能跳转，请点击 </a>
</dd></dl>
</div>
</body>
</html><?php Template_Class::ob_out();?>