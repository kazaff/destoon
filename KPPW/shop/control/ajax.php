<?php

require_once (dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/app_comm.php');
if($ajax=='report'){
	
	$title ="举报成功！";
	$handlekey = 'report';
	require_once $template_obj->template("ajax");
	die();
	
}