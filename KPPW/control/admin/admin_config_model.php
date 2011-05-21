<?php

if(!defined('ADMIN_KEKE')) {
	exit('Access Denied');
}

if ($op == "open"){
	$model_obj = new Keke_witkey_model_class();
	$model_obj->setWhere("model_id = $model_id");
	$model_obj->setModel_status(1);
	$model_obj->edit_keke_witkey_model();
	Func_comm_class::adminshowmessage("操作成功","index.php?do=config&view=model");
}elseif ($op == 'close'){
	$model_obj = new Keke_witkey_model_class();
	$model_obj->setWhere("model_id = $model_id");
	$model_obj->setModel_status(0);
	$model_obj->edit_keke_witkey_model();
	Func_comm_class::adminshowmessage("操作成功","index.php?do=config&view=model");
}elseif ($op == 'add'){
	if(!is_dir(S_ROOT.'./task/'.$txt_model_name)){
		Func_comm_class::adminshowmessage("操作失败,模型目录不存在","index.php?do=config&view=model");
	}else{
		$model_config_file = S_ROOT.'./task/'.$txt_model_name.'/control/admin/task_config.xml';
		if(!file_exists($model_config_file)){
			Func_comm_class::adminshowmessage("操作失败,模型配置文件不存在","index.php?do=config&view=model");
		}else{
			$model_arr = Xml_Oper_Class::get_xml_toarr($model_config_file);
			$model_obj = new Keke_witkey_model_class();
			$model_obj->setWhere(' model_id = '.$model_arr[model_id]);
			
			$model_info = $model_obj->query_keke_witkey_model();

			if($model_info){
				Func_comm_class::adminshowmessage("操作失败,模型ID已存在","index.php?do=config&view=model");
			}else{
				$model_obj = new Keke_witkey_model_class();
				$model_obj->setModel_id($model_arr[model_id]);
				$model_obj->setModel_name($model_arr[model_name]);
				$model_obj->setModel_dir($model_arr[model_dir]);
				$model_obj->setModel_code($model_arr[model_code]);
				$model_obj->setModel_dev($model_arr[model_dev]);
				$model_obj->setModel_status($model_arr[model_status]);
				$model_obj->setModel_status($model_arr[model_status]);
				$model_obj->setOn_time(time());
				
				if (file_exists(S_ROOT."./task/".$model_arr[model_dir]."/control/admin/install_sql.php")){
					require S_ROOT."./task/".$model_arr[model_dir]."/control/admin/install_sql.php";
				}
				
				$model_obj->create_keke_witkey_model();
				Func_comm_class::adminshowmessage("操作成功,任务模型添加成功！","index.php?do=config&view=model");
			}
		}
	}
}elseif ($op == 'del'){
	$model_obj = new Keke_witkey_model_class();
	$model_obj->setModel_id($model_id);
	
	$model_info = $model_list[$model_id];
	if (file_exists(S_ROOT."./task/".$model_info[model_dir]."/control/admin/uninstall_sql.php")){
	require "../../task/".$model_info[model_dir]."/control/admin/uninstall_sql.php";
	}
	
	$model_obj->del_keke_witkey_model();
	Func_comm_class::adminshowmessage("操作成功,任务模型卸载成功！","index.php?do=config&view=model");
}elseif ($op == 'listorder'){
	$model_obj = new Keke_witkey_model_class();
	$model_obj->setWhere("model_id='$model_id'");
	$model_obj->setListorder($value?$value:0);
	$model_obj->edit_keke_witkey_model();
	die();
}


$model_list = Cache_ext_Class::gettabledata('witkey_model','','',0,'model_id');


require_once $template_obj->template('control/admin/tpl/admin_config_model');