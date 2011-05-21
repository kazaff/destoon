<?php


if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

if ($is_submit)
{
	$user_obj = new Keke_witkey_space_class();
	$user_obj->setWhere("uid = '{$uid}'");
	$user_obj->setIndus_id($indus_id);
	$res = $user_obj->edit_keke_witkey_space();
	echo $res;
	die();
}

$title = "选择行业";
$user_info = Func_comm_class::getuserinfo($uid);

$indus_p_arr = Cache_ext_Class::getIndustryList(1,0);



require_once  $template_obj->template ($do."_".$view);

