<?php
require 'config.inc.php';
require '../common.inc.php';

$mid = isset($mid) ? intval($mid) : 0;		//请求的模块的ID

if($mid) {
	//如果是group-1，验证管理员身份
	include DT_ROOT.'/module/member/admin.inc.php';
	
	$group_editor = $MG['editor'];	//编辑器样式
	in_array($group_editor, array('Default', 'Destoon', 'Simple', 'Basic')) or $group_editor = 'Destoon';
	
	$MST = cache_read('module-2.php');	//加载会员模块的基本配置	
	$show_menu = $MST['show_menu'] ? true : false;
	
	if(!$_userid) $action = 'add';//Guest
	if($_groupid > 5 && !$_edittime && $action == 'add') dheader($MODULE[2]['linkurl'].'edit.php?tab=2');
	
	if($submit) {
		check_post() or dalert($L['bad_data']); //safe
		$BANWORD = cache_read('banword.php');
		if($BANWORD && isset($post)) {
			$keys = array('title', 'tag', 'introduce', 'content');
			foreach($keys as $v) {
				if(isset($post[$v])) $post[$v] = banword($BANWORD, $post[$v]);
			}
		}
	}

	$MYMODS = array();
	if(isset($MG['moduleids']) && $MG['moduleids']) {
		$MYMODS = explode(',', $MG['moduleids']);
	}
	if($MYMODS) {
		foreach($MYMODS as $k=>$v) {
			$v = abs($v);
			if(!is_file(DT_ROOT.'/module/'.$MODULE[$v]['module'].'/my.inc.php')) unset($MYMODS[$k]);
		}
	}

	$MENUMODS = $MYMODS;
	if($show_menu) {
		$MENUMODS = array();
		foreach($MODULE as $m) {
			if($m['moduleid'] > 4 && is_file(DT_ROOT.'/module/'.$m['module'].'/my.inc.php')) $MENUMODS[] = $m['moduleid'];
		}
	}

	$vid = $mid;
	if($mid == 9 && isset($resume)) $vid = -9;
	if(!$MYMODS || !in_array($vid, $MYMODS)) message('', $MODULE[2]['linkurl'].$DT['file_my']);

	$IMVIP = isset($MG['vip']) && $MG['vip']; 
	$moduleid = $mid;
	$module = $MODULE[$moduleid]['module'];
	if(!$module) message();
	$MOD = cache_read('module-'.$moduleid.'.php');
	$my_file = DT_ROOT.'/module/'.$module.'/my.inc.php';
	if(is_file($my_file)) {
		require $my_file;
	} else {
		dheader($MODULE[2]['linkurl']);
	}
} else {
	require DT_ROOT.'/module/'.$module.'/my.inc.php';
}
?>