<?php
	
	if (! defined ( 'IN_KEKE' )) {
		exit ( 'Access Denied' );
	}
	
	if (! $task_id) {
		Func_comm_class::showmessage ( "参数错误" ,"index.php?do=task&task_id=$task_id&view=work#t_work_list");
	}
	
	if (! $uid) {
		Func_comm_class::showmessage ( "错误提示","index.php?do=task&task_id=$task_id&view=work#t_work_list",0,"您必须先登陆" );
	}
	
	$model_id= $model_id?$model_id:6;
	$file_path = S_ROOT."./task/".$model_list[$model_id]['model_code']."/control/admin/task_config.xml";
	$reward_config = Xml_Oper_Class::get_xml_toarr($file_path);
	
	$task_obj = new Keke_witkey_task_class ( );
    $work_obj = new Keke_witkey_work_class ( );
	
	$ops = array ('sign' );
	
	switch ($op) {
		case 'workcomment' :
			switch ($comment_type) {
				
				
				case 5 :
					$title = '客服留言';
					$msg_success_title = '客服留言发送成功！';
					$msg_success_content = '客服留言已成功发送';
					$msg_fail_title = '客服留言发送失败！';
					$msg_fail_content = '客服留言发送失败';
					;
					break;
				case 3 :
					$title = '稿件留言';
					$msg_success_title = '稿件留言发送成功！';
					$msg_success_content = '稿件留言已成功发送';
					$msg_fail_title = '稿件留言发送失败！';
					$msg_fail_content = '稿件留言发送失败';
					;
					break;
				default :
					;
					break;
			}
			
			if (isset ( $sbt_comment )) {
				if (!trim(Func_comm_class::str_filter ( $tar_content))){
					Func_comm_class::showmessage("操作失败", 'index.php?do=task&task_id=' . $task_id, 2, "您必须输入留言内容", 'error' );
				}
				$comment_obj = new Keke_witkey_comment_class ( ); 
				$space_obj = new Keke_witkey_space_class ( ); 
				$task_obj = new Keke_witkey_task_class ( ); 
				
				$space_obj->setWhere ( 'uid=' . intval ( $hdn_to_uid ) );
				$space_info = $space_obj->query_keke_witkey_space ();
				
				$task_obj->setWhere ( ' task_id = ' . $task_id );
				$task_info = $task_obj->query_keke_witkey_task ();
				$obj_id = $obj_id?$obj_id:$task_id;
				$comment_obj->setStatus ( 0 );
				$comment_obj->setObj_id ( intval ( $obj_id ) );
				$comment_obj->setP_id(intval($p_id));
				$comment_obj->setComment_type ( $comment_type );
				$comment_obj->setUid ( $uid );
				$comment_obj->setUsername ( $username );
				$tar_content = Func_comm_class::str_filter($tar_content);
				$comment_obj->setContent ( Func_comm_class::str_filter ( $tar_content ) );
				$comment_obj->setOn_time ( time () );
				$res = $comment_obj->create_keke_witkey_comment ();
				Func_comm_class::update_score_value($uid,'task_comment',3);
				if ($res) {
					Func_comm_class::showmessage ( $msg_success_title, 'index.php?do=task&task_id=' . $task_id, 2, $msg_success_content );
				} else {
					Func_comm_class::showmessage ( $msg_fail_title, 'index.php?do=task&task_id=' . $task_id, 2, $msg_fail_content, 'error' );
				}
			}
			
			require_once $template_obj->template ( 'comment' );
			
			break;
		case 'accept_task' :
			
			if ($task_info ['task_status'] != 2) {
				Func_comm_class::showmessage ( '任务状态错误',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			}
			if ($uid != $task_info ['prom_count']) {
				Func_comm_class::showmessage ( '只有雇主的威客能承接该任务',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			}
			$task_obj = new Keke_witkey_task_class();
			$task_obj->setWhere("task_id = '$task_id'");
			$task_obj->setTask_status(3);
			$task_obj->edit_keke_witkey_task();
			
			$euserinfo = Func_comm_class::getuserinfo($task_info['uid']);
			Func_comm_class::notify_user("雇佣被接受",'<a target="_blank" href="index.php?do=space&member_id='.$uid.'">'.$username.'</a>接受了你的雇佣任务<a target="_blank" href="index.php?do=task&task_id='.$task_id.'">'.$task_info['task_title'].'</a>',$task_info['uid'],$euserinfo['username']);
			if ($euserinfo['email']){
				Func_comm_class::sendMail($euserinfo['email'],"雇佣任务被接受 - {$basic_config['website_name']}",'<a target="_blank" href="index.php?do=space&member_id='.$uid.'">'.$username.'</a>雇佣你完成任务<a target="_blank" href="index.php?do=task&task_id='.$task_id.'">'.$task_info['task_title'].'</a>');
			}
			Func_comm_class::showmessage ( "任务接受成功","index.php?do=task&task_id=$task_id&view=work");
			break;
		case 'refuse_task' :
			
			if ($task_info ['task_status'] != 2) {
				Func_comm_class::showmessage ( '任务状态错误',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			}
			if ($uid != $task_info ['prom_count']) {
				Func_comm_class::showmessage ( '只有雇主指定的威客才能拒绝承接该任务',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			}
			$task_obj = new Keke_witkey_task_class();
			$task_obj->setWhere("task_id = '$task_id'");
			$task_obj->setTask_status(5);
			$task_obj->edit_keke_witkey_task();
			
			$euserinfo = Func_comm_class::getuserinfo($task_info['uid']);
			$fina_obj = new Keke_witkey_finance_class();
			if ($task_info['cash_cost']){
				db_factory::execute("update ".TABLEPRE."witkey_space set balance = balance+{$task_info['cash_cost']} where uid = {$task_info['uid']}");
				$fina_obj->setUser_balance($euserinfo['balance']+$task_info['cash_cost']);
				$fina_obj->setFina_cash($task_info['cash_cost']);
			}
			if ($task_info['credit_cost']){
				db_factory::execute("update ".TABLEPRE."witkey_space set credit = credit+{$task_info['credit_cost']} where uid = {$task_info['uid']}");
				$fina_obj->setUser_credit($euserinfo['credit']+$task_info['credit_cost']);
				$fina_obj->setFina_credit($task_info['credit_cost']);
			}
			$fina_obj->setFina_type(2);
			$fina_obj->setFina_narrate(8);
			$fina_obj->setFina_time(time());
			$fina_obj->setTask_id($task_id);
			$fina_obj->setUid($task_info['uid']);
			$fina_obj->setUsername($task_info['username']);
			$fina_obj->create_keke_witkey_finance();
			
			
			Func_comm_class::notify_user("雇佣被拒绝",'<a target="_blank" href="index.php?do=space&member_id='.$uid.'">'.$username.'</a>拒绝了你的雇佣任务<a target="_blank" href="index.php?do=task&task_id='.$task_id.'">'.$task_info['task_title'].'</a>,任务款返还.',$task_info['uid'],$euserinfo['username']);
			if ($euserinfo['email']){
				Func_comm_class::sendMail($euserinfo['email'],"雇佣任务被拒绝 - {$basic_config['website_name']}",'<a target="_blank" href="index.php?do=space&member_id='.$uid.'">'.$username.'</a>拒绝了你的雇佣任务<a target="_blank" href="index.php?do=task&task_id='.$task_id.'">'.$task_info['task_title'].'</a>');
			}
			Func_comm_class::showmessage ( "任务拒绝成功","index.php?do=task&task_id=$task_id&view=work");
			break;
		case 'cancer_task':
			
			if ($task_info ['task_status'] != 2&&$task_info ['task_status'] != 3) {
				Func_comm_class::showmessage ( '任务状态错误',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			}
			if ($uid != $task_info ['uid']) {
				Func_comm_class::showmessage ( '只有雇主才能取消该任务',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			}
			
			$work_obj->setWhere ( 'task_id=' . intval ( $task_id ) );
			$work_count = $work_obj->count_keke_witkey_work ();
			$work_count = intval ( $work_count );
			if ($work_info) {
				Func_comm_class::showmessage ('未收到任何投稿才允许取消任务',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			}
			
			$task_obj = new Keke_witkey_task_class();
			$task_obj->setWhere("task_id = '$task_id'");
			$task_obj->setTask_status(5);
			$task_obj->edit_keke_witkey_task();
			
			$euserinfo = Func_comm_class::getuserinfo($task_info['uid']);
			$fina_obj = new Keke_witkey_finance_class();
			if ($task_info['cash_cost']){
				db_factory::execute("update ".TABLEPRE."witkey_space set balance = balance+{$task_info['cash_cost']} where uid = {$task_info['uid']}");
				$fina_obj->setUser_balance($euserinfo['balance']+$task_info['cash_cost']);
				$fina_obj->setFina_cash($task_info['cash_cost']);
			}
			if ($task_info['credit_cost']){
				db_factory::execute("update ".TABLEPRE."witkey_space set credit = credit+{$task_info['credit_cost']} where uid = {$task_info['uid']}");
				$fina_obj->setUser_credit($euserinfo['credit']+$task_info['credit_cost']);
				$fina_obj->setFina_credit($task_info['credit_cost']);
			}
			$fina_obj->setFina_type(2);
			$fina_obj->setFina_narrate(8);
			$fina_obj->setFina_time(time());
			$fina_obj->setTask_id($task_id);
			$fina_obj->setUid($task_info['uid']);
			$fina_obj->setUsername($task_info['username']);
			$fina_obj->create_keke_witkey_finance();
			
			Func_comm_class::showmessage ( "任务取消成功","index.php?do=task&task_id=$task_id&view=work");
			break;
			
		case 'workaccept' :
			if ($task_info ['task_status'] != 3) {
				Func_comm_class::showmessage ( '该任务不是进行中任务',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			}
			if ($task_info ['uid'] != $uid) {
				Func_comm_class::showmessage ( '您没有权限',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			}
			$work_obj = new Keke_witkey_work_class ( );
			$work_obj->setWhere ( "work_id = '{$work_id}'" );
			$work_arr = $work_obj->query_keke_witkey_work ();
			$work_info = $work_arr [0];
			if (! $work_info) {
				Func_comm_class::showmessage ( '该稿件不存在',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			}
			if ($work_info ['work_status'] == 4) {
				Func_comm_class::showmessage ( '稿件状态错误',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			}
			$xs_task_config = Cache_ext_Class::getConfig ( 'xs_task' );
			
				$task_obj->setWhere ( "task_id = '{$task_id}'" );
				$task_obj->setTask_status ( 7 );
				$task_obj->setSp_end_time ( time ( 'now()' ) + $xs_task_config ['show_limit_time'] * 24 * 3600 );
				$task_obj->edit_keke_witkey_task ();
				
				$work_obj->setWork_status ( 4 );
				$work_obj->setWhere ( "work_id = '{$work_id}'" );
				$work_obj->edit_keke_witkey_work ();
				Func_comm_class::feed_add ( '<a target="_blank" href="index.php?do=space&member_id=' . $work_info ['uid'] . '">' . $work_info ['username'] . '</a>成功中标了任务<a href="index.php?do=task&task_id=' . $task_info ['task_id'] . '">' . $task_info ['task_title'] . '</a>', $work_info ['uid'], $work_info ['username'], 'work_accept' );
				
				$message_obj = new Message_Class ( );
				if ($message_obj->validate ( 'tender_isnotice' )) {
					$message_obj->setUid ( $work_info ['uid'] );
					$message_obj->setUsername ( $work_info ['username'] );
					$message_obj->setValue ( '任务编号', $task_info ['task_id'] );
					$message_obj->setValue ( '任务标题', $task_info ['task_title'] );
					$url= "<a href =\'index.php?do=task&task_id=$task_info[task_id]\' target=\'_blank\' >{$task_info['task_title']}</a>";
			        $message_obj->setValue ( '任务链接', $url );
					$message_obj->setTitle ( '任务中标' );
					$message_obj->send ();
				}
				
				$euserinfo = Func_comm_class::getuserinfo($task_info['prom_count']);
				$fina_obj = new Keke_witkey_finance_class();
				$p_cash = $task_cash['task_cash'];
				
				db_factory::execute("update ".TABLEPRE."witkey_space set balance = balance+{$p_cash} where uid = {$task_info['prom_count']}");
				$fina_obj->setUser_balance($euserinfo['balance']+$p_cash);
				$fina_obj->setFina_cash($p_cash);
				
				
				$fina_obj->setFina_type(3);
				$fina_obj->setFina_narrate(9);
				$fina_obj->setFina_time(time());
				$fina_obj->setTask_id($task_id);
				$fina_obj->setUid($task_info['prom_count']);
				$fina_obj->setUsername($euserinfo['username']);
				$fina_obj->create_keke_witkey_finance();
				 
				db_factory::execute("update ".TABLEPRE."witkey_space set accepted_num = accepted_num+1 where uid= {$work_info ['uid']}");
				Func_comm_class::showmessage ( "任务选稿成功","index.php?do=task&task_id=$task_id&view=work#t_work_list");
			
			break;
		
		case 'taskwork' :
			$title = '悬赏任务交稿';
			if ($uid == $task_info ['uid']) {
				Func_comm_class::showmessage ( '您不能给自己交稿',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			}
			if ($task_info ['task_status'] != 3) {
				Func_comm_class::showmessage ( '该任务不是进行中任务',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			}
			$user_arr = Func_comm_class::getuserinfo ( $uid );
			extract ( $user_arr );
			if (isset ( $sbt_work )) {
				if (!$tar_content){
					Func_comm_class::showmessage ( '稿件内容不能为空',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
				}
				
				$work_obj = new Keke_witkey_work_class ( ); 
				$work_obj->setTask_id ( intval ( $obj_id ) );
				$work_obj->setUid ( $uid );
				$work_obj->setUsername ( $username );
				$work_obj->setVote_num ( 0 );
				$work_obj->setWork_status ( 0 );
				$work_obj->setHide_work ( $ckb_hidework == 'on' ? 1 : 0 );
				$work_obj->setWork_desc ( $tar_content );
				$work_obj->setWork_time ( time () );
				
				$res = $work_obj->create_keke_witkey_work ();
				if ($res) {
					
					$sign_obj = new Keke_witkey_sign_class ( ); 
					$sign_obj->setWhere ( ' task_id =' . $obj_id . ' and uid = ' . $uid );
					$sign_count = $sign_obj->count_keke_witkey_sign ();
					if ($sign_count ==0) {
						$sign_obj->setTask_id ( intval ( $obj_id ) );
						$sign_obj->setUid ( $uid );
						$sign_obj->setUsername ( $username );
						$sign_obj->setBid_time ( time () );
						$sign_obj->setBid_status ( 0 );
						$rid = $sign_obj->create_keke_witkey_sign ();
						if($rid){
							db_factory::execute ( 'update ' . TABLEPRE . 'witkey_task set sign_num=sign_num+1 where task_id =  ' . intval ( $obj_id ) );
						}
					}
				
					db_factory::execute("update ".TABLEPRE."witkey_space set take_num = take_num+1 where uid = $uid" );
					
					db_factory::execute ( 'update ' . TABLEPRE . 'witkey_task set work_num=work_num+1 where task_id =  ' . intval ( $obj_id ) );
					Func_comm_class::update_score_value($uid,'task_pubwork',2);
					Func_comm_class::feed_add ( '<a target="_blank" href="index.php?do=space&member_id=' . $uid . '">' . $username . '</a>给任务<a href="index.php?do=task&task_id=' . $task_info ['task_id'] . '&view=work">' . $task_info ['task_title'] . '</a>投递了新的稿件', $uid, $username, 'pub_work' );
					Func_comm_class::notify_user ( '投稿通知', '您的任务<a href="index.php?do=task&task_id=' . $task_info ['task_id'] . '&view=work">' . $task_info ['task_title'] . '</a>有新的投稿', $task_info ['uid'], $task_info ['username'] );
					Func_comm_class::showmessage ( '交稿成功！', 'index.php?do=task&task_id=' . $obj_id.'&view=work', 2, '恭喜您，交稿成功' );
				} else {
					Func_comm_class::showmessage ( '交稿失败！', 'index.php?do=task&task_id=' . $obj_id.'&view=work', 2, '对不起，交稿失败', 'error' );
				}
			}
			
			require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template']."/work" );
			
			break;
	
		
	
	}