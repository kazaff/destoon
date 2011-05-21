<?php

if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}



if($op == 'add'){
	Func_comm_class::adminCheckRole(23);
	$member_obj = new Keke_witkey_member_class();
	if ($is_submit)
	{
		if(!$txt_username&&!$edituid){
			Func_comm_class::adminshowmessage('用户名不能为空',"index.php?do=user&type=front");
		}
		$member_obj->setWhere("username='{$txt_username}'");
		$memberinfo_arr = $member_obj->query_keke_witkey_member();
		$memberinfo_arr = $memberinfo_arr[0];
		if ($memberinfo_arr&&$memberinfo_arr['uid']!=$edituid)
		{
			Func_comm_class::adminshowmessage('该用户名已存在',"index.php?do=user&type=front&op=add&edituid=$edituid");
		}
		
		
		$member_obj->setUsername($txt_username);
		if ($pwd_pwd){
		$member_obj->setPassword(md5($pwd_pwd));
			//邮件
			$message_obj = new Message_Class();
			if ($message_obj->validate('update_password_isnotice')){
				$message_obj->setUid($memberinfo_arr['uid']);
				$message_obj->setUsername($memberinfo_arr['username']);
				$message_obj->setValue("新密码",$pwd_pwd);
				$message_obj->setTitle('更改密码');
				$message_obj->send();
			}
		}
		$member_obj->setEmail($txt_email);
		if ($edituid){
			$member_obj->setWhere("uid='$edituid'");
			$member_obj->edit_keke_witkey_member();
			$user_uid = $edituid;
		}
		else {
			$user_uid = $member_obj->create_keke_witkey_member();
		}
		
		$memberspace_obj = new Keke_witkey_space_class();
		$memberspace_obj->setUid($user_uid);
		$memberspace_obj->setUsername($txt_username);
		if ($pwd_pwd){
		$memberspace_obj->setPassword(md5($pwd_pwd));
		}
		if (!$edituid){
		$memberspace_obj->setReg_time(time('now()'));
		}
		$memberspace_obj->setIsvip($rdo_isvip);
		$memberspace_obj->setVip_end_time(strtotime($txt_vip_end_time));
		$memberspace_obj->setExperience_value(intval($txt_experience_value));
		$memberspace_obj->setStatus($rdo_static);
		$memberspace_obj->setEmail($txt_email);
		$memberspace_obj->setPhone($txt_phone);
		$memberspace_obj->setQq($txt_qq);
		$memberspace_obj->setMsn($txt_msn);
		$memberspace_obj->setCredit(intval($txt_credit));
		$memberspace_obj->setBalance(intval($txt_balance));
		
		if ($edituid){
			/**
			 * 管理员追加的金额与钱
			 */
			$member_arr = Func_comm_class::getuserinfo($edituid);
			$add_balance = $txt_balance - $member_arr['balance'];
			$add_credit = $txt_credit - $member_arr['credit'];
			$message_str = "";
			if($add_balance>0){
				$message_str .= "系统管理员{$admin_info['username']}给您的现金帐户追加了".sprintf("%10.2f",$add_balance)."元,";
			}elseif($add_balance<0){
				$message_str .= "系统管理员{$admin_info['username']}给您的现金帐户扣除了".sprintf("%10.2f",abs($add_balance))."元,";
			}
			if($add_credit>0){
				$message_str .= "系统管理员{$admin_info['username']}给您的代金券帐户追加了".sprintf("%10.2f",$add_credit)."元";
			}elseif ($add_credit<0){
				$message_str .= "系统管理员{$admin_info['username']}给您的代金券帐户扣除了".sprintf("%10.2f",abs($add_credit))."元";
			}
			
			if ($pwd_pwd||$txt_email)
			{
				Syn_interface_class::user_edit($txt_username,'',$pwd_pwd,$txt_email);
			}
			
			$memberspace_obj->edit_keke_witkey_space();
			Func_comm_class::adminSystemLog("编辑会员$edituid");
			Func_comm_class::notify_user("系统消息","管理员 <b>{$admin_info['username']}</b> 设置了您的帐户信息，",$edituid,$memberinfo_arr['username']);
			Func_comm_class::notify_user("系统消息",$message_str,$edituid,$memberinfo_arr['username']);
			if ($view=="service"){
			Func_comm_class::adminshowmessage('编辑成功',"index.php?do=user&type=service");
			}
			else {
				Func_comm_class::adminshowmessage('编辑成功',"index.php?do=user&type=front");
			}
		}
		else{
			$res = $memberspace_obj->create_keke_witkey_space();
			Func_comm_class::adminSystemLog("添加会员$res");
			Func_comm_class::adminshowmessage('用户创建成功',"index.php?do=user&type=front");
		}
	}
	if ($edituid)
	{
		$memberinfo_arr = Func_comm_class::getuserinfo($edituid);
	}
	
	
	
	require_once $template_obj->template('control/admin/tpl/admin_user_front_add');
}

else if ($op == 'allowapply'){
	Func_comm_class::adminCheckRole(25);
	$memberspace_obj = new Keke_witkey_space_class();
	if (!$authuid)Func_comm_class::adminshowmessage('错误的参数',"index.php?do=user&type=front&op=allowapply");
	$memberspace_obj->setWhere("uid={$authuid}");
	$memberspace_obj->setIs_auth(2);
	$memberspace_obj->setAuth_time(time('now()'));
	$memberspace_obj->edit_keke_witkey_space();
	//邮件
	$message_obj = new Message_Class();
	if ($message_obj->validate('user_auth_success_isnotice')){
		$user_info = Func_comm_class::getuserinfo($authuid);
		$message_obj->setUid($authuid);
		$message_obj->setUsername($user_info['username']);
		$message_obj->setTitle('团队认证成功');
		$message_obj->send();
	}
	Func_comm_class::adminSystemLog("通过$edituid的团队认证");
	Func_comm_class::adminshowmessage('操作成功',"index.php?do=user&type=front&op=apply");
}
else if ($op == 'dennyapply'){
	Func_comm_class::adminCheckRole(25);
	$memberspace_obj = new Keke_witkey_space_class();
	if (!$authuid)Func_comm_class::adminshowmessage('错误的参数',"index.php?do=user&type=front&op=apply");
	$memberspace_obj->setWhere("uid={$authuid}");
	$memberspace_obj->setIs_auth(0);
	$memberspace_obj->setAuth_time(time());
	$memberspace_obj->edit_keke_witkey_space();
	//邮件
	$message_obj = new Message_Class();
	if ($message_obj->validate('user_auth_fail_isnotice')){
		$user_info = Func_comm_class::getuserinfo($authuid);
		$message_obj->setUid($authuid);
		$message_obj->setUsername($user_info['username']);
		$message_obj->setTitle('团队认证失败');
		$message_obj->send();
	}
	Func_comm_class::adminSystemLog("拒绝$edituid的团队认证");
	Func_comm_class::adminshowmessage('操作成功',"index.php?do=user&type=front&op=apply");
}
else if ($op == 'apply'){
	Func_comm_class::adminCheckRole(25);
	$memberspace_obj = new Keke_witkey_space_class();
	if ($authuid)
	{
		$memberspace_obj->setWhere("uid='{$authuid}'");
		$memberinfo_arr = $memberspace_obj->query_keke_witkey_space();
		$memberinfo_arr = $memberinfo_arr[0];
		require_once $template_obj->template('control/admin/tpl/admin_user_front_apply_view');
		die();
	}
//批量操作
	if (isset ( $sbt_action )) {
	$o_p = $rdo;
	$keyids = $ckb;
	//var_dump($keyids);die();
	 $ids = implode(',',$keyids);
	 
	if (count ( $keyids )) {
		$memberspace_obj->setWhere("uid in ({$ids})");
		if ($sbt_action == "批量通过认证"){
			$memberspace_obj->setIs_auth(2);
			//邮件
			$memberspace_obj->setStatus(2);
				foreach ($keyids as $key_id)
				{
					//邮件
					$message_obj = new Message_Class();
					if ($message_obj->validate('user_auth_success_isnotice')){
						$message_obj->setUid($key_id);
						$user_info = Func_comm_class::getuserinfo($key_id);
						$message_obj->setUsername($user_info['username']);
						$message_obj->setTitle('认证成功');
						$message_obj->send();
					}
				}
			Func_comm_class::adminSystemLog("通过$keyids的认证");
			$memberspace_obj->edit_keke_witkey_space();
		}
		elseif ($sbt_action == "批量取消认证"){
			$memberspace_obj->setIs_auth(0);
			foreach ($keyids as $key_id)
			{
				//邮件
				$message_obj = new Message_Class();
				if ($message_obj->validate('user_auth_fail_isnotice')){
					$message_obj->setUid($key_id);
					$user_info = Func_comm_class::getuserinfo($key_id);
					$message_obj->setUsername($user_info['username']);
					$message_obj->setTitle('认证失败');
					$message_obj->send();
				}
			}
			Func_comm_class::adminSystemLog("拒绝$keyids的认证");
			$memberspace_obj->edit_keke_witkey_space();
		}
		Func_comm_class::adminshowmessage('操作成功',"index.php?do=user&type=front&op=apply");
		}
	}
	
	
	$page_obj = new Pages_Class();
	if ($slt_is_auth){
		$where_arr = "is_auth=$slt_is_auth ";
	}
	else{
		$where_arr = "is_auth>0 ";
	}
	$memberspace_obj->setWhere($where_arr);
	
	$url = "index.php?do=user&op=apply&slt_is_auth=$slt_is_auth";
	
	$slt_page_size = $slt_page_size?$slt_page_size:10;
	$limit = $slt_page_size;
	$count = $memberspace_obj->count_keke_witkey_space();
	$page = $page?$page:1;
	$pages = $page_obj->getPages($count,$limit,$page,$url);
	$memberspace_obj->setWhere($where_arr." order by auth_time desc ".$pages['where']);
	$pages = $page_obj->getPages($count,$limit,$page,$url);
	
	$userlist_arr = $memberspace_obj->query_keke_witkey_space();
	
	require_once $template_obj->template('control/admin/tpl/admin_user_front_apply_list');
}
else if ($op == 'del'){
	Func_comm_class::adminCheckRole(24);
	$user_info = Func_comm_class::getuserinfo($edituid);
	
	$memberspace_obj = new Keke_witkey_space_class();
	if (!$edituid)Func_comm_class::adminshowmessage('错误的参数',"index.php?do=user&type=front");
	$memberspace_obj->setWhere("uid={$edituid}");
	$memberspace_obj->del_keke_witkey_space();
	$member_obj = new Keke_witkey_member_class();
	$member_obj->setWhere("uid={$edituid}");
	$member_obj->del_keke_witkey_member();
	Syn_interface_class::user_delete($user_info['username']);
	
	Func_comm_class::adminSystemLog("删除会员$edituid");
	Func_comm_class::adminshowmessage('操作成功',"index.php?do=user&type=front");
}
else if ($op == 'able'){
	Func_comm_class::adminCheckRole(24);
	$memberspace_obj = new Keke_witkey_space_class();
	if (!$edituid)Func_comm_class::adminshowmessage('错误的参数',"index.php?do=user&type=front");
	$memberspace_obj->setWhere("uid={$edituid}");
	$memberspace_obj->setStatus(1);
	$memberspace_obj->edit_keke_witkey_space();
	Func_comm_class::adminSystemLog("解冻会员$edituid");
	Func_comm_class::adminshowmessage('操作成功',"index.php?do=user&type=front");
}
else if ($op == 'disable'){
	Func_comm_class::adminCheckRole(24);
	$memberspace_obj = new Keke_witkey_space_class();
	if (!$edituid)Func_comm_class::adminshowmessage('错误的参数',"index.php?do=user&type=front");
	$memberspace_obj->setWhere("uid={$edituid}");
	$memberspace_obj->setStatus(2);
	$memberspace_obj->edit_keke_witkey_space();
	//邮件
	$message_obj = new Message_Class();
	if ($message_obj->validate('freeze_isnotice')){
		$message_obj->setUid($edituid);
		$user_info = Func_comm_class::getuserinfo($edituid);
		$message_obj->setUsername($user_info['username']);
		$message_obj->setTitle('用户冻结');
		$message_obj->send();
	}
	Func_comm_class::adminSystemLog("冻结会员$edituid");
	Func_comm_class::adminshowmessage('操作成功',"index.php?do=user&type=front");
}
else{
	Func_comm_class::adminCheckRole(24);
	$page_obj = new Pages_Class();//实例化分页对象
	$memberspace_obj = new Keke_witkey_space_class();
	
	$url ='index.php?do=user&type=front&op=list&slt_static=$slt_static&txt_uid='.$txt_uid.'&txt_username='.$txt_username.'&slt_page_size='.$slt_page_size.'&ckb_isvip='.$ckb_isvip.'&ord='.$ord;
	
	//批量操作
	if (isset ( $sbt_action )) {
	//$o_p = $rdo;
	$keyids = $ckb;
	//var_dump($keyids);die();
	 $ids = implode(',',$keyids);
	 
		if (count ( $keyids )) {
			$memberspace_obj->setWhere("uid in ({$ids})");
			if ($sbt_action == "批量删除"){
				$memberspace_obj->del_keke_witkey_space();
				$member_obj = new Keke_witkey_member_class();
				$member_obj->setWhere("uid in ({$ids})");
				$member_obj->del_keke_witkey_member();
				foreach($keyids as $key => $value){
					Func_comm_class::adminSystemLog("删除用户$value");				
				}
			}
			elseif ($sbt_action == "批量禁用"){
				$memberspace_obj->setStatus(2);
				foreach ($keyids as $key_id)
				{
					//邮件
					$message_obj = new Message_Class();
					if ($message_obj->validate('freeze_isnotice')){
						$message_obj->setUid($key_id);
						$user_info = Func_comm_class::getuserinfo($key_id);
						$message_obj->setUsername($user_info['username']);
						$message_obj->setTitle('用户冻结');
						$message_obj->send();
					}
				}
				Func_comm_class::adminSystemLog("编辑用户$keyids");
				$memberspace_obj->edit_keke_witkey_space();
			}
			elseif ($sbt_action == "批量开启"){
				$memberspace_obj->setStatus(1);
				$memberspace_obj->edit_keke_witkey_space();
				Func_comm_class::adminSystemLog("编辑用户$keyids");
			}
			Func_comm_class::adminshowmessage('操作成功',$url);
		}
	 } 

	
	$where_str =  "1=1 ";
	
	//每页显示多少条，默认10
	$slt_page_size = intval($slt_page_size)?intval($slt_page_size):10;
	
	if ($txt_uid)
	{
		$where_str .= "and uid='{$txt_uid}' ";
	}
	if ($txt_username)
	{
		$where_str .= "and username like '%{$txt_username}%' ";
	}
	if ($ckb_isvip)
	{
		$where_str .= "and isvip=1 ";
	}
	if ($slt_static == 1)
	{
		$where_str .= "and status=1 ";
	}
	if ($slt_static == 2)
	{
		$where_str .= "and status=0 ";
	}
	
	
//排序条件
switch ($ord) {
	case 1:
		$where_str.=' order by uid desc ';//文章ID倒序
	;
	break;
	case 2:
		$where_str.=' order by uid asc ';//文章ID升序
	;
	break;
	case 3:
		$where_str.=' order by credit desc ';//时间倒序
	;
	break;
	case 4:
		$where_str.=' order by credit asc ';//时间升序
	;
	break;
	case 5:
		$where_str.=' order by balance desc ';//时间倒序
	;
	break;
	case 6:
		$where_str.=' order by balance asc ';//时间升序
	;
	break;
	default:
		$where_str.=' order by uid desc ';//文章ID倒序
		;
	break;
}

	$memberspace_obj->setWhere($where_str);
	$count = $memberspace_obj->count_keke_witkey_space();
	
	$limit=$slt_page_size;
	$page = $_GET ['page'] ? $_GET ['page'] : 1;
	$pages = $page_obj->getPages($count,$limit,$page,$url);
	$memberspace_obj->setWhere($where_str.$pages['where']);
	$userlist_arr = $memberspace_obj->query_keke_witkey_space();
	$grouplist_arr = Cache_ext_Class::getGroupList();
	require_once $template_obj->template('control/admin/tpl/admin_user_front_list');
}

