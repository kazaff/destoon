<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$art_cat_obj = new Keke_witkey_article_category_class();
$art_obj = new Keke_witkey_article_class();
$art_ext_obj = new Keke_witkey_article_ext_class();
$art_p_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category"," art_cat_pid =100 ","",3600);

$art_c_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category"," art_index like '%{100}%'  ","",3600);


$art_obj->setWhere(' art_cat_id = 143');
$art_arr = $art_obj->query_keke_witkey_article();

$art_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category"," art_cat_pid !=1 ","",NULL,NULL);
foreach ($art_cat_arr as $value) {
	$cat_ids.=$value[art_cat_id].',';
}
$cat_ids.='0';
$art_obj->setWhere(' art_cat_id in ('.$cat_ids.') order by views limit 0,12 ');
$art_now_arr = $art_obj->query_keke_witkey_article();

$art_obj->setWhere("is_recommend = 1 limit 0,8");
$commend_list = $art_obj->query_keke_witkey_article();


require_once  $template_obj->template ( $do );
