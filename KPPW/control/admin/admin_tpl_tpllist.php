<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

$filepath = S_ROOT.'./tpl/'.$tplname;
$file_obj = new File_Class();
$tpllist = $file_obj->get_dir_file_info($filepath,false,true);


require_once $template_obj->template ( 'control/admin/tpl/admin_tpl_tpllist');

