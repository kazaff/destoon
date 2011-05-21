<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(52);
 

$filename = S_ROOT.'./control/admin/tpl/template_tag_'.$tplname.'.htm';
$code_content = "";

if (file_exists($filename)) {
	$fp=fopen($filename,"r"); 
	while (!feof($fp)) {   
		$code_content  .= fgets($fp);   
	}

	fclose($fp);
}





require_once $template_obj->template ( 'control/admin/tpl/admin_tpl_'.$view );