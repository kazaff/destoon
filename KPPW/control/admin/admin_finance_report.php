<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(47);

$curyear = intval(date("Y",time()));

for ($index = $curyear-5; $index <= $curyear; $index++) {
	$curyear_arr[] = $index;
}
rsort($curyear_arr);

$fina_ext_obj = new Keke_witkey_finance_ext_class();

$curdate = $slt_curyear?$slt_curyear:date('Y',time());


$cash_in_arr = db_factory::query('select  sum(site_cash) as fina_cash,  month(from_unixtime(fina_time)) as m  from '.TABLEPRE.'witkey_finance where year(from_unixtime(fina_time))='.$curdate.'  group by month(from_unixtime(fina_time))');

$cash_out_arr = db_factory::query('select  sum(fina_cash) as fina_cash,  month(from_unixtime(fina_time)) as m  from '.TABLEPRE.'witkey_finance where fina_narrate=6 and year(from_unixtime(fina_time))='.$curdate.'  group by month(from_unixtime(fina_time))');

$cash_profit_arr = db_factory::query('select  sum(site_profit) as fina_cash,  month(from_unixtime(fina_time)) as m  from '.TABLEPRE.'witkey_finance where year(from_unixtime(fina_time))='.$curdate.'  group by month(from_unixtime(fina_time))');


foreach ($cash_in_arr as $value) {
	$temp_arr1[$value['m']] = $value['fina_cash'];
}

for ($m = 1; $m <= 12; $m++) {
     if($temp_arr1[$m])
     {
     	$b[$m] = $temp_arr1[$m];
     }else
     {
     	$b[$m] = 0;
     }

}
 
$data1 = implode(',',$b);


foreach ($cash_out_arr as $value) {
	$temp_arr2[$value['m']] = $value['fina_cash'];
}

for ($m = 1; $m <= 12; $m++) {
     if($temp_arr2[$m])
     {
     	$b2[$m] = $temp_arr2[$m];
     }else
     {
     	$b2[$m] = 0;
     }

}
 
$data2 = implode(',',$b2);


foreach ($cash_profit_arr as $value) {
	$temp_arr3[$value['m']] = $value['fina_cash'];
}

for ($m = 1; $m <= 12; $m++) {
     if($temp_arr3[$m])
     {
     	$b3[$m] = $temp_arr3[$m];
     }else
     {
     	$b3[$m] = 0;
     }

}
 
$data3 = implode(',',$b3);

require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );