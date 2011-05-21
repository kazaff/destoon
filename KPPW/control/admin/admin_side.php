<?php


$menuset_arr = Cache_ext_Class::getMenuset();

$resource_arr = $menuset_arr['menu'];
$group_arr = Cache_ext_Class::getGroupList();
if (!$group_arr) {
	die();
}

$url_this = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
$urlset_arr = $resource_arr[$menu];


if(!$urlset_arr)
{
	$urlset_arr = array(
		array('name'=>'常用操作','items'=>array(
		$menuset_arr['resource'][1],
		$menuset_arr['resource'][9],
		$menuset_arr['resource'][24],
		$menuset_arr['resource'][32],
		$menuset_arr['resource'][36],
		$menuset_arr['resource'][51],
		$menuset_arr['resource'][53],
		$menuset_arr['resource'][55],
		)),
	);
}
elseif ($menu == "task"){

	
	
}


require_once $template_obj->template('control/admin/tpl/admin_'.$do);