<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$MOD['vote_enable'] or dheader(DT_PATH);
$TYPE = get_type('vote', 1);
require MD_ROOT.'/vote.class.php';
$do = new vote();
$typeid = isset($typeid) ? intval($typeid) : 0;
if($itemid) {
	$do->itemid = $itemid;
	$item = $do->get_one();
	$item or dheader(DT_PATH);
	extract($item);
	if($submit) {
		$could_vote = true;
		$condition = $_username ? "AND username='$_username'" : "AND ip='$DT_IP'";
		$r = $db->get_one("SELECT rid FROM {$DT_PRE}vote_record WHERE itemid=$itemid $condition");
		if($r) $could_vote = false;
		if($fromtime && $DT_TIME < $fromtime) $could_vote = false;
		if($totime && $DT_TIME > $totime) $could_vote = false;
		if(!check_group($_groupid, $MOD['vote_group'])) $could_vote = false;
		if($could_vote) {
			if($item['choose']) {
				$ids = array();
				$num = 0;
				foreach($vote as $k=>$v) {
					$s = 's'.$v;
					if($$s) {
						$ids[] = $v;
						++$num;
					}
				}
				if($num >= $vote_min && $num <= $vote_max) {
					foreach($ids as $k=>$v) {
						$v = 'v'.$v;
						$db->query("UPDATE {$DT_PRE}vote SET votes=votes+1,`{$v}`=`{$v}`+1 WHERE itemid=$itemid");
					}
					$i = implode(',', $ids);
					$db->query("INSERT INTO {$DT_PRE}vote_record (itemid,username,ip,votetime,votes) VALUES ('$itemid','$_username','$DT_IP','$DT_TIME','$i')");
				}
			} else {
				$i = $vote[0];
				$s = 's'.$i;
				$v = 'v'.$i;
				if($$s) {
					$db->query("UPDATE {$DT_PRE}vote SET votes=votes+1,`{$v}`=`{$v}`+1 WHERE itemid=$itemid");
					$db->query("INSERT INTO {$DT_PRE}vote_record (itemid,username,ip,votetime,votes) VALUES ('$itemid','$_username','$DT_IP','$DT_TIME','$i')");
				}
			}
			dheader($linkurl);
		} else {
			dalert($L['vote_failed'], $linkurl);
		}
	}
	$adddate = timetodate($addtime, 3);
	$fromdate = $fromtime ? timetodate($fromtime, 3) : $L['timeless'];
	$todate = $totime ? timetodate($totime, 3) : $L['timeless'];
	$votes = array();
	$j = 0;
	for($i = 1; $i < 11; $i++) {
		$s = 's'.$i;
		if($$s) {
			$votes[$i]['title'] = $$s;
			$v = 'v'.$i;
			$votes[$i]['votes'] = $$v;
			$votes[$i]['percent'] = $item['votes'] ? dround($$v*100/$item['votes'], 2, true).'%' : '0%';
			$votes[$i]['number'] = ++$j;
		}
	}
	$db->query("UPDATE {$DT_PRE}vote SET hits=hits+1 WHERE itemid=$itemid");
	$head_title = $head_keywords = $head_description = $title.$DT['seo_delimiter'].$L['vote_title'];
	$template = $item['template'] ? $item['template'] : 'vote';
	include template($template, $module);
} else {
	$head_title = $head_keywords = $head_description = $L['vote_title'];
	$condition = '1';
	if($typeid) $condition .= " AND typeid=$typeid";
	$lists = $do->get_list($condition, 'addtime DESC');
	include template('vote', $module);
}
?>