<?php
if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$nav_active_index = "newslist";

$art_cat_obj = new Keke_witkey_article_category_class();

$art_obj = new Keke_witkey_article_class();

$page_obj = new Pages_Class();


if($art_cat_id){
	$art_cat_id_str.=intval($art_cat_id);
	$art_cat_obj->setWhere(' art_cat_id='.intval($art_cat_id));
	$art_cat_info = $art_cat_obj->query_keke_witkey_article_category();
	$art_cat_pid = $art_cat_info[0]['art_cat_pid'];
}



$art_cat_pid = intval($art_cat_pid)?intval($art_cat_pid):1;

$art_cat_obj->setWhere(' art_cat_id = '.$art_cat_pid);
$art_cat_p_info = $art_cat_obj->query_keke_witkey_article_category();

$art_cat_obj->setWhere(' art_cat_pid = '.$art_cat_pid.' order by listorder asc ');
$art_cat_c_arr = $art_cat_obj->query_keke_witkey_article_category();

if($art_cat_p_info[0]['cat_name']){
	$page_title=$art_cat_p_info[0]['cat_name'].'_'.$_K['html_title'];
}

if($art_cat_info[0]['cat_name']){
	$page_title=$art_cat_info[0]['cat_name'].' - '.$_K['html_title'];
}

$where = ' 1 = 1 ';



$art_cat_id_str.='0';

if($art_cat_id){
	$where.=" and  art_cat_id in (select art_cat_id from ".TABLEPRE."witkey_article_category where art_index like '%{{$art_cat_id}}%')";
}else{
	$where.=" and  art_cat_id in (select art_cat_id from ".TABLEPRE."witkey_article_category where art_index like '%{1}%')"; 
}

$where_listorder = ' order by pub_time desc ';

$where.=$where_listorder;

$slt_page_size = intval($slt_page_size)?intval($slt_page_size):8;

$art_obj->setWhere($where);
$count = $art_obj->count_keke_witkey_article();

$url ='index.php?do='.$do;
if(intval($art_cat_id)){
	$url.='&art_cat_id='.$art_cat_id;
}
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);


$art_obj->setWhere($where.$pages[where]);
$art_arr = $art_obj->query_keke_witkey_article();

require_once  $template_obj->template ( $do );
?>