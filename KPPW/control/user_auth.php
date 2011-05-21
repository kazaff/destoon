<?php



if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

$auth_item_obj = new Keke_witkey_auth_item_class();


$auth_item_obj->setWhere(' auth_open = 1 ');
$auth_item_arr = $auth_item_obj->query_keke_witkey_auth_item();

$user_info = Func_comm_class::getuserinfo($uid);

$bank_auth_obj = new Keke_witkey_bank_auth_class();
$bank_auth_obj->setWhere("uid = '$uid'");
$bank_ds = $bank_auth_obj->query_keke_witkey_bank_auth();
$bank_arr = $bank_ds[0];


require_once  $template_obj->template ($do."_".$view);