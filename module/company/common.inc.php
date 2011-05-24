<?php 
defined('IN_DESTOON') or exit('Access Denied');
//定义模块的根目录
define('MD_ROOT', DT_ROOT.'/module/'.$module);

require DT_ROOT.'/include/module.func.php';		//加载模块公用函数集合
require MD_ROOT.'/global.func.php';		//加载公司模块的全局函数

$CATEGORY = cache_read('category-'.$moduleid.'.php');	//公司行业分类数据
$ITEMS = cache_read('cateitem-'.$moduleid.'.php');	//

if($MOD['seo_keywords']) $head_keywords = $MOD['seo_keywords'];
if($MOD['seo_description']) $head_description = $MOD['seo_description'];
$table = $DT_PRE.$module;	//公司表名
$table_member = $DT_PRE.'member';	//用户表名

$AREA = cache_read('area.php');		//地区分类数据
?>