<?php Template_Class::subtplcheck('control/admin/tpl/admin_login', '1303866348', 'control/admin/tpl/admin_login');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_K['charset']?>" />
<title>Login</title>
<meta name="keywords" content="" />
<meta name="description"  content="" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<link href="tpl/css/base.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body{ background:#79A836;}
.login{ width:500px; height:400px; margin:0 auto; margin-top:100px; background:url(tpl/img/login_bg.jpg) no-repeat; overflow:hidden;}
.logo{ margin-left:10px; margin-top:60px;}
.login_gut{ margin-top:30px; margin-left:100px; font-size:14px; color:#fff; text-align:left;}
.login_gut li{ height:30px; line-height:30px;}
.input_t{ border:0; width:150px; height:15px; padding:2px; background:#E0EFC6;}
.input_but{border:0; background:url(tpl/img/login_but_bg.jpg) no-repeat; color:#385900; width:49px; height:21px; line-height:21px;}
</style>
</head>
<body>
<div class="login">
<form action="index.php?do=login" method="post"">
<input type="hidden" name="is_submit" value="1"/>
<div class="logo"><img src="tpl/img/login_logo.jpg" /></div>
    <div class="login_gut">
    	<ul><li>用户名：<input type="text" name="txt_username" value="" class="input_t"/></li>
        <li>密　码：<input type="password" name="pwd_pwd" value="" class="input_t"/></li>
        <li>　　　　<input type="submit" value="登录" class="input_but"/>　<input type="button" value="取消" class="input_but"/></li></ul>
    </div>
</form>
</div>
</body>
</html><?php Template_Class::ob_out();?>