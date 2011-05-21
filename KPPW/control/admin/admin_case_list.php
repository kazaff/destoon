<?php


if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}



$case_obj=new Keke_witkey_case_class();

$page_obj=new Pages_Class();



$count=$case_obj->count_keke_witkey_case();


$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;

$url ='index.php?do='.$do.'&view='.$view.'.slt_page_size='.$slt_page_size;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);

$where = " where 1=1";
if(isset($sbt_search)){
	if($txt_id){
		$where .= " and a.case_id = $txt_id";
	}
	if($txt_title)
	{
		$where .= " and  concat(a.case_desc,b.task_title) like '%$txt_title%'  ";
	}
	if($txt_auther)
	{
		$where.=" and a.case_auther=$txt_auther";
	}
}
$sql = "select *,ifnull(case_title,task_title) task_title from ".TABLEPRE."witkey_case as a left join ".TABLEPRE."witkey_task as b on a.obj_id = b.task_id ";
$sql .= $where.$pages['where'] ;

$case_arr = db_factory::query($sql);
 


if($action=='del'){
	if($case_id){
		$case_obj->setWhere('case_id='.$case_id);
		$res = $case_obj->del_keke_witkey_case();
		Func_comm_class::adminshowmessage('删除成功！','index.php?do=case&view=list');
	}else{
		Func_comm_class::adminshowmessage('删除失败！','index.php?do=case&view=list');
	}
}

if(isset($sbt_action))
{
	$o_p = $rdo;
	$keyids = $ckb;
	if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	}
	     
	if (count ( $keyids )) 
	{
			
	$case_obj->setWhere('case_id in ('.$ids.')');
	$res=$case_obj->del_keke_witkey_case();
	    if($res)
	    {
		     Func_comm_class::adminshowmessage('批量删除成功！','index.php?do=case&view=list');
		
	    }
	    else 
	    {
		     Func_comm_class::adminshowmessage('批量删除失败！','index.php?do=case&view=list');
		
	    }
	}
}
require_once $template_obj->template('control/admin/tpl/admin_'.$do.'_'.$view);