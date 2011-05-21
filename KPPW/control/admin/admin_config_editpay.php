<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}
Func_comm_class::adminCheckRole(2);

$payment_config = Cache_ext_Class::getPaymentConfig($payname);

if (!$payment_config)
{
	Func_comm_class::adminshowmessage("错误的模型目录","index.php?do=config&view=pay");
}

$items = explode(";",$payment_config['initparam']);
$temp = array();
foreach ($items as $item){
	$it = explode(":",$item);
	$temp[] = array('k'=>$it[0],'name'=>$it[1],'v'=>$payment_config[$it[0]]);
}
$items = $temp;

if (isset($submit)){
	$xml_path = S_ROOT."./payment/".$payname."/pay_config.xml";
	$xml_obj = new Xml_Oper_Class($xml_path);
	$xml_obj->setxml('pay_status',$rdo_pay_status);
	$xml_obj->setxml('descript',$txt_description);
	
	foreach ($items as $item){
		eval('$v = $config_'.$item['k'].';');	
		if ($item[v]!=$v){
			if (db_factory::query("select * from ".TABLEPRE."witkey_payment where payment='{$payment_config['pay_dir']}' and k='{$item['k']}'")){
				db_factory::updatetable(TABLEPRE."witkey_payment",array('v'=>$v),"payment='{$payment_config['pay_dir']}' and k='{$item['k']}'");
			}
			else {
				$ins_arr = array(
					'k'=>$item['k'],
					'v'=>$v,
					'name'=>$item['name'],
					'payment'=>$payment_config['pay_dir']
				);
				db_factory::inserttable(TABLEPRE."witkey_payment",$ins_arr);
			}
		}
	}
	
	Func_comm_class::adminshowmessage("编辑完成",'index.php?do=config&view=pay');
}

require_once $template_obj->template ( 'control/admin/tpl/admin_config_' . $view );