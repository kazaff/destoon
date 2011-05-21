<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}



Func_comm_class::check_login('index.php?do=release');

$zb_config = Cache_ext_Class::getConfig ( 'zb_task' );

$user_info = Func_comm_class::getuserinfo($uid);
$access_rule = Cache_ext_Class::getRule("taskpub",$uid,$user_info,$model_id);
if ($access_rule<0){
	Func_comm_class::showmessage("消息提示","index.php?do=release",5,"您所在的用户组不允许发布此类型的任务","error");
}
elseif($access_rule>0){
	$count = db_factory::query("select count(*) count from ".TABLEPRE."witkey_task where uid=$uid and model_id = $model_id and start_time <".time()-24*3600);
	$count = $count[0]['count'];
	if ($count>=$access_rule){
		Func_comm_class::showmessage("消息提示","index.php?do=release",5,"您所在的用户组每天只允许发布{$access_rule}个{$model_list[$model_id]['model_name']}","error");
	}
}

if ($zb_config [is_open_zb] != 1) {
	die ( Func_comm_class::showmessage ( '操作无效,招标模式已关闭，请联系管理员！' ) );
}

$task_obj = new Keke_witkey_task_class ( );



$indus_obj = new Keke_witkey_industry_class ( ); 

$basic_config = Cache_ext_Class::getConfig ( 'basic' );

$zb_cash_cove = Cache_ext_Class::getConfigRule ( 'cash' );
$upload_size = Func_comm_class::formatBytes ( UPLOAD_MAXSIZE );

$indus_obj->setWhere ( ' indus_pid = 0 and indus_type=1 order by listorder asc ' );
$indus_p_arr = $indus_obj->query_keke_witkey_industry ();

$finance_obj = new Keke_witkey_finance_class ( );

$finance_obj->setFina_type ( 1 );
$finance_obj->setUid ( $uid );
$finance_obj->setUsername ( $username );

$user_info = Func_comm_class::getuserinfo ( $uid );

$user_info = Func_comm_class::getuserinfo($uid);
$access_rule = Cache_ext_Class::getRule("taskpub",$uid,$user_info,$model_id);
if ($access_rule<0){
	Func_comm_class::showmessage("消息提示","index.php?do=release",5,"您所在的用户不允许发布此类型的任务","error");
}
elseif($access_rule>0){
	$count = db_factory::query("select count(*) count from ".TABLEPRE."witkey_task where uid=$uid and model_id = $model_id and start_time <".time()-24*3600);
	$count = $count[0]['count'];
	if ($count>=$access_rule){
		Func_comm_class::showmessage("消息提示","index.php?do=release",5,"您所在的用户每天只允许发布{$access_rule}个{$model_list[$model_id]['model_name']}","error");
	}
}

$user_info ['credit'] = $basic_config ['credit_is_allow'] == 1 ? $user_info ['credit'] : 0;

if (isset ( $hdn_paystatus )) {
	if ($_POST[form_hash] == $_SESSION ['form_hash'])
		die ( Func_comm_class::showmessage ( '错误提示', 'index.php?do=release&model_id='.$model_id, 3, '提交无效', 'error' ) );
	$_SESSION ['form_hash'] = $_POST[form_hash];
	$task_cash = intval ( $zb_config ['zb_fees'] ) + 0;
	$user_credit = floatval ( $user_info ['credit'] ) + 0;
	$user_balance = floatval ( $user_info ['balance'] ) + 0;
	
	switch ($hdn_paystatus) {
		case 'confirm' :
			if ($user_credit + $user_balance < $task_cash)
				die ( Func_comm_class::showmessage ( '错误提示', 'index.php?do=release&model_i='.$model_id, 3, '非法支付!','error' ) );
			$sy_credit = $user_credit - $task_cash;
			if ($sy_credit > 0) {
				$task_obj->setCredit_cost($task_cash);
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
				$audit_str = ",招标进入到后台审核流程";
			} else {
				$task_obj->setTask_status ( 2 );
				$finance_obj->setSite_profit($task_cash);
			}
			db_factory::execute ( "update " . TABLEPRE . "witkey_space set pub_num = pub_num+1 where uid = $uid" );
			break;
		case 'online' :
			$task_obj->setTask_status ( 0 );
			break;
		default :
			$task_obj->setTask_status ( 0 );
			break;
	}
	$txt_task_title = Func_comm_class::str_filter($txt_task_title);
	$task_obj->setTask_title ( $txt_task_title );
	$task_obj->setModel_id( 2 );
	if ($user_info [isvip] == 1) {
		$task_obj->setIsvip ( 1 );
	}
	$task_obj->setTask_cash_coverage ( $slt_zb_cove );
	
	$task_obj->setTask_cash ( $task_cash );
	
	$task_obj->setStart_time ( time () );
	$zb_task_time = intval ( $txt_zb_days );
	$task_obj->setEnd_time ( time () + $zb_task_time * 24 * 3600 );
	$task_obj->setIndus_id ( $slt_indus_id );
	$tar_content = Func_comm_class::str_filter($tar_content);
	$task_obj->setTask_desc ( $tar_content );
	$task_obj->setUid ( $uid );
	$task_obj->setUsername ( $username );
	
	$kf_arr = Cache_ext_Class::gettabledata('witkey_space',' group_id = 7','',NULL);
	$kf_arr_count = count($kf_arr);
	$randno = rand(0,$kf_arr_count-1);
	$kf_uid = $kf_arr[$randno][uid]?$kf_arr[$randno][uid]:ADMIN_UID;
	$task_obj->setKf_uid($kf_uid);
	
	$task_obj->setCity($slt_city?"$slt_province,$slt_city":"$slt_province");
	$res = $task_obj->create_keke_witkey_task ();
	Func_comm_class::update_score_value($uid,'pub_task',2);
	

 //upload attachment save to database
   $file_obj = new Keke_witkey_file_class();
	if($hdn_att_file){
		$file_arr =  array_filter(explode(',',$hdn_att_file));
		foreach ($file_arr as $v) {
			$file_obj->setFile_id($v);
		    $file_obj->setUid($uid);
		    $file_obj->setUsername($username);
		    $file_obj->setTask_id($res);
		    $file_obj->edit_keke_witkey_file();
		}
		
	}
	
	if ($res) {
        
		db_factory::execute("update ".TABLEPRE."witkey_space set pub_num = pub_num+1 where uid=$uid ");
		switch ($hdn_paystatus) {
			case 'confirm' :
				if ($task_obj->getTask_status()==2){
					
					$message_obj = new Message_Class();
					if ($message_obj->validate('task_pub_isnotice')){
						$message_obj->setUid($uid);
						$message_obj->setUsername($username);
						$message_obj->setValue('任务编号',$res);
						$message_obj->setValue('任务标题',$txt_task_title);
						$url= "<a href =\'index.php?do=task&task_id=$res\' target=\'_blank\' >$txt_task_title</a>";
						$message_obj->setValue ( '任务链接', $url );
						$message_obj->setValue('开始时间',date('Y-m-d H:i:s',time()));
						$message_obj->setValue('结束时间',date('Y-m-d H:i:s',time()+intval($zb_task_time)*24*3600));
						$message_obj->setTitle('任务付款成功');
						$message_obj->send();
					}
					Func_comm_class::feed_add('<a href="index.php?do=space&member_id='.$uid.'" target="_blank">'.$username.'</a>发布了任务 <a target="_blank" href="index.php?do=task&task_id='.$res.'">'.$task_obj->getTask_title().'</a>',$uid,$username,'pub_task',$res);
				}
				$finance_obj->setTask_id ( $res );
				$finance_obj->setFina_time ( time () );
				$finance_obj->create_keke_witkey_finance ();
				
				Func_comm_class::showmessage ( '招标任务发布成功！'.$audit_str,'index.php?do=task_list&model_id='.$model_id );
				break;
			case 'online' :
				$pay_cash = $task_cash - ($user_balance + $user_credit);
				Func_comm_class::showmessage ( '招标任务发布提示', 'index.php?do=user&view=cash&type=task&obj_id=' . $res . '&cash=' . $pay_cash, 3, sprintf ( '您需要在线支付%10.2f元', $pay_cash ) );
				break;
			default :
				Func_comm_class::showmessage ( '任务发布提示', 'index.php?do=user', 3, '您的招标任务已经保存到未付款的任务中...' );
				break;
		
		}
	}

}

if ($ajax == 'confirm') {
	$title = "招标任务信息确认";
	require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template'].'/confirm' );
	die ();
}
else{
	if (Cache_ext_Class::gettabledata("witkey_file","file_id = '$fid' and uid = $uid")){
	    $b = Func_comm_class::del_att_file($fid);
	    if($b){
	    	 Func_comm_class::echojson(1);
	    }else {
	    	 Func_comm_class::echojson(0);
	    }
    }
}

if ($ac == 'show_indus') {
	$indus_obj->setWhere ( ' indus_pid=' . $indus_pid );
	$indus_c_arr = $indus_obj->query_keke_witkey_industry ();
	foreach ( $indus_c_arr as $row ) {
		$option .= '<option value=' . $row [indus_id] . '>' . $row [indus_name] . '</option>';
	}
	echo $option;
	die ();
}

require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template'].'/release' );

