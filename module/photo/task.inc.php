<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
if($html == 'show') {
	$itemid or exit;
	$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid AND status=3");
	$item or exit;
	extract($item);
	$fee = get_fee($item['fee'], $MOD['fee_view']);
	$currency = $MOD['fee_currency'];
	$unit = $currency == 'money' ? $DT['money_unit'] : $DT['credit_unit'];
	$name = $currency == 'money' ? $DT['money_name'] : $DT['credit_name'];
	$inner = false;
	if(check_group($_groupid, $MOD['group_show'])) {
		if($fee) {
			$inner = true;
			if($MG['fee_mode'] && $MOD['fee_mode']) {
				$user_status = 3;
			} else {
				$mid = $moduleid;
				if($_userid) {
					if(check_pay($mid, $itemid)) {
						$user_status = 3;
					} else {
						$user_status = 2;						
						$linkurl = linkurl($MOD['linkurl'].$linkurl, 1);
						$pay_url = linkurl($MODULE[2]['linkurl'], 1).'pay.php?mid='.$mid.'&itemid='.$itemid.'&fee='.$fee.'&currency='.$currency.'&sign='.crypt_sign($_username.$mid.$itemid.$fee.$currency.$linkurl.$item['title']).'&title='.rawurlencode($item['title']).'&forward='.urlencode($linkurl);
					}
				} else {
					$user_status = 0;
				}
			}
		} else {
			$user_status = 3;
		}
	} else {
		$inner = true;
		$user_status = $_userid ? 1 : 0;
	}
	if($_username && $_username == $item['username']) $user_status = 3;
	if($inner) {
		if($user_status == 3) {
			$T = array();
			$result = $db->query("SELECT itemid,thumb,introduce FROM {$table_item} WHERE item=$itemid ORDER BY listorder ASC,itemid ASC");
			while($r = $db->fetch_array($result)) {
				$T[] = $r;
			}
			$demo_url = $MOD['linkurl'].itemurl($item, '{destoon_page}');
			$next_photo = $items > 1 ? next_photo($page, $items, $demo_url) : $linkurl;
			$prev_photo = $items > 1 ? prev_photo($page, $items, $demo_url) : $linkurl;
			if($T) {
				$S = side_photo($T, $page, $demo_url);
			} else {
				$S = array();
				$T[0]['thumb'] = DT_SKIN.'image/spacer.gif';
				$T[0]['introduce'] = $L['no_picture'];
			}
			$P = $T[$page-1];
			$P['src'] = str_replace('.thumb.'.file_ext($P['thumb']), '', $P['thumb']);
			$action = 'side';
			$content = strip_nr(ob_template('content', 'chip'), true);
			echo 'Inner("side", \''.$content.'\');';
			$action = '';
		}
		$content = strip_nr(ob_template('content', 'chip'), true);
		echo 'Inner("photo", \''.$content.'\');';
	}
	$update = '';
	include DT_ROOT.'/include/update.inc.php';
	echo 'Inner("hits", \''.$item['hits'].'\');';
	if($MOD['show_html'] && $task_item && $DT_TIME - @filemtime(DT_ROOT.'/'.$MOD['moduledir'].'/'.$item['linkurl']) > $task_item) tohtml('show', $module);
} else if($html == 'list') {
	$catid or exit;
	if($MOD['list_html'] && $task_list && $DT_TIME - @filemtime(DT_ROOT.'/'.$MOD['moduledir'].'/'.listurl($moduleid, $catid, $page, $CATEGORY, $MOD)) > $task_list) {
		$fid = $page;
		$num = 3;
		tohtml('list', $module);
	}
} else if($html == 'index') {
	if($DT_TIME - @filemtime(DT_CACHE.'/cateitem-'.$moduleid.'.php') > $task_index) cache_item($moduleid);
	if($DT['cache_hits'] && $DT_TIME - @filemtime(DT_CACHE.'/hits-'.$moduleid.'.dat') > $DT['cache_hits']) update_hits($moduleid, $table);
	$file = DT_ROOT.'/'.$MOD['moduledir'].'/'.$DT['index'].'.'.$DT['file_ext'];
	if($MOD['index_html']) {
		if($DT_TIME - @filemtime($file) > $task_index) tohtml('index', $module);
	} else {
		if(is_file($file)) @unlink($file);
	}
}
?>