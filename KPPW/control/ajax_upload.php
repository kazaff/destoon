<?php


if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

$ext_url = explode ( "|", UPLOAD_ALLOWEXT );
$err = '';
$file_name = $file_name?$file_name:'filedata';
$file_obj = new Keke_witkey_file_class ( );
if ($file_type != "big") {
	if ($img_width) {
	    $img_info = getimagesize($_FILES[$file_name]['tmp_name']);
	    if($img_info){
	    	$w = $img_info[0];
	    	if($img_width!= $w){
	    		$err = "上传图片宽高不符合指定要求，请调整后再上传!";
	    		if ($_K['charset']=='GBK'){
	    			$err = Func_comm_class::gbktoutf($err);
	    		}
	    		echo Func_comm_class::json_encode_k( array ('err' => $err, 'msg' => 'error' ) );
				die ();
	    	}
	    }
	}
	if ($img_height) {
	    $img_info = getimagesize($_FILES[$file_name]['tmp_name']);
	    if($img_info){
	    	$h = $img_info[1];
	    	if($img_height!=$h){
	    		$err = "上传图片宽高不符合指定要求，请调整后再上传!";
	    		if ($_K['charset']=='GBK'){
	    			$err = Func_comm_class::gbktoutf($err);
	    		}
	    		echo Func_comm_class::json_encode_k ( array ('err' => $err, 'msg' => 'error' ) );
				die ();
	    	}
	    }
	}
	
	$file_uploads = new Upload_Class ( UPLOAD_ROOT , $ext_url, UPLOAD_MAXSIZE );
	$savename = $file_uploads->run ( $file_name, 1 );
	 
	if (is_array ( $savename )) { 
		if ($type == 'admin') {
			$file_pic = '../../data/uploads/' . UPLOAD_RULE . $savename [0] [saveName];
		} else {
			$file_pic = 'data/uploads/' . UPLOAD_RULE . $savename [0] [saveName];
		}
		
		$real_file = $savename [0] [name];
		if ($type == 'link') {
			$msg = array ('url' => $file_pic . ',' . $real_file, 'localname' => $real_file, 'id' => '1' ,'up_file'=>$file_pic );
		} else if ($type = "att") {
			$msg = array ('url' => $file_pic, 'localname' => $real_file, 'id' => '1','up_file'=>$file_pic );
		} else {
			$msg = array ('url' => '!' . $file_pic, 'localname' => $real_file, 'id' => '1','up_file'=>$file_pic  );
		}
		$file_obj->setUid ( $uid );
		$file_obj->setUsername ( $username );
		$file_obj->setTask_id ( intval ( $task_id ) );
		$file_obj->setFile_name ( $real_file );
		$file_obj->setFile_save_name ( $file_pic );
		$file_obj->setOn_time ( time () );
		$res = $file_obj->create_keke_witkey_file ();
		$err = '';
	} else {
		$err = $savename;
	}
	if($_K['charset']!='UTF-8'){
			$msg = Func_comm_class::gbktoutf($msg);
	}
	echo Func_comm_class::json_encode_k ( array ('err' => $err, 'msg' => $msg,'fid'=>$res ) );
	
	die ();
} else { 
	 
	$file_uploads = new Upload_Class ( UPLOAD_ROOT , '', 50 * (1024 * 1024) );
	$savename = $file_uploads->run ( $file_name, 1 );
	
	if (is_array ( $savename )) {
		echo 'data/uploads/'.UPLOAD_RULE.$savename [0] ['saveName'];
	} else {
		echo $savename;
	}
	die ();
	
	exit ( 0 );
}


