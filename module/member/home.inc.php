<?php 
defined('IN_DESTOON') or exit('Access Denied');
login();
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$MG['homepage'] && $MG['home'] or dalert(lang('message->without_permission_and_upgrade'), $MOD['linkurl']);
require DT_ROOT.'/include/post.func.php';
include load('homepage.lang');
if($action == 'reset' && in_array($item, array('menu', 'main', 'side'))) {
	foreach(array('show', 'order', 'num', 'file', 'name') as $v) {
		$v = $item.'_'.$v;
		$db->query("DELETE FROM {$DT_PRE}company_setting WHERE userid=$_userid AND item_key='$v'");
	}
	dmsg($L['home_msg_reset'], 'home.php');
}
if($submit) {
	if(isset($reset)) {
		delete_upload($setting['background'], $_userid);
		delete_upload($setting['logo'], $_userid);
		delete_upload($setting['banner'], $_userid);
		foreach($setting as $k=>$v) {
			$db->query("DELETE FROM {$DT_PRE}company_setting WHERE userid=$_userid AND item_key='$k'");
		}
		dmsg($L['home_msg_reset'], 'home.php');
	} else {
		clear_upload($setting['background'].$setting['logo'].$setting['banner'].$setting['mypage']);
		$announce = $setting['announce'];
		unset($setting['announce']);	
		$mypage = $setting['mypage'];
		unset($setting['mypage']);
		$setting = dhtmlspecialchars($setting);
		$setting['announce'] = dsafe($announce);
		$setting['mypage'] = dsafe($mypage);
		update_company_setting($_userid, $setting);
		dmsg($L['home_msg_save'], 'home.php');
	}
} else {
	$menu_c = ','.$MG['menu_c'].',';
	if($MG['menu_d']) {
		$_menu_show = array();
		foreach($HMENU as $k=>$v) {
			$_menu_show[$k] = strpos(','.$MG['menu_d'].',', ','.$k.',') !== false ? 1 : 0;
		}
		$_menu_show = implode(',', $_menu_show);
	} else {
		$_menu_show = '1,1,1,1,1,1,1,1,0,0,0,0,0';
	}
	$_menu_order = '0,10,20,30,40,50,60,70,80,90,100,110,120';
	$_menu_num = '1,16,30,30,10,30,1,12,12,12,12,30,1';
	$_menu_file = implode(',' , $MFILE);
	$_menu_name = implode(',' , $HMENU);

	$side_c = ','.$MG['side_c'].',';
	if($MG['side_d']) {
		$_side_show = array();
		foreach($HSIDE as $k=>$v) {
			$_side_show[$k] = strpos(','.$MG['side_d'].',', ','.$k.',') !== false ? 1 : 0;
		}
		$_side_show = implode(',', $_side_show);
	} else {
		$_side_show = '1,1,1,0,1,0,1';
	}
	$_side_order = '0,10,20,30,40,50,60';
	$_side_num = '1,5,10,1,1,5,5';
	$_side_file = implode(',' , $SFILE);
	$_side_name = implode(',' , $HSIDE);

	$main_c = ','.$MG['main_c'].',';
	if($MG['main_d']) {
		$_main_show = array();
		foreach($HMAIN as $k=>$v) {
			$_main_show[$k] = strpos(','.$MG['main_d'].',', ','.$k.',') !== false ? 1 : 0;
		}
		$_main_show = implode(',', $_main_show);
	} else {
		$_main_show = '1,1,1,0,0,0,0';
	}
	$_main_order = '0,10,20,30,40,50,60';
	$_main_num = '10,1,10,5,3,4,4';
	$_main_file= implode(',' , $IFILE);
	$_main_name = implode(',' , $HMAIN);

	$HOME = get_company_setting($_userid);
	extract($HOME);

	$menu_show = explode(',', isset($HOME['menu_show']) ? $HOME['menu_show'] : $_menu_show);
	$menu_order = explode(',', isset($HOME['menu_order']) ? $HOME['menu_order'] : $_menu_order);
	$menu_num = explode(',', isset($HOME['menu_num']) ? $HOME['menu_num'] : $_menu_num);
	$menu_file = explode(',', isset($HOME['menu_file']) ? $HOME['menu_file'] : $_menu_file);
	$menu_name = explode(',', isset($HOME['menu_name']) ? $HOME['menu_name'] : $_menu_name);
	$_HMENU = array();
	asort($menu_order);
	foreach($menu_order as $k=>$v) {
		$_HMENU[$k] = $HMENU[$k];
		if($menu_num[$k] < 1 || $menu_num[$k] > 50) $menu_num[$k] = 10;
	}
	$HMENU = $_HMENU;
	$pageid = array_search('page', $menu_file);

	$main_show = explode(',', isset($HOME['main_show']) ? $HOME['main_show'] : $_main_show);
	$main_order = explode(',', isset($HOME['main_order']) ? $HOME['main_order'] : $_main_order);
	$main_num = explode(',', isset($HOME['main_num']) ? $HOME['main_num'] : $_main_num);
	$main_file = explode(',', isset($HOME['main_file']) ? $HOME['main_file'] : $_main_file);
	$main_name = explode(',', isset($HOME['main_name']) ? $HOME['main_name'] : $_main_name);
	$_HMAIN = array();
	asort($main_order);
	foreach($main_order as $k=>$v) {
		$_HMAIN[$k] = $HMAIN[$k];
		if($main_num[$k] < 1 || $main_num[$k] > 50) $main_num[$k] = 10;
	}
	$HMAIN = $_HMAIN;

	$side_show = explode(',', isset($HOME['side_show']) ? $HOME['side_show'] : $_side_show);
	$side_order = explode(',', isset($HOME['side_order']) ? $HOME['side_order'] : $_side_order);
	$side_num = explode(',', isset($HOME['side_num']) ? $HOME['side_num'] : $_side_num);
	$side_file = explode(',', isset($HOME['side_file']) ? $HOME['side_file'] : $_side_file);
	$side_name = explode(',', isset($HOME['side_name']) ? $HOME['side_name'] : $_side_name);
	$_HSIDE = array();
	asort($side_order);
	foreach($side_order as $k=>$v) {
		$_HSIDE[$k] = $HSIDE[$k];
		if($side_num[$k] < 1 || $side_num[$k] > 50) $side_num[$k] = 10;
	}
	$HSIDE = $_HSIDE;

	isset($HOME['side_pos']) or $side_pos = 0;
	isset($HOME['side_width']) or $side_width = 200;
	isset($HOME['show_stats']) or $show_stats = 1;
	isset($HOME['intro_length']) or $intro_length = 1000;
	isset($HOME['map']) or $map = '';
	isset($HOME['background']) or $background = '';
	isset($HOME['bgcolor']) or $bgcolor = '';
	isset($HOME['banner']) or $banner = '';
	isset($HOME['logo']) or $logo = '';
	isset($HOME['css']) or $css = '';
	isset($HOME['announce']) or $announce = '';
	isset($HOME['seo_title']) or $seo_title = '';
	isset($HOME['seo_keywords']) or $seo_keywords = '';
	isset($HOME['seo_description']) or $seo_description = '';

	$head_title = $L['home_title'];
	include template('home', $module);
}
?>