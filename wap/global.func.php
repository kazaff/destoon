<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
function wap_output() {
	global $WCF, $CFG;
	$data = ob_get_contents();
	ob_end_clean();
	if($WCF['wap_charset'] == 'unicode') {
		$data = unicode($data);
	} else {
		if(strtolower($CFG['charset'] != 'utf-8')) $data = convert($data, $CFG['charset'],  'utf-8');
	}
	echo $data;
}

function wap_msg($msg, $forward = '') {
	extract($GLOBALS, EXTR_SKIP);
	include template('msg', 'wap');
	wap_output();
	exit();
}

function wap_pages($total, $page = 1, $perpage = 20) {
	global $DT_URL, $DT, $CFG, $L;
	if($total <= $perpage) return '';
	$total = ceil($total/$perpage);
	$page = intval($page);
	if($page < 1 || $page > $total) $page = 1;
	$demo_url = preg_replace("/(.*)([&?]page=[0-9]*)(.*)/i", "\\1\\3", $DT_URL);
	$s = strpos($demo_url, '?') === false ? '?' : '&';
	$demo_url = $demo_url.$s.'page={destoon_page}';
	$demo_url = str_replace('&', '&amp;', $demo_url);
	$demo_url = urldecode($demo_url);
	$pages = '<b>'.$page.'</b>/'.$total.' ';
	$_page = $page >= $total ? 1 : $page + 1;
	$url = str_replace('{destoon_page}', $_page, $demo_url);
	$pages .= '<a href="'.$url.'">'.$L['next_page'].'</a> ';

	$_page = $page <= 1 ? $total : ($page - 1);
	$url = str_replace('{destoon_page}', $_page, $demo_url);
	$pages .= '<a href="'.$url.'">'.$L['prev_page'].'</a> ';

	$_page = 1;
	$url = str_replace('{destoon_page}', $_page, $demo_url);
	$pages .= '<a href="'.$url.'">'.$L['home_page'].'</a> ';

	$_page = $total;
	$url = str_replace('{destoon_page}', $_page, $demo_url);
	$pages .= '<a href="'.$url.'">'.$L['last_page'].'</a> ';
	return $pages;
}

function unicode($str) {
	global $CFG;
	$return = '';
	$step = strtolower($CFG['charset'] == 'utf-8') ? 3 : 2;
	while($str != '') {
		if(ord(substr($str, 0, 1)) > 127) {
			$return .= "&#x".dechex(utf8_unicode(convert(substr($str, 0, $step), $CFG['charset'],  'utf-8'))).";";
			$str = substr($str, $step, strlen($str));
		} else {
			$return .= substr($str, 0, 1);
			$str = substr($str, 1, strlen($str));
		}
	}
	return $return;
}

function utf8_unicode($chr) {
	switch(strlen($chr)) {
		case 1:
			return ord($chr);
		break;
		case 2:
			$n = (ord($chr[0]) & 0x3f) << 6;
			$n += ord($chr[1]) & 0x3f;
			return $n;
		break;
		case 3:
			$n = (ord($chr[0]) & 0x1f) << 12;
			$n += (ord($chr[1]) & 0x3f) << 6;
			$n += ord($chr[2]) & 0x3f;
			return $n;
		break;
		case 4:
			$n = (ord($chr[0]) & 0x0f) << 18;
			$n += (ord($chr[1]) & 0x3f) << 12;
			$n += (ord($chr[2]) & 0x3f) << 6;
			$n += ord($chr[3]) & 0x3f;
			return $n;
		break;
	}
}
?>