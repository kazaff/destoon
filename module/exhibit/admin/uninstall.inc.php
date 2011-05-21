<?php
defined('IN_DESTOON') or exit('Access Denied');
$db->query("DROP TABLE IF EXISTS `".$DT_PRE.$module."`");
$db->query("DROP TABLE IF EXISTS `".$DT_PRE.$module."_data`");
?>