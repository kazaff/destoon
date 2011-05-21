<?php
defined('IN_DESTOON') or exit('Access Denied');
function update_quote($date = 0) {
	global $do, $db, $MOD, $DT_TIME, $QP, $kw, $keyword, $quotes, $L;
	if(!$QP) return;
	$qid = -1;
	foreach($QP as $k=>$v) {
		if($v['title'] == $kw) $qid = $k;
	}
	if($qid == -1) return;
	$date or $date = timetodate($DT_TIME, 3);
	$fromtime = strtotime($date.' 00:00:00');
	$totime = strtotime($date.' 23:59:59');
	$condition = "edittime>$fromtime AND edittime<$totime AND price>0 AND unit<>'' AND tag<>'' ".$MOD['quote_condition'];
	$condition .= $MOD['quote_match'] ? " AND keyword LIKE '%$keyword%'" : " AND tag='$kw'";
	$quotes = array();
	$result = $db->query("SELECT * FROM {$db->pre}sell WHERE $condition ORDER BY edittime DESC LIMIT $MOD[quote_max]");
	while($r = $db->fetch_array($result)) {
		$quotes[] = $r;
	}
	$items = count($quotes);
	if($items < $MOD['quote_min']) return;
	$post = array();
	$post['content'] = ob_template('quote', 'quote');
	$today = timetodate($DT_TIME, 3);
	$Q = $db->get_one("SELECT * FROM {$db->pre}quote WHERE adddate='$today' AND tag='$kw' ORDER BY addtime DESC");
	if($Q) {
		if($Q['items'] > $items) return;
		foreach($Q as $k=>$v) {
			$post[$k] = $v;
		}
		$post['addtime'] = timetodate($post['addtime']);
		$do->itemid = $Q['itemid'];
		$do->edit($post);
	} else {
		$post['title'] = lang($L['auto_title'], array(timetodate($DT_TIME, $L['auto_date']), $kw));
		$post['catid'] = $QP[$qid]['catid'];
		$post['tag'] = $QP[$qid]['title'];
		$post['pid'] = $QP[$qid]['pid'];
		$post['introduce'] = $post['thumb'] = $post['thumb_no'] = $post['template'] = '';
		$post['username'] = 'system';
		$post['fee'] = 0;
		$post['addtime'] = timetodate($DT_TIME);
		$post['status'] = $MOD['quote_check'] ? 2 : 3;
		$do->add($post);
	}
	return true;
}
?>