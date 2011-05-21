<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$r = $db->get_one("SELECT linkurl FROM {$table} WHERE groupid>5 AND vip>0 ORDER BY rand()");
$url = $r ? $r['linkurl'] : $MOD['linkurl'];
dheader($url);
?>