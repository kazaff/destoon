<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

Func_comm_class::adminCheckRole(54);

$fina_ext_obj = new Keke_witkey_finance_ext_class();
$withdraw_obj = new Keke_witkey_withdraw_class();



$total_year_in = db_factory::query("select sum(site_cash) as cash from ".TABLEPRE."witkey_finance where year(from_unixtime(fina_time)) = year(curdate()) group by year(from_unixtime(fina_time))");
$total_year_in = $total_year_in[0][cash]?$total_year_in[0][cash]:0;

$total_year_out = db_factory::query("select sum(fina_cash) as cash from ".TABLEPRE."witkey_finance where fina_narrate=6 and year(from_unixtime(fina_time)) = year(curdate()) group by year(from_unixtime(fina_time))");
$total_year_out = $total_year_out[0][cash]?$total_year_out[0][cash]:0;

$total_year_profit = db_factory::query("select sum(site_profit) as cash from ".TABLEPRE."witkey_finance where year(from_unixtime(fina_time)) = year(curdate()) group by year(from_unixtime(fina_time))");
$total_year_profit = $total_year_profit[0][cash]?$total_year_profit[0][cash]:0;


$total_month_in = db_factory::query("select sum(site_cash) as cash from ".TABLEPRE."witkey_finance where month(from_unixtime(fina_time)) = month(curdate()) group by year(from_unixtime(fina_time))");
$total_month_in = $total_month_in[0][cash]?$total_month_in[0][cash]:0;

$total_month_out = db_factory::query("select sum(fina_cash) as cash from ".TABLEPRE."witkey_finance where fina_narrate=6 and month(from_unixtime(fina_time)) = month(curdate()) group by month(from_unixtime(fina_time))");
$total_month_out = $total_month_out[0][cash]?$total_month_out[0][cash]:0;

$total_month_profit = db_factory::query("select sum(site_profit) as cash from ".TABLEPRE."witkey_finance where month(from_unixtime(fina_time)) = month(curdate()) group by month(from_unixtime(fina_time))");
$total_month_profit = $total_month_profit[0][cash]?$total_month_profit[0][cash]:0;



$total_day_in = db_factory::query("select sum(site_cash) as cash from ".TABLEPRE."witkey_finance where day(from_unixtime(fina_time)) = day(curdate()) group by day(from_unixtime(fina_time))");
$total_day_in = $total_day_in[0][cash]?$total_day_in[0][cash]:0;

$total_day_out = db_factory::query("select sum(fina_cash) as cash from ".TABLEPRE."witkey_finance where fina_narrate=6 and day(from_unixtime(fina_time)) = day(curdate()) group by day(from_unixtime(fina_time))");
$total_day_out = $total_day_out[0][cash]?$total_day_out[0][cash]:0;

$total_day_profit = db_factory::query("select sum(site_profit) as cash from ".TABLEPRE."witkey_finance where day(from_unixtime(fina_time)) = day(curdate()) group by day(from_unixtime(fina_time))");
$total_day_profit = $total_day_profit[0][cash]?$total_day_profit[0][cash]:0;



$withdraw_obj->setWhere('withdraw_status in(0,2)');
$withdraw_count = $withdraw_obj->count_keke_witkey_withdraw();


require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );