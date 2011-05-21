<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$art_obj = new Keke_witkey_article_class();
$art_cat_obj = new Keke_witkey_article_category_class();

$upload_obj = new Upload_Class(UPLOAD_ROOT,array("gif",'jpeg','jpg','png'),UPLOAD_MAXSIZE);

$types =  array ('help', 'art','single');
$type = (! empty ( $type ) && in_array ( $type, $types )) ? $type : 'art';


if($type=='art'){
	Func_comm_class::adminCheckRole(31);
	$art_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category","art_index like '%{1}%'","",NULL,'art_cat_id');
}elseif($type=='help'){
	Func_comm_class::adminCheckRole(81);
	$art_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category","art_index like '%{100}%'","",NULL,'art_cat_id');
}elseif($type=='single'){
	Func_comm_class::adminCheckRole(98);
	$art_cat_arr = Cache_ext_Class::gettabledata("witkey_article_category","art_index like '%{200}%'","",NULL,'art_cat_id');
}


if($art_id){
	$art_obj->setWhere('art_id='.intval($art_id));
	$art_info = $art_obj->query_keke_witkey_article();
	$art_info = $art_info[0];
	
	$find = '/'.'src="data'.'/i';
	$replase = 'src="../../data';
	$art_info[content] =  preg_replace ( $find, $replase,$art_info[content] );
}




if($sbt_edit){
	$art_obj->setUid(1);
	$art_obj->setUsername($txt_username);
	$art_obj->setArt_source($txt_art_source);
	$art_obj->setArt_cat_id($slt_cat_id);
	$art_obj->setArt_title(Func_comm_class::str_filter($txt_art_title));
	$art_obj->setIs_recommend($ckb_is_recommend);
	$art_obj->setIs_delineas($ckb_is_delineas);
	$art_obj->setContent(Func_comm_class::str_filter($tar_content));
	$art_obj->setIs_show(1);
	$art_obj->setListorder($txt_listorder?$txt_listorder:0);
	$art_obj->setSeo_title(Func_comm_class::str_filter($tar_seo_title));
	$art_obj->setSeo_keyword(Func_comm_class::str_filter($tar_seo_keyword));
	$art_obj->setSeo_desc(Func_comm_class::str_filter($tar_seo_desc));
	
	$find ='src=\"../../data/';
	$replase = 'src=\"data/';
	$tar_content =  str_ireplace ( $find, $replase, $tar_content );
	
	$art_obj->setContent(Func_comm_class::str_filter($tar_content));
	$art_obj->setPub_time(time());
	if($hdn_art_id){
		$art_obj->setArt_id($hdn_art_id);
		
		$files = $upload_obj->run('fle_art_pic',1);
		if($files!='The uploaded file is Unallowable!'){
			
			$art_pic = $files[0]['saveName'];
			if($art_pic){
				$art_pic = "data/uploads/".UPLOAD_RULE.$art_pic;
			}
		}
		$art_obj->setArt_pic($art_pic?$art_pic:$hdn_art_pic);
		$res = $art_obj->edit_keke_witkey_article();
		if($res){
			Func_comm_class::adminSystemLog("编辑文章 ". Func_comm_class::str_filter($txt_art_title));
			Func_comm_class::adminshowmessage('文章编辑成功！','index.php?do=article&type='.$type);
		}
	}else{
		
		
		$files = $upload_obj->run('fle_art_pic',1);
	
		if($files!='The uploaded file is Unallowable!'){
			
			$art_pic = $files[0]['saveName'];
			if($art_pic){
				$art_pic = "data/uploads/".UPLOAD_RULE.$art_pic;
			}
		}
		
		$art_obj->setArt_pic($art_pic?$art_pic:'');
		$res = $art_obj->create_keke_witkey_article();
		Func_comm_class::adminSystemLog("添加文章". Func_comm_class::str_filter($txt_art_title));
		if($res){
			Func_comm_class::adminshowmessage('文章编辑成功！','index.php?do=article&type='.$type);
		}
	}
}



$temp_arr = array();
Func_comm_class::get_tree($art_cat_arr,$temp_arr,'option',NULL,'art_cat_id','art_cat_pid','cat_name');
$cat_arr = $temp_arr;
unset($temp_arr);

require_once $template_obj->template('control/admin/tpl/admin_'.$do);