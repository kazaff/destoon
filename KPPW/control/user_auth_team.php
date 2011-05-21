<?php


if(!defined('IN_KEKE')) {
	exit('Access Denied');
}
$user_info = Func_comm_class::getuserinfo($uid);

if ($is_submit){
	$space_obj = new Keke_witkey_space_class();
	

	
	if ($_FILES['file_cardpic']['name']){		
		$upload_obj = new Upload_Class(UPLOAD_ROOT,array("gif",'jpeg','jpg','png'),UPLOAD_MAXSIZE);
		$files = $upload_obj->run('file_cardpic',1);//上传文件
		if ($files=='The uploaded file exceeds the upload_max_filesize directive in php.ini.'){
			Func_comm_class::showmessage('上传失败',"index.php?do=user&view=auth_team",3,'图片过大,上传失败','error');
		}
		

		$cardpic = $files[0]['saveName'];
		if($cardpic){
			$cardpic = "data/uploads/".UPLOAD_RULE.$cardpic;
			$space_obj->setIdpic($cardpic);
		}
	}
	$space_obj->setWhere("uid='$uid'");
	$space_obj->setIdcard($txt_idcard);
	$space_obj->setAuth_name($txt_auth_name);
	$space_obj->setIs_auth(1);
	$space_obj->setAuth_time(time('now()'));
	$space_obj->edit_keke_witkey_space();
	
	Func_comm_class::showmessage("您的认证信息已提交,请耐心等待管理员审核。","index.php?do=user&view=auth_team");
}

require_once  $template_obj->template ($do."_".$view);