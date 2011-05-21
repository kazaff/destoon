<?php


if(!defined('IN_KEKE')) {
	exit('Access Denied');
}

$studio_obj = new Keke_witkey_studio_class();
$space_obj = new Keke_witkey_space_class();
$member_obj = new Keke_witkey_member_class();
$studio_member_obj = new Keke_witkey_studio_member_class();
$studio_member_ext_obj = new Keke_witkey_studio_member_ext_class();
$studio_apply_obj = new Keke_witkey_studio_apply_class();
$upload_obj = new Upload_Class ( UPLOAD_ROOT , array ("gif", 'jpeg', 'jpg', 'png' ), UPLOAD_MAXSIZE );

$ops = array('create','member','apply','invite','leave');
$op = in_array($op,$ops)?$op:"index";

$user_info = Func_comm_class::getuserinfo($uid);
$studio_info = NULL;
if($user_info[studio_id]){
	$studio_obj->setWhere(' studio_id = '.$user_info[studio_id]);
	$studio_info = $studio_obj->query_keke_witkey_studio();
	$studio_info = $studio_info[0];
	$studio_info[area] = explode(',',$studio_info[area]);
	
	

}


if($show=='invite'){
	$title = '邀请加入工作室';
	require_once  $template_obj->template ($do."_".$view."_invite");
	die();
}



if($sbt_invite){
	$member_obj->setWhere(' username =  "'.$txt_invite_username.'"');
	$member_info = $member_obj->query_keke_witkey_member();
	$member_info = $member_info[0];
	if($member_info){
		$studio_apply_obj->setApply_type(2);
		$studio_apply_obj->setContent($username.'诚恳的邀请您加入'.$studio_info[title].'工作室');
		$studio_apply_obj->setOn_date(time());
		$studio_apply_obj->setUid($member_info[uid]);
		$studio_apply_obj->setUsername($member_info[username]);
		$studio_apply_obj->setStudio_id($studio_info[studio_id]);
		$res = $studio_apply_obj->create_keke_witkey_studio_apply();
		if($res){
			
			Func_comm_class::sendMail($member_info['email'],"工作室加入邀请","<a href=\"".$_K['siteurl']."/index.php?do=space&member_id=$uid\">$username</a> 邀请您加入他的工作室   >> {$studio_info[title]}  <a style=\"color:#ff9a4a\" href=\"".$_K['siteurl']."/index.php?do=user&view=studio&op=invite\">查看</a>");
			Func_comm_class::notify_user("工作室邀请","<a href=\"".$_K['siteurl']."/index.php?do=space&member_id=$uid\">$username</a> 邀请您加入他的工作室   >> {$studio_info[title]}  <a style=\"color:#ff9a4a\" href=\"".$_K['siteurl']."/index.php?do=user&view=studio&op=invite\">查看</a>",$member_info['uid'],$member_info['username']);
			Func_comm_class::showmessage('邀请成员成功！','index.php?do='.$do.'&view='.$view.'&op=invite');
		}
	}else{
		Func_comm_class::showmessage('对不起，您填写的用户名不存在','index.php?do='.$do.'&view='.$view.'&op=create',3,'','error');
	}
}

switch ($op) {
	case 'index':
		$feed_list = Cache_ext_Class::gettabledata("witkey_feed","feedtype like '%studio%'","feed_id desc",0,'','10');
		
		$new_created_list = Cache_ext_Class::gettabledata("witkey_studio","studio_status>0","studio_id desc",0,'',8);
		
		
		
		break;
	case 'leave':
			
			$space_obj = new Keke_witkey_space_class();
			$space_obj->setWhere("uid = $uid");
			$space_obj->setStudio_id(0);
			$space_obj->edit_keke_witkey_space();
			
			
			$studio_obj = new Keke_witkey_studio_class();
			if ($uid == $studio_info['uid']){echo $studio_info['studio_id'];
				$space_obj->setWhere("studio_id = {$studio_info['studio_id']}");
				$stu_arr = $space_obj->query_keke_witkey_space();
				$space_obj->setWhere("studio_id = {$studio_info['studio_id']}");
				$space_obj->setStudio_id(0);
				$space_obj->edit_keke_witkey_space();
				
				foreach ($stu_arr as $value){
					Func_comm_class::notify_user("<a href=\"index.php?do=space&member_id=$uid\">$username</a>解散了工作室,您现在没有工作室.","studio_cancer",$value['uid'],$value['username']);
				}
				
				$studio_apply_obj = new Keke_witkey_studio_apply_class();
				$studio_apply_obj->setWhere("studio_id = {$studio_info['studio_id']}");
				$studio_apply_obj->del_keke_witkey_studio_apply();
				
				$studio_invite_obj = new Keke_witkey_studio_member_class();
				$studio_invite_obj->setWhere("studio_id = {$studio_info['studio_id']}");
				$studio_invite_obj->del_keke_witkey_studio_member();
			}
			else {
				$studio_obj->setWhere("studio_id = {$studio_info['studio_id']}");
				$studio_obj->setMembers($studio_info['members']-1);
			}
			
			Func_comm_class::showmessage('操作完毕','index.php?do='.$do.'&view='.$view,3);
		
		break;
	case 'create':
		if($sbt_edit){
			
			$user_info = Func_comm_class::getuserinfo($uid);
			$st_allow_rule = Cache_ext_Class::getRule("studio_create",$uid,$user_info);
			if ($st_allow_rule<0){
				Func_comm_class::showmessage('您所在的用户组没有创建工作室的权限','index.php?do='.$do.'&view='.$view.'&op=create',3,'','error');
			}
			
			if ($user_info['studio_id']&&!$studio_info){
				Func_comm_class::showmessage('您已经创建过工作室','index.php?do='.$do.'&view='.$view.'&op=create',3,'','error');
			}
			
			if($_FILES['fle_studio_logo']['name']){
				$files1 = $upload_obj->run ( 'fle_studio_logo' );
				if(is_array($files1)){
					$studio_logo= "data/uploads/".UPLOAD_RULE.$files1[0]['saveName'];
				}
			}
			
			if($_FILES['fle_studio_banner']['name']){
				$files2 = $upload_obj->run ( 'fle_studio_banner' );
				if(is_array($files2)){
					$studio_banner= "data/uploads/".UPLOAD_RULE.$files2[1]['saveName'];
				}
			}
			$studio_username = explode(',',$studio_username);
			$nameliststr = "";
			if ($studio_username)
			{
				foreach ($studio_username as $n)
				{
					$nameliststr .= $nameliststr?",":"";
					$nameliststr .= "'$n'";
				}
			}
			$space_obj->setWhere(" username in  (".$nameliststr.") and (studio_id is null or studio_id=0) ");
			$member_list = $space_obj->query_keke_witkey_space();
			$studio_obj->setTitle($studio_name);
			$studio_obj->setAddress($txt_address);
			$studio_obj->setEmail($txt_email);
			$studio_obj->setFax($txt_fax);
			$studio_obj->setArea($slt_province.','.$slt_city);
			$studio_obj->setAboutus($tar_desc);
			$studio_obj->setMembers(1);
			$studio_obj->setPhone($txt_phone);
			$studio_obj->setPostcode($txt_postcode);
			$studio_obj->setUid($uid);
			$studio_obj->setUsername($username);
			$studio_obj->setLogo($studio_logo);
			$studio_obj->setBanner_pic($studio_banner);
			$studio_obj->setOn_date(time());
			
			if($studio_info){
				$studio_obj->setStudio_id($hdn_studio_id);
				$res = $studio_obj->edit_keke_witkey_studio();
				if($res){
					foreach ($member_list as $member_info){
						if($member_info){
							$studio_apply_obj->_apply_id = NULL;
							$studio_apply_obj->setApply_type(2);
							$studio_apply_obj->setContent($username.'诚恳的邀请您加入'.$studio_info[title].'工作室');
							$studio_apply_obj->setOn_date(time());
							$studio_apply_obj->setUid($member_info[uid]);
							$studio_apply_obj->setUsername($member_info[username]);
							$studio_apply_obj->setStudio_id($studio_info[studio_id]);
							$res = $studio_apply_obj->create_keke_witkey_studio_apply();
							
							if ($res){
								Func_comm_class::notify_user("工作室邀请","<a href=\"index.php?do=space&member_id=$uid\">$username</a> 邀请您加入他的工作室   >> {$studio_name}  <a style=\"color:#ff9a4a\" href=\"index.php?do=user&view=studio&op=invite\">查看</a>",$member_info['uid'],$member_info['username']);
							}
							
						}
					}
					Func_comm_class::showmessage('工作室编辑成功！','index.php?do='.$do.'&view='.$view.'&op='.$op);
				}
			}else{
				$res = $studio_obj->create_keke_witkey_studio();
				
				$space_obj->setUid($uid);
				$space_obj->setStudio_id($res);
				$space_obj->edit_keke_witkey_space();
				
				$studio_member_obj->setStudio_id($res);
				$studio_member_obj->setUid($uid);
				$studio_member_obj->setUsername($username);
				$studio_member_obj->setOn_date(time());
				$studio_member_obj->create_keke_witkey_studio_member();
				if($res){
					foreach ($member_list as $member_info){
						if($member_info){
							$studio_apply_obj->_apply_id = NULL;
							$studio_apply_obj->setApply_type(2);
							$studio_apply_obj->setStudio_id($res);
							$studio_apply_obj->setContent($username.'诚恳的邀请您加入'.$studio_info[title].'工作室');
							$studio_apply_obj->setOn_date(time());
							$studio_apply_obj->setUid($member_info[uid]);
							$studio_apply_obj->setUsername($member_info[username]);
							$res = $studio_apply_obj->create_keke_witkey_studio_apply();
							
							if ($res){
								Func_comm_class::notify_user("工作室邀请","<a href=\"index.php?do=space&member_id=$uid\">$username</a> 邀请您加入他的工作室   >> {$studio_name}  <a style=\"color:#ff9a4a\" href=\"index.php?do=user&view=studio&op=invite\">查看</a>",$member_info['uid'],$member_info['username']);
							}
							
						}
					}
					
					Func_comm_class::showmessage('工作室创建成功！','index.php?do='.$do.'&view='.$view.'&op='.$op);
				}
			}
		}
	;
	break;
	case 'member':
		$studio_member_ext_obj->setWhere(' a.studio_id = '.$user_info[studio_id].' order by a.w_uid asc  ');
		$studio_member_arr = $studio_member_ext_obj->query_keke_witkey_studio_member();
		if($ac=='del'){
			db_factory::execute("update ".TABLEPRE."witkey_studio set members = members-1 where studio_id = {$studio_apply_info[studio_id]}");
			$studio_member_obj->setW_uid($w_uid);
			$res = $studio_member_obj->del_keke_witkey_studio_member();
			if($res){
				Func_comm_class::showmessage('成员已踢出成功！','index.php?do='.$do.'&view='.$view.'&op='.$op);	
			}
		}
	;
	break;
	case 'apply':
		$studio_apply_obj->setWhere(' apply_type = 1 and studio_id = '.$user_info[studio_id]);
		$studio_apply_arr = $studio_apply_obj->query_keke_witkey_studio_apply();
		
		if($ac=='apply'){
			
				$studio_apply_obj->setWhere(' apply_id = '.$apply_id);
				$studio_apply_info = $studio_apply_obj->query_keke_witkey_studio_apply();
				$studio_apply_info = $studio_apply_info[0];
				
				$studio_apply_obj->setWhere(' apply_id = '.$apply_id);
				$studio_apply_obj->setApply_status(1);
				$res = $studio_apply_obj->edit_keke_witkey_studio_apply();
				
				$studio_member_obj->setWhere(' uid = '.$studio_apply_info[uid]);
				$studio_member_count = $studio_member_obj->count_keke_witkey_studio_member();
				
				db_factory::execute("update ".TABLEPRE."witkey_studio set members = members+1 where studio_id = {$studio_apply_info[studio_id]}");
				
				if(!$studio_member_count){
					$studio_member_obj->setStudio_id($studio_apply_info[studio_id]);
					$studio_member_obj->setUid($studio_apply_info[uid]);
					$studio_member_obj->setUsername($studio_apply_info[username]);
					$studio_member_obj->setOn_date(time());
					$res = $studio_member_obj->create_keke_witkey_studio_member();
				}
				
				$space_obj->setUid($studio_apply_info[uid]);
				$space_obj->setStudio_id($studio_apply_info[studio_id]);
				$res = $space_obj->edit_keke_witkey_space();
				if($res){
					Func_comm_class::showmessage('加入工作室审核通过！','index.php?do='.$do.'&view='.$view.'&op='.$op);	
				}
		}
		
	;
	break;
		case 'invite':
		if($studio_info[studio_status]==1){
			$studio_apply_obj->setWhere('  apply_type = 2 and studio_id = '.$studio_info[studio_id]);
		}else{
			$studio_apply_obj->setWhere(' apply_type = 2 and uid = '.$uid);
		}
		
		$studio_apply_arr = $studio_apply_obj->query_keke_witkey_studio_apply();
		
		if($ac=='invite'){
				$studio_apply_obj->setWhere(' apply_id = '.$apply_id);
				$studio_apply_info = $studio_apply_obj->query_keke_witkey_studio_apply();
				$studio_apply_info = $studio_apply_info[0];
				
				$studio_apply_obj->setWhere(' apply_id = '.$apply_id);
				$studio_apply_obj->setApply_status(1);
				$res = $studio_apply_obj->edit_keke_witkey_studio_apply();
				
				db_factory::execute("update ".TABLEPRE."witkey_studio set members = members+1 where studio_id = {$studio_apply_info[studio_id]}");
				
				$studio_member_obj->setWhere(' uid = '.$studio_apply_info[uid]);
				$studio_member_count = $studio_member_obj->count_keke_witkey_studio_member();
				if(!$studio_member_count){
					$studio_member_obj->setStudio_id($studio_apply_info[studio_id]);
					$studio_member_obj->setUid($studio_apply_info[uid]);
					$studio_member_obj->setUsername($studio_apply_info[username]);
					$studio_member_obj->setOn_date(time());
					$res = $studio_member_obj->create_keke_witkey_studio_member();
					$space_obj->setUid($uid);
					$space_obj->setStudio_id($studio_apply_info[studio_id]);
					$res = $space_obj->edit_keke_witkey_space();
				}
				if($res){
					Func_comm_class::showmessage('您成功加入工作室！','index.php?do='.$do);	
				}
		}
	;
	break;
	default:
		;
	break;
}

require_once  $template_obj->template ($do."_".$view);