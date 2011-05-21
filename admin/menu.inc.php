<?php
defined('IN_DESTOON') or exit('Access Denied');
$menu = array(
	array('数据维护', '?file=database'),
	array('模板风格', '?file=template'),
	array('标签向导', '?file=tag'),
	array('后台搜索', '?file=search'),
	array('木马扫描', '?file=scan'),
	array('后台日志', '?file=log'),
	array('上传记录', '?file=upload'),
	array('404日志', '?file=404'),
	array('搜索记录', '?file=keyword'),
	array('问题验证', '?file=question'),
	array('词语过滤', '?file=banword'),
	array('重名检测', '?file=repeat'),
	array('禁止IP', '?file=banip'),
	array('单页采编', '?file=fetch'),
);
if(!$_founder) unset($menu[0],$menu[1],$menu[3]);
$menu_help = array(
	array('使用协议', '?file=destoon&action=license'),
	array('在线文档', '?file=destoon&action=doc'),
	array('技术支持', '?file=destoon&action=support'),
	array('官方论坛', '?file=destoon&action=bbs'),
	array('信息反馈', '?file=destoon&action=feedback'),
	array('检查更新', '?file=destoon&action=update'),
	array('关于软件', '?file=destoon&action=about'),
);
$menu_system = array(
	array('网站设置', '?file=setting'),
	array('模块管理', '?file=module'),
	array('地区管理', '?file=area'),
	array('管理员管理', '?file=admin'),
);
?>