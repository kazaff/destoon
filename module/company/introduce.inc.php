<?php 
defined('IN_DESTOON') or exit('Access Denied');
$content_table = content_table(4, $userid, is_file(DT_CACHE.'/4.part'), $DT_PRE.'company_data');
$r = $db->get_one("SELECT content FROM {$content_table} WHERE userid=$userid", 'CACHE');
$content = $r['content'];
$COM['thumb'] = $COM['thumb'] ? $COM['thumb'] : DT_SKIN.'image/company.jpg';
include template('introduce', $template);
?>