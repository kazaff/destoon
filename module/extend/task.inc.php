<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$EMOD = $MOD;
$task_item or $task_item = 3600;
if($html == 'webpage') {
	$itemid or exit;
	$r = $db->get_one("SELECT linkurl FROM {$DT_PRE}webpage WHERE itemid=$itemid AND islink=0");
	$r or exit;
	$db->query("UPDATE {$DT_PRE}webpage SET hits=hits+1 WHERE itemid=$itemid");
	if($DT_TIME - @filemtime(DT_ROOT.'/'.$r['linkurl']) > $task_item) tohtml('webpage', $module);
} else if($html == 'announce') {
	$itemid or exit;
	$r = $db->get_one("SELECT linkurl,hits FROM {$DT_PRE}announce WHERE itemid=$itemid AND islink=0");
	$r or exit;
	echo 'try{$("hits").innerHTML = '.$r['hits'].';}catch(e){}';
	$db->query("UPDATE {$DT_PRE}announce SET hits=hits+1 WHERE itemid=$itemid");
	if($DT_TIME - @filemtime(DT_ROOT.'/announce/'.$itemid.'.'.$DT['file_ext']) > $task_item) tohtml('announce', $module);
} else if($html == 'spread') {
	$itemid or exit;
	$r = $db->get_one("SELECT mid,word FROM {$DT_PRE}spread WHERE itemid=$itemid");
	$r or exit;
	$filename = DT_CACHE.'/htm/m'.$r['mid'].'_k'.urlencode($r['word']).'.htm';
	if($DT_TIME - @filemtime($filename) > $task_item) {
		$MOD = cache_read('module-'.$r['mid'].'.php');
		$CATEGORY = cache_read('category-'.$r['mid'].'.php');
		tohtml('spread', $module);
	}
} else if($html == 'ad') {
	$a = $db->get_one("SELECT * FROM {$DT_PRE}ad ORDER BY rand()");
	$a or exit;
	if($DT_TIME - @filemtime(DT_CACHE.'/htm/'.ad_name($a)) > $task_item) {
		if($a['typeid'] == 6) {
			$CATEGORY = cache_read('category-'.$a['key_moduleid'].'.php');
			$MOD['linkurl'] = $MODULE[$a['key_moduleid']]['linkurl'];
		}
		tohtml('ad', $module);
	}
}
if(date('G', $DT_TIME) > 5) {
	$MOD = $EMOD;
	if($MOD['sitemaps'] && ($DT_TIME - @filemtime(DT_ROOT.'/sitemaps.xml') > $MOD['sitemaps_update']*60)) tohtml('sitemaps', $module);
	if($MOD['baidunews'] && ($DT_TIME - @filemtime(DT_ROOT.'/baidunews.xml') > $MOD['baidunews_update']*60)) tohtml('baidunews', $module);
} else {
	$files = glob(DT_CACHE.'/sql/'.strtolower(random(2)).'/*.php');
	if($files) {
		foreach($files as $f) {
			if($DT_TIME - filemtime($f) > 86400*2) unlink($f);
		}
	}
}
?>