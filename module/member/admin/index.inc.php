<?php
defined('IN_DESTOON') or exit('Access Denied');
require MD_ROOT.'/member.class.php';
$do = new member;
$menus = array (
    array('添加会员', '?moduleid='.$moduleid.'&action=add'),
    array('会员列表', '?moduleid='.$moduleid),
    array('审核会员', '?moduleid='.$moduleid.'&action=check'),
    array('会员升级', '?moduleid='.$moduleid.'&file=grade&action=check'),
    array('联系会员', '?moduleid='.$moduleid.'&file=contact'),
    array('公司列表', '?moduleid=4'),
    array(VIP.'列表', '?moduleid=4&file=vip'),
);
isset($userid) or $userid = 0;
$CATEGORY = cache_read('category-4.php');

if(in_array($action, array('add', 'edit'))) {
	$MFD = cache_read('fields-member.php');
	$CFD = cache_read('fields-company.php');
	isset($post_fields) or $post_fields = array();
	if($MFD || $CFD) require DT_ROOT.'/include/fields.func.php';
}

if(in_array($action, array('', 'check'))) {
	$sfields = array('按条件', '公司名', '会员名', '通行证名','姓名', '手机号码', '部门', '职位', 'Email', 'QQ', 'MSN', '阿里旺旺', 'Skype', '注册IP', '登录IP', '推荐人');
	$dfields = array('username', 'company', 'username', 'passport', 'truename', 'mobile', 'department', 'career', 'email', 'qq', 'msn', 'ali', 'skype', 'regip', 'loginip', 'inviter');
	$sorder  = array('结果排序方式', '注册时间降序', '注册时间升序', '登录时间降序', '登录时间升序', '登录次数降序', '登录次数升序', '账户'.$DT['money_name'].'降序', '账户'.$DT['money_name'].'升序', '会员'.$DT['credit_name'].'降序', '会员'.$DT['credit_name'].'升序', '短信余额降序', '短信余额升序');
	$dorder  = array('userid DESC', 'regtime DESC', 'regtime ASC', 'logintime DESC', 'logintime ASC', 'logintimes DESC', 'logintimes ASC', 'money DESC', 'money ASC', 'credit DESC', 'credit ASC', 'sms DESC', 'sms ASC');
	$sgender = array('性别', '先生' , '女士');
	$sprofile = array('资料', '已完善' , '未完善');
	$semail = array('邮件', '已认证' , '未认证');
	$smobile = array('手机', '已认证' , '未认证');
	$struename = array('实名', '已认证' , '未认证');
	$sbank = array('银行', '已认证' , '未认证');
	$scompany = array('公司', '已认证' , '未认证');

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;
	$groupid = isset($groupid) ? intval($groupid) : 0;
	$gender = isset($gender) ? intval($gender) : 0;
	$uid = isset($uid) ? intval($uid) : '';
	$username = isset($username) ? trim($username) : '';
	$vprofile = isset($vprofile) ? intval($vprofile) : 0;
	$vemail = isset($vemail) ? intval($vemail) : 0;
	$vmobile = isset($vmobile) ? intval($vmobile) : 0;
	$vtruename = isset($vtruename) ? intval($vtruename) : 0;
	$vbank = isset($vbank) ? intval($vbank) : 0;
	$vcompany = isset($vcompany) ? intval($vcompany) : 0;
	isset($fromtime) or $fromtime = '';
	isset($totime) or $totime = '';
	isset($timetype) or $timetype = 'regtime';
	$minmoney = isset($minmoney) ? intval($minmoney) : '';
	$maxmoney = isset($maxmoney) ? intval($maxmoney) : '';
	$mincredit = isset($mincredit) ? intval($mincredit) : '';
	$maxcredit = isset($maxcredit) ? intval($maxcredit) : '';
	$minsms = isset($minsms) ? intval($minsms) : '';
	$maxsms = isset($maxsms) ? intval($maxsms) : '';

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);
	$gender_select = dselect($sgender, 'gender', '', $gender);
	$group_select = group_select('groupid', '会员组', $groupid);
	$vprofile_select = dselect($sprofile, 'vprofile', '', $vprofile);
	$vemail_select = dselect($semail, 'vemail', '', $vemail);
	$vmobile_select = dselect($smobile, 'vmobile', '', $vmobile);
	$vtruename_select = dselect($struename, 'vtruename', '', $vtruename);
	$vbank_select = dselect($sbank, 'vbank', '', $vbank);
	$vcompany_select = dselect($scompany, 'vcompany', '', $vcompany);

	$condition = $action ? 'groupid=4' : 'groupid!=4';//
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($gender) $condition .= " AND gender=$gender";
	if($groupid) $condition .= " AND groupid=$groupid";
	if($uid) $condition .= " AND userid=$uid";
	if($username) $condition .= " AND username='$username'";
	if($vprofile) $condition .= $vprofile == 1 ? " AND edittime>0" : " AND edittime=0";
	if($vemail) $condition .= $vemail == 1 ? " AND vemail>0" : " AND vemail=0";
	if($vmobile) $condition .= $vmobile == 1 ? " AND vmobile>0" : " AND vmobile=0";
	if($vtruename) $condition .= $vtruename == 1 ? " AND vtruename>0" : " AND vtruename=0";
	if($vbank) $condition .= $vbank == 1 ? " AND vbank>0" : " AND vbank=0";
	if($vcompany) $condition .= $vcompany == 1 ? " AND vcompany>0" : " AND vcompany=0";
	if($fromtime) $condition .= " AND $timetype>".(strtotime($fromtime.' 00:00:00'));
	if($totime) $condition .= " AND $timetype<".(strtotime($totime.' 23:59:59'));
	if($minmoney) $condition .= " AND money>=$minmoney";
	if($maxmoney) $condition .= " AND money<=$maxmoney";
	if($mincredit) $condition .= " AND credit>=$mincredit";
	if($maxcredit) $condition .= " AND credit<=$maxcredit";
	if($minsms) $condition .= " AND sms>=$minsms";
	if($maxsms) $condition .= " AND sms<=$maxsms";
}
if(in_array($action, array('add', 'edit'))) {
	$COM_TYPE = explode('|', $MOD['com_type']);
	$COM_SIZE = explode('|', $MOD['com_size']);
	$COM_MODE = explode('|', $MOD['com_mode']);
	$MONEY_UNIT = explode('|', $MOD['money_unit']);
	$BANKS = explode('|', trim($MOD['cash_banks']));
}
switch($action) {
	case 'add':
		if($submit) {
			$member['banner'] = '';
			$member['groupid'] = $member['regid'];
			if($member['groupid'] == 5) $member['company'] = $member['truename'].'(个人)';
			$member['passport'] = $member['passport'] ? $member['passport'] : $member['username'];
			$member['edittime'] = $member['edittime'] ? $DT_TIME : 0;
			if($MFD) fields_check($post_fields, $MFD);
			if($CFD) fields_check($post_fields, $CFD);
			if($do->add($member)) {
				if($MFD) fields_update($post_fields, $do->tb_member, $do->userid, 'userid', $MFD);
				if($CFD) fields_update($post_fields, $do->tb_company, $do->userid, 'userid', $CFD);
				if($MOD['welcome'] > 0) {
					$post = $member;
					$username = $post['username'];
					$title = '欢迎加入'.$DT['sitename'];
					$content = ob_template('welcome', 'mail');
					if($MOD['welcome'] == 1 || $MOD['welcome'] == 3) send_message($username, $title, $content);
					if($MOD['welcome'] == 2 || $MOD['welcome'] == 3) send_mail($post['email'], $title, $content);
				}
				dmsg('添加成功', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			include tpl('member_add', $module);
		}
	break;
	case 'edit':
		$userid or msg();
		$do->userid = $userid;
		if($submit) {
			$member['edittime'] = $member['edittime'] ? $DT_TIME : 0;
			$member['validtime'] = $member['validtime'] ? strtotime($member['validtime']) : 0;
			if($userid == 1 || $userid == $CFG['founderid']) $member['groupid'] = 1;
			if($MFD) fields_check($post_fields, $MFD);
			if($CFD) fields_check($post_fields, $CFD);
			$status = 0;
			if($gid != $member['groupid']) {
				$groupid = $member['groupid'];
				if($groupid == 1) {
					$status = 1;
					$member['groupid'] = $gid;
				} else if($GROUP[$groupid]['vip']) {
					$status = 2;
					$member['groupid'] = $gid;
				}
			}
			if($do->edit($member)) {
				if($MFD) fields_update($post_fields, $do->tb_member, $do->userid, 'userid', $MFD);
				if($CFD) fields_update($post_fields, $do->tb_company, $do->userid, 'userid', $CFD);
				if($status == 1) msg('会员资料修改成功，如果需要添加管理员，请进入管理员管理...', '?file=admin&action=add&username='.$username, 5);
				if($status == 2) msg('会员资料修改成功，如果需要添加'.VIP.'会员，请进入'.VIP.'管理...', '?moduleid=4&file=vip&action=add&username='.$username, 5);
				dmsg('会员资料修改成功', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			$user = $do->get_one();
			extract($user);
			$content_table = content_table(4, $userid, is_file(DT_CACHE.'/4.part'), $DT_PRE.'company_data');
			$d = $db->get_one("SELECT content FROM {$content_table} WHERE userid=$userid");
			$introduce = $d['content'];
			$cates = $catid ? explode(',', substr($catid, 1, -1)) : array();
			$validtime = $validtime ? timetodate($validtime, 3) : '';
			include tpl('member_edit', $module);
		}
	break;
	case 'show':
		if(isset($mobile)) {
			$r = $db->get_one("SELECT username FROM {$table} WHERE mobile='$mobile'");
			if($r) $username = $r['username'];
		}
		$username = isset($username) ? $username : '';
		($userid || $username) or msg('会员不存在');
		if($userid) $do->userid = $userid;
		$user = $do->get_one($username);
		$user or msg('会员不存在');
		extract($user);
		include tpl('member_show', $module);
	break;
	case 'delete':
		$userid or msg('请选择会员');
		$db->halt = 0;
		if($do->delete($userid)) {
			dmsg('删除成功', $forward);
		} else {
			msg($do->errmsg);
		}
	break;
	case 'move':
		$userid or msg('请选择会员');
		$gid = isset($groupids) ? $groupids : $groupid;
		if($gid == 1) msg('操作失败！&nbsp;如果需要添加管理员<br/><a href="?file=admin&action=add">请点这里进入管理员管理...</a>');
		if($GROUP[$gid]['vip']) msg('操作失败！&nbsp;如果需要添加'.VIP.'会员<br/><a href="?moduleid=4&file=vip&action=add">请点这里进入'.VIP.'管理...</a>');
		$do->move($userid, $gid);
		dmsg('移动成功', $forward);
	break;
	case 'check':
		if($userid) {
			if(is_array($userid)) {
				$userids = $userid;
			} else {
				$userids[0] = $userid;
			}
			foreach($userids as $userid) {
				$do->userid = $userid;
				$member = $do->get_one();
				$groupid = $member['regid'];
				$db->query("UPDATE {$do->tb_member} SET groupid=$groupid WHERE userid=$userid");
				$db->query("UPDATE {$do->tb_company} SET groupid=$groupid WHERE userid=$userid");
				if($MOD['welcome'] > 0) {
					$username = $member['username'];
					$email = $member['email'];
					$title = '欢迎加入'.$DT['sitename'];
					$content = ob_template('welcome', 'mail');
					if($MOD['welcome'] == 1 || $MOD['welcome'] == 3) send_message($username, $title, $content);
					if($MOD['welcome'] == 2 || $MOD['welcome'] == 3) send_mail($email, $title, $content);
				}
			}
			//$do->check($userid);
			dmsg('审核成功', $forward);
		} else {
			$members = $do->get_list($condition, $dorder[$order]);
			include tpl('member_check', $module);
		}
	break;
	case 'rename':
		$cusername or message('当前会员名不能为空');
		$nusername or message('会员名不能为空');
		if($do->rename($cusername, $nusername)) {
			dmsg('修改成功', $forward);
		} else {
			msg($do->errmsg);
		}
	break;
	case 'login':
		if($userid) {
			$auth = encrypt($userid.'|'.$_username);
			set_cookie('admin_user', $auth);
			msg('授权成功，正在转入会员商务中心...', $MODULE[2]['linkurl']);
		} else {
			msg();
		}
	break;
	case 'unlock':
		$ip or msg('请填写需要解锁的IP');
		$ipfile = DT_CACHE.'/ban/'.$ip.'.php';
		if(is_file($ipfile)) {
			cache_delete($ip.'.php', 'ban');
			msg('IP:'.$ip.' 已经成功解除锁定', $forward);
		} else {
			msg('IP:'.$ip.' 未被系统锁定');
		}
	break;
	default:
		$members = $do->get_list($condition, $dorder[$order]);
		include tpl('member', $module);
	break;
}
?>