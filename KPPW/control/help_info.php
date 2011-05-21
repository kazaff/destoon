<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$art_cat_obj = new Keke_witkey_article_category_class();
$art_obj = new Keke_witkey_article_class();
$art_ext_obj = new Keke_witkey_article_ext_class();
$art_p_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category"," art_cat_pid =100 and art_cat_id !=143 ","",NULL,'art_cat_id');

$art_c_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category"," art_index like '%{100}%' and art_cat_id !=143 ","",NULL,'art_cat_id');


if(intval($art_id)){
	$art_obj->setWhere(' art_id = '.intval($art_id));
	$art_info = $art_obj->query_keke_witkey_article();
	$art_info = $art_info[0];
	
	$art_obj->setWhere(' art_id = '.intval($art_id));
	$art_obj->setViews($art_info[views]+1);
	$art_obj->edit_keke_witkey_article();
	$art_cat_obj->setWhere(' art_cat_id = '.intval($art_info[art_cat_id]));
	$art_cat_info = $art_cat_obj->query_keke_witkey_article_category();
	$art_cat_info = $art_cat_info[0];
	
	$art_cat_obj->setWhere(' art_cat_id = '.intval($art_cat_info[art_cat_pid]));
	$art_cat_p_info = $art_cat_obj->query_keke_witkey_article_category();
	$art_cat_p_info = $art_cat_p_info[0];
	
	$art_obj->setWhere('art_cat_id = '.intval($art_info[art_cat_id]));
	$art_arr = $art_obj->query_keke_witkey_article();
}

require_once  $template_obj->template ( $do );
