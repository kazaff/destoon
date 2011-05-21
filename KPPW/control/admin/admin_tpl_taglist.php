<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(52);
 
$tag_list = Cache_ext_Class::gettaglist();
if ($txt_tagname)
{
	$zzz[] = $tag_list[$txt_tagname];
	$tag_list = $zzz;
}


$tag_obj = new Keke_witkey_tag_class();

if ($op == 'del')
{
	$delid = $delid?$delid:Func_comm_class::adminshowmessage('错误的参数','index.php?do='.$do.'&view='.$view);
	$tag_obj->setWhere("tag_id='{$delid}'");
	$tag_obj->del_keke_witkey_tag();
	Cache::delete('tag_list_cache');
	Func_comm_class::adminSystemLog("删除了标签$delid");
	Func_comm_class::adminshowmessage('批量操作成功！','index.php?do='.$do.'&view='.$view);
}


if (isset ( $sbt_action )) {
	$keyids = $ckb;
	
	 if(is_array($keyids)){
	 	$ids = implode(',',$keyids);
	 }
	if (count ( $keyids )) {
		
		$tag_obj->setWhere(' tag_id in ('.$ids.') ');
		switch ($sbt_action) {
		
			case '批量删除' : 
				$tag_obj->del_keke_witkey_tag();
				Cache::delete('tag_list_cache');
				Func_comm_class::adminSystemLog("删除了标签$ids");
				break;
			default : 
				break;
		}
		
		
		Func_comm_class::adminshowmessage('批量操作成功！','index.php?do='.$do.'&view='.$view);

	} else {
		Func_comm_class::adminshowmessage('请选择要操作的项！','index.php?do='.$do.'&view='.$view);
	}
}


require_once $template_obj->template ( 'control/admin/tpl/admin_tpl_'.$view );