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
		//$user_status
		//4 - 显示载入
		//3 - 显示信息
		//2 - 显示支付
		//1 - 显示升级
		//0 - 显示登录
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
		if($user_status == 3 || $user_status == 2) {
			$content_table = content_table($moduleid, $itemid, $MOD['split'], $table_data);
			$content = $db->get_one("SELECT content FROM {$content_table} WHERE itemid=$itemid");
			$content = $content['content'];
			if($user_status == 2) $description = get_description($content, $MOD['pre_view']);
			if(strpos($content, '[pagebreak]') !== false) {
				$content = explode('[pagebreak]', $content);
				$total = count($content);
				$pages = showpages($item, $total, $page);
				$content = $content[$page-1];
			}
			if($MOD['keylink']) $content = keylink($content, $moduleid);
		}
		$content = strip_nr(ob_template('content', 'chip'), true);
		echo 'Inner("content", \''.$content.'\');';
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