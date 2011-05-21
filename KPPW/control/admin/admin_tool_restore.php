<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}


Func_comm_class::adminCheckRole(32);

$db_factory = new db_factory();
$file_obj = new File_Class();
$backup_patch = S_ROOT.'./data/backup/';

$file_arr = $file_obj->get_dir_file_info($backup_patch);

$temp_arr = array();
foreach ($file_arr as $value) {
	if(strpos($value['name'],'zip')===false){
		$temp_arr[]= $value;
	}
}
$file_arr = $temp_arr;
switch ($ac) {
	case 'restore':
		set_time_limit(500);
		$file_sql = file_get_contents($backup_patch.$restore_name);
       	
		$sql = str_replace ( "\r\n", "\n", $file_sql );
		$ret = array ();
		$num = 0;
		foreach ( explode ( ";\n", trim ( $sql ) ) as $query ) {
			$ret [$num] = '';
			$queries = explode ( "\n", trim ( $query ) );
			foreach ( $queries as $query ) {
				$ret [$num] .= (isset ( $query [0] ) && $query [0] == '#') || (isset ( $query [1] ) && isset ( $query [1] ) && $query [0] . $query [1] == '--') ? '' : $query;
			}
			$num ++;
		}
		
		foreach ($ret as $vvv) {
			 $res = db_factory::execute($vvv);
		}
	 	if($res){
			Func_comm_class::adminSystemLog("恢复数据库操作成功");
			Func_comm_class::echojson('数据库还原成功！',1);
		}else{
			Func_comm_class::adminSystemLog("恢复数据库操作失败");
			Func_comm_class::echojson('数据库还原失败！',0);
		}
	
	break;
	case 'download':
		
		  header ( "Content-type: application/sql" );
		  header("Content-Disposition: attachment; filename=$file_name");
		  $c = Template_Class::sreadfile(S_ROOT."./data/backup/".$file_name);
		  $l = strlen($c);
		  header("Content-Length: $l");
		  print ($c);
		  die();
		break;
	case 'del':
		$res = unlink($backup_patch.$restore_name);
		if($res){
			Func_comm_class::adminSystemLog("删除数据库备份文件");
			Func_comm_class::adminshowmessage('数据库备份文件删除成功！','index.php?do='.$do.'&view='.$view);
		}else{
			Func_comm_class::adminshowmessage('数据库备份文件删除失败！','index.php?do='.$do.'&view='.$view);
		}
		
	;
	break;
 
}

 

require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );