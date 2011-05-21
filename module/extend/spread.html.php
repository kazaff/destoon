<?php 
defined('IN_DESTOON') or exit('Access Denied');
if(!$itemid) return false;
$item = $db->get_one("SELECT * FROM {$DT_PRE}spread WHERE itemid=$itemid");
if(!$item) return false;

$filename = DT_CACHE.'/htm/m'.urlencode($item['mid']).'_k'.urlencode($item['word']).'.htm';
if($DT_TIME - @filemtime($filename) < 60) return false;

$result = $db->query("SELECT * FROM {$DT_PRE}spread WHERE mid=$item[mid] AND word='$item[word]' AND fromtime<=$DT_TIME AND totime>=$DT_TIME ORDER BY price DESC,itemid ASC");
$totime = 0;
$itemids = array();
while($r = $db->fetch_array($result)) {
	if($r['totime'] > $totime) $totime = $r['totime'];
	$itemids[] = $r['tid'];
}
if(!$itemids) {
	@unlink($filename);
	return false;
}
$spread_itemids = implode(',', $itemids);
$spread_moduleid = $item['mid']; 
$spread_module = $MODULE[$spread_moduleid]['module'];
$id = $spread_moduleid == 4 ? 'userid' : 'itemid';
$path = $MODULE[$spread_moduleid]['linkurl'];
$pages = '';
$tags = $tag = array();
$result = $db->query("SELECT * FROM {$DT_PRE}{$spread_module} WHERE `{$id}` IN ($spread_itemids)");
while($r = $db->fetch_array($result)) {
	if(strpos($r['linkurl'], '://') === false) $r['linkurl'] = $path.$r['linkurl'];
	$tag[$r[$id]] = $r;
}
if(!$tag) {
	@unlink($filename);
	return false;
}
$spread_url = extendurl('spread').rewrite('index.php?kw='.urlencode($item['word']));
foreach($itemids as $v) {//Order
	if($tag[$v]) $tags[] = $tag[$v];
}
ob_start();
echo '<!--'.$totime.'-->';
include template('spread_code', $module);
$data = ob_get_contents();
ob_clean();
file_put($filename, $data);
return true;
?>