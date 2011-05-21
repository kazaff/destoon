<?php 
defined('IN_DESTOON') or exit('Access Denied');

define('MD_ROOT', DT_ROOT.'/module/'.$module);	//定义会员模块根目录
require MD_ROOT.'/global.func.php';		//会员模块全局函数

if(defined('DT_ADMIN')) {
	$GROUP = cache_read('group.php');
} else {
	//如果有数据提交，进行检查和过滤
	if($submit) {
		check_post() or dalert($L['bad_data']); //safe,只支持POST提交
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
	
	$group_editor = $MG['editor'] ? 'Default' : 'Destoon';
	$show_menu = $MOD['show_menu'] ? true : false;

	$MENUMODS = $MYMODS;
	if($show_menu) {
		$MENUMODS = array();
		foreach($MODULE as $m) {
			if($m['moduleid'] > 4 && is_file(DT_ROOT.'/module/'.$m['module'].'/my.inc.php')) $MENUMODS[] = $m['moduleid'];
		}
	}
}

require DT_ROOT.'/include/module.func.php';		//模块类型的功能函数集合
isset($admin_user) or $admin_user = false;

$AREA = cache_read('area.php');		//读取地区信息

$table = $DT_PRE.'member';	//会员模块对应的数据库表名
$table_company = $DT_PRE.'company';		//公司模块对应的数据表名
?>