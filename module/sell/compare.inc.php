<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
check_group($_groupid, $MOD['group_compare']) or dalert(lang('message->without_permission'), 'goback');
$DT_URL = $DT_REF;
$itemid && is_array($itemid) or dalert($L['compare_choose'], 'goback');
$itemid = array_unique(array_map('intval', $itemid));
$item_nums = count($itemid);
$item_nums < 9 or dalert($L['compare_max'], 'goback');
$item_nums > 1 or dalert($L['compare_min'], 'goback');
$itemid = implode(',', $itemid);
$tags = array();
$result = $db->query("SELECT * FROM {$table} WHERE itemid IN ($itemid) ORDER BY addtime DESC");
while($r = $db->fetch_array($result)) {
	$r['editdate'] = timetodate($r['edittime'], 3);
	$r['adddate'] = timetodate($r['addtime'], 3);
	$r['stitle'] = dsubstr($r['title'], 30);
	$r['stitle'] = set_style($r['stitle'], $r['style']);
	$r['userurl'] = userurl($r['username']);
	$r['linkurl'] = $MOD['linkurl'].$r['linkurl'];
	$tags[] = $r;
}
$head_title = $L['compare_title'].$DT['seo_delimiter'].$MOD['name'];
include template('compare', $module);
?>