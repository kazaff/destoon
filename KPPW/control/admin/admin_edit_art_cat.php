<?php


if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$art_cat_obj = new Keke_witkey_article_category_class();

$types =  array ('help', 'art');
$type = (! empty ( $type ) && in_array ( $type, $types )) ? $type : 'art';


if($type=='art'){
	Func_comm_class::adminCheckRole(39);
	$art_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category","art_index like '%{1}%'","",NULL,'art_cat_id');
}elseif($type=='help'){
	Func_comm_class::adminCheckRole(84);
	$art_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category","art_index like '%{100}%'","",NULL,'art_cat_id');
}


if($art_cat_id){
	$art_cat_obj->setWhere('art_cat_id='.intval($art_cat_id));
	$art_cat_info = $art_cat_obj->query_keke_witkey_article_category();
	$art_cat_info = $art_cat_info[0];
	$art_cat_pid = $art_cat_info[art_cat_pid];
}


if($sbt_edit){
	
	$flag = null;
	if($hdn_art_cat_id){
		$art_cat_obj->setWhere('art_cat_id='.intval($hdn_art_cat_id));
		$art_cat_info = $art_cat_obj->query_keke_witkey_article_category();
		$art_cat_info = $art_cat_info[0];
		if($art_cat_info['art_cat_pid']>0){
			$art_cat_obj->setArt_cat_pid($slt_cat_id);
		}
	}else{
		$art_cat_obj->setArt_cat_pid($slt_cat_id);
	}
	
	$art_cat_obj->setCat_name($txt_cat_name);
	$art_cat_obj->setListorder($txt_listorder?$txt_listorder:0);
	$art_cat_obj->setIs_show(intval($chk_is_show));
	$art_cat_obj->setOn_time(time());
	$art_index = "";
	$art_index = "{{$slt_cat_id}}".$art_index;
	$flag = $art_cat_arr[$slt_cat_id];
	
	while ($flag['art_cat_pid']){
		$art_index = "{{$flag['art_cat_pid']}}".$art_index;
		$flag = $art_cat_arr[$flag['art_cat_pid']];
	}
	
	if($hdn_art_cat_id){
		$art_cat_obj->setArt_cat_id($hdn_art_cat_id);
		$art_index = $art_index."{{$hdn_art_cat_id}}";
		$art_cat_obj->setArt_index($art_index);
		$res = $art_cat_obj->edit_keke_witkey_article_category();//编辑文章分类
		if($res){
			Func_comm_class::adminSystemLog("编辑文章分类$slt_cat_id");
			Func_comm_class::adminshowmessage('文章分类编辑成功！','index.php?do=art_cat&type='.$type);
		}
	}else{
		$res = $art_cat_obj->create_keke_witkey_article_category();//添加文章分类
		$art_index = $art_index."{{$res}}";
		if($res){
			$art_cat_obj->setWhere("art_cat_id='$res'");
			$art_cat_obj->setArt_index($art_index);
			$art_cat_obj->edit_keke_witkey_article_category();
			Func_comm_class::adminSystemLog("添加文章分类$res");
			Func_comm_class::adminshowmessage('文章分类编辑成功！','index.php?do=art_cat&type='.$type);
		}
	}
}

$temp_arr = array();
Func_comm_class::get_tree($art_cat_arr,$temp_arr,'option',$art_cat_pid,'art_cat_id','art_cat_pid','cat_name');
$cat_arr = $temp_arr;
unset($temp_arr);
//var_dump($cat_arr);


/*function dafenglei_select($m,$id,$index){	
	global $art_cat_arr;
	$n = str_pad('',$m,'-',STR_PAD_RIGHT);
	$n = str_replace("-","&nbsp;&nbsp;",$n);
	for($i=0;$i<count($art_cat_arr);$i++){
	
		if($art_cat_arr[$i]['art_cat_pid']==$id){
			if($art_cat_arr[$i]['art_cat_id']==$index){
				echo "        <option value=\"".$art_cat_arr[$i]['art_cat_id']."\" selected=\"selected\">".$n."|----".$art_cat_arr[$i]['cat_name']."</option>\n";
			}else{
				echo "        <option value=\"".$art_cat_arr[$i]['art_cat_id']."\">".$n."|--".$art_cat_arr[$i]['cat_name']."</option>\n";
			}
			dafenglei_select($m+1,$art_cat_arr[$i]['art_cat_id'],$index);
		}
	}
}*/

require_once $template_obj->template('control/admin/tpl/admin_'.$do);