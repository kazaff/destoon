<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(36);

$file_obj = new File_Class();
$backup_patch = S_ROOT.'./data/tpl_c/';



if(isset($sbt_edit)){
	

	if($ckb_obj_cache){
		$res = $file_obj->delete_files(S_ROOT."./data/data_cache/");
		$msg = '对象缓存清空！';
	}
	
	if($ckb_tpl_cache){
		$res = $file_obj->delete_files($backup_patch);
		$msg.= '  模板缓存清空！';
	}
	Func_comm_class::adminSystemLog("清空缓存");
	Func_comm_class::adminshowmessage($msg,'index.php?do='.$do.'&view='.$view);
	
}

require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );