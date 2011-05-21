<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


$unit_obj = new Keke_witkey_unit_image_class ( );


if (isset ( $unit_id ) && intval ( $unit_id ) > 0) {
	
	$unit_obj->setWhere ( " unit_id = $unit_id" );
	$s = $unit_obj->query_keke_witkey_unit_image ();
	if ($s) {
		extract ( $s [0] );
	}

}



if (isset ( $submit ) && $unit_id) {
	if(!$_FILES['fle_unit_pic']['name'])
	{
		$pic_name = NULL;
	}else {
	    $pic_name = uploadimg ();	
	}
	
	$unit_obj->setUnit_id ( $unit_id );
	$unit_obj->setUnit_name ( $txt_unit_name );
	$unit_obj->setUnit_type ( $slt_unit_type );
	$unit_obj->setUnit_pic($pic_name);
	$res = $unit_obj->edit_keke_witkey_unit_image();
	if($res){
		Func_comm_class::adminshowmessage('编辑修改成功！',"index.php?do=mark_mangeico");
	}else {
		Func_comm_class::adminshowmessage("编辑修改失败","index.php?do=mark_mangeico");
	}
	

} elseif(isset($submit)) {
    $pic_name = uploadimg ();
	$unit_obj->setUnit_name($txt_unit_name);
	$unit_obj->setUnit_type($slt_unit_type);
	$unit_obj->setUnit_pic($pic_name);
	$res = $unit_obj->create_keke_witkey_unit_image();
	if($res){
		Func_comm_class::adminshowmessage('添加成功！',"index.php?do=$do");
	}else {
		Func_comm_class::adminshowmessage('添加失败！',"index.php?do=$do");
	}
}

function uploadimg() {
	$upload_obj = new Upload_Class ( UPLOAD_ROOT . "ico/", array ("gif", 'jpeg', 'jpg', 'png' ), UPLOAD_MAXSIZE );
	$files = $upload_obj->run ( 'fle_unit_pic' );
 	if ($upload_obj->errno) {
		Func_comm_class::adminshowmessage ( '上传失败!' . $upload_obj->errmsg (), "index.php?do=mark_addico" );
	} else {
		return $pic_name = "ico/".$files[0]['saveName'];
	}
	
}

require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do );