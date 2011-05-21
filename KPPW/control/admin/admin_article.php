<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

$art_obj = new Keke_witkey_article_class();
$art_obj_ext = new Keke_witkey_article_class();
$art_cat_obj = new Keke_witkey_article_category_class();
$page_obj = new Pages_Class();

 



$where = ' 1 = 1 ';

$types =  array ('help', 'art','single');
$type = (! empty ( $type ) && in_array ( $type, $types )) ? $type : 'art';


if($type=='art'){
	Func_comm_class::adminCheckRole(32);
	$art_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category","art_index like '%{1}%'","",NULL,'art_cat_id');
	$where .= " and art_cat_id in (select art_cat_id from ".TABLEPRE."witkey_article_category where art_index like '%{1}%') ";
}elseif($type=='help'){
	Func_comm_class::adminCheckRole(80);
	$art_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category","art_index like '%{100}%'","",NULL,'art_cat_id');
	$where .= " and art_cat_id in (select art_cat_id from ".TABLEPRE."witkey_article_category where art_index like '%{100}%') ";
}elseif($type=='single'){
	Func_comm_class::adminCheckRole(97);
	$art_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category","art_index like '%{200}%'","",NULL,'art_cat_id');
	$where .= " and art_cat_id in (select art_cat_id from ".TABLEPRE."witkey_article_category where art_index like '%{200}%') ";
}


	if($slt_cat_id){
		$where.=" and art_cat_id in  (select art_cat_id from ".TABLEPRE."witkey_article_category where art_index like '%{{$slt_cat_id}}%') ";
	}
	if($slt_is_show){
		$where.=' and is_show = '.$slt_is_show;
	}
	if($txt_id){
		$where.=' and art_id = '.$txt_id;
	}
	if($txt_title){
		$where.=' and art_title like '.'"%'.$txt_title.'%" ';
	}
	if($txt_author){
		$where.=' and username like '.'"%'.$txt_author.'%" ';
	}


 
switch ($ord) {
	case 1:
		$where.=' order by art_id desc ';
	;
	break;
	case 2:
		$where.=' order by art_id asc ';
	;
	break;
	case 3:
		$where.=' order by pub_time desc ';
	;
	break;
	case 4:
		$where.=' order by pub_time asc ';
	;
	break;
	default:
		$where.=' order by pub_time desc ';
	break;
}


$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;

$art_obj_ext->setWhere($where);
$count = $art_obj_ext->count_keke_witkey_article();

$url ='index.php?do='.$do.'&slt_cat_id='.$slt_cat_id.'&slt_is_show='.$slt_is_show.'&slt_page_size='.$slt_page_size.'&txt_id='.$txt_id.'&txt_title='.$txt_title.'&txt_author='.$txt_author.'&type='.$type;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);


$art_obj_ext->setWhere($where.$pages[where]);
$art_arr = $art_obj_ext->query_keke_witkey_article();



if($ac=='del'){
	if($art_id){
		$art_obj->setWhere('art_id='.$art_id);
		$res = $art_obj->del_keke_witkey_article();
		Func_comm_class::adminshowmessage('文章删除成功！','index.php?do=article&type='.$type);
	}else{
		Func_comm_class::adminshowmessage('文章不存在，删除失败！','index.php?do=article&type='.$type);
	}
}


if (isset ( $sbt_action )) {
	$o_p = $rdo;
	$keyids = $ckb;
	
	if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	}
	if (count ( $keyids )) {
		
		$art_obj->setWhere(' art_id in ('.$ids.') ');
		switch ($sbt_action) {
			case '放入回收站' : 
				$art_obj->setIs_show(2);
				$res = $art_obj->edit_keke_witkey_article();
				Func_comm_class::adminSystemLog("批量删除文章$ids");
				break;
			case '恢复文章' : 
				$art_obj->setIs_show(1);
				$res = $art_obj->edit_keke_witkey_article();
				Func_comm_class::adminSystemLog("批量恢复文章$ids");
				break;
			case '批量删除' : 
				$res = $art_obj->del_keke_witkey_article();
				Func_comm_class::adminSystemLog("批量删除文章$ids");
				break;
			default : 
				break;
		}
		if($res){
			Func_comm_class::adminshowmessage('批量操作成功！','index.php?do='.$do.'&type='.$type);
		}else{
			Func_comm_class::adminshowmessage('批量操作失败，请重新操作！','index.php?do='.$do.'&type='.$type);
		}
	} else {
		Func_comm_class::adminshowmessage('请选择要操作的项！','index.php?do='.$do.'&type='.$type);
	}
}

$cat_arr = $art_cat_arr;

$temp_arr = array();
Func_comm_class::get_tree($art_cat_arr,$temp_arr,'option',NULL,'art_cat_id','art_cat_pid','cat_name');
$cat_arr_list = $temp_arr;
unset($temp_arr);



require_once $template_obj->template('control/admin/tpl/admin_'.$do);