<?php

if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

$title = "用户登录";

if(isset($submit))
{
	$img = new Secode_class();
	 
	$a =$img->check($code);
	if($a)
	{
		echo "ok";
	}
	else
	{
		echo "false";
	}
}

if(isset($ajax))
{
	$ext_url = explode ( "|", UPLOAD_ALLOWEXT );

     $err = '';

$file_uploads = new Upload_Class ( UPLOAD_ROOT . UPLOAD_RULE, $ext_url, UPLOAD_MAXSIZE );
$savename = $file_uploads->run ( 'fle_2', 1 );
if (is_array ( $savename )) {
	$file_pic = 'data/uploads/' . UPLOAD_RULE . $savename [0] [saveName];
	$real_file = $savename [0] [name];
	
	$msg = array ('url' =>$file_pic.','.$real_file,'localname'=>$real_file,'id' => '1' );
	$err = '';
} else {
	$err = $savename;
}

echo json_encode ( array ('err' =>$err, 'msg' =>$msg ) );

die ();
	
}

if(isset($ac))
{
	 
	require_once $template_obj->template("login");
	die();
}

require_once  $template_obj->template ( $do );