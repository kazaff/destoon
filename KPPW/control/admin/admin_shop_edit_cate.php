<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(19);




$indus_obj = new Keke_witkey_industry_class();



$indus_arr = Cache_ext_Class::getIndustryList(1);


if($indus_id){
	$indus_info = $indus_arr[$indus_id];
	$indus_pid = $indus_info[indus_pid];
}


if($sbt_edit){
	$indus_obj->setIndus_pid($slt_indus_id);
	$indus_obj->setIndus_type(2);
	$indus_obj->setIndus_name($txt_indus_name);
	$indus_obj->setListorder($txt_listorder?$txt_listorder:0);
	$indus_obj->setIs_recommend(intval($chk_is_recommend));
	$indus_obj->setOn_time(time());
	if($hdn_indus_id){
		$indus_obj->setIndus_id($hdn_indus_id);
		$res = $indus_obj->edit_keke_witkey_industry();
		Cache::delete('keke_witkey_industry');
		if($res){
			Func_comm_class::adminSystemLog("编辑行业$hdn_indus_id");
			Func_comm_class::adminshowmessage('行业编辑成功！','index.php?do=shop&view=cate');
		}
	}else{
		$res = $indus_obj->create_keke_witkey_industry();
		Cache::delete('keke_witkey_industry');
		if($res){
			Func_comm_class::adminSystemLog("添加行业$res");
			Func_comm_class::adminshowmessage('行业编辑成功！','index.php?do=shop&view=cate');
		}
	}
}

function dafenglei_select($m,$id,$index){	
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
			dafenglei_select($m+1,$indus['indus_id'],$index);
		}
	}
}

require_once $template_obj->template ( 'control/admin/tpl/admin_'.$do.'_' . $view );