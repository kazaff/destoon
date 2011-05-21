<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
unset($_SESSION['destoon_admin']);
set_cookie('auth', '');
msg('已经安全退出网站后台管理', '?');
?>