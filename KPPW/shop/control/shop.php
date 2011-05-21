<?php
 
if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$views = array ("index", "service", "case", "contact", "comment" );
$view = $view ? $view : "index";

 
if (! $shop_id) {
	Func_comm_class::showmessage ( "错误提示", 'shop.php?do=index', 3, "该店铺还没有开通", 'error' );
}
 
$shop_info = db_factory::query ( "select b.*,a.*,a.indus_id as shop_indus_id from " . TABLEPRE . "witkey_shop a left join " . TABLEPRE . "witkey_space b on a.uid = b.uid where a.shop_id = '$shop_id'" );
$shop_info = $shop_info [0];
if (! $shop_info) {
	Func_comm_class::showmessage ( "错误提示", 'shop.php?do=index', 3, "该店铺不存在", 'error' );
}
if ($shop_info ['is_close']) {
	Func_comm_class::showmessage ( "错误提示", 'shop.php?do=index', 3, "该店铺已关闭", 'error' );
}

 
if ($shop_info ['shop_type'] == 1) {
 
	$shop_config = db_factory::query ( "select * from " . TABLEPRE . "witkey_shop_tpl_pconfig where shop_id = '{$shop_info['shop_id']}' " );
	$shop_config = $shop_config[0];
 
	$shop_banner = $shop_config ['banner_img'];
	if (! $shop_banner && $shop_config ['banner_id']) {
		$banner_info = Cache_ext_Class::gettabledata ( "witkey_shop_banner", "banner_id = '{$shop_info['banner_id']}'", "", null, "", 1, 1 );
		$shop_banner = $banner_info ['img_file'];
	}
	
	$shop_indus = Cache_ext_Class::getIndustryList ( 1 );
	$service_range = explode ( ',', $shop_info ['service_range'] );
 
	$shop_pindus = Cache_ext_Class::gettabledata("witkey_shop_cus_cate","shop_id={$shop_info['shop_id']} and obj_type = 2","",null,'cus_cate_id');
 
	$link_arr = db_factory::query ( "select * from " . TABLEPRE . "witkey_link where shop_id = $shop_id order by listorder asc" );

} else {
 
	$shop_config = db_factory::query ( "select * from " . TABLEPRE . "witkey_shop_tpl_econfig where shop_id = '{$shop_info['shop_id']}' " );
	$shop_config = $shop_config[0];
}
 
$shop_meun = Cache_ext_Class::gettabledata ( "witkey_shop_menu", "shop_id='$shop_id'", '', 5000, '', 1, 1 );
if (! $shop_meun) {
	include_once 'header_menu_default.php';
	$shop_meun = $menu_arr [$shop_info ['shop_type']];
}

 
if ($_COOKIE ['view_shop_id_' . $shop_id] + 24 * 3600 < time ()) {
	db_factory::execute ( "update " . TABLEPRE . "witkey_shop set views = views+1 where shop_id='$shop_id'" );
	setcookie ( "view_shop_id_$shop_id", time () );
}
 
if($uid && $uid != $shop_info['uid']){
Func_comm_class::update_score_value($uid,'access_shop',3);
}
 

 
require 'shop_' . $view . '.php';

