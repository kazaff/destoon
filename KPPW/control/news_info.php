<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}


$nav_active_index = 5;

$art_obj = new Keke_witkey_article_class();

$art_cat_obj = new Keke_witkey_article_category_class();



if($art_id){
	$art_obj->setWhere('art_id='.intval($art_id));
	$art_info = $art_obj->query_keke_witkey_article();
	$art_info = $art_info[0];

	
	$art_obj->setWhere(' art_id < '.intval($art_id).' and art_cat_id = '.$art_info['art_cat_id'].' order by art_id desc limit 0,1 ');
	$s_art_info = $art_obj->query_keke_witkey_article();
	$s_art_info = $s_art_info[0];
	
	$art_obj->setWhere(' art_id > '.intval($art_id).' and art_cat_id = '.$art_info['art_cat_id'].' order by art_id asc limit 0,1 ');
	$x_art_info = $art_obj->query_keke_witkey_article();
	$x_art_info = $x_art_info[0];

	db_factory::execute("update ".TABLEPRE."witkey_article set views = views+1 where art_id = $art_id");
	
	if($art_info){
		$art_cat_id = $art_info['art_cat_id'];
	}

	if($art_cat_id){
		$art_cat_id_str.=intval($art_cat_id);
		$art_cat_obj->setWhere(' art_cat_id='.intval($art_cat_id));
		$art_cat_info = $art_cat_obj->query_keke_witkey_article_category();
		$art_cat_pid = $art_cat_info[0]['art_cat_pid'];
	}
	
	if($art_cat_id){
		$where.=' art_cat_id =2  ';
		$art_obj->setWhere($where);
		$art_arr = $art_obj->query_keke_witkey_article();
	}
	
	$art_cat_obj->setWhere(' art_cat_id = '.$art_cat_pid);
	$art_cat_p_info = $art_cat_obj->query_keke_witkey_article_category();
	
	$art_cat_obj->setWhere(' art_cat_pid = '.$art_cat_pid.' order by listorder asc ');
	$art_cat_c_arr = $art_cat_obj->query_keke_witkey_article_category();

	if ($art_info[seo_keyword]){
	$art_obj->setWhere(' seo_keyword like "%'.$art_info[seo_keyword].'%" order by art_id desc limit 0,6');
	$xg_news_arr = $art_obj->query_keke_witkey_article();
	}

}else{
	Func_comm_class::showmessage('您访问的内容不存在或已被管理删除！','index.php?do=news_list',3,'','error');
}


require_once  $template_obj->template ( $do );