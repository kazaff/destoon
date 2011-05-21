<?php

$task_obj = new Keke_witkey_task_class ( ); 
$zb_config = Cache_ext_Class::getConfig ( 'zb_task' );
$page_obj = new Pages_Class ( ); 



$tender_status_arr = array ('0' => '任务未付款', '1' => '任务待审核', '2' => '任务招标中', '3' => '任务进行中', '4' => '任务进行中', '7' => '任务完成','10'=>'任务审核失败' );

$tender_cash_rule = Cache_ext_Class::getConfigRule ( 'cash' );

$cash_rule_arr = $tender_cash_rule;
$user_info = Func_comm_class::getuserinfo ( $uid );
	if (isset ( $ajax ) && $ajax == 'pay') {
		$finance_obj = new Keke_witkey_finance_class ( );
		$finance_obj->setFina_type ( 1 );
		$finance_obj->setUid ( $uid );
		$finance_obj->setUsername ( $username );
		
		$task_cash = intval ( $zb_config ['zb_fees'] ) + 0;
		$user_credit = floatval ( $user_info ['credit'] ) + 0;
		$user_balance = floatval ( $user_info ['balance'] ) + 0;
		if ($user_credit + $user_balance < $task_cash)
			die ( Func_comm_class::echojson ( '非法支付', 0 ) );
		$sy_credit = $user_credit - $task_cash;
		if ($sy_credit > 0) {
			$task_obj->setCredit_cost ( $task_cash );
			db_factory::execute ( "update " . TABLEPRE . "witkey_space set credit = credit-{$task_cash} where uid ={$uid}" );
			$finance_obj->setFina_credit ( $task_cash );
			
			$u_credit_arr = db_factory::query ( "select credit from " . TABLEPRE . "witkey_space where uid =" . $uid );
			$finance_obj->setFina_narrate ( 4 );
			$finance_obj->setUser_credit ( $u_credit_arr [0] ['credit'] );
		
		} else {
			$task_obj->setCredit_cost ( $user_credit );
			$task_obj->setCash_cost ( abs ( $sy_credit ) );
			db_factory::execute ( "update " . TABLEPRE . "witkey_space set credit = credit-{$user_credit},balance = balance-" . abs ( $sy_credit ) . " where uid ={$uid}" );
			$finance_obj->setFina_cash ( abs ( $sy_credit ) );
			$finance_obj->setFina_credit ( $user_credit );
			$u_space_arr = db_factory::query ( "select credit,balance from " . TABLEPRE . "witkey_space where uid =" . $uid );
			$finance_obj->setFina_narrate ( 4 );
			$finance_obj->setUser_balance ( $u_space_arr [0] ['balance'] );
			$finance_obj->setUser_credit ( $u_space_arr [0] ['credit'] );
		}
		
		if ($zb_config ['zb_audit'] == 1) {
			$task_obj->setTask_status ( 1 );
			$s = "任务待审核";
		} else {
			$task_obj->setTask_status ( 2 );
			$s = "任务招标中";
		}
		db_factory::execute ( "update " . TABLEPRE . "witkey_space set pub_num = pub_num+1 where uid = $uid" );
		$task_obj->setStart_time ( time () );
		$task_obj->setEnd_time ( time () + 24 * 3600 * $task_day );
		$task_obj->setTask_id ( $task_id );
		
		$res = $task_obj->edit_keke_witkey_task ();
		if ($res) {
			$finance_obj->setTask_id ( $task_id );
			$finance_obj->setFina_time ( time () );
			$finance_obj->create_keke_witkey_finance ();
			Func_comm_class::echojson ( '任务付款成功！', 1, array ('status' => $s ) );
		} else {
			Func_comm_class::echojson ( '', 0 );
		}
	}
if ($uid) {
	
	$cover_arr = Cache_ext_Class::getConfigRule ( 'cash' );
	if (isset ( $ajax ) && $ajax = show_confirm) {
		$title = '招标任务付款确认信息';
		require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template']."/user_tender_confirm" );
		die ();
	}

	
	$where = " uid =" . $uid . " and model_id = {$model_id} ";
	
	if (isset ( $slt_task_status )) {
		$where .= ' and  task_status =' . intval ( $slt_task_status );
	}

	if ($txt_task_title) {
		$where .= ' and task_title like "%' . $txt_task_title . '%"';
	}
	
	$txt_start_time = strtotime ( $txt_start_time );
	$txt_end_time = strtotime ( $txt_end_time );
	
	if (intval ( $txt_start_time ) && intval ( $txt_end_time )) {
		if (intval ( $txt_start_time ) >= intval ( $txt_end_time )) {
			Func_comm_class::showmessage ( '搜索失败', 'index.php?do=' . $do . '&view=' . $view, 2, '开始时间不能大于结束时间', 'error' );
		} elseif (intval ( $txt_start_time ) == intval ( $txt_end_time )) {
			$where .= ' and start_time = ' . intval ( $txt_start_time );
		} else {
			$where .= ' and start_time >= ' . intval ( $txt_start_time ) . ' and start_time <= ' . intval ( $txt_end_time );
		}
	}
	
	if ($slt_cash_cove) {
		$where .= ' and task_cash_coverage = ' . intval ( $slt_cash_cove );
	}
	
	$page_size = intval ( $page_size ) ? intval ( $page_size ) : 17;
	
	$task_obj->setWhere ( $where );
	$count = $task_obj->count_keke_witkey_task ();
	
	$url = 'index.php?do=' . $do . '&view=' . $view . '&model_id='.$model_id.'&page_size=' . $page_size . '&slt_task_status=' . $slt_task_status . '&txt_task_title=' . $txt_task_title . '&txt_start_time=' . $txt_start_time . '&txt_end_time=' . $txt_end_time . '&slt_cash_cove=' . $slt_cash_cove . '&slt_order=' . $slt_order;
	$page = $_GET ['page'] ? $_GET ['page'] : 1;
	$limit = $page_size;
	$pages = $page_obj->getPages ( $count, $limit, $page, $url );
	
	$order_where = ' order by start_time desc ';
	
	$where .= $order_where;
	
	$task_obj->setWhere ( $where . $pages [where] );
	$task_arr = $task_obj->query_keke_witkey_task ();
	
	for($i = 0; $i < count ( $task_arr ); $i ++) {
		$task_arr [$i] [remaining_time] = Func_comm_class::time2Units ( $task_arr [$i] [end_time] );
	}

} else {
	Func_comm_class::showmessage ( '您还没有登录，无法进行此操作！', 'index.php',3,'','error' );
}

require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template']."/user_release_task" );

