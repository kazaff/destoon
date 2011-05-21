<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(51);
include '../../lib/helper/archive.php';



$filename = ''.$tplname.'_mod_'.time().'.zip';
$zip_obj = new zip_file('../../data/backup/'.$filename);
$zip_obj->set_options(array('recurse'=> 1,'overwrite' => 1, 'storepaths' => 1));
$zip_obj->add_files("../../tpl/".$tplname);
$zip_obj->create_archive();

d($_K['siteurl']."/data/backup/$filename");

function d($name) {
		header('Content-Type: application/force-download');
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: no-cache, must-revalidate, max-age=60");
		header("Expires: Sat, 01 Jan 2000 12:00:00 GMT");
		header('Content-Disposition: attachment;filename="'.$name."\"\n");
		
		$result = file_get_contents($name);
		
		header("Content-Length: ".strlen($result));
		print($result);
	}



