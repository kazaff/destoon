<?php
if(!defined('IN_KEKE')) {
	exit('Access Denied');
}
$nav_active_index = 6;
$page_obj = new Pages_Class();

$page = $page?$page:1;

$wheresql = "where a.is_stop!=1 and b.is_close!=1 ";
if ($slt_service_type){
	$wheresql.="and a.service_type = '$slt_service_type' ";
}
if ($rdo_submit_method){
	$wheresql.="and a.submit_method = '$rdo_submit_method' ";
}
if ($indus_id){
	$wheresql.="and a.indus_path like '%|$indus_id|%' ";
}
if (intval($slt_pubtime)){
	$t = time()-($slt_pubtime*24*3600);
	$wheresql.="and a.on_time > '$t' ";
}
if ($txt_keyword){
	$wheresql.="and a.title like '%$txt_keyword%' ";
}
if ($service_id){
	$wheresql.="and service_id = '$service_id' ";
}

$count = db_factory::query("select count(*) count from ".TABLEPRE."witkey_service a left join ".TABLEPRE."witkey_shop b on a.shop_id=b.shop_id $wheresql");
$count=$count[0]['count'];
$url = "shop.php?do=service_list&&slt_service_type=$slt_service_type&rdo_submit_method=$rdo_submit_method&indus_id=$indus_id&slt_pubtime=$slt_pubtime&txt_kewword=$txt_kewword";

$limit=10;
$pages = $page_obj->getPages($count,$limit,$page,$url);
$order = " order by a.on_time desc";
$sql = "select a.*,b.job,b.indus_id shop_indus,b.shop_type,b.work_year,c.address,c.truename,c.w_m_credit_value,
c.isvip,c.email_auth,c.enterprise_auth,c.realname_auth,c.bank_auth
from 
".TABLEPRE."witkey_service a left join 
".TABLEPRE."witkey_shop b on a.shop_id=b.shop_id left join
".TABLEPRE."witkey_space c on b.uid = c.uid
$wheresql  $order    {$pages[where]} ";

$service_list = db_factory::query($sql);

 


require_once $template_obj->template("shop/tpl/{$_K['template']}/{$do}");
