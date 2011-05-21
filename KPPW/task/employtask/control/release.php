<?php

if (! defined ( 'IN_KEKE' )) {
	exit ( 'Access Denied' );
}
Func_comm_class::check_login('index.php?do=login');

$file_path = S_ROOT."./task/".$model_list[$model_id]['model_code']."/control/admin/task_config.xml";
$xs_config = Xml_Oper_Class::get_xml_toarr($file_path);

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


$task_obj = new Keke_witkey_task_class();


if(isset($ajax)&&$ajax=='inputuid'){
	$title="信息提示";
	require_once $template_obj->template("task/".$model_info['model_dir']."/tpl/".$_K['template']."/inputuid");
}

if(isset($ajax)&&$ajax=='geteuinfo'){
	$tag= is_numeric($inputuid)?0:1;
	$user_arr = Func_comm_class::getuserinfo($inputuid,$tag);
	Func_comm_class::echojson('',count($user_arr),$user_arr);
}
 

$indus_obj = new Keke_witkey_industry_class();

$finance_obj = new Keke_witkey_finance_class();
$finance_objc = new Keke_witkey_finance_class();

$finance_obj->setFina_type(1);
$finance_obj->setUid($uid);
$finance_obj->setUsername($username);

$finance_objc->setFina_type(1);
$finance_objc->setUid($uid);
$finance_objc->setUsername($username);


$basic_config = Cache_ext_Class::getConfig('basic');

$upload_size = Func_comm_class::formatBytes(UPLOAD_MAXSIZE);

$indus_obj->setWhere(' indus_pid = 0 and indus_type=1 order by listorder asc ');
$indus_p_arr = $indus_obj->query_keke_witkey_industry();



$user_info = Func_comm_class::getuserinfo($uid);

$user_info['credit'] = $basic_config['credit_is_allow']==1?$user_info['credit']:0;
if(Func_comm_class::submitcheck ('formhash')){
	$task_cash = intval($txt_task_cash)+0;
	$prom_cash = $ckb_is_prom==1?intval($txt_prom_cash)+0:0;
	$user_credit = floatval($user_info['credit'])+0;
	$user_balance = floatval($user_info['balance'])+0;
	$_SESSION['form_hash'] = $_POST['form_hash'];
	
	switch ($hdn_paystatus) {
		case 'confirm':
		if($user_credit+$user_balance < $task_cash+$prom_cash)die(Func_comm_class::showmessage('非法提交!'));
		 
		  $sy_credit =  $user_credit-$task_cash;
		  if($sy_credit>0)
		  {
		  	$task_obj->setCredit_cost($task_cash);
		  	db_factory::execute("update " .TABLEPRE."witkey_space set credit = credit-{$task_cash} where uid ={$uid}");
		  	$finance_obj->setFina_credit($task_cash);
		  	
		  	$u_credit_arr = db_factory::query("select credit from ".TABLEPRE."witkey_space where uid =".$uid);
		  	$user_credit = $basic_config['credit_is_allow']==1?$u_credit_arr[0]['credit']:0;
		  	$finance_obj->setFina_narrate(4);
		  	$finance_obj->setUser_credit($user_credit);
		  }
		  else 
		  {
		  	$task_obj->setCredit_cost($user_credit);
		  	$task_obj->setCash_cost(abs($sy_credit)); 
		  	db_factory::execute("update " .TABLEPRE."witkey_space set credit = credit-{$user_credit},balance = balance-".abs($sy_credit)." where uid ={$uid}");
		  	$finance_obj->setFina_cash(abs($sy_credit));
		  	$finance_obj->setFina_credit($user_credit);
		  	$u_space_arr = db_factory::query("select credit,balance from ".TABLEPRE."witkey_space where uid =".$uid);
		  	$user_credit = $basic_config['credit_is_allow']==1?$u_space_arr[0]['credit']:0;
		  	$finance_obj->setFina_narrate(4);
		  	$finance_obj->setUser_balance($u_space_arr[0]['balance']);
		  	$finance_obj->setUser_credit($user_credit);
		  }
		  
		  if($ckb_is_prom==1&&$txt_prom_cash>0)
		  {
		  	 $sy_creditt = $user_credit - $prom_cash;
		  	  
			  if($sy_creditt>0)
			  {
			  	$task_obj->setProm_credit($prom_cash);
			  	db_factory::execute("update " .TABLEPRE."witkey_space set credit = credit-{$prom_cash} where uid ={$uid}");
			  	$finance_objc->setFina_credit($prom_cash);
			  	$u_credit_arr = db_factory::query("select credit from ".TABLEPRE."witkey_space where uid =".$uid);
			  	
			  	$finance_objc->setFina_narrate(5);
			  	
			  	$finance_objc->setUser_credit($u_credit_arr[0]['credit']);
			  }else 
			  {
			  	$task_obj->setProm_credit($ssy_creditt);
			  	$task_obj->setProm_cash(abs($sy_creditt));
			  	db_factory::execute("update " .TABLEPRE."witkey_space set credit = credit-".$user_credit.",balance = balance-".abs($sy_creditt)." where uid ={$uid}");
			  
			  	$finance_objc->setFina_cash(abs($sy_creditt));
			  	$finance_objc->setFina_credit($user_credit);
			  	$u_space_arr = db_factory::query("select credit,balance from ".TABLEPRE."witkey_space where uid =".$uid);
			  
			  	$finance_objc->setFina_narrate(5);
			 
			  	$finance_objc->setUser_balance($u_space_arr[0]['balance']);
			  	
			  	$finance_objc->setUser_credit($u_space_arr[0]['credit']);
			  }
		  }
         
		 if($task_cash >=$xs_config[audit_cash])
		 { 
           $task_obj->setTask_status(2);
           $finance_obj->setSite_profit($task_cash*$xs_config['deduct_scale']/100);
		 }
		 else 
		 {
		 	$task_obj->setTask_status(1);
		 	
		 	$audit_status = 1;
		 }
		break;
		case 'online':
	    $task_obj->setTask_status(0); 	
		break;
		case 'wait':
		$task_obj->setTask_status(0);
		break;
	}
	
	 $task_obj->setTask_cash($task_cash);
     
    $txt_task_title = Func_comm_class::str_filter($txt_task_title);
	$task_obj->setTask_title($txt_task_title);
	$task_obj->setModel_id($model_id);
	
	$task_obj->setTask_mode($slt_task_mode);
	
	$task_obj->setStart_time(time());
	$task_obj->setEnd_time(time()+intval($txt_task_day)*24*3600);
	$task_obj->setIndus_id($slt_indus_id);
	$tar_content = Func_comm_class::str_filter($tar_content);
	$task_obj->setTask_desc($tar_content);
	$task_obj->setUid($uid);
	$task_obj->setUsername($username);
	$task_obj->setIs_prom($ckb_is_prom==1?1:2);
	 
	$task_obj->setProm_count($euid);
	
	
	$kf_arr = Cache_ext_Class::gettabledata('witkey_space',' group_id = 7','',NULL);
	$kf_arr_count = count($kf_arr);
	$randno = rand(0,$kf_arr_count-1);
	$kf_uid = $kf_arr[$randno][uid]?$kf_arr[$randno][uid]:ADMIN_UID;
	$task_obj->setKf_uid($kf_uid);
	$res = $task_obj->create_keke_witkey_task();

//upload attachment save to database
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
	
	if($hdn_paystatus == 'confirm')
	{
		
		$finance_obj->setTask_id($res);
		$finance_obj->setFina_time(time());
		$finance_obj->create_keke_witkey_finance();
		
		if($ckb_is_prom==1){
		$finance_objc->setTask_id($res);
		$finance_objc->setFina_time(time());
		$finance_objc->create_keke_witkey_finance();
		}
		else 
		{
			unset($finance_objc);
		}
	}
	
	
	
    $mulit_mode_obj = new Keke_witkey_task_prize_class();
	if($slt_task_mode==2)
	{
	   	for($i=1;$i<=$hdn_mulit;$i++)
	   	{
	   		$mulit_mode_obj->setTask_id($res);
	   		
	   		$mulit_mode_obj->setPrize($i);
	   		
	   		$mulit_mode_obj->setPrize_count($_POST['txt_pople_'.$i]);
	   		
	   		$mulit_mode_obj->setPrize_cash($_POST['txt_avg_money_'.$i]);
	   		$mulit_mode_obj->create_keke_witkey_task_prize();
	   	}
	   	
	}
	if($res){
		
		db_factory::execute("update ".TABLEPRE."witkey_space set pub_num = pub_num+1 where uid=$uid ");
		switch ($hdn_paystatus) {
			case 'confirm':
			
				$euserinfo = Func_comm_class::getuserinfo($euid);
				Func_comm_class::notify_user("雇佣邀请",'<a target="_blank" href="index.php?do=space&member_id='.$uid.'">'.$username.'</a>雇佣你完成任务<a target="_blank" href="index.php?do=task&task_id='.$res.'">'.$txt_task_title.'</a>',$euid,$euserinfo['username']);
				if ($euserinfo['email']){
					Func_comm_class::sendMail($euserinfo['email'],"雇佣任务邀请 - {$basic_config['website_name']}",'<a target="_blank" href="index.php?do=space&member_id='.$uid.'">'.$username.'</a>雇佣你完成任务<a target="_blank" href="index.php?do=task&task_id='.$res.'">'.$txt_task_title.'</a>');
				}
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
						$message_obj->setValue('结束时间',date('Y-m-d H:i:s',time()+intval($txt_task_day)*24*3600));
						$message_obj->setTitle('任务发布成功');
						$message_obj->send();
					}
					Func_comm_class::feed_add('<a href="index.php?do=space&member_id='.$uid.'" target="_blank">'.$username.'</a>发布了任务 <a target="_blank" href="index.php?do=task&task_id='.$res.'">'.$task_obj->getTask_title().'</a>',$uid,$username,'pub_task',$res);
					Func_comm_class::update_score_value($uid,'pub_task',2);
				}
				
				if($audit_status == 1) {
					Func_comm_class::showmessage('任务发布提示','index.php?do=task_list&model_id='.$model_id,5,'您的任务付款成功，此任务已进入后台审核流程，审核通过后才可看到该任务<p>
					      <a href="index.php?do=release&model_id='.$model_id.'">继续发布任务</a>  <a href="index.php?do=task_list&model_id='.$model_id.'">返回任务大厅</a>
					      </P>');
				}else{
					
				   Func_comm_class::showmessage('任务发布提示','index.php?do=task&task_id='.$res,3,'顾佣任务发布成功！');	
				}
				
		       	
			break;
			case 'online':
			   $pay_cash = $task_cash-($user_balance+$user_credit);
			   
			   Func_comm_class::showmessage('任务发布提示','index.php?do=user&view=cash&type=task&obj_id='.$res.'&cash='.$pay_cash,2,sprintf('您需要在线支付%10.2f元',$pay_cash));
			break;
			default:
				Func_comm_class::showmessage('任务发布提示','index.php?do=user',3,'您的任务已经保存到未付款的任务中...');
			break;
		}
		
		
	}
}

$reward_day_rule = Cache_ext_Class::gettabledata("witkey_day_rule","model_id='{$model_info['model_id']}'","rule_cash",null,"day_rule_id");
$day_rul_str = "";
foreach ($reward_day_rule as $value) {
   $day_rul_str .= $value['rule_cash']."元以上，任务的最大天数为".$value['rule_day']."天<br>";
}

if(isset($ajax))
{
	$msg="";
	$status = 0;
	switch ($ajax) {
    	case "getmaxday":  
    	 if($task_cash>=$xs_config[task_min_cash]){
	    	 $max_day =	Func_comm_class::getShowDay($task_cash,$model_id);
	    	 Func_comm_class::echojson($max_day,1);
    	 }else 
    	 {
    	 	 Func_comm_class::echojson("任务最小金额不能低于".$xs_config[task_min_cash],0);
    	 }
    	 
    	die();
    	break;
    	case "confirm":
    		$title ="顾佣任务确认";
    		$service_cash = $task_cash_val*$xs_config['deduct_scale']/100;
    		require_once $template_obj->template('task/'.$model_info['model_dir'].'/tpl/'.$_K['template'].'/confirm');
    		die();
    	break;
    	case 'invite':
    		$indus_id = $indus_id?$indus_id:-1;
    		$space_obj = new Keke_witkey_space_class();
	        $space_obj->setWhere(" isvip = 1 and indus_id ={$indus_id} and username != '$username'");				
			$user_arr = $space_obj->query_keke_witkey_space();
           	$title = "推荐VIP名单";
            if(count($user_arr))
	        {
    		    require_once $template_obj->template('task/'.$model_info['model_dir'].'/tpl/'.$_K['template'].'/invite');
	        }
	        die();
	       
    	break;
    	case 'sms':
    		global $_K;
    		if($uids)
    		{ 	
    			$uid_arr = explode(',',$uids);
    			
    			
    			if($_K['charset'] == 'GBK'){
    			  $task_title = Func_comm_class::utftogbk($task_title);
    			  $usernames =  Func_comm_class::utftogbk($usernames);
    			 }
    			$username_arr = explode(',',$usernames);
    		    $sms_conent = $username.'于'.date('Y年-m月-d日',time()).'发布了顾佣任务<< <a href="index.php?do=task&task_id='.$task_id.'" target="_blank" >'.$task_title.' </a>  >> 特邀请您参与投标!'; 
 				$sql = "insert into ".TABLEPRE."witkey_message (recive_uid,recive_username,title,content,on_time) values";
    		    for ($i=0;$i<count($uid_arr);$i++)
 				{
 				  if ($i){
 				  	$sql .= ',';
 				  }
    		      $sql .= "($uid_arr[$i],'$username_arr[$i]','顾佣任务邀请通知!','$sms_conent',".time().")";
 				}
 				
 				$res = db_factory::execute($sql);
 				if($res){
 					Func_comm_class::echojson('',1);
 				}else{
 					Func_comm_class::echojson('',0);
 				}
 				
    		}
    		die();
    	break;
    	case 'del_att':
    	  if (Cache_ext_Class::gettabledata("witkey_file","file_id = '$fid' and uid = $uid")){
    	  $b = Func_comm_class::del_att_file($fid);
    	  if($b){
    	  	Func_comm_class::echojson(1);
    	  }else {
    	  	Func_comm_class::echojson(0);
    	  }
    	  }
    	break;
    }
    	
}



 

require_once $template_obj->template ( 'task/'.$model_info['model_dir'].'/tpl/'.$_K['template'].'/release' );