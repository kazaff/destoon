<?php
/**
 * @copyright keke-teach
 * @author shang
 * @version v 1.0
 * 2010-5-19早上0:54:00
 */
if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(37);

$file_obj = new Keke_witkey_file_class();//实例化附件表对象
$page_obj = new Pages_Class();//实例化分页对象

//$file_exe_obj = new File_Class();
$backup_patch = S_ROOT.'./data/uploads/';

$where = ' 1 = 1 ';//默认查询条件

//查询条件
if(isset($sbt_search)){
	if($txt_id){//ID条件
		$where.=' and file_id = '.$txt_id;
	}
	if($txt_title){//附件名称条件
		$where.=' and file_name like '.'"%'.$txt_title.'%" ';
	}
}


//排序条件
switch ($ord) {
	case 1:
		$where.=' order by file_id desc ';//附件ID倒序
	;
	break;
	case 2:
		$where.=' order by file_id asc ';//附件ID升序
	;
	break;
	case 3:
		$where.=' order by on_time desc ';//时间倒序
	;
	break;
	case 4:
		$where.=' order by on_time asc ';//时间升序
	;
	break;
	default:
		$where.=' order by on_time desc ';//时间倒序
	break;
}


//每页显示多少条，默认10
$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	
//查询统计
$file_obj->setWhere($where);
$count = $file_obj->count_keke_witkey_file();

//分页条件
$url ='index.php?do='.$do.'&view='.$view.'&slt_page_size='.$slt_page_size.'&txt_id='.$txt_id.'&txt_title='.$txt_title;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);

//查询结果数组
$file_obj->setWhere($where.$pages[where]);
$file_arr = $file_obj->query_keke_witkey_file();


//删除附件
if($ac=='del'){
	if($file_id){
		$file_obj->setWhere('file_id='.$file_id);
		$file_info = $file_obj->query_keke_witkey_file();
		
		//edit by yuan
		foreach ($file_info as $file){
			unlink($backup_patch.$file_name);
		}
		
//		$file_name = $file_info[0][file_name];
//		$res = unlink($backup_patch.$file_name);
		
		
		$file_obj->setWhere('file_id='.$file_id);
		$res = $file_obj->del_keke_witkey_file();	
		Func_comm_class::adminSystemLog("删除附件$file_id");
		Func_comm_class::adminshowmessage('附件删除成功！','index.php?do='.$do.'&view='.$view);
	}else{
		Func_comm_class::adminshowmessage('附件不存在，删除失败！','index.php?do='.$do.'&view='.$view);
	}
}

//批量操作
if (isset ( $sbt_del )) {
	
	$keyids = $ckb;
	//var_dump($keyids);die();
	 if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	 }
if (count ( $keyids )) {
		$file_obj->setWhere(' file_id in ('.$ids.') ');
		$res = $file_obj->del_keke_witkey_file();
		if($res){
			Func_comm_class::adminSystemLog("删除附件$ids");
			Func_comm_class::adminshowmessage('批量操作成功！','index.php?do='.$do.'&view='.$view);
		}
	} else {
		Func_comm_class::adminshowmessage('请选择要操作的项！','index.php?do='.$do.'&view='.$view);
	}
}


require_once $template_obj->template ( 'control/admin/tpl/admin_'.$do.'_' . $view );