<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$CATEGORY = cache_read('category-'.$moduleid.'.php');
$table = $DT_PRE.'know';
$table_data = $DT_PRE.'know_data';
$table_answer = $DT_PRE.'know_answer';
$PROCESS = $L['know_process'];
if($itemid) {
	$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid AND status=3");
	$item or wap_msg($L['msg_not_exist']);
	extract($item);	
	$could_answer = check_group($_groupid, $MOD['group_answer']);
	if($item['process'] != 1 || ($_username && $_username == $item['username'])) $could_answer = false;
	if($could_answer) {
		if($_username) {
			$r = $db->get_one("SELECT itemid FROM {$table_answer} WHERE username='$_username' AND qid=$itemid");
		} else {
			$r = $db->get_one("SELECT itemid FROM {$table_answer} WHERE ip='$DT_IP' AND qid=$itemid AND addtime>$DT_TIME-86400");
		}
	}
	if($action == 'list') {
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table_answer} WHERE qid=$itemid AND status=3");
		$pages = wap_pages($r['num'], $page, $pagesize);
		if($item['answer'] != $r['num']) $db->query("UPDATE {$table} SET answer=$r[num] WHERE itemid=$itemid");
		$lists = array();
		$result = $db->query("SELECT * FROM {$table_answer} WHERE qid=$itemid AND status=3 ORDER BY itemid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$lists[] = $r;
		}
		$head_title = $title.$DT['seo_delimiter'].$L['answer_list'].$DT['seo_delimiter'].$MOD['name'].$DT['seo_delimiter'].$head_title;
	} else if($action == 'answer') {
		$could_answer or wap_msg($L['answer_no_right']);
		require_once DT_ROOT.'/include/post.func.php';
		if($submit) {
			$content = htmlspecialchars(trim($content));
			if(strtolower($CFG['charset'] != 'utf-8')) $content = convert($content, 'utf-8', $CFG['charset']);
			if(!$content) wap_msg($L['type_answer']);
			$need_check =  $MOD['check_add'] == 2 ? $MG['check'] : $MOD['check_answer'];
			$status = get_status(3, $need_check);
			$db->query("INSERT INTO {$table_answer} (qid,content,username,addtime,ip,status) VALUES ('$itemid', '$content', '$_username', '$DT_TIME', '$DT_IP', '$status')");			
			if($status == 3) $db->query("UPDATE {$table} SET answer=answer+1");
			if($MOD['credit_answer'] && $_username && $status == 3) {
				$could_credit = true;
				if($MOD['credit_maxanswer'] > 0) {					
					$r = $db->get_one("SELECT SUM(amount) AS total FROM {$DT_PRE}finance_credit WHERE username='$_username' AND addtime>$DT_TIME-86400  AND reason='".$L['answer']."'");
					if($r['total'] > $MOD['credit_maxanswer']) $could_credit = false;
				}
				if($could_credit) {
					credit_add($_username, $MOD['credit_answer']);
					credit_record($_username, $MOD['credit_answer'], 'system', $L['answer'], 'ID:'.$itemid.'(WAP)');
				}
			}
			if($MOD['answer_message'] && $item['username']) {
				$linkurl = $MOD['linkurl'].$item['linkurl'];
				$message = lang($L['answer_message'], array(dsubstr($item['title'], 20, '...'), $item['title'], nl2br($content), $linkurl));
				send_message($item['username'], dsubstr($message, 60, '...'), $message);
			}
			wap_msg($status == 3 ? $L['answer_success'] : $L['answer_check'], "?moduleid=$moduleid&itemid=$itemid");
		}
	} else {
		$CAT = get_cat($catid);
		if(!check_group($_groupid, $MOD['group_show']) || !check_group($_groupid, $CAT['group_show'])) wap_msg($L['msg_no_right']);
		$description = '';
		$user_status = 3;
		$fee = get_fee($item['fee'], $MOD['fee_view']);
		require $action == 'pay' ? 'pay.inc.php' : 'content.inc.php';
		$content_table = content_table($moduleid, $itemid, $MOD['split'], $table_data);
		$content = $db->get_one("SELECT content FROM {$content_table} WHERE itemid=$itemid");
		$content = $content['content'];
		$content = strip_tags($content);
		$content = preg_replace("/\&([^;]+);/i", '', $content);
		if($user_status == 2) $description = get_description($content, $MOD['pre_view']);
		$contentlength = strlen($content);
		if($contentlength > $maxlength) {
			$start = ($page-1)*$maxlength;
			$content = dsubstr($content, $maxlength, '', $start);
			$pages = wap_pages($contentlength, $page, $maxlength);
		}
		$content = nl2br($content);
		$best = $aid ? $db->get_one("SELECT * FROM {$DT_PRE}know_answer WHERE itemid=$aid") : array();
		$editdate = timetodate($addtime, 5);
		if($page == 1) $db->query("UPDATE {$table} SET hits=hits+1 WHERE itemid=$itemid");
		$head_title = $title.$DT['seo_delimiter'].$MOD['name'].$DT['seo_delimiter'].$head_title;
	}
} else {
	if($kw) {
		check_group($_groupid, $MOD['group_search']) or wap_msg($L['msg_no_search']);
	} else if($catid) {
		isset($CATEGORY[$catid]) or wap_msg($L['msg_not_cate']);
		$CAT = get_cat($catid);
		if(!check_group($_groupid, $MOD['group_list']) || !check_group($_groupid, $CAT['group_list'])) {
			wap_msg($L['msg_no_right']);
		}
	} else {
		check_group($_groupid, $MOD['group_index']) or wap_msg($L['msg_no_right']);
	}
	$head_title = $MOD['name'].$DT['seo_delimiter'].$head_title;
	if($kw) $head_title = $kw.$DT['seo_delimiter'].$head_title;
	$keyword = $kw ? str_replace(array(' ', '*'), array('%', '%'), $kw) : '';
	$condition = "status=3";
	if($keyword) $condition .= " AND keyword LIKE '%$keyword%'";
	if($catid) $condition .= ($CATEGORY[$catid]['child']) ? " AND catid IN (".$CATEGORY[$catid]['arrchildid'].")" : " AND catid=$catid";
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
	$pages = wap_pages($r['num'], $page, $pagesize);
	$lists = array();
	$order = $MOD['order'];
	$result = $db->query("SELECT itemid,catid,title,addtime,process FROM {$table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
	while($r = $db->fetch_array($result)) {
		$r['editdate'] = timetodate($r['addtime'], 2);
		$r['catname'] = $CATEGORY[$r['catid']]['catname'];
		$lists[] = $r;
	}
}
include template('know', 'wap');
?>