<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$art_cat_obj = new Keke_witkey_article_category_class();
$art_obj = new Keke_witkey_article_class();
$art_ext_obj = new Keke_witkey_article_ext_class();

$art_p_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category"," art_cat_pid =100 and art_cat_id !=143 ","",NULL,'art_cat_id');

$art_c_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category"," art_index like '%{100}%' and art_cat_id !=143 ","",NULL,'art_cat_id');

if($keyword){
	$art_c_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category"," art_cat_pid !=1 ","",NULL,NULL);
	foreach ($art_c_cat_arr as $value) {
		$cat_ids.=$value[art_cat_id].',';
	}
	$cat_ids.='0';

	$art_obj->setWhere(' art_cat_id in ('.$cat_ids.') and ( art_title like  "%'.$art_info[seo_keyword].'%" or seo_keyword like "%'.$art_info[seo_keyword].'%") and art_title like "%'.$keyword.'%" ');	
	$art_arr = $art_obj->query_keke_witkey_article();
}

if(intval($art_cat_id)){
	$art_cat_obj->setWhere(' art_cat_id = '.intval($art_cat_id));
	$art_cat_info = $art_cat_obj->query_keke_witkey_article_category();
	$art_cat_info = $art_cat_info[0];
	
	$art_cat_obj->setWhere(' art_cat_id = '.intval($art_cat_info[art_cat_pid]));
	$art_cat_p_info = $art_cat_obj->query_keke_witkey_article_category();
	$art_cat_p_info = $art_cat_p_info[0];
	
	$art_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category"," art_cat_id = ".intval($art_cat_id),"",NULL,NULL);
	$art_obj->setWhere('art_cat_id = '.intval($art_cat_id));
	$art_arr = $art_obj->query_keke_witkey_article();
}

if(intval($art_cat_pid)){
	$art_cat_obj->setWhere(' art_cat_id = '.intval($art_cat_pid));
	$art_cat_p_info = $art_cat_obj->query_keke_witkey_article_category();
	$art_cat_p_info = $art_cat_p_info[0];
	$art_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category"," art_cat_pid = ".intval($art_cat_pid),"",NULL,NULL);
	foreach ($art_cat_arr as $value) {
		$cat_ids.=$value[art_cat_id].',';
	}
	$cat_ids.='0';
	$art_obj->setWhere(' art_cat_id in ('.$cat_ids.')');
	$art_arr = $art_obj->query_keke_witkey_article();
}


require_once  $template_obj->template ( $do );
