<?php 
defined('IN_DESTOON') or exit('Access Denied');
$could_contact or dalert($L['msg_contact_deny'], 'goback');
$could_message = check_group($_groupid, $MOD['group_message']);
if($username == $_username || $domain) $could_message = true;
include template('contact', $template);
?>