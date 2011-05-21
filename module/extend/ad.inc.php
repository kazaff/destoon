<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$MOD['ad_enable'] or dheader(DT_PATH);
$TYPE = $L['ad_type'];
require MD_ROOT.'/ad.class.php';
$do = new ad();
$currency = $MOD['ad_currency'];
$unit = $currency == 'money' ? $DT['money_unit'] : $DT['credit_unit'];
$typeid = isset($typeid) ? intval($typeid) : 0;
$pid = isset($pid) ? intval($pid) : 0;
$aid = isset($aid) ? intval($aid) : 0;
if($action == 'buy' && $pid) {
	dheader($MODULE[2]['linkurl'].'ad.php?action=add&pid='.$pid);
} else {
	if($pid || $aid) {
		$MOD['ad_view'] or message($L['preview_close']);		
		$filename = '';
		$ad_moduleid = 0;
		if($pid) {
			$do->pid = $pid;
			$p = $do->get_one_place();
			$p or message($L['not_ad_place']);
			$head_title = lang($L['view_ad_place'], array($p['name']));
			$typeid = $p['typeid'];
			if($typeid > 5) {
				//
			} else {
				$filename = 'ad_'.$pid.'.htm';
			}
		} else if($aid) {
			$do->aid = $aid;
			$a = $do->get_one();
			$a or message($L['not_ad']);
			$head_title = lang($L['view_ad'], array($a['title']));
			$typeid = $a['typeid'];
			if($typeid > 5) {
				$ad_moduleid = $a['key_moduleid'];
				$ad_catid = $a['key_catid'];
				$ad_kw = $a['key_word'];
			} else {
				$filename = 'ad_'.$a['pid'].'.htm';
			}
		}
		include template('ad_view', $module);
	} else {
		$destoon_task = "moduleid=$moduleid&html=ad";
		$head_title = $L['ad_title'];
		$condition = 'open=1';
		if($typeid) {
			$head_title = $TYPE[$typeid].$DT['seo_delimiter'].$head_title;
			$condition .= " AND typeid=$typeid";
		}
		$head_keywords = $head_description = '';
		$ads = $do->get_list_place($condition, 'listorder DESC,pid DESC');
		include template('ad', $module);
	}
}
?>