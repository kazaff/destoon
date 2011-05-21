<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

require_once '../../config/config_ucenter.php';

if(isset($ac)&& $ac = 'setting'){
	$config_ucenter = Template_Class::sreadfile(S_ROOT."/config/config_ucenter.php");
	
	$uc_arr = $settingnew[uc];
    foreach ($uc_arr as $k=>$v){
			$k = strtolower('uc_'.$k);
			$config_ucenter =  preg_replace("/\\\$_UC\[\'$k\'\]=*\'.*?'\;/i", "\$_UC['$k']='$v';", $config_ucenter);
	}
	Template_Class::swritefile(S_ROOT."./config/config_ucenter.php",$config_ucenter);
	
	
	Func_comm_class::adminshowmessage("参数设定成功！","index.php?do=user&type=integration",2);
}

require_once $template_obj->template('control/admin/tpl/admin_'.$do.'_'.$type);