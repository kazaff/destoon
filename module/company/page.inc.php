<?php 
defined('IN_DESTOON') or exit('Access Denied');
$mypage = get_company_setting($userid, 'mypage', 'CACHE');
include template('page', $template);
?>