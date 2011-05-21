<?php
/**
 * @copyright keke-teach
 * @author shang
 * @version v 1.0
 * 2010-5-28下午16:59:00
 */
if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

/*********************/

$case_obj=new Keke_witkey_case_class();

$page_obj=new Pages_Class();



$count=$case_obj->count_keke_witkey_case();


//顶级行业分类
$indus_p_arr = Cache_ext_Class::getIndustryList(1,0);
//所有行业分类
$indus_c_arr = Cache_ext_Class::getIndustryList(1);


$where =' 1 = 1 and b.task_status = 7 ';

//大分类下的子分类id
if($indus_id){
    $indus_obj->setWhere(' indus_pid='.intval($indus_id));
	$indus_new_arr = $indus_obj->query_keke_witkey_industry();
	if(is_array($indus_new_arr)){
		foreach ($indus_new_arr as $value) {
			$indus_new_str.=$value[indus_id].',';
		}
	}
	if($indus_new_str){
		$where.=' and indus_id in ('.$indus_new_str.intval($indus_id).')';
	}else{
		$where.=' and indus_id ='.intval($indus_id);
	}
}

//招标任务成交金额
$tender_cash_rule = Cache_ext_Class::getConfigRule('cash');


$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;

$url ='index.php?do='.$do.'&view='.$view.'.slt_page_size='.$slt_page_size;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit=$slt_page_size;
$pages = $page_obj->getPages($count,$limit,$page,$url);

$where = " where 1=1";
if(isset($sbt_search)){
	if($txt_id){
		$where .= " and a.case_id = $txt_id";
	}
	if($txt_title)
	{
		$where .= " and  concat(a.case_desc,b.task_title) like '%$txt_title%'  ";
	}
	if($txt_auther)
	{
		$where.=" and a.case_auther=$txt_auther";
	}
}

$sql = "select *,ifnull(case_title,task_title) task_title from ".TABLEPRE."witkey_case as a left join ".TABLEPRE."witkey_task as b on a.obj_id = b.task_id ";

$sql .= $where.$pages['where'] ;

$task_arr = db_factory::query($sql);
 


/********************/
//查询结果数组
//$sql .= $pages[where];    /*这里？*/
//$task_arr = db_factory::query($sql);

//var_dump($task_arr);
//die();

require_once  $template_obj->template ( $do );