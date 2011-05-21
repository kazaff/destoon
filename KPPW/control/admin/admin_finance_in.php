<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}
Func_comm_class::adminCheckRole(6);






$finace_obj = new Keke_witkey_finance_class (); 
$page_obj = new Pages_Class (); 
$finace_ext_obj = new Keke_witkey_finance_ext_class ();
$where = ' 1 = 1 '; 



$start_time = $start_time ? $start_time : strtotime ( '-1 month' );
$end_time = $end_time ? $end_time : time();

$where .= " and fina_time>= $start_time and fina_time<=$end_time ";

if ($slt_fina_narrate) {
	$where .= " and fina_narrate = $slt_fina_narrate";
}

if ($txt_username){
	$where .= " and username = '$txt_username'";
}




$date_format ;
	switch ($report_type) {
		case 'year' :
			$gw = " group by year(from_unixtime(fina_time))";
			$date_format = "'%Y'";
			$f_item_sql = "concat(CAST(from_unixtime(fina_time,$date_format) as CHAR), '年') as time";
			$report_name = "年报";
			break;
		case 'month' :
			$gw = " group by year(from_unixtime(fina_time)),month(from_unixtime(fina_time))";
			$date_format = "'%Y-%m'";
			$f_item_sql = "concat(CAST(from_unixtime(fina_time,$date_format) as CHAR), '月') as time";
			$report_name = "月报";
			break;
		default :
			$gw = " group by year(from_unixtime(fina_time)),month(from_unixtime(fina_time)),day(from_unixtime(fina_time))"; 
			$date_format = "'%Y-%m-%d'";
			$f_item_sql = "from_unixtime(fina_time,$date_format) as time";
			$report_name = "日报";
			break;
	}

switch ($ord) {
	
	case 3 :
		$gw1 .= ' order by count_time desc '; //时间倒序
		;
		break;
	case 4 :
		$gw1 .= ' order by count_time asc '; //时间升序
		;
		break;

}




$slt_page_size = 31;


 
$finace_ext_obj->setWhere($where . $gw);
$count = $finace_ext_obj->count_fina_report();


$url = "index.php?do= $do &view=$view&slt_page_size=$slt_page_size&report_type=$report_type&start_time=$start_time&end_time=$end_time&slt_fina_narrate=$slt_fina_narrate";
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit = $slt_page_size;
$pages = $page_obj->getPages ( $count, $limit, $page, $url );





$finace_arr = db_factory::query("select sum(site_cash) as cash,sum(site_profit)as profit,count(fina_id) as count,$f_item_sql from ".TABLEPRE."witkey_finance where ".$where.$gw.$gw1 . $pages [where]);
$temp_arr = array();
foreach ($finace_arr as $fina){
	$temp_arr[$fina['time']] = $fina;
}
$finace_arr = $temp_arr;
$temp2_arr = db_factory::query("select sum(fina_cash) ot,$f_item_sql from ".TABLEPRE."witkey_finance where fina_narrate=6 and ".$where.$gw.$gw1 . $pages [where]);
foreach ($temp2_arr as $fw){
	$finace_arr[$fw['time']]['out'] = $fw['ot'];
}


if(isset($export))
{
	$filename =date("Y-m-d",time())."excelreport.xls";
    $contents = "<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" >
           <caption height='25'> <b> ".date('Y-m-d',$start_time)  ."~".date('Y-m-d',$end_time)."财务".$report_name."表</b> </caption>
          <tr>
            <th width=\"60\" align=\"left\">ID</th>
            <th width=\"100\" >时间</th>
			<th witdh=\"\">财务记录数量</th>
			<th witdh=\"\">收入</th>
			<th witdh=\"\" >支出</th>
			<th witdh=\"\" >毛利</th>
          </tr>
          ";
    $k = 1;
    foreach($finace_arr as $key=>$value)
    {
    	$contents .= "<tr>
    	<td align=left>".($k++)."</td>
    	<td align=left>".$value[time]."</td>
    	<td align=center>".$value[count]."</td>
    	<td align=center>￥".($value[cash]?$value[cash]:"0.00")."</td>
    	<td align=center>￥".($value[out]?$value[out]:"0.00")."</td>
    	<td align=center>￥".($value[profit]?$value[profit]:"0.00")."</td>
    	</tr>";
    }
		   
		
	  $contents .= "</table>";    

    
    
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
	echo $contents;
	die();
	
}

require_once $template_obj->template ( 'control/admin/tpl/admin_' . $do . '_' . $view );