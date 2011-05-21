<?php

include_once 'app_comm.php';

switch ($ac) {
	case "cate_add" :
		$title = '添加自定义分类';
		break;
	case "submit_file" :
		if ($type == 2) {
		$title ="添加视频文件";
		} elseif ($type == 3) {
		$title = "添加普通文件";
		}
		$max_size = ini_get('upload_max_filesize');
		break;
}

require_once $template_obj->template ( 'ajax' );