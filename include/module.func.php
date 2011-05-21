<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
function get_fee($item_fee, $mod_fee) {
	if($item_fee < 0) {
		$fee = 0;
	} else if($item_fee == 0) {
		$fee = $mod_fee;
	} else {
		$fee = $item_fee;
	}
	return $fee;
}

function keyword($kw, $items, $moduleid) {
	global $db, $DT_TIME, $DT;
	if(!$DT['search_kw'] || $items < 2 || strlen($kw) < 3 || strlen($kw) > 30 || strpos($kw, ' ') !== false) return;
	$kw = addslashes($kw);
	$r = $db->get_one("SELECT * FROM {$db->pre}keyword WHERE moduleid=$moduleid AND word='$kw'");
	if($r) {
		//if($r['status'] == 2) return;
		$items = $items > $r['items'] ? $items : $r['items'];
		$month_search = date('Y-m', $r['updatetime']) == date('Y-m', $DT_TIME) ? 'month_search+1' : '1';
		$week_search = date('W', $r['updatetime']) == date('W', $DT_TIME) ? 'week_search+1' : '1';
		$today_search = date('Y-m-d', $r['updatetime']) == date('Y-m-d', $DT_TIME) ? 'today_search+1' : '1';
		$db->query("UPDATE {$db->pre}keyword SET items='$items',updatetime='$DT_TIME',total_search=total_search+1,month_search=$month_search,week_search=$week_search,today_search=$today_search WHERE itemid=$r[itemid]");
	} else {
		$letter = gb2py($kw);
		$status = $DT['search_check_kw'] ? 2 : 3;
		$db->query("INSERT INTO {$db->pre}keyword (moduleid,word,keyword,letter,items,updatetime,total_search,month_search,week_search,today_search,status) VALUES ('$moduleid','$kw','$kw','$letter','$items','$DT_TIME','1','1','1','1','$status')");
	}
}

function money_add($username, $amount) {
	global $db;
	if($username && $amount) $db->query("UPDATE {$db->pre}member SET money=money+{$amount} WHERE username='$username'");
}

function money_lock($username, $amount) {
	global $db;
	if($username && $amount) $db->query("UPDATE {$db->pre}member SET locking=locking+{$amount} WHERE username='$username'");
}

function money_record($username, $amount, $bank, $editor, $reason, $note = '') {
	global $db, $DT_TIME;
	if($username && $amount) {
		$r = $db->get_one("SELECT money FROM {$db->pre}member WHERE username='$username'");
		$balance = $r['money'];
		$db->query("INSERT INTO {$db->pre}finance_record (username,bank,amount,balance,addtime,reason,note,editor) VALUES ('$username','$bank','$amount','$balance','$DT_TIME','$reason','$note','$editor')");
	}
}

function credit_add($username, $amount) {
	global $db;
	if($username && $amount) $db->query("UPDATE {$db->pre}member SET credit=credit+{$amount} WHERE username='$username'");
}

function credit_record($username, $amount, $editor, $reason, $note = '') {
	global $db, $DT_TIME, $DT;
	if($DT['log_credit'] && $username && $amount) {
		$r = $db->get_one("SELECT credit FROM {$db->pre}member WHERE username='$username'");
		$balance = $r['credit'];
		$db->query("INSERT INTO {$db->pre}finance_credit (username,amount,balance,addtime,reason,note,editor) VALUES ('$username','$amount','$balance','$DT_TIME','$reason','$note','$editor')");
	}
}

function sms_add($username, $amount) {
	global $db;
	if($username && $amount) $db->query("UPDATE {$db->pre}member SET sms=sms+{$amount} WHERE username='$username'");
}

function sms_record($username, $amount, $editor, $reason, $note = '') {
	global $db, $DT_TIME;
	if($username && $amount) {
		$r = $db->get_one("SELECT sms FROM {$db->pre}member WHERE username='$username'");
		$balance = $r['sms'];
		$db->query("INSERT INTO {$db->pre}finance_sms (username,amount,balance,addtime,reason,note,editor) VALUES ('$username','$amount','$balance','$DT_TIME','$reason','$note','$editor')");
	}
}

function secondstodate($seconds) {
	include load('include.lang');
	$date = '';
	if($seconds > 0) {
		$t = floor($seconds/86400);
		if($t) {
			$date .= $t.$L['mod_day'];
			$seconds = $seconds%86400;
		}
		$t = floor($seconds/3600);
		if($t) {
			$date .= $t.$L['mod_hour'];
			$seconds = $seconds%3600;
		}
		$t = floor($seconds/60);
		if($t) {
			$date .= $t.$L['mod_minute'];
			$seconds = $seconds%60;
		}
		if($seconds) {
			$date .= $seconds.$L['mod_second'];
		}
	}
	return $date;
}

function get_intro($content, $length = 0) {
	return $length ? dsubstr(preg_replace("/&([a-z]{1,});/", '', dtrim(strip_tags($content))), $length) : '';
}

function get_description($content, $length) {
	if($length) {
		$content = str_replace(array(' ', '[pagebreak]'), array('', ''), $content);
		return nl2br(dsubstr(trim(strip_tags($content)), $length, '...'));
	} else {
		return '';
	}
}

function get_module_setting($moduleid, $key = '') {
	$M = cache_read('module-'.$moduleid.'.php');
	return $key ? $M[$key] : $M;
}

function anti_spam($string) {
	global $MODULE, $DT;
	if($DT['anti_spam'] && preg_match("/^[a-z0-9_@\-\s\/\.\,\(\)\+]+$/i", $string)) {
		return '<img src="'.$MODULE[3]['linkurl'].'image.php?auth='.urlencode(encrypt($string)).'" align="absmddle"/>';
	} else {
		return $string;
	}
}

function hide_ip($ip, $sep = '*') {
	if(!preg_match("/[\d\.]{7,15}/", $ip)) return $ip;
	$tmp = explode('.', $ip);
	return $tmp[0].'.'.$tmp[1].'.'.$sep.'.'.$sep;
}

function check_pay($moduleid, $itemid) {
	global $db, $_username, $DT_TIME, $MOD;
	$condition = "moduleid=$moduleid AND itemid=$itemid AND username='$_username'";
	if($MOD['fee_period']) $condition .= " AND paytime>".($DT_TIME - $MOD['fee_period']*60);
	return $db->get_one("SELECT itemid FROM {$db->pre}finance_pay WHERE $condition");
}

function check_sign($string, $sign) {
	return $sign == crypt_sign($string);
}

function crypt_sign($string) {
	global $DT_IP;
	return strtoupper(md5(md5($DT_IP.$string.DT_KEY)));
}

function cache_item($moduleid) {
	global $db;
	$data = array();
	$query = $db->query("SELECT catid,item FROM {$db->pre}category WHERE moduleid='$moduleid' ORDER BY listorder,catid");
	while($r = $db->fetch_array($query)) {
		$data[$r['catid']] = $r['item'];
	}
	cache_write('cateitem-'.$moduleid.'.php', $data);
}

function update_item($catid, $item) {
	global $db;
	$item = intval($item);
	$db->query("UPDATE LOW_PRIORITY {$db->pre}category SET item=$item WHERE catid=$catid", 'UNBUFFERED');
}

function cache_hits($moduleid, $itemid) {
	if(@$fp = fopen(DT_CACHE.'/hits-'.$moduleid.'.php', 'a')) {
		fwrite($fp, $itemid.' ');
		fclose($fp);
	}
}

function update_hits($moduleid, $table) {
	global $db, $DT_TIME;
	$hits = trim(file_get(DT_CACHE.'/hits-'.$moduleid.'.php'));
	file_put(DT_CACHE.'/hits-'.$moduleid.'.php', ' ');
	file_put(DT_CACHE.'/hits-'.$moduleid.'.dat', $DT_TIME);
	if($hits) {
		$tmp = array_count_values(explode(' ', $hits));
		$arr = array();
		foreach($tmp as $k=>$v) {
			$arr[$v] .= $k ? ','.$k : '';
		}
		$id = $moduleid == 4 ? 'userid' : 'itemid';
		foreach($arr as $k=>$v) {
			$db->query("UPDATE LOW_PRIORITY {$table} SET hits=hits+'$k' WHERE `$id` IN (0".$v.")", 'UNBUFFERED');
		}
	}
}

function keylink($content, $item) {
	global $KEYLINK;
	$KEYLINK or $KEYLINK = cache_read('keylink-'.$item.'.php');
	if(!$KEYLINK) return $content;
	$data = $content;
	foreach($KEYLINK as $k=>$v) {
		$quote = str_replace(array("'", '-'), array("\'", '\-'), preg_quote($v['title']));
		$data = preg_replace('\'(?!((<.*?)|(<a.*?)|(<strong.*?)))('.$quote.')(?!(([^<>]*?)>)|([^>]*?</a>)|([^>]*?</strong>))\'si', '<a href="'.$v['url'].'" target="_blank"><strong class="keylink">'.$v['title'].'</strong></a>', $data, 1);
		if($data == '') $data = $content;
	}
	return $data;
}

function gender($gender, $type = 0) {
	global $L;
	if($type) return $gender == 1 ? $L['man'] : $L['woman'];
	return $gender == 1 ? $L['sir'] : $L['lady'];
}

function fix_link($url) {
	if(strlen($url) < 10) return '';
	return strpos($url, '://') === false  ? 'http://'.$url : $url;
}

function vip_year($fromtime) {
	global $DT_TIME;
	return $fromtime ? intval(date('Y', $DT_TIME) - date('Y', $fromtime)) + 1 : 1;
}

function get_albums($item, $type = 0) {
	$imgs = array();
	if($type == 0) {
		$nopic = DT_SKIN.'image/nopic60.gif';
		$imgs[] = $item['thumb'] ? $item['thumb'] : $nopic;
		$imgs[] = $item['thumb1'] ? $item['thumb1'] : $nopic;
		$imgs[] = $item['thumb2'] ? $item['thumb2'] : $nopic;
	} else if($type == 1) {
		$nopic = DT_SKIN.'image/nopic240.gif';
		$imgs[] = $item['thumb'] ? str_replace('.thumb.', '.middle.', $item['thumb']) : $nopic;
		$imgs[] = $item['thumb1'] ? str_replace('.thumb.', '.middle.', $item['thumb1']) : $nopic;
		$imgs[] = $item['thumb2'] ? str_replace('.thumb.', '.middle.', $item['thumb2']) : $nopic;
	}
	return $imgs;
}

function xml_linkurl($linkurl, $modurl = '') {
	if(strpos($linkurl, '://') === false) $linkurl = linkurl($modurl).$linkurl;
	return str_replace('&', '&amp;', $linkurl);
}

function highlight($str) {
	return '<span class="highlight">'.$str.'</span>';
}
?>