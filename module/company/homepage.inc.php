<?php 
defined('IN_DESTOON') or exit('Access Denied');
$content_table = content_table(4, $userid, is_file(DT_CACHE.'/4.part'), $DT_PRE.'company_data');
$r = $db->get_one("SELECT content FROM {$content_table} WHERE userid=$userid", 'CACHE');
$intro_length = isset($HOME['intro_length']) && $HOME['intro_length'] ? intval($HOME['intro_length']) : 1000;
$COM['intro'] = nl2br(dsubstr(trim(strip_tags($r['content'])), $intro_length, '...'));
$COM['thumb'] = $COM['thumb'] ? $COM['thumb'] : DT_SKIN.'image/company.jpg';

if($COMGROUP['main_d']) {
	$_main_show = array();
	foreach($HMAIN as $k=>$v) {
		$_main_show[$k] = strpos(','.$COMGROUP['main_d'].',', ','.$k.',') !== false ? 1 : 0;
	}
	$_main_show = implode(',', $_main_show);
} else {
	$_main_show = '1,1,1,0,0,0,0';
}
$_main_order = '0,10,20,30,40,50,60';
$_main_num = '10,1,10,5,3,4,4';
$_main_file= implode(',' , $IFILE);
$_main_name = implode(',' , $HMAIN);

$main_show = explode(',', isset($HOME['main_show']) ? $HOME['main_show'] : $_main_show);
$main_order = explode(',', isset($HOME['main_order']) ? $HOME['main_order'] : $_main_order);
$main_num = explode(',', isset($HOME['main_num']) ? $HOME['main_num'] : $_main_num);
$main_file = explode(',', isset($HOME['main_file']) ? $HOME['main_file'] : $_main_file);
$main_name = explode(',', isset($HOME['main_name']) ? $HOME['main_name'] : $_main_name);
$_HMAIN = array();
asort($main_order);
foreach($main_order as $k=>$v) {
	if($main_show[$k] && in_array($main_file[$k], $IFILE)) {
		$_HMAIN[$k] = $HMAIN[$k];
	}
	if($main_num[$k] < 1 || $main_num[$k] > 50) $main_num[$k] = 10;
}
$HMAIN = $_HMAIN;
$seo_title = isset($HOME['seo_title']) && $HOME['seo_title'] ? $HOME['seo_title'] : '';
$head_title = '';
if($CACHE_HOME) {
	defined('TOHTML') or define('TOHTML', true);
	ob_start();
	include template('index', $template);
	$data = ob_get_contents();
	ob_clean();
	file_put($CACHE_HOME, '<?php defined("IN_DESTOON") or exit("Access Denied");?>'.$data);
	echo $data;
} else {
	include template('index', $template);
	if(isset($update) && $db->cache_ids && ($username == $_username || $_groupid == 1 || $domain)) {
		foreach($db->cache_ids as $v) {
			file_del(DT_CACHE.'/sql/'.substr($v, 0, 2).'/'.$v.'.php');
		}
		file_del(DT_CACHE.'/com/'.substr($username, 0, 2).'/'.$username.'.php');
		dheader($COM['linkurl']);
	}
}
?>