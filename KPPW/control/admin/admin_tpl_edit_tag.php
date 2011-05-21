<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(52);
 

$indus_arr = Cache_ext_Class::getIndustryList();
$art_cat_arr = Cache_ext_Class::getArticleCategoryList();

$tag_obj = new Keke_witkey_tag_class();
if ($tagid)
{
	$tag_obj->setWhere("tag_id='{$tagid}'");
	$taginfo = $tag_obj->query_keke_witkey_tag();
	$taginfo = $taginfo[0];
}

$tag_type_size = count($model_list)+6;


if ($submit)
{
	if (!$txt_tagname)
	{
		Func_comm_class::adminshowmessage("请输入标签名","index.php?do=tpl&view=edit_tag&tagid=$tagid");
	}
	
	
	$tag_obj2 = new Keke_witkey_tag_class();
	$tag_obj2->setWhere("tagname = '{$txt_tagname}' and tag_id!='$tagid'");
	if ($tag_obj2->query_keke_witkey_tag())
	{
		Func_comm_class::adminshowmessage("该标签名已被使用,请更换","index.php?do=tpl&view=edit_tag&tagid=$tagid");
	}
	
	if (!$txt_tplname&&$rdo_tag_type!=5)
	{
		Func_comm_class::adminshowmessage("必须填入模板","index.php?do=tpl&view=edit_tag&tagid=$tagid");
	}
	$tag_obj->setTagname($txt_tagname);
	$tag_obj->setTag_type($rdo_tag_type);
	$tag_obj->setTask_indus_id($slt_task_indus_id);
	$tag_obj->setTask_ids($txt_task_indus_ids);
	if ($rdo_task_type)
	{
		$tag_obj->setTask_type($rdo_task_type);
	}
	$tag_obj->setTask_status($slt_task_status);
	$txt_start_time1 = $txt_start_time1?Func_comm_class::sstrtotime($txt_start_time1):0;
	$tag_obj->setStart_time1($txt_start_time1);
	$txt_start_time2 = $txt_start_time2?Func_comm_class::sstrtotime($txt_start_time2):0;
	$tag_obj->setStart_time2($txt_start_time2);
	$txt_end_time1 = $txt_end_time1?Func_comm_class::sstrtotime($txt_end_time1):0;
	$tag_obj->setEnd_time1($txt_end_time1);
	$txt_end_time2 = $txt_end_time2?Func_comm_class::sstrtotime($txt_end_time2):0;
	$tag_obj->setEnd_time2($txt_end_time2);
	$txt_left_day?$tag_obj->setLeft_day($txt_left_day):'';
	$txt_left_hour?$tag_obj->setLeft_hour($txt_left_hour):'';
	$txt_task_cash1?$tag_obj->setTask_cash1($txt_task_cash1):'';
	$txt_task_cash2?$tag_obj->setTask_cash2($txt_task_cash2):'';
	$txt_prom_cash1?$tag_obj->setProm_cash1($txt_prom_cash1):'';
	$txt_prom_cash2?$tag_obj->setProm_cash2($txt_prom_cash2):'';
	$txt_cache_time?$tag_obj->setCache_time($txt_cache_time):"";
	$tag_obj->setUsername($txt_username);
	$tag_obj->setOpen_is_top($rdo_open_is_top);
	
	$tag_obj->setArt_cat_id($slt_art_cat_id);
	$tag_obj->setArt_cat_ids($txt_art_cat_ids);
	$txt_art_time1 = Func_comm_class::sstrtotime($txt_art_time1)?$txt_art_time1:0;
	$tag_obj->setArt_time1($txt_art_time1);
	$txt_art_time2 = Func_comm_class::sstrtotime($txt_art_time2)?$txt_art_time2:0;
	$tag_obj->setArt_time2($txt_art_time2);
	$tag_obj->setArt_ids($txt_art_ids);
	$tag_obj->setArt_iscommend($ckb_art_iscommend?1:0);
	$tag_obj->setArt_hasimg($ckb_art_hasimg?1:0);
	$tag_obj->setCat_type($rdo_cat_type);
	$temp = $rdo_cat_type==2?$slt_art_cat_cat_id:$slt_task_cat_cat_id;
	$tag_obj->setCat_cat_id($temp);
	$tag_obj->setCat_cat_ids($txt_cat_cat_ids);
	$tag_obj->setCat_loadsub($cat_loadsub?1:0);
	$tag_obj->setCat_onlyrecommend($cat_onlyrecommend?1:0);
	$tag_obj->setTag_sql(addslashes($tar_custom_sql));
	$tag_obj->setCode($tar_custom_code);
	
	$txt_loadcount?$tag_obj->setLoadcount($txt_loadcount):'';
	$txt_perpage?$tag_obj->setPerpage($txt_perpage):'';
	$tag_obj->setTplname($txt_tplname);
	if ($rdo_tag_type)
	{
		$tag_obj->setListorder($slt_task_order);
	}
	else 
	{
		$tag_obj->setListorder($slt_art_order);
	}
	if ($tagid)
	{
		$tag_obj->setWhere("tag_id='{$tagid}'");
		$res = $tag_obj->edit_keke_witkey_tag();
		Cache::delete("tag_list_cache");
		Func_comm_class::adminSystemLog('编辑标签'.$tagid);
	}
	else {
		$res = $tag_obj->create_keke_witkey_tag();
		Func_comm_class::adminSystemLog('创建标签'.$res);
		
	}
	
	Cache::delete('tag_list_cache');
	
	$filename = S_ROOT.'./control/admin/tpl/template_tag_'.$txt_tplname.'.htm';
	if (file_exists($filename)||$rdo_tag_type==5){
		$url = "index.php?do=tpl&view=taglist";
		Func_comm_class::adminshowmessage("操作成功",$url);
	}
	else {
		$fp=fopen("$filename", "w+"); 
		if ( !is_writable($filename) ){
		      Func_comm_class::adminshowmessage("文件:" .$filename. "不可写，请检查！");
		}
		fclose($fp);
		
		$url = "index.php?do=tpl&view=edit_tagtpl&tplname=$txt_tplname";
		Func_comm_class::adminshowmessage("操作成功,请设置模板代码",$url);
	}
	
	
}


function indusfenglei_select($m,$id,$index){	
	global $indus_arr;
	
	$n = str_pad('',$m,'-',STR_PAD_RIGHT);
	$n = str_replace("-","&nbsp;&nbsp;",$n);
	
	foreach ($indus_arr as $indus)
	{
		if($indus['indus_pid']==$id){
			if($indus['indus_id']==$index){
				echo "        <option value=\"".$indus['indus_id']."\" selected=\"selected\">".$n."|----".$indus['indus_name']."</option>\n";
			}else{
				echo "        <option value=\"".$indus['indus_id']."\">".$n."|--".$indus['indus_name']."</option>\n";
			}
			indusfenglei_select($m+1,$indus['indus_id'],$index);
		}
	}
}


function articlefenglei_select($m,$id,$index){	
	global $art_cat_arr;
	$n = str_pad('',$m,'-',STR_PAD_RIGHT);
	$n = str_replace("-","&nbsp;&nbsp;",$n);
	foreach ($art_cat_arr as $k=>$v){
		if($v['art_cat_pid']==$id){
			if($v['art_cat_id']==$index){
				echo "        <option value=\"".$v['art_cat_id']."\" selected=\"selected\">".$n."|----".$v['cat_name']."</option>\n";
			}else{
				echo "        <option value=\"".$v['art_cat_id']."\">".$n."|--".$v['cat_name']."</option>\n";
			}
			articlefenglei_select($m+1,$v['art_cat_id'],$index);
		}
	}
}


require_once $template_obj->template ( 'control/admin/tpl/admin_tpl_'.$view );
