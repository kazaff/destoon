<?php 
defined('IN_DESTOON') or exit('Access Denied');
isset($file) or $file = 'homepage';
if(isset($update) || isset($preview)) {
	$db->cids = 1;
	$CACHE_HOME = '';
} else {
	$CACHE_HOME = $DT['cache_home'] ? DT_CACHE.'/com/'.substr($username, 0, 2).'/'.$username.'.php' : '';
	if($file == 'homepage' && $CACHE_HOME && $DT_TIME - @filemtime($CACHE_HOME) < $DT['cache_home']) {
		include $CACHE_HOME;
		exit;
	}
}
$sql = "SELECT * FROM {$table_member} m,{$table} c WHERE m.userid=c.userid AND m.username='$username'";
$COM = $db->get_one($sql, 'CACHE');
if(!$COM || in_array($COM['groupid'], array(2, 3, 4))) {
	$cid = md5($sql);
	@unlink(DT_CACHE.'/sql/'.substr($cid, 0, 2).'/'.$cid.'.php');
	$head_title = $L['not_comapny'];
	@header("HTTP/1.1 404 Not Found");
	include template('com-notfound', 'message');
	exit;
}
if(!$COM['edittime'] && !$MOD['openall']) {
	$head_title = $COM['company'];
	@header("HTTP/1.1 404 Not Found");
	include template('com-opening', 'message');
	exit;
}
$domain = $COM['domain'];
if($domain) {
	if(strpos($DT_URL, $domain) === false && !isset($preview)) {
		$subdomain = userurl($username);
		if(strpos($DT_URL, $subdomain) === false) {
			dheader('http://'.$domain.'/');
		} else {
			if($DT_URL == $subdomain.'index.php' || $DT_URL == $subdomain) dheader('http://'.$domain);
			dheader(str_replace($subdomain, 'http://'.$domain.'/', $DT_URL));
		}
	}
	$DT['rewrite'] = intval($CFG['com_rewrite']);
}
$userid = $COM['userid'];
$linkurl = userurl($username, '', $domain);
if($COM['linkurl'] != $linkurl) {
	$COM['linkurl'] = $linkurl;
	$db->query("UPDATE LOW_PRIORITY {$table} SET linkurl='$linkurl' WHERE userid=$userid", 'UNBUFFERED');
}
if($COM['vip'] && $COM['totime'] && $COM['totime'] < $DT_TIME) {//VIP Expired
	$COM['vip'] = 0;
	$COM['groupid'] = $gid = $COM['regid'];
	$db->query("UPDATE {$table} SET groupid=$gid,vip=0 WHERE userid=$userid");
	$db->query("UPDATE {$DT_PRE}member SET groupid=$gid WHERE userid=$userid");
}
if($COM['styletime'] && $COM['styletime'] < $DT_TIME) {//SKIN Expired
	$COM['skin'] = $COM['template'] = '';
	$db->query("UPDATE {$table} SET styletime=0,skin='',template='' WHERE userid=$userid");
}
$COM['year'] = vip_year($COM['fromtime']);
$COMGROUP = cache_read('group-'.$COM['groupid'].'.php');
if(!isset($COMGROUP['homepage']) || !$COMGROUP['homepage']) {
	$head_title = $COM['company'];
	$head_keywords = $COM['keyword'];
	$head_description = $COM['introduce'];
	$member = $COM;
	$content_table = content_table(4, $userid, is_file(DT_CACHE.'/4.part'), $DT_PRE.'company_data');
	$r = $db->get_one("SELECT content FROM {$content_table} WHERE userid=$userid", 'CACHE');
	$content = $r['content'];
	$member['thumb'] = $member['thumb'] ? $member['thumb'] : DT_SKIN.'image/company.jpg';
	include template('show', $module);
	exit;
}
isset($rewrite) or $rewrite = '';
if($rewrite) {
	$r = explode('-', $rewrite);
	$rc = count($r);
	if($rc%2 == 0) {
		for($i = 0; $i < $rc; $i++) {
			if(in_array($r[$i], array('itemid', 'typeid', 'page', 'view', 'kw', 'preview', 'update'))) {
				$$r[$i] = $r[++$i];
			} else {
				++$i;
			}
		}
	}
	$page = isset($page) ? max(intval($page), 1) : 1;
	$catid = isset($catid) ? intval($catid) : 0;
	$itemid = isset($itemid) ? (is_array($itemid) ? $itemid : intval($itemid)) : 0;
	$kw = isset($kw) ? htmlspecialchars(str_replace(array("\'"), array(''), trim(urldecode($kw)))) : '';
	if(strlen($kw) < $DT['min_kw'] || strlen($kw) > $DT['max_kw']) $kw = '';
	$keyword = $kw ? str_replace(array(' ', '*'), array('%', '%'), $kw) : '';
}
include load('homepage.lang');
in_array($file, $MFILE) or dheader($MOD['linkurl']);
if($COMGROUP['menu_d']) {
	$_menu_show = array();
	foreach($HMENU as $k=>$v) {
		$_menu_show[$k] = strpos(','.$COMGROUP['menu_d'].',', ','.$k.',') !== false ? 1 : 0;
	}
	$_menu_show = implode(',', $_menu_show);
} else {
	$_menu_show = '1,1,1,1,1,1,1,1,0,0,0,0,0';
} 
$_menu_order = '0,10,20,30,40,50,60,70,80,90,100,110,120';
$_menu_num = '1,16,30,30,10,30,1,12,12,12,12,30,1';
$_menu_file = implode(',' , $MFILE);
$_menu_name = implode(',' , $HMENU);

if($COMGROUP['side_d']) {
	$_side_show = array();
	foreach($HSIDE as $k=>$v) {
		$_side_show[$k] = strpos(','.$COMGROUP['side_d'].',', ','.$k.',') !== false ? 1 : 0;
	}
	$_side_show = implode(',', $_side_show);
} else {
	$_side_show = '1,1,1,0,1,0,1';
}
$_side_order = '0,10,20,30,40,50,60';
$_side_num = '1,5,10,1,1,5,5';
$_side_file = implode(',' , $SFILE);
$_side_name = implode(',' , $HSIDE);

$HOME = get_company_setting($COM['userid'], '', 'CACHE');
$menu_show = explode(',', isset($HOME['menu_show']) ? $HOME['menu_show'] : $_menu_show);
$menu_order = explode(',', isset($HOME['menu_order']) ? $HOME['menu_order'] : $_menu_order);
$menu_num = explode(',', isset($HOME['menu_num']) ? $HOME['menu_num'] : $_menu_num);
$menu_file = explode(',', isset($HOME['menu_file']) ? $HOME['menu_file'] : $_menu_file);
$menu_name = explode(',', isset($HOME['menu_name']) ? $HOME['menu_name'] : $_menu_name);
$_HMENU = array();
asort($menu_order);
foreach($menu_order as $k=>$v) {
	$_HMENU[$k] = $HMENU[$k];
}
$HMENU = $_HMENU;

$MENU = array();
$menuid = 0;
foreach($HMENU as $k=>$v) {
	if($menu_show[$k] && in_array($menu_file[$k], $MFILE)) {
		$MENU[$k]['name'] = $menu_name[$k];
		$MENU[$k]['linkurl'] = userurl($username, 'file='.$menu_file[$k], $domain);
	}
	if($file == $menu_file[$k]) $menuid = $k;
	if($menu_num[$k] < 1 || $menu_num[$k] > 50) $menu_num[$k] = 10;
}

$side_show = explode(',', isset($HOME['side_show']) ? $HOME['side_show'] : $_side_show);
$side_order = explode(',', isset($HOME['side_order']) ? $HOME['side_order'] : $_side_order);
$side_num = explode(',', isset($HOME['side_num']) ? $HOME['side_num'] : $_side_num);
$side_file = explode(',', isset($HOME['side_file']) ? $HOME['side_file'] : $_side_file);
$side_name = explode(',', isset($HOME['side_name']) ? $HOME['side_name'] : $_side_name);
$_HSIDE = array();
asort($side_order);
foreach($side_order as $k=>$v) {
	if($side_show[$k] && in_array($side_file[$k], $SFILE)) {
		$_HSIDE[$k] = $HSIDE[$k];
	}
	if($side_num[$k] < 1 || $side_num[$k] > 50) $side_num[$k] = 10;
}
$HSIDE = $_HSIDE;
$side_pos = isset($HOME['side_pos']) && $HOME['side_pos'] ? 1 : 0;
$side_width = isset($HOME['side_width']) && $HOME['side_width'] ? $HOME['side_width'] : 200;
$show_stats = isset($HOME['show_stats']) && $HOME['show_stats'] == 0 ? 0 : 1;
$skin = 'default';
$template = 'homepage';
if($COM['skin'] && $COM['template']) {
	$skin = $COM['skin'];
	$template = $COM['template'];
} else if($COMGROUP['styleid']) {
	$r = $db->get_one("SELECT skin,template FROM {$DT_PRE}style WHERE itemid=$COMGROUP[styleid]", 'CACHE');
	if($r) {
		$skin = $r['skin'];
		$template = $r['template'];
	}
}
if($COM['banner']) {
	$banner_ext = strtolower(file_ext($COM['banner']));
	if($banner_ext == 'swf') {
		//
	} else if(in_array($banner_ext, array('jpg', 'gif', 'png'))) {
		$HOME['banner'] = $COM['banner'];
		$COM['banner'] = '';
	} else {
		$COM['banner'] = '';
	}
}
$preview = isset($preview) ? intval($preview) : 0;
if($file == 'homepage') {
	if($preview) {
		$preview = $db->get_one("SELECT * FROM {$DT_PRE}style WHERE itemid={$preview}");
		if($preview) {
			$skin = $preview['skin'];
			$template = $preview['template'];
		}
	}
}
$could_comment = $MOD['comment'];
$homeurl = $MOD['homeurl'];
if($domain) $could_comment = false;
$could_contact = check_group($_groupid, $MOD['group_contact']);
if($username == $_username || $domain) $could_contact = true;
$HSPATH = $MODULE[4]['linkurl'].'skin/'.$skin.'/';
$background = isset($HOME['background']) && $HOME['background'] ? $HOME['background'] : '';
$banner = isset($HOME['banner']) && $HOME['banner'] ? $HOME['banner'] : (is_file(DT_ROOT.'/'.$MODULE[4]['moduledir'].'/skin/'.$skin.'/banner.jpg') ? $HSPATH.'banner.jpg' : '');
$bgcolor = isset($HOME['bgcolor']) && $HOME['bgcolor'] ? $HOME['bgcolor'] : '';
$logo = isset($HOME['logo']) && $HOME['logo'] ? $HOME['logo'] : '';
$css = isset($HOME['css']) && $HOME['css'] ? $HOME['css'] : '';
$announce = isset($HOME['announce']) && $HOME['announce'] ? $HOME['announce'] : '';
$map = isset($HOME['map']) && $HOME['map'] ? $HOME['map'] : '';
$head_title = $MENU[$menuid]['name'];
$seo_keywords = isset($HOME['seo_keywords']) && $HOME['seo_keywords'] ? $HOME['seo_keywords'] : '';
$seo_description = isset($HOME['seo_description']) && $HOME['seo_description'] ? $HOME['seo_description'] : '';
$head_keywords = strip_tags($seo_keywords ? $seo_keywords : $COM['company'].','.str_replace('|', ',', $COM['business']));
$head_description = strip_tags($seo_description ? $seo_description : $COM['introduce']);
if($DT['cache_hits']) {
	 cache_hits($moduleid, $userid);
} else {
	$db->query("UPDATE LOW_PRIORITY {$table} SET hits=hits+1 WHERE userid=$userid", 'UNBUFFERED');
}
include DT_ROOT.'/module/company/'.$file.'.inc.php';
?>