<?php

define("IN_KEKE",TRUE);
require 'app_comm.php';

$ops = array('time','tag','payment');
$op = in_array($op,$ops)?$op:"time";



if ($op == 'time')
{
	$last_respons = Cache::write(time(),'time_traveler_last_exec_cache',5*3600);
	
	if (!$last_respons){
		$time_factory = new Time_fac_class();
		$time_factory->run();
	}
}

if($op == 'tag'){
	$html_str = Cache::get('tag_html_data_'.$tag_id);
	$html_str = $html_str?$html_str:Loaddata_Class::gettagHTML($tag_id);
	$html_str = str_replace("'","\'",trim($html_str));
	$html_str = str_replace("\r\n","",$html_str);
	$html_str = str_replace("\n","",$html_str);
	$tag_html_data = Cache::get('tag_html_data_'.$tag_info['tag_id']);
	echo("document.write('".$html_str."');");
	
}

if ($op=='payment'){
	if ($pay_op){
		$payment_config = Cache_ext_Class::getPaymentConfig($pay_m);
		if (!$payment_config){
			Func_comm_class::showmessage("支付配置错误，支付无法完成，请联系管理员。",'index.php',3,'','error');
		}
		
		if (file_exists(S_ROOT."./payment/{$payment_config['pay_dir']}/$pay_op.php")){
			require S_ROOT."./payment/{$payment_config['pay_dir']}/$pay_op.php";
		}
	}
}

