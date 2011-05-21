<?php
if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$_SESSION ['uid'] = '';
$_SESSION ['username'] = '';
$_SESSION['auid']="";
$_SESSION['user_info']="";
if (isset ( $_COOKIE ['user_login'] )) {
	setcookie ( 'user_login', '' );
}

if (isset ( $_COOKIE ['prom_cke'] )) {
	setcookie ( 'prom_cke', '' );
}

$synhtml = Syn_interface_class::user_synlogout();

Func_comm_class::showmessage ( '您已成功退出！'.$synhtml, 'index.php', 1 );