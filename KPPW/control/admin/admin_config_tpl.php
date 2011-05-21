<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(51);

$config_tpl_obj = new Keke_witkey_template_class();

$tpl_arr = $config_tpl_obj->query_keke_witkey_template();

if($sbt_edit){
	
	if ($sbt_edit == '更新'){
		$config_tpl_obj->setWhere('temp_id='.$rdo_is_selected);
		$config_tpl_obj->setIs_selected(1);
		$res = $config_tpl_obj->edit_keke_witkey_template();
		
		$config_tpl_obj = new Keke_witkey_template_class();
		$config_tpl_obj->setWhere('temp_id!='.$rdo_is_selected);
		$config_tpl_obj->setIs_selected(2);
		$res = $config_tpl_obj->edit_keke_witkey_template();
		$config_tpl_obj->setWhere( " is_selected =1 limit 1 ");
		$config_tpl_arr = $config_tpl_obj->query_keke_witkey_template();
		if($res){
			Cache::delete("keke_witkey_template");
			Cache::write($config_tpl_arr,"keke_witkey_template");
			Func_comm_class::adminshowmessage('模板配置设置成功！','index.php?do=config&view=tpl');
		}
	}
	if ($sbt_edit == '从目录安装'||$sbt_edit == 'uploadreturn'){
		if (!$txt_newtplpath){
			Func_comm_class::adminshowmessage('未输入目录','index.php?do=config&view=tpl');
		}
		
		
		if (file_exists(S_ROOT."./tpl/$txt_newtplpath/modinfo.txt"))
		{
			$file_obj = new File_Class();
			$modinfo = $file_obj->read_file(S_ROOT."./tpl/$txt_newtplpath/modinfo.txt");
			$mods = explode(';',$modinfo);
			$modinfo = array();
			foreach ($mods as $m){
				if (!$m)continue;
				$m1 = explode('=',trim($m));
				$modinfo[$m1[0]]=$m1[1];
			}
			
			$config_tpl_obj->setWhere("temp_path ='$txt_newtplpath'");
			if ($config_tpl_obj->count_keke_witkey_template())
			{
				Func_comm_class::adminshowmessage("该模板已安装过",'index.php?do=config&view=tpl');
			}
			
			$config_tpl_obj->setDevelop($modinfo['develop']);
			$config_tpl_obj->setOn_time(time());
			$config_tpl_obj->setTemp_path($txt_newtplpath);
			$config_tpl_obj->setTemp_title($modinfo['temp_title']);
			$config_tpl_obj->setTemp_desc($modinfo['temp_desc']);
			$config_tpl_obj->create_keke_witkey_template();
			Func_comm_class::adminshowmessage("模板安装成功",'index.php?do=config&view=tpl');
		}
		else {
			Func_comm_class::adminshowmessage('模板不存在或配置信息错误','index.php?do=config&view=tpl');
		}
	}
	
	if ($sbt_edit == '从本地上传'){
		$upload_obj = new Upload_Class(UPLOAD_ROOT,array("zip"),UPLOAD_MAXSIZE);
		$files = $upload_obj->run('uploadtplfile',1);//上传文件
			if($files!='The uploaded file is Unallowable!'){
				
				$mod_file = $files[0]['saveName'];
				if($mod_file){
					$mod_file = "data/uploads/".UPLOAD_RULE.$mod_file;
				}
			}
		
		$file_obj = new File_Class();
		$dirs = array();
		$fso=opendir("../../tpl");
		while($flist=readdir($fso)){
			if (is_dir("../../tpl/".$flist)){
				$dirs[$flist]=$flist;
			}
		}
		closedir($fso);
		
		include '../../lib/helper/archive.php';
		$zip_obj = new zip_file("../../".$mod_file);
		$zip_obj->set_options(array('inmemory'=>1));
		$zip_obj->extractZip("../../".$mod_file,'../../');
		unlink("../../".$mod_file);
		

		
		
		$fso=opendir("../../tpl");
		while($flist=readdir($fso)){
			if (is_dir("../../tpl/".$flist)){
				if (!$dirs[$flist]){
				$newaddfile = $flist;
				break;
				}
			}
		}
		}
		
		if(!$newaddfile){
			Func_comm_class::adminshowmessage('该模板已上传成功！,但该目录已存在，模板文件已覆盖,如有问题请重新安装','index.php?do=config&view=tpl');
		}
		else {
			Func_comm_class::adminshowmessage('该模板已上传成功,正在安装','index.php?do=config&view=tpl&sbt_edit=uploadreturn&txt_newtplpath='.$newaddfile);
		}
	
}

if($delid){
	$config_tpl_obj->setWhere('temp_id='.intval($delid));
	$res = $config_tpl_obj->del_keke_witkey_template();
	if($res){
		Cache::delete("keke_witkey_template");
		Cache::write($config_tpl_arr,"keke_witkey_template");
		Func_comm_class::adminshowmessage('模板配置卸载成功！','index.php?do=config&view=tpl');
	}
}


require_once $template_obj->template ( 'control/admin/tpl/admin_config_' . $view );