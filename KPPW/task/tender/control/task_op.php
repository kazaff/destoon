<?php
	
	
	if (! defined ( 'IN_KEKE' )) {
		exit ( 'Access Denied' );
	}
	
	if (! $task_id) {
		Func_comm_class::showmessage ( "参数错误",'index.php',3,'','error' );
	}
	
	if (! $uid) {
		Func_comm_class::showmessage ( "错误提示","",0,"您必须先登陆",'error' );
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
					$title = '任务交流';
					$msg_success_title = '任务留言发送成功！';
					$msg_success_content = '任务留言已成功发送';
					$msg_fail_title = '任务留言发送失败！';
					$msg_fail_content = '任务留言发送失败';
					;
					
					$user_info = Func_comm_class::getuserinfo($uid);
					$access_rule = Cache_ext_Class::getRule("taskcomment",$uid,$user_info,$model_info['model_id']);
					if ($access_rule<0){
						Func_comm_class::showmessage("消息提示","index.php?do=task&task_id=$task_id",5,"您所在的用户组不允许评论此类型的任务","error");
					}
					
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
				$comment_obj->setComment_type ( $comment_type );
				$comment_obj->setP_id(intval($p_id));
				$comment_obj->setUid ( $uid );
				$comment_obj->setUsername ( $username );
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
		

		case 'taskbid' :
			$title = '任务投标';
			if ($uid == $task_info ['uid']) {
				Func_comm_class::showmessage ( '您不能给自己投标','index.php',3,'','error' );
			}
			if ($task_info ['task_status'] != 2) {
				Func_comm_class::showmessage ( '该任务不是进行中任务','index.php',3,'','error' );
			}
			
			$user_info = Func_comm_class::getuserinfo($uid);
			$access_rule = Cache_ext_Class::getRule("taskbid",$uid,$user_info,$model_info['model_id']);
			if ($access_rule<0){
				Func_comm_class::showmessage("消息提示","index.php?do=task&task_id=$task_id",5,"您所在的用户组无法报名此类型的任务","error");
			}
			elseif($access_rule>0){
				$count = db_factory::query("select count(*) count from ".TABLEPRE."witkey_bid a inner join ".TABLEPRE."witkey_task b on a.task_id = b.task_id where a.uid=$uid and a.bid_time <".(time()-24*3600)." and b.model_id={$model_info['model_id']}");
				$count = $count[0]['count'];
				if ($count>=$access_rule){
					Func_comm_class::showmessage("消息提示","index.php?do=task&task_id=$task_id",5,"您所在的用户组每天只允许投标{$access_rule}个{$model_list[$model_id]['model_name']}类型的任务","error");
				}
			}
			
			if (isset ( $sbt_bid )) {
				$bid_obj = new Keke_witkey_bid_class ( ); 
				

				$bid_obj->setTask_id ( intval ( $obj_id ) );
				$bid_obj->setUid ( $uid );
				$bid_obj->setUsername ( $username );
				$bid_obj->setCycle ( intval($txt_day) );
				$bid_obj->setQuote ( intval($txt_cash) );
				$bid_obj->setArea ( $birthprovince.' '.$birthcity );
				$bid_obj->setBid_status ( 0 );
				$bid_obj->setMessage ( $tar_content );
				$bid_obj->setBid_time ( time () );
				
				$res = $bid_obj->create_keke_witkey_bid ();
				
				db_factory::execute ( 'update ' . TABLEPRE . 'witkey_task set sign_num=sign_num+1 where task_id =  ' . intval ( $obj_id ) );
				Func_comm_class::update_score_value($uid,'task_bid',2);
				if ($res) {
					Func_comm_class::feed_add ( '<a target="_blank" href="index.php?do=space&member_id=' . $uid . '">' . $username . '</a>参与了任务<a href="index.php?do=task&task_id=' . $task_info ['task_id'] . '&view=work">' . $task_info ['task_title'] . '</a>的投标', $uid, $username, 'pub_work' );
					Func_comm_class::notify_user ( '任务投标通知', '您的任务<a href="index.php?do=task&task_id=' . $task_info ['task_id'] . '&view=work">' . $task_info ['task_title'] . '</a>有新的投标', $task_info ['uid'], $task_info ['username'] );
					Func_comm_class::showmessage ( '投标成功！', 'index.php?do=task&task_id=' . $obj_id, 2, '恭喜您，投标提交成功' );
				} else {
					Func_comm_class::showmessage ( '投标失败！', 'index.php?do=task&task_id=' . $obj_id, 2, '对不起，投标提交失败', 'error' );
				}
			}
			
			require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template']."/bid" );
			
			break;
		case 'workreply' :
			break;
	
	}