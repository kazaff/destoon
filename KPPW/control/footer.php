<?php


if(!defined('IN_KEKE')) {
	exit('Access Denied');
}


if ($view == "customerservice"){
	$space_obj = new Keke_witkey_space_class();
	$space_obj->setWhere("group_id = 7");
	$customer_list = $space_obj->query_keke_witkey_space();
	
	$r_list = Cache_ext_Class::gettabledata("witkey_article","art_cat_id = 200","",3600,"",10);
	
	require_once  $template_obj->template ( $view );
}
else {
	$nav_active_index = 5;
	$art_obj = new Keke_witkey_article_class();
	$art_cat_obj = new Keke_witkey_article_category_class();
	
	if (!$art_id){
		Func_comm_class::showmessage('错误的参数！','index.php?do=news_list',3,"","error");
	}
	$art_obj->setWhere('art_id='.intval($art_id));
	$art_info = $art_obj->query_keke_witkey_article();
	$art_info = $art_info[0];
	if (!$art_info){
		Func_comm_class::showmessage('您访问的内容不存在或已被管理删除！','index.php?do=news_list',3,"","error");
	}
	if ($art_info['art_cat_id'] != 200){
		Func_comm_class::showmessage('页面跳转中！','index.php?do=news_list',3,"","error");
	}
	
	$r_list = Cache_ext_Class::gettabledata("witkey_article","art_cat_id = 200","",3600,"",10);
	
	require_once  $template_obj->template ( 'single' );
	
}





