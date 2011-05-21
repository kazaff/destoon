<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
require '../common.inc.php';
login();
if($action == 'item') {
	$mid = isset($mid) ? intval($mid) : 0;
	$mid > 3 or dheader('DT_PATH');	
	$from = isset($from) ? trim($from) : 'item';
	$condition = $mid == 4 ? 'groupid>5' : 'status=3';
	if($keyword) $condition .= " AND keyword LIKE '%$keyword%'";
	if($_groupid == 1) {
		if($from == 'member') $condition .= " AND username='$_username'";
	} else {
		$condition .= " AND username='$_username'";
	}
	$order = $mid == 4 ? 'userid DESC' : 'addtime DESC';
	$table = get_table($mid);
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
	$items = $r['num'];
	$pages = pages($items, $page, $pagesize);
	$lists = array();
	$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
	while($r = $db->fetch_array($result)) {
		if($mid == 4) {
			$r['itemid'] = $r['userid'];
			$r['alt'] = $r['title'] = $r['company'];
			$r['adddate'] = $r['editdate'] = timetodate(0, 5);
			$r['level'] = 0;
		} else {
			$r['adddate'] = timetodate($r['addtime'], 5);
			$r['editdate'] = timetodate($r['edittime'], 5);
			$r['alt'] = $r['title'];
			$r['title'] = set_style($r['title'], $r['style']);
			if(strpos($r['linkurl'], '://') === false) $r['linkurl'] = $MODULE[$mid]['linkurl'].$r['linkurl'];
		}
		$lists[] = $r;
	}
	$head_title = '选择信息';
} else {
	$mid = 12;
	isset($MODULE[$mid]) or message('系统未开启图库功能');
	$from = isset($from) ? trim($from) : '';
	$fid = isset($fid) ? trim($fid) : '';
	if($itemid) {
		$item = $db->get_one("SELECT username,title FROM {$DT_PRE}photo WHERE itemid=$itemid");
		if(!$item || ($item['username'] != $_username && $_groupid > 1)) dheader(DT_PATH);
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}photo_item WHERE item=$itemid");
		$items = $r['num'];
		$pages = pages($items, $page, $pagesize);
		$lists = array();
		$result = $db->query("SELECT * FROM {$DT_PRE}photo_item WHERE item=$itemid ORDER BY listorder ASC,itemid ASC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['ext'] = file_ext($r['thumb']);
			$r['middle'] = str_replace('.thumb.'.$r['ext'], '.middle.'.$r['ext'], $r['thumb']);
			$r['large'] = str_replace('.thumb.'.$r['ext'], '', $r['thumb']);
			$lists[] = $r;
		}
	} else {
		$condition = 'status=3 AND items>0';
		if($keyword) $condition .= " AND keyword LIKE '%$keyword%'";
		if($_groupid == 1) {
			//if($from == 'member') $condition .= " AND username='$_username'";
		} else {
			$condition .= " AND username='$_username'";
		}
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}photo WHERE $condition");
		$items = $r['num'];
		$pages = pages($items, $page, $pagesize);
		$lists = array();
		$result = $db->query("SELECT * FROM {$DT_PRE}photo WHERE $condition ORDER BY addtime LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$lists[] = $r;
		}
	}
	$head_title = '选择图片';
}
include template('select', 'member');
?>