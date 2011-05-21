<?php


 
$tpl_mode = 1;



require '../../app_comm.php';
define('ADMIN_KEKE',TRUE);
 
define('ADMIN_ROOT',S_ROOT.'./control/admin/');

$_K['admin_tpl_path']= S_ROOT.'./control/admin/tpl/';

if ($do == 'edittpl')
{
	if(!$_SESSION['uid']){
		Func_comm_class::adminshowmessage('您必须先登陆','index.php?do=login');
	}
	
	if (get_magic_quotes_gpc()){
		$code_content = stripslashes($code_content);
	}
	
	$admin_info = Func_comm_class::getuserinfo($_SESSION['uid']);
	Func_comm_class::adminCheckRole(51);
	
	
	$tname = $tname?$tname:Func_comm_class::adminshowmessage("未指定模板文件","index.php?do=tpl&view=tpllist&tplname=$tplname");
	if ($tname == "请输入模板名.htm")Func_comm_class::adminshowmessage("未指定模板文件","index.php?do=tpl&view=tpllist&tplname=$tplname");
	
	$filename = S_ROOT.'./tpl/'.$tplname.'/'.$tname;
	if ( !is_writable($filename) ){
		Func_comm_class::adminshowmessage("文件:" .$filename. "不可写，请检查！","index.php?do=tpl&view=tpllist&tplname=$tplname");
	}
	Template_Class::swritefile($filename,htmlspecialchars_decode($code_content));
	Func_comm_class::adminSystemLog('编辑模板'.$tplname.'/'.$tname);
	Func_comm_class::adminshowmessage("模板编辑成功","index.php?do=tpl&view=tpllist&tplname=$tplname");
}
if ($do == 'deltpl'){
	if(!$_SESSION['uid']){
		Func_comm_class::adminshowmessage('您必须先登陆','index.php?do=login');
	}
	
	$admin_info = Func_comm_class::getuserinfo($_SESSION['uid']);
	Func_comm_class::adminCheckRole(51);
	
	$filename = S_ROOT.'./tpl/'.$tplname.'/'.$tname;
	if (!is_file($filename)){
		Func_comm_class::adminshowmessage("该文件不存在','index.php?do=tpl&view=tpllist&tplname=$tplname");
	}
	else {
		unlink($filename);
		Func_comm_class::adminshowmessage('操作成功',"index.php?do=tpl&view=tpllist&tplname=$tplname");
	}	
}
if ($do == 'edittagtpl')
{
	if(!$_SESSION['uid']){
		Func_comm_class::adminshowmessage('您必须先登陆','index.php?do=login');
	}
	
	$admin_info = Func_comm_class::getuserinfo($_SESSION['uid']);
	Func_comm_class::adminCheckRole(52);
	
	if (get_magic_quotes_gpc()){
		$code_content = stripslashes($code_content);
	}
	
	$tplname = $tplname?$tplname:Func_comm_class::adminshowmessage("未指定模板文件","index.php?do=tpl&view=edit_tagtpl&tplname=$tplname");
	$filename = S_ROOT.'./control/admin/tpl/template_tag_'.$tplname.'.htm';
	$fp=fopen("$filename", "w+"); 
	fwrite($fp,$code_content);
	if ( !is_writable($filename) ){
		Func_comm_class::adminshowmessage("文件:" .$filename. "不可写，请检查！","index.php?do=tpl&view=edit_tagtpl&tplname=$tplname");
	}
	fclose($fp);
	Func_comm_class::adminSystemLog('编辑标签模板'.$tplname);
	Func_comm_class::adminshowmessage("模板编辑成功","index.php?do=tpl&view=edit_tagtpl&tplname=$tplname");
}
if ($do == 'previewtag')
{
	$tagid = intval($tagid);
	if (!$tagid){
		die();
	}
	$taglist = Cache_ext_Class::gettaglist(1);
	$tag_info = $taglist[$tagid];
	
	Loaddata_Class::previewtag($tag_info);
}

