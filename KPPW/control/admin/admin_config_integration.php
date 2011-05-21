<?php
 /**
 * @copyright keke-teach
 * @author Monkey
 * @version v 1.0
 * 2010-7-16下午06:02:31
 */



if(!defined('ADMIN_KEKE')) {
	exit('Access Denied');
}

if ($setting == 'del'){
	$config_obj = new Keke_witkey_basic_config_class();
	$config_obj->setWhere('1=1');
	$config_obj->setUser_intergration(1);
	$config_obj->edit_keke_witkey_basic_config();
	Cache::delete("keke_witkey_basic_config");
	Func_comm_class::adminshowmessage("卸载成功！","index.php?do=config&view=integration");
}

if ($type == 'uc'){
	require_once '../../config/config_ucenter.php';

	if(isset($ac)&& $ac = 'setting'){
		$config_ucenter = Template_Class::sreadfile(S_ROOT."/config/config_ucenter.php");
		$uc_arr = $settingnew[uc];
	    foreach ($uc_arr as $k=>$v){
				$k = strtolower('uc_'.$k);
				$config_ucenter =  preg_replace("/\\\$_UC\[\'$k\'\]=*\'.*?'\;/i", "\$_UC['$k']='$v';", $config_ucenter);
		}
		Template_Class::swritefile(S_ROOT."./config/config_ucenter.php",$config_ucenter);
		$config_obj = new Keke_witkey_basic_config_class();
		$config_obj->setWhere('1=1');
		$config_obj->setUser_intergration(2);
		$config_obj->edit_keke_witkey_basic_config();
		Cache::delete("keke_witkey_basic_config");
		Func_comm_class::adminshowmessage("参数设定成功！","index.php?do=config&view=integration",2);
	}
	require_once $template_obj->template ( 'control/admin/tpl/admin_config_'.$view.'_uc' );
	die();
}

require_once $template_obj->template ( 'control/admin/tpl/admin_config_'.$view );




