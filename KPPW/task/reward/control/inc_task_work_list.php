<?php


if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}

if (! $reward_config)
	$reward_config = Cache_ext_Class::getConfig ( 'xs_task' );
$order = "";
$ord = $ord?$ord:"desc";
if ($reward_config ['vip_work_istop']) {
	$order = "order by b.isvip desc,a.work_time $ord";
} else  {
	$order = "order by a.work_time $ord";
}
// 票数最高
if($ordertype==1){
	
}else if ($ordertype==2){
//最新交稿
}else if ($ordertype==3){
//最先交搞

}

$where = "";
if ($worktype == 'my') {
	$where .= "and a.uid='{$_SESSION['uid']}' ";
}
if ($worktype == 'vip') {
	$where .= "and b.isvip>0 ";
}
if ($worktype == '5') {
	$where .= "and a.work_status='$worktype' ";
}
if ($worktype == '6') {
	$where .= "and a.work_status='$worktype' ";
}
if ($worktype == '7') {
	$where .= "and a.work_status='$worktype' ";
}
if ($worktype == 'all') {
	$where .= "and 1=1 ";
}
if ($workstatus) {
	$where .= "and a.work_status='$workstatus' ";
}
if ($slt_work_search == 1) {
	$where .= "and b.username='$txt_work_search' ";
} elseif ($slt_work_search == 2) {
	$where .= "and a.work_id like '%$txt_work_search%' ";
}

$count = db_factory::query ( "select count(*)as count from 
" . TABLEPRE . "witkey_work a ,
" . TABLEPRE . "witkey_space b
where a.task_id = '$task_id'
and a.uid = b.uid $where" );
$page_size = 10;
$url = 'index.php?do=task&view=' . $view . '&page_size=' . $page_size . '&task_id=' . $task_id;
$page = $_GET ['page'] ? $_GET ['page'] : 1;
$limit = $page_size;
$count = $count [0] ['count'];
$work_pages = $page_obj->getPages ( $count, $limit, $page, $url );

$limit = ($page - 1) * $limit;
$limit = "limit $limit,$page_size";

$uidsql = $uid ? "and c.by_uid='$uid'" : "";

$sql = "SELECT
 b.username,
 b.isvip,
 b.realname_auth,
 b.enterprise_auth,
 b.email_auth,
 b.bank_auth,
 b.studio_id,
 b.reg_time,
 b.accepted_num,
 b.experience_value,
 b.g_m_credit_value,
 b.w_m_credit_value,
 b.seller_good_rate,
 b.buyer_good_rate,
 b.realname_auth,
 b.enterprise_auth,
 b.email_auth,
 b.bank_auth,
 b.last_login_time,
a.*,
c.mark_status,
d.studio_id,
d.title
FROM
" . TABLEPRE . "witkey_work a left join
" . TABLEPRE . "witkey_space b on b.uid=a.uid left join
" . TABLEPRE . "witkey_mark_log c on c.obj_id=a.task_id $uidsql and c.mark_type=1 left join 
" . TABLEPRE . "witkey_studio d on b.studio_id = d.studio_id
where a.task_id = '$task_id'
$where
$order $limit";
$work_list = db_factory::query ( $sql );

$temp_arr = array ();
$work_ids = array ();
foreach ( $work_list as $w ) {
	$temp_arr [$w ['work_id']] = $w;
	$work_ids [] = $w ['work_id'];
}
$work_list = $temp_arr;



$temp = db_factory::query ( "select count(*) as count FROM " . TABLEPRE . "witkey_work a ," . TABLEPRE . "witkey_space b where a.task_id = '$task_id' and b.isvip>0 and a.uid = b.uid" );
$workcount_arr ['vip'] = $temp ? $temp [0] ['count'] : 0;
$temp = db_factory::query ( "select count(*) as count from " . TABLEPRE . "witkey_work where task_id = '$task_id' and work_status=5" );
$workcount_arr ['status5'] = $temp ? $temp [0] ['count'] : 0;
if ($task_info ['task_mode'] == 2) {
	$temp = db_factory::query ( "select count(*) as count from " . TABLEPRE . "witkey_work where task_id = '$task_id' and work_status in (1,2,3)" );
	$workcount_arr ['status4'] = $temp ? $temp [0] ['count'] : 0;
} else {
	$temp = db_factory::query ( "select count(*) as count from " . TABLEPRE . "witkey_work where task_id = '$task_id' and work_status=4" );
	$workcount_arr ['status4'] = $temp ? $temp [0] ['count'] : 0;
}
$temp = db_factory::query ( "select count(*) as count from " . TABLEPRE . "witkey_work where task_id = '$task_id' and work_status=6" );
$workcount_arr ['status6'] = $temp ? $temp [0] ['count'] : 0;
$temp = db_factory::query ( "select count(*) as count from " . TABLEPRE . "witkey_work where task_id = '$task_id' and work_status=7" );
$workcount_arr ['status7'] = $temp ? $temp [0] ['count'] : 0;

$file_obj = new Keke_witkey_file_class ( );
if ($work_ids) {
	$file_obj->setWhere ( "work_id in(" . implode ( ',', $work_ids ) . ")" );
	
	$file_arr = $file_obj->query_keke_witkey_file ();
	$temp_arr = array ();
	foreach ( $file_arr as $f ) {
		$temp_arr [$f ['work_id']] [$f ['file_id']] = $f;
	}
	$file_arr = $temp_arr;
}

$comment_obj = new Keke_witkey_comment_class ( );
if ($work_ids) {
	$comment_obj->setWhere ( "comment_type = 3 and obj_id in (" . implode ( ',', $work_ids ) . ")" );
	$workcomment_arr = $comment_obj->query_keke_witkey_comment ();
	$temp_arr = array ();
	foreach ( $workcomment_arr as $c ) {
		$temp_arr [$c ['obj_id']] [] = $c;
	}
	$workcomment_arr = $temp_arr;
}

if ($uid == $task_info ['uid'] && $task_info ['task_status'] == 2 && $task_info ['model_id'] == 1) {
	$button_arr ['work_comment'] = 1;
	if ($task_info ['task_mode'] == 1) {
		$button_arr ['work_notice'] = 1;
		$button_arr ['work_accept'] = 1;
	}
	if ($task_info ['task_mode'] == 3 && $workcount_arr ['status4'] < $task_info ['work_count']) {
		$button_arr ['work_accept'] = 1;
		$button_arr ['work_wrong'] = 1;
	}
	if ($task_info ['task_mode'] == 2) {
		$prize_obj = new Keke_witkey_task_prize_class ( );
		$prize_obj->setWhere ( "task_id = '{$task_id}'" );
		$prize_arr = $prize_obj->query_keke_witkey_task_prize ();
		$temp_arr = array ();
		$p_en = array (1 => 0, 2 => 0, 3 => 0 );
		foreach ( $prize_arr as $prize ) {
			$temp_arr [$prize ['prize']] = $prize;
			$p_en [$prize ['prize']] += $prize ['prize_count'];
		}
		$prize_arr = $temp_arr;
		$temp_arr = array ();
		$wc_arr = db_factory::query ( "select work_status,count(*) as count from " . TABLEPRE . "witkey_work where task_id = '{$task_id}' and work_status in (1,2,3) group by work_status" );
		foreach ( $wc_arr as $w ) {
			$temp_arr [$w ['work_status']] = $w;
			$p_en [$w ['work_status']] -= $w ['count'];
		}
		$wc_arr = $temp_arr;
	}
}
if ($uid && $task_info ['task_status'] == 4) {
	$vote_obj = new Keke_witkey_vote_class ( );
	$vote_obj->setWhere ( "uid ='{$uid}' and task_id='{$task_id}'" );
	$vote_info = $vote_obj->query_keke_witkey_vote ();
	if (! $vote_info) {
		$button_arr ['work_vote'] = 1;
	}
}

//点评的稿件数
$comment_works = db_factory::query("select count(*) as c from ".TABLEPRE."witkey_work where task_id = $task_id and work_status >0");
$comment_works = $comment_works[0]['c'];

//搞件点评率
$work_comment_rate = ceil($task_info['work_num']?$comment_works/$task_info['work_num']*100:0);

//点评率设置

if($work_comment_rate>=0 && $work_comment_rate <=50){
	$work_comment_desc = "<b>一般！</b>雇主不太关注任务进展";
}else if($work_comment_rate>50 && $work_comment_rate <=80){
	$work_comment_desc = "<b>中！</b>雇主比较关注任务进展";
}else{
	$work_comment_desc = "<b>好！</b>雇主非常关注任务进展";
}


