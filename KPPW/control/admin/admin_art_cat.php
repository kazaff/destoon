<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}



$art_cat_obj = new Keke_witkey_article_category_class();


$need_index_art = Cache_ext_Class::gettabledata("witkey_article_category"," art_index='' or art_index is null","",0,'art_cat_id');
if ($op == "repair_index"){
	$need_index_art = Cache_ext_Class::gettabledata("witkey_article_category","","",NULL,'art_cat_id');
}
if ($need_index_art){
	$art_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category","","",NULL,'art_cat_id');
	foreach ($need_index_art as $n_art){
		$flag = $n_art;
		$art_index = "";
		while ($flag['art_cat_pid']){
			$art_index = "{{$flag['art_cat_pid']}}".$art_index;
			$flag = $art_cat_arr[$flag['art_cat_pid']];
		}
		$art_index = $art_index."{{$n_art['art_cat_id']}}";
		$art_cat_obj->setWhere("art_cat_id = {$n_art['art_cat_id']}");
		$art_cat_obj->setArt_index($art_index);
		$art_cat_obj->edit_keke_witkey_article_category();
	}
}


$where = ' 1 = 1 ';

$types =  array ('help', 'art');
$type = (! empty ( $type ) && in_array ( $type, $types )) ? $type : 'art';

if($type=='art'){
	$art_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category","art_index like '%{1}%'","",NULL,'art_cat_id');
	$where.=" and art_index like ('%{1}%') ";
	Func_comm_class::adminCheckRole(31);
}elseif($type=='help'){
	$art_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category","art_index like '%{100}%'","",NULL,'art_cat_id');
	
	$where.=" and art_index like ('%{100}%') ";
	Func_comm_class::adminCheckRole(83);
}


if(isset($sbt_search)){
	if($slt_cat_id){
		$where.=" and art_cat_id != $slt_cat_id and art_cat_id like '%{$slt_cat_id}%'";
	}
	
	if($txt_id){
		$where.=' and art_cat_id = '.$txt_id;
	}
	if($txt_title){
		$where.=' and cat_name like '.'"%'.$txt_title.'%" ';
	}
}


switch ($ord) {
	case 1:
		$where.=' order by art_cat_id desc ';
	;
	break;
	case 2:
		$where.=' order by art_cat_id asc ';
	;
	break;
	case 3:
		$where.=' order by on_time desc ';
	;
	break;
	case 4:
		$where.=' order by on_time asc ';
	;
	break;
	case 5:
		$where.=' order by listorder desc ';
	;
	break;
	case 6:
		$where.=' order by listorder asc ';
	;
	break;
	default:
		$where.=' order by on_time desc ';
	break;
}


$art_cat_obj->setWhere($where);
$art_cat_show_arr = $art_cat_obj->query_keke_witkey_article_category();

$temp_arr = array();
Func_comm_class::get_tree($art_cat_show_arr,$temp_arr,'list',NULL,'art_cat_id','art_cat_pid','cat_name');
$cat_show_arr = $temp_arr;
unset($temp_arr);


if($ac=='del'){
	if($art_cat_id){
		if (in_array($art_cat_id,array(1,100,200))){Func_comm_class::adminshowmessage('一级分类无法删除！','index.php?do=art_cat&type='.$type);}
		
		$art_cat_obj->setWhere('art_cat_id='.$art_cat_id);
		$res = $art_cat_obj->del_keke_witkey_article_category();
		Cache::delete('keke_witkey_article_category');
		Func_comm_class::adminshowmessage('分类删除成功！','index.php?do=art_cat&type='.$type);
	}else{
		Func_comm_class::adminshowmessage('分类不存在，删除失败！','index.php?do=art_cat&type='.$type);
	}
}

if (isset ( $sbt_action )) {
	$o_p = $rdo;
	$keyids = $ckb;
	//var_dump($keyids);die();
	 if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	 }
	if (count ( $keyids )) {
		
		$art_cat_obj->setWhere(' art_cat_id in ('.$ids.') ');
		switch ($sbt_action) {
		
			case '批量删除' : 
				$art_cat_obj->setWhere(' art_cat_id in ('.$ids.') and art_cat_id not in (1,100,200) ');
				
				$res = $art_cat_obj->del_keke_witkey_article_category();
				break;
			default : 
				break;
		}
		Cache::delete('keke_witkey_article_category');
		if($res){
			Func_comm_class::adminshowmessage('批量操作成功！','index.php?do='.$do.'&type='.$type);
		}else{
			Func_comm_class::adminshowmessage('批量操作失败，请重新操作！','index.php?do='.$do.'&type='.$type);
		}
	} else {
		Func_comm_class::adminshowmessage('请选择要操作的项！','index.php?do='.$do.'&type='.$type);
	}
}


$temp_arr = array();
Func_comm_class::get_tree($art_cat_arr,$temp_arr,'option',NULL,'art_cat_id','art_cat_pid','cat_name');
$cat_arr = $temp_arr;
unset($temp_arr);


require_once $template_obj->template('control/admin/tpl/admin_'.$do);