<?php
	
	if (! defined ( 'IN_KEKE' )) {
		exit ( 'Access Denied' );
	}
	
	if (! $task_id) {
		Func_comm_class::showmessage ( "参数错误" ,"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error');
	}
	
	if (! $uid) {
		Func_comm_class::showmessage ( "错误提示","index.php?do=task&task_id=$task_id&view=work#t_work_list",0,"您必须先登陆",'error' );
	}
	$reward_config = Cache_ext_Class::getConfig ( 'xs_task' );
	
	$task_obj = new Keke_witkey_task_class ( );

	
	$ops = array ('sign' );
	
	switch ($op) {
		case 'sign' :
			break;
		case 'workcomment' :
			switch ($comment_type) {
				case 1 :
					
					$user_info = Func_comm_class::getuserinfo($uid);
					$access_rule = Cache_ext_Class::getRule("taskcomment",$uid,$user_info,$model_info['model_id']);
					if ($access_rule<0){
						Func_comm_class::showmessage("消息提示","index.php?do=task&task_id=$task_id",5,"您所在的用户组不允许评论此类型的任务","error");
					}
					
					
					
					$title = '任务交流';
					$msg_success_title = '任务留言发送成功！';
					$msg_success_content = '任务留言已成功发送';
					$msg_fail_title = '任务留言发送失败！';
					$msg_fail_content = '任务留言发送失败';
					;
					break;
				case 2 :
					$title = '任务举报';
					$comment_content = "对编号为{$task_info['task_id']}的任务进行举报:"; 
					$msg_success_title = '任务举报发送成功！';
					$msg_success_content = '任务举报已成功发送';
					$msg_fail_title = '任务举报发送失败！';
					$msg_fail_content = '任务举报发送失败';
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
				case 4 :
					$title = '稿件举报';
					$comment_content = "对编号为{$work_id}的稿件进行举报:";
					$msg_success_title = '稿件举报发送成功！';
					$msg_success_content = '稿件举报已成功发送';
					$msg_fail_title = '稿件举报发送失败！';
					$msg_fail_content = '稿件举报发送失败';
					;
					break;
				case 5 :
					$title = '客服留言';
					$msg_success_title = '客服留言发送成功！';
					$msg_success_content = '客服留言已成功发送';
					$msg_fail_title = '客服留言发送失败！';
					$msg_fail_content = '客服留言发送失败';
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
		
		case 'worknotice' :
			if ($task_info ['task_status'] != 2) {
				Func_comm_class::showmessage ( '该任务不是进行中任务',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			if ($task_info ['model_id'] != 1) {
				Func_comm_class::showmessage ( '该任务不是悬赏任务',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			if ($task_info ['uid'] != $uid) {
				Func_comm_class::showmessage ( '您没有权限',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			if ($task_info ['task_mode'] != 1) {
				Func_comm_class::showmessage ( '该任务不是单人中标模式',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			$work_obj = new Keke_witkey_work_class ( );
			$work_obj->setWhere ( "work_id = '{$work_id}'" );
			$work_arr = $work_obj->query_keke_witkey_work ();
			$work_info = $work_arr [0];
			if (! $work_info) {
				Func_comm_class::showmessage ( '该稿件不存在',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			if ($work_info ['work_status'] == 4) {
				Func_comm_class::showmessage ( '稿件状态错误',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			$work_obj->setWork_status ( 5 );
			$work_obj->setWhere ( "work_id = '{$work_id}'" );
			if ($work_obj->edit_keke_witkey_work ()) {
				
				db_factory::execute("update ".TABLEPRE."witkey_space set nominate_num = nominate_num+1 where uid={$work_info ['uid']} ");
				
				Func_comm_class::notify_user ( '稿件入围通知', '您的稿件<a href="index.php?do=task&task_id=' . $work_info ['task_id'] . '&view=work&worktype=my&ord=#t_work_list">' . $work_info ['work_id'] . '</a>获得入围', $work_info ['uid'], $work_info ['username'] );
				Func_comm_class::showmessage ( '稿件入围成功',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			} else {
				Func_comm_class::showmessage ( '稿件提名错误',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
		
		case 'tasksign' :
			if ($ac == 'tasksign') {
				$sign_obj = new Keke_witkey_sign_class ( );
				$user_info = Func_comm_class::getuserinfo($uid);
				$access_rule = Cache_ext_Class::getRule("tasksign",$uid,$user_info,$model_info['model_id']);
				if ($access_rule<0){
					Func_comm_class::showmessage("消息提示","index.php?do=task&task_id=$task_id",5,"您所在的用户组无法报名此类型的任务","error");
				}
				elseif($access_rule>0){
					$count = db_factory::query("select count(*) count from ".TABLEPRE."witkey_sign a inner join ".TABLEPRE."witkey_task b on a.task_id = b.task_id where a.uid=$uid and a.bid_time <".(time()-24*3600)." and b.model_id={$model_info['model_id']}");
					$count = $count[0]['count'];
					if ($count>=$access_rule){
						Func_comm_class::showmessage("消息提示","index.php?do=task&task_id=$task_id",5,"您所在的用户组每天只允许报名{$access_rule}个{$model_list[$model_id]['model_name']}类型的任务","error");
					}
				}

				$sign_obj->setWhere ( ' task_id =' . $obj_id . ' and uid = ' . $uid );
				$sign_count = $sign_obj->count_keke_witkey_sign ();
				
				if ($sign_count) {
					Func_comm_class::showmessage ( '报名失败！', 'index.php?do=task&task_id=' . $obj_id, 2, '您已经报过名，请勿重发操作', 'error' );
				}
				
				$sign_obj->setTask_id ( intval ( $obj_id ) );
				$sign_obj->setUid ( $uid );
				$sign_obj->setUsername ( $username );
				$sign_obj->setBid_time ( time () );
				$sign_obj->setBid_status ( 0 );
				$res = $sign_obj->create_keke_witkey_sign ();
				
				db_factory::execute ( 'update ' . TABLEPRE . 'witkey_task set sign_num=sign_num+1 where task_id =  ' . intval ( $obj_id ) );
				Func_comm_class::notify_user ( '任务报名通知', '您的任务<a href="index.php?do=task&task_id=' . $task_info ['task_id'] . '&view=work">' . $task_info ['task_title'] . '</a>有新的报名', $task_info ['uid'], $task_info ['username'] );
				
				if ($res) {
					Func_comm_class::showmessage ( '报名成功！', 'index.php?do=task&task_id=' . $obj_id, 2, '恭喜您，报名成功' );
				} else {
					Func_comm_class::showmessage ( '报名失败！', 'index.php?do=task&task_id=' . $obj_id, 2, '对不起，报名失败', 'error' );
				}
			}
			
			break;
		
		case 'workwrong' :
			if ($task_info ['task_status'] != 2) {
				Func_comm_class::showmessage ( '该任务不是进行中任务',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			if ($task_info ['model_id'] != 1) {
				Func_comm_class::showmessage ( '该任务不是悬赏任务',"index.php?do=task&task_id=$task_id&view=work#t_work_list" ,3,'','error');
			}
			if ($task_info ['uid'] != $uid) {
				Func_comm_class::showmessage ( '您没有权限',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			if ($task_info ['task_mode'] != 3) {
				Func_comm_class::showmessage ( '该任务不是计件模式',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			$work_obj = new Keke_witkey_work_class ( );
			$work_obj->setWhere ( "work_id = '{$work_id}'" );
			$work_arr = $work_obj->query_keke_witkey_work ();
			$work_info = $work_arr [0];
			if (! $work_info) {
				Func_comm_class::showmessage ( '该稿件不存在',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			if ($work_info ['work_status']) {
				Func_comm_class::showmessage ( '稿件状态错误',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			$work_obj->setWork_status ( 7 );
			$work_obj->setWhere ( "work_id = '{$work_id}'" );
			if ($work_obj->edit_keke_witkey_work ()) {
				Func_comm_class::notify_user ( '稿件未采纳', '您的稿件<a href="index.php?do=task&task_id=' . $work_info ['task_id'] . '&view=work&worktype=my&ord=#t_work_list">' . $work_info ['work_id'] . '</a>未被雇主采纳', $work_info ['uid'], $work_info ['username'] );
				Func_comm_class::showmessage ( '稿件已设为未采纳',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			} else {
				Func_comm_class::showmessage ( '稿件设置失败',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			
			break;
		case 'workaccept' :
			if ($task_info ['task_status'] != 2) {
				Func_comm_class::showmessage ( '该任务不是进行中任务',"index.php?do=task&task_id=$task_id&view=work#t_work_list" ,3,'','error');
			}
			if ($task_info ['uid'] != $uid) {
				Func_comm_class::showmessage ( '您没有权限',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			$work_obj = new Keke_witkey_work_class ( );
			$work_obj->setWhere ( "work_id = '{$work_id}'" );
			$work_arr = $work_obj->query_keke_witkey_work ();
			$work_info = $work_arr [0];
			if (! $work_info) {
				Func_comm_class::showmessage ( '该稿件不存在',"index.php?do=task&task_id=$task_id&view=work#t_work_list" ,3,'','error');
			}
			if ($work_info ['work_status'] == 4) {
				Func_comm_class::showmessage ( '稿件状态错误',"index.php?do=task&task_id=$task_id&view=work#t_work_list" ,3,'','error');
			}
			$xs_task_config = Cache_ext_Class::getConfig ( 'xs_task' );
			if ($task_info ['task_mode'] == 1) {
				
				$task_obj->setWhere ( "task_id = '{$task_id}'" );
				$task_obj->setTask_status ( 3 );
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
				
				db_factory::execute("update ".TABLEPRE."witkey_space set accepted_num = accepted_num+1 where uid= {$work_info ['uid']}");
				Func_comm_class::showmessage ( "任务选稿成功","index.php?do=task&task_id=$task_id&view=work#t_work_list");
			} else if ($task_info ['task_mode'] == 3) {
				$temp = db_factory::query ( "select count(*) as count from " . TABLEPRE . "witkey_work where task_id = '$task_id' and work_status=6" );
				$workcount = $temp ? $temp [0] ['count'] : 0;
				if ($workcount >= $task_info ['work_count']) {
					Func_comm_class::showmessage ( "稿件数量已达到上限","index.php?do=task&task_id=$task_id&view=work#t_work_list" );
				}
				
				$work_obj->setWork_status ( 6 );
				$work_obj->setWhere ( "work_id = '{$work_id}'" );
				$work_obj->edit_keke_witkey_work ();
				if ($workcount + 1 == $task_info ['work_count']) {
					
					$task_obj->setWhere ( "task_id = '{$task_id}'" );
					$task_obj->setTask_status ( 3 );
					$task_obj->setSp_end_time ( time ( 'now()' ) + $xs_task_config ['show_limit_time'] * 24 * 3600 );
					$task_obj->edit_keke_witkey_task ();
				}
				
				db_factory::execute("update ".TABLEPRE."witkey_space set accepted_num = accepted_num+1 where uid={$work_info ['uid']} ");
				
				Func_comm_class::feed_add ( '<a target="_blank" href="index.php?do=space&member_id=' . $work_info ['uid'] . '">' . $work_info ['username'] . '</a>成功中标了任务<a href="index.php?do=task&task_id=' . $task_info ['task_id'] . '">' . $task_info ['task_title'] . '</a>', $work_info ['uid'], $work_info ['username'], 'work_accept' );
				Func_comm_class::notify_user ( '中标通知', '您的稿件<a href="index.php?do=task&task_id=' . $work_info ['task_id'] . '&view=work&worktype=my&ord=#t_work_list">' . $work_info ['work_id'] . '</a>已经被任务发者采纳，点击任务查看详细信息', $work_info ['uid'], $work_info ['username'] );
				Func_comm_class::showmessage ( "您选择的稿件已经设置成合格稿件!" ,"index.php?do=task&task_id=$task_id&view=work#t_work_list");
			} else if ($task_info ['task_mode'] == 2) {
				if (! in_array ( $prize_id, array (1, 2, 3 ) )) {
					Func_comm_class::showmessage ( "错误的参数",'',3,'','error' );
				}
				
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
				
				if ($prize_arr [$prize_id] ['prize_count'] <= $wc_arr [$prize_id] ['count']) {
					Func_comm_class::showmessage ( "该奖项数量已达到上限" ,"index.php?do=task&task_id=$task_id&view=work#t_work_list");
				}
				
				$work_obj->setWork_status ( $prize_id );
				$work_obj->setWhere ( "work_id = '{$work_id}'" );
				$work_obj->edit_keke_witkey_work ();
				$p_en [$prize_id] -= 1;
				
				if ($p_en [1] < 1 && $p_en [2] < 1 && $p_en [3] < 1) {
					
					$task_obj->setWhere ( "task_id = '{$task_id}'" );
					$task_obj->setTask_status ( 3 );
					$task_obj->setSp_end_time ( time() + $xs_task_config ['show_limit_time'] * 24 * 3600 );
					$task_obj->edit_keke_witkey_task ();
				}
				
				db_factory::execute("update ".TABLEPRE."witkey_space set accepted_num = accepted_num+1 where uid={$work_info ['uid']} ");
				Func_comm_class::update_score_value( $uid,'work_accept',2);
				Func_comm_class::feed_add ( '<a target="_blank" href="index.php?do=space&member_id=' . $work_info ['uid'] . '">' . $work_info ['username'] . '</a>得到了多人任务中的'.$prize_id.'等奖,任务名称<a href="index.php?do=task&task_id=' . $task_info ['task_id'] . '">' . $task_info ['task_title'] . '</a>', $work_info ['uid'], $work_info ['username'], 'work_accept' );
				Func_comm_class::notify_user ( '中标通知', '您的稿件<a href="index.php?do=task&task_id=' . $work_info ['task_id'] . '&view=work&worktype=my&ord=#t_work_list">' . $work_info ['work_id'] . '</a>获得了任务发布者的'.$prize_id.'等奖，请点击任务查看详细信息', $work_info ['uid'], $work_info ['username'] );
				
				Func_comm_class::showmessage ( "搞件成功设置为{$prize_id}等奖" ,"index.php?do=task&task_id=$task_id&view=work#t_work_list");
			}
			break;
		case "tasksetvote" :
			
			$work_obj = new Keke_witkey_work_class ( );
			if ($uid == $task_info ['uid'] && $task_info ['task_status'] == 2 && $reward_config ['vote_limit_time']) {
				$work_obj->setWhere ( "task_id = '$task_id' and work_status=5" );
				if ($work_obj->count_keke_witkey_work () >= 2) {
					$button_arr ['set_vote'] = 1;
				}
			}
			if ($uid != $task_info ['uid']) {
				Func_comm_class::showmessage ( '您没有权限','index.php',3,'','error' );
			}
			if ($task_info ['task_status'] != 2) {
				Func_comm_class::showmessage ( '该任务不是进行中任务','index.php',3,'','error' );
			}
			if ($task_info ['model_id'] != 1) {
				Func_comm_class::showmessage ( '该任务不是悬赏任务','index.php',3,'','error' );
			}
			if (! $xs_task_config) {
				$xs_task_config = Cache_ext_Class::getConfig ( 'xs_task' );
			}
			if (! $xs_task_config ['vote_limit_time']) {
				Func_comm_class::showmessage ( '投票功能未开启','index.php',3,'','error' );
			}
			$work_obj = new Keke_witkey_work_class ( );
			$work_obj->setWhere ( "task_id = '$task_id' and work_status=5" );
			if ($work_obj->count_keke_witkey_work () < 2) {
				Func_comm_class::showmessage ( '入围稿件不足2个,无法投票',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			
			$task_obj->setWhere ( "task_id='$task_id'" );
			$task_obj->setTask_status ( 4 );
			$task_obj->setSp_end_time ( time ( 'now' ) + $xs_task_config ['vote_limit_time'] * 24 * 3600 );
			$task_obj->edit_keke_witkey_task ();
			Func_comm_class::showmessage ( '发起投票成功',"index.php?do=task&task_id=$task_id&view=work#t_work_list" );
			break;
		case "workvote" :
			
			$user_info = Func_comm_class::getuserinfo($uid);
			$access_rule = Cache_ext_Class::getRule("taskvote",$uid,$user_info,$model_id);
			if ($access_rule<0){
				Func_comm_class::showmessage("消息提示","index.php?do=release",5,"您所在的用户组不允许参与投票此类型的任务","error");
			}
			
			
			if ($task_info ['task_status'] != 4) {
				Func_comm_class::showmessage ( '该任务不是投票中任务','index.php',3,'','error' );
			}
			$xs_task_config = Cache_ext_Class::getConfig ( 'xs_task' );
			$user_info = Func_comm_class::getuserinfo ( $uid );
			if ((time ( 'now()' ) - $user_info ['reg_time']) < ($xs_task_config ['reg_vote_limit_time'] * 3600)) {
				Func_comm_class::showmessage ( "新注册用户" . $xs_task_config ['reg_vote_limit_time'] . "小时内无法投票","index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			{
				$vote_obj = new Keke_witkey_vote_class ( );
				$vote_obj->setWhere ( "task_id = '{$task_id}' and work_id = '{$work_id}' and (uid='$uid' or vote_ip='" . Func_comm_class::getIP () . "')" );
				$vote_info = $vote_obj->query_keke_witkey_vote ();
				if ($vote_info) {
					Func_comm_class::showmessage ( "您或者您的IP已经投过票,不允许重复投票","index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
				}
			}
			if (! $work_id) {
				Func_comm_class::showmessage ( "您没有选择投票人","index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			$work_obj = new Keke_witkey_work_class ( );
			$work_obj->setWhere ( "work_id = '{$work_id}'" );
			$work_info = $work_obj->query_keke_witkey_work ();
			$work_info = $work_info [0];
			if ($work_info ['task_id'] != $task_id) {
				Func_comm_class::showmessage ( "该稿件不属于该任务","index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error');
			}
			if ($work_info ['work_status'] != "5") {
				Func_comm_class::showmessage ( "该稿件不在投票范围","index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			
			$vote_obj->setUid ( $uid );
			$vote_obj->setUsername ( $username );
			$vote_obj->setTask_id ( $task_id );
			$vote_obj->setVote_ip ( Func_comm_class::getIP () );
			$vote_obj->setVote_time ( time ( 'now()' ) );
			$vote_obj->setWork_id ( $work_id );
			if ($vote_obj->create_keke_witkey_vote ()) {
				$work_obj->setWhere ( "work_id = '{$work_id}'" );
				$work_obj->setVote_num ( $work_info ['vote_num'] + 1 );
				$work_obj->edit_keke_witkey_work ();
				Func_comm_class::update_score_value($uid,'task_apply',3);
				Func_comm_class::showmessage ( "投票成功" ,"index.php?do=task&task_id=$task_id&view=work#t_work_list");
			} else {
				Func_comm_class::showmessage ( "投票失败" ,"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error');
			}
			break;
		
		case "taskdelay" :
			$title = '加价延期';
			
			
			
			
			$user_info = Func_comm_class::getuserinfo ( $uid );
			$basic_config = Cache_ext_Class::getConfig ( 'basic' );
			
			if ($task_info ['task_status'] != 2) {
				Func_comm_class::showmessage ( '该任务不是进行中任务','index.php',3,'','error');
			}
			if ($task_info ['model_id'] != 1) {
				Func_comm_class::showmessage ( '该任务不是悬赏任务','index.php',3,'','error');
			}
			$xs_task_config = Cache_ext_Class::getConfig ( 'xs_task' );
			if (! $xs_task_config ['adjourn_day']) {
				Func_comm_class::showmessage ( '加价功能未开放','index.php',3,'','error');
			}
			if ($task_info ['uid'] != $uid) {
				Func_comm_class::showmessage ( '您没有权限进行此操作','index.php',3,'','error' );
			}
			$defer_rule_arr = Cache_ext_Class::gettabledata("witkey_defer_rule","model_id = '{$model_info['model_id']}'","defer_times",0,"defer_rule_id");
			$delay_obj = new Keke_witkey_task_delay_class ( );
			$delay_obj->setWhere ( "task_id='{$task_id}' and delay_status>0" );
			$delaycount = $delay_obj->count_keke_witkey_task_delay ();
			if ($delaycount >= count ( $defer_rule_arr )) {
				Func_comm_class::showmessage ( '加价次数已达到上限','index.php',3,'','error' );
			}
			$delaycount += 1;
			$temp = array ();
			foreach ( $defer_rule_arr as $xzx ) {
				$temp [$xzx ['defer_times']] = $xzx;
			}
			$defer_rule_arr = $temp;
			
			$min_cash = $defer_rule_arr [$delaycount] ['defer_cash_scale'] * $task_info [task_cash] / 100;
			$min_cash = $min_cash > intval ( $min_cash ) ? intval ( $min_cash + 1 ) : $min_cash;
			
			if ($is_submit) {
				if ($slt_day > $xs_task_config ['adjourn_day']) {
					Func_comm_class::showmessage ( "天数过长",'index.php',3,'','error' );
				}
				
				$costcash = $txt_delay_cash;
				if ($costcash < $min_cash) {
					Func_comm_class::showmessage ( "加价价格太低",'index.php',3,'','error' );
				}
				
				$mycredit = $user_info ['credit'];
				$mycash = $user_info ['balance'];
				if ($basic_config ['credit_is_allow'] != 1) {
					$mycredit = 0;
				}
				
				if ($costcash > $mycredit + $mycash) {
					$delay_obj->setDelay_cash ( $costcash );
					$delay_obj->setOn_time ( time ( 'now()' ) );
					$delay_obj->setDelay_status ( 0 );
					$delay_obj->setUid ( $uid );
					$delay_obj->setDelay_day ( $slt_day );
					$delay_obj->setTask_id ( $task_id );
					$obj_id = $delay_obj->create_keke_witkey_task_delay ();
					$onlinepaycash = $costcash - $mycredit - $mycash;
					Func_comm_class::showmessage ( "请选择支付途径", "index.php?do=user&view=cash&type=delay&obj_id=" . $obj_id . "&cash=" . $onlinepaycash );
				} else {
					
					$delay_obj->setDelay_cash ( $costcash );
					$delay_obj->setOn_time ( time ( 'now()' ) );
					$delay_obj->setDelay_status ( 1 );
					$delay_obj->setUid ( $uid );
					$delay_obj->setDelay_day ( $slt_day );
					$delay_obj->setTask_id ( $task_id );
					$obj_id = $delay_obj->create_keke_witkey_task_delay ();
					
					$fina_obj = new Keke_witkey_finance_class ( );
					$fina_obj->setFina_time ( time ( 'now()' ) );
					$fina_obj->setFina_type ( 1 );
					$fina_obj->setFina_narrate ( 10 );
					$fina_obj->setUid ( $uid );
					$fina_obj->setUsername ( $username );
					$fina_obj->setTask_id ( $task_id );
					if ($basic_config [credit_is_allow] == 1) {
						if ($user_info ['credit'] < $costcash) {
							$costcredit = $user_info ['credit'];
						} else {
							$costcredit = $costcash;
						}
						$task_obj->setTask_cash ( $task_info ['task_cash'] + $costcash );
						
						$costcash = ($costcash - $costcredit);
						db_factory::execute ( "update " . TABLEPRE . "witkey_space set credit=credit-'{$costcredit}' where uid='$uid'" );
						$fina_obj->setFina_credit ( $costcredit );
						$fina_obj->setUser_credit ( $user_info ['credit'] - $costcredit );
						$task_obj->setCredit_cost ( $task_info ['credit_cost'] + $costcredit );
					}
					
					if ($costcash > 0) {
						db_factory::execute ( "update " . TABLEPRE . "witkey_space set balance=balance-'{$costcash}' where uid='$uid'" );
						$fina_obj->setFina_cash ( $costcash );
						$fina_obj->setUser_balance ( $user_info ['balance'] - $costcash );
						$task_obj->setCash_cost ( $task_info ['cash_cost'] + $costcash );
					}
					
					
					$cost_profit = $txt_delay_cash * $xs_task_config['deduct_scale']/100;
					$fina_obj->setSite_profit($cost_profit);
					
					$fina_obj->create_keke_witkey_finance ();
					$task_obj->setEnd_time ( $task_info ['end_time'] + $slt_day * 24 * 3600 );
					$task_obj->setWhere ( "task_id = '{$task_id}'" );
					$task_obj->setCredit_cost ( $task_info ['credit_cost'] + $costcredit );
					$task_obj->setCash_cost ( $task_info ['cash_cost'] + $costcash );
					$task_obj->setTask_cash ( $task_info ['task_cash'] + $txt_delay_cash );
					if ($task_info ['task_mode'] == 2) {
						$prize_obj = new Keke_witkey_task_prize_class ( );
						$prize_obj->setWhere ( "task_id='{$task_info['task_id']}'" );
						$prizecount = $prize_obj->count_keke_witkey_task_prize ();
						db_factory::execute ( "update " . TABLEPRE . "witkey_task_prize set prize_cash = prize_cash+" . ($txt_delay_cash / $prizecount) );
					} elseif ($task_info ['task_mode'] == 3) {
						$task_obj->setSingle_cash ( $task_info ['single_price'] + $txt_delay_cash / $task_info ['work_count'] );
					}
					
					Func_comm_class::feed_add ( '<a target="_blank" href="index.php?do=space&member_id=' . $uid . '">' . $username . '</a>延长了任务<a href="index.php?do=task&task_id=' . $task_info ['task_id'] . '&view=work">' . $task_info ['task_title'] . '</a>并提高了佣金', $task_info ['uid'], $task_info ['username'], 'work_delay' );
					$task_obj->edit_keke_witkey_task ();
					Func_comm_class::showmessage ( "延期成功","index.php?do=task&task_id=$task_id&view=work#t_work_list" );
				
				}
			
			}
			
			$day_arr = array ();
			for($i = 1; $i <= $xs_task_config ['adjourn_day']; $i ++) {
				$day_arr [$i] = $i;
			}
			
			require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template']."/delay" );
			
			break;
		
		case 'taskwork' :
			$title = '悬赏任务交稿';
			
			if ($uid == $task_info ['uid']) {
				Func_comm_class::showmessage ( '您不能给自己交稿',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			if ($task_info ['task_status'] != 2) {
				Func_comm_class::showmessage ( '该任务不是进行中任务',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
			}
			$user_arr = Func_comm_class::getuserinfo ( $uid );
			
			
			$user_info = $user_arr;
			$access_rule = Cache_ext_Class::getRule("taskwork",$uid,$user_info,$model_info['model_id']);
			if ($access_rule<0){
				Func_comm_class::showmessage("消息提示","index.php?do=task&task_id=$task_id",5,"您所在的用户组不允许投递此类型的任务","error");
			}
			elseif($access_rule>0){
				$count = db_factory::query("select count(*) count from ".TABLEPRE."witkey_work a left inner join ".TABLEPRE."witkey_task b on a.task_id=b.task_id where a.uid=$uid and work_time <".(time()-24*3600)." and b.model_id={$model_info['model_id']}");
				$count = $count[0]['count'];
				if ($count>=$access_rule){
					Func_comm_class::showmessage("消息提示","index.php?do=task&task_id=$task_id",5,"您所在的用户组每天只允许投递{$access_rule}个{$model_list[$model_id]['model_name']}类型的任务","error");
				}
			}
			
			extract ( $user_arr );
			if (isset ( $sbt_work )) {
				if (!$tar_content){
					Func_comm_class::showmessage ( '稿件内容不能为空',"index.php?do=task&task_id=$task_id&view=work#t_work_list",3,'','error' );
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
	
		
		case 'workreply' :
			break;
		case 'hidework' :
			$work_obj = new Keke_witkey_work_class();
			$userinfo = Func_comm_class::getuserinfo($uid);
			
			$user_info = Func_comm_class::getuserinfo($uid);
			$access_rule = Cache_ext_Class::getRule("workhide",$uid,$user_info,$model_info['model_id']);
			if ($access_rule<0){
				Func_comm_class::showmessage("消息提示","index.php?do=release",5,"您所在的用户组不允许隐藏悬赏任务稿件","error");
			}
			
			$work_obj->setWhere("uid='$uid' and task_id='$task_id'");
			$work_obj->setHide_work(1);
			$res = $work_obj->edit_keke_witkey_work();
			if ($res){
			Func_comm_class::showmessage ( '稿件隐藏成功！', 'index.php?do=task&task_id=' . $task_id.'&view=work', 2, '恭喜您，稿件隐藏成功' );
			}
			else {
				Func_comm_class::showmessage ( '没有需要隐藏的稿件！', 'index.php?do=task&task_id=' . $task_id.'&view=work', 2, '您没有稿件或稿件已隐藏' );
			}
			break;
	
	}