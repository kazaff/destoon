<?php
if (! defined ( 'ADMIN_KEKE' )) {
	exit ( 'Access Denied' );
}

if($view=="user"){
	if ($op == 'setrole')
	{
		Func_comm_class::adminCheckRole(29);
		$edituid = $edituid?$edituid:Func_comm_class::adminshowmessage('参数错误',$_K['refer']);
		$space_obj = new Keke_witkey_space_class();
		$space_obj->setWhere("uid = '$edituid'");
		$spaceinfo = $space_obj->query_keke_witkey_space();
		$spaceinfo = $spaceinfo?$spaceinfo[0]:Func_comm_class::adminshowmessage('该用户不存在',$_K['refer']);
		
		$menuset_arr = Cache_ext_Class::getMenuset();

		if ($is_submit)
		{
			$space_obj->setGroup_id($rdo_group_id);
			$space_obj->setWhere("uid = '$edituid'");
			$space_obj->edit_keke_witkey_space();
			Func_comm_class::adminSystemLog("设置用户$edituid的组");
			Func_comm_class::notify_user("用户组设定","管理员 <b>{$admin_info['username']}</b> 设置了您的后台用户组，",$spaceinfo['uid'],$spaceinfo['username']);
			Func_comm_class::adminshowmessage("权限设置成功","index.php?do=user&type=front");
		}
		
		$grouparr = Cache_ext_Class::getGroupList();
		
		require_once $template_obj->template('control/admin/tpl/admin_user_back_setrole');
	}
	
	
}
elseif ($view =="group")
{
	$menuset_arr = Cache_ext_Class::getMenuset();
	$membergroup_obj = new Keke_witkey_member_group_class();
	Func_comm_class::adminCheckRole(29);
	//添加-编辑模式
	if ($op == 'add')
	{
		if ($is_submit)
		{
			$txt_groupname = $txt_groupname?$txt_groupname:Func_comm_class::adminshowmessage("请输入组名");
			$chb_resource = $chb_resource?implode(',',$chb_resource):Func_comm_class::adminshowmessage("您没有选择权限",$_K['refer']);
			$membergroup_obj->setWhere("groupname='{$txt_groupname}' and group_id != '{$editgid}'");
			if ($membergroup_obj->query_keke_witkey_member_group())
			{
				Func_comm_class::adminshowmessage("该用户组已存在",$_K['refer']);
			}
			$membergroup_obj->setGroupname($txt_groupname);
			$membergroup_obj->setGroup_roles($chb_resource);
			$membergroup_obj->setOn_time(time('now()'));
			if ($editgid)
			{
				$membergroup_obj->setWhere("group_id={$editgid}");
				$membergroup_obj->edit_keke_witkey_member_group();
				Func_comm_class::adminSystemLog("编辑用户组$editgid");
			}
			else {
				$res = $membergroup_obj->create_keke_witkey_member_group();
				Func_comm_class::adminSystemLog("创建用户组$res");
			}
			
			Func_comm_class::adminshowmessage("操作成功",$_K['refer']);
		}
		
		
		$grouprole_arr = array();
		
		if ($editgid)
		{
			$membergroup_obj->setWhere("group_id={$editgid}");
			$groupinfo_arr = $membergroup_obj->query_keke_witkey_member_group();
			$groupinfo_arr = $groupinfo_arr[0];
			$grouprole_arr = explode(',',$groupinfo_arr['group_roles']);
		}
		require_once $template_obj->template('control/admin/tpl/admin_user_back_group_add');
		die();
	}
	if ($op == 'del'){
		$editgid = $editgid?$editgid:Func_comm_class::adminshowmessage('参数错误',$_K['refer']);
		$membergroup_obj->setWhere("group_id='{$editgid}'");
		$membergroup_obj->del_keke_witkey_member_group();
		Func_comm_class::adminSystemLog("删除用户组$editgid");
		Func_comm_class::adminshowmessage('操作成功',$_K['refer']);
	}
	
	//列表模式
	
	$grouplist_arr = $membergroup_obj->query_keke_witkey_member_group();
	
	require_once $template_obj->template('control/admin/tpl/admin_user_back_group_list');
}


