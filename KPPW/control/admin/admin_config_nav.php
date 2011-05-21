<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(79);

$nav_list = Cache_ext_Class::gettabledata("witkey_nav","","listorder",null,"nav_id");
$nav_obj = new Keke_witkey_nav_class();


if ( $submit) {
	$res = 0;
	if ($ruleitem['del'])
	{
		$nav_obj->setWhere("nav_id in ({$ruleitem['del']})");
		
		$res+=$nav_obj->del_keke_witkey_nav();
	}

	if ($ruleitem['new'])
	foreach ($ruleitem['new'] as $value){
		if ($value['nav_title']&&$value['nav_url']){
			$nav_obj->_nav_id=NULL;
			$nav_obj->setNav_title($value['nav_title']);
			$nav_obj->setNav_url($value["nav_url"]);
			$nav_obj->setNav_style($value["nav_style"]);
			$nav_obj->setIshide($value["ishide"]?$value["ishide"]:0);
			$nav_obj->setNewwindow($value["newwindow"]?1:0);
			$value["listorder"]?$nav_obj->setListorder($value["listorder"]):"";
			
			
			$res += $nav_obj->create_keke_witkey_nav();
		}
	}
	
	if ($ruleitem['old'])
	foreach ($ruleitem['old'] as $key=>$value){
			$nav_obj->_nav_id=NULL;
			$nav_obj->setWhere("nav_id = {$key}");
			$nav_obj->setNav_title($value['nav_title']);
			$nav_obj->setNav_url($value["nav_url"]);
			$nav_obj->setNav_style($value["nav_style"]);
			$nav_obj->setIshide($value["ishide"]?$value["ishide"]:0);
			$nav_obj->setNewwindow($value["newwindow"]?1:0);
			$value["listorder"]?$nav_obj->setListorder($value["listorder"]):"";
			
			
			$res += $nav_obj->edit_keke_witkey_nav();
		
	}
	
	$nav_list = Cache_ext_Class::gettabledata("witkey_nav","","listorder",-1,"nav_id");
	
	if ($res){
		Func_comm_class::adminshowmessage("自定义导航设置成功","index.php?do=config&view=nav");
	}
	else {
		Func_comm_class::adminshowmessage("没有任何修改","index.php?do=config&view=nav");
	}
}

require_once $template_obj->template ( 'control/admin/tpl/admin_config_' . $view );