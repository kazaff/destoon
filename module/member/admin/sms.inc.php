<?php
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('发送短信', '?moduleid='.$moduleid.'&file='.$file),
    array('发送记录', '?moduleid='.$moduleid.'&file='.$file.'&action=send'),
    array('短信增减', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('短信记录', '?moduleid='.$moduleid.'&file='.$file.'&action=record'),
    array('获取列表', '?moduleid='.$moduleid.'&file='.$file.'&action=make'),
    array('号码列表', '?moduleid='.$moduleid.'&file='.$file.'&action=list'),
);
function _userinfo($mobile) {
	global $db;
	return $db->get_one("SELECT * FROM {$db->pre}member m,{$db->pre}company c WHERE m.userid=c.userid AND m.mobile='$mobile'");
}
switch($action) {
	case 'add':
		if($submit) {
			$username or msg('请填写会员名');
			$amount or msg('请填写数量');
			$reason or msg('请填写事由');
			$amount = intval($amount);
			if($amount <= 0) msg('分值格式错误');
			$username = trim($username);
			$r = $db->get_one("SELECT username,sms FROM {$DT_PRE}member WHERE username='$username'");
			if(!$r) msg('会员不存在');
			if(!$type) {
				if($r['sms'] < $amount) msg('会员短信余额不足，当前余额为:'.$r['sms'].'条');
				$amount = -$amount;
			}
			$reason or $reason = '奖励';
			$note or $note = '手工';
			sms_add($username, $amount);
			sms_record($username, $amount, $_username, $reason, $note);
			dmsg('添加成功', '?moduleid='.$moduleid.'&file='.$file.'&action=record');
		} else {
			include tpl('sms_add', $module);
		}
	break;
	case 'record':
		$table = $DT_PRE.'finance_sms';
		$sfields = array('按条件', '会员名', '数量', '事由', '备注', '操作人');
		$dfields = array('username', 'username', 'amount', 'reason', 'note', 'editor');
		$sorder  = array('排序方式', '数量降序', '数量升序', '时间降序', '时间升序');
		$dorder  = array('itemid DESC', 'amount DESC', 'amount ASC', 'addtime DESC', 'addtime ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($username) or $username = '';
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($dfromtime) or $dfromtime = '';
		isset($dtotime) or $dtotime = '';
		isset($type) or $type = 0;
		isset($order) && isset($dorder[$order]) or $order = 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$order_select = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($fromtime) $condition .= " AND addtime>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND addtime<".(strtotime($totime.' 23:59:59'));
		if($type) $condition .= $type == 1 ? " AND amount>0" : " AND amount<0";
		if($username) $condition .= " AND username='username'";
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$records = array();
		$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY $dorder[$order] LIMIT $offset,$pagesize");
		$income = $expense = 0;
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$r['amount'] > 0 ? $income += $r['amount'] : $expense += $r['amount'];
			$records[] = $r;
		}
		include tpl('sms_record', $module);
	break;
	case 'list':		 
		$others = array();
		$mailfiles = glob(DT_ROOT.'/file/mobile/*.txt');
		$mail = $mails = array();
		if(is_array($mailfiles)) {
			$class = 1;
			foreach($mailfiles as $id=>$mailfile)	{
				$tmp = basename($mailfile);
					$mail['filename'] = $tmp;
					$mail['filesize'] = round(filesize($mailfile)/(1024), 2);
					$mail['mtime'] = timetodate(filemtime($mailfile), 5);
					$mail['count'] = substr_count(file_get($mailfile), "\n") + 1;	
					$mails[] = $mail;
			}
		}
		include tpl('sms_list', $module);
	break;
	case 'make':
		if(isset($make)) {
			$tb or $tb = $DT_PRE.'member';
			$field or $field = 'mobile';
			$sql or $sql = 'groupid>4';
			$sql = stripslashes($sql);
			$num or $num = 1000;
			$pagesize = $num;
			$offset = ($page-1)*$pagesize;
			if($page == 1) $random = $title ? $title : mt_rand(1000, 9999);
			$result = $db->query("SELECT $field FROM $tb WHERE $sql LIMIT $offset,$pagesize");
			$mail = '';
			while($r = $db->fetch_array($result)) {
				if($r[$field]) $mail .= $r[$field]."\n";
			}
			if($mail) {
				$filename = timetodate($DT_TIME, 'Ymd').'_'.$random.'_'.$page.'.txt';
				file_put(DT_ROOT.'/file/mobile/'.$filename, trim($mail));
				$page++;
				msg('文件'.$filename.'获取成功。<br/>请稍候，程序将自动继续...', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&tb='.urlencode($tb).'&field='.urlencode($field).'&sql='.urlencode($sql).'&num='.$num.'&page='.$page.'&random='.urlencode($random).'&make=1');
			} else {
				msg('列表获取成功', '?moduleid='.$moduleid.'&file='.$file.'&action=list');
			}
		} else {
			include tpl('sms_make', $module);
		}
	break;
	case 'download':
		$file_ext = file_ext($filename);
		if($file_ext != 'txt') msg('只能下载TxT文件');
		file_down(DT_ROOT.'/file/mobile/'.$filename);
	break;
	case 'upload':
		require DT_ROOT.'/include/upload.class.php';
		$upload = new upload($_FILES, 'file/mobile/', $uploadfile_name, 'txt');	
		$upload->adduserid = false;
		if($upload->uploadfile()) dmsg('上传成功', '?moduleid='.$moduleid.'&file='.$file.'&action=list');
		msg($upload->errmsg);
	break;
	case 'delete':
		 if(is_array($filenames)) {
			 foreach($filenames as $filename) {
				 if(file_ext($filename) == 'txt') @unlink(DT_ROOT.'/file/mobile/'.$filename);
			 }
		 } else {
			 if(file_ext($filenames) == 'txt') @unlink(DT_ROOT.'/file/mobile/'.$filenames);
		 }
		 dmsg('删除成功', '?moduleid='.$moduleid.'&file='.$file.'&action=list');
	break;
	case 'delete_record':
		$itemid or msg('未选择记录');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$DT_PRE}finance_sms WHERE itemid IN ($itemids)");
		dmsg('删除成功', $forward);
	break;
	case 'delete_sms':
		$itemid or msg('未选择记录');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$DT_PRE}sms WHERE itemid IN ($itemids)");
		dmsg('删除成功', $forward);
	break;
	case 'send':
		$sfields = array('按条件', '短信内容', '发送结果', '手机号', '操作人');
		$dfields = array('message', 'message', 'code', 'mobile', 'editor');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$condition = '1';
		if($keyword) $condition .= $fields < 3 ? " AND $dfields[$fields] LIKE '%$keyword%'" : " AND $dfields[$fields]='$keyword'";
		if($fromtime) $condition .= " AND sendtime>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND sendtime<".(strtotime($totime.' 23:59:59'));
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}sms WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$lists = array();
		$result = $db->query("SELECT * FROM {$DT_PRE}sms WHERE $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['sendtime'] = str_replace(' ', '<br/>', timetodate($r['sendtime'], 6));
			$r['num'] = ceil($r['word']/$DT['sms_len']);
			$lists[] = $r;
		}
		include tpl('sms_send', $module);
	break;
	default:
		if(isset($send)) {
			if(isset($preview) && $preview) {
				if($sendtype == 2) {
					$mobiles = explode("\n", $mobiles);
					$mobile = trim($mobiles[0]);
				} else if($sendtype == 3) {
					$mobiles = explode("\n", file_get(DT_ROOT.'/file/mobile/'.$mobilelist));
					$mobile = trim($mobiles[0]);
				}
				$user = _userinfo($mobile);
				if($user) eval("\$content = \"$content\";");
				exit($content);
			}
			if($sendtype == 1) {
				$content or msg('请填写短信内容');
				$mobile or msg('请填写接收号码');
				$mobile = trim($mobile);
				$s = 0;
				if(is_mobile($mobile)) {
					$user = _userinfo($mobile);
					if($user) eval("\$content = \"$content\";");
					$content = strip_sms($content);
					$sms_code = send_sms($mobile, $content);
					if(strpos($sms_code, $DT['sms_ok']) !== false) $s++;
				}
				dmsg($s ? '短信发送成功' : '短信发送失败', $forward);
			} else if($sendtype == 2) {
				$content or msg('请填写短信内容');
				$mobiles or msg('请填写接收号码');
				$mobiles = explode("\n", $mobiles);
				$_content = $content;				
				$s = $f = 0;
				foreach($mobiles as $mobile) {
					$mobile = trim($mobile);
					if(is_mobile($mobile)) {
						$user = _userinfo($mobile);
						$content = $_content;
						if($user) eval("\$content = \"$content\";");
						$content = strip_sms($content);
						$sms_code = send_sms($mobile, $content);
						if(strpos($sms_code, $DT['sms_ok']) !== false) {
							$s++;
						} else {
							$f++;
						}
					}
				}
				dmsg('发送成功('.$s.'),发送失败('.$f.')', $forward);
			} else if($sendtype == 3) {
				if(isset($id)) {
					$data = cache_read($_username.'_sendsms.php');
					$content = $data['content'];
					$mobilelist = $data['mobilelist'];
				} else {
					$id = $s = $f = 0;
					$content or msg('请填写短信内容');
					$mobilelist or msg('请选择号码列表');
					$data = array();
					$data['mobilelist'] = $mobilelist;
					$data['content'] = $content;
					cache_write($_username.'_sendsms.php', $data);
				}
				$_content = $content;
				$pernum = intval($pernum);
				if(!$pernum) $pernum = 10;
				$mobiles = file_get(DT_ROOT.'/file/mobile/'.$mobilelist);
				$mobiles = explode("\n", $mobiles);
				for($i = 1; $i <= $pernum; $i++) {
					$mobile = trim($mobiles[$id++]);
					if(is_mobile($mobile)) {
						$user = _userinfo($mobile);
						$content = $_content;
						if($user) eval("\$content = \"$content\";");
						$content = strip_sms($content);
						$sms_code = send_sms($mobile, $content);
						if(strpos($sms_code, $DT['sms_ok']) !== false) {
							$s++;
						} else {
							$f++;
						}
					}
				}
				if($id < count($mobiles)) {
					msg('已发送('.$id.')条短信，('.$s.')成功('.$f.')失败，系统将自动继续，请稍候...', '?moduleid='.$moduleid.'&file='.$file.'&sendtype=3&id='.$id.'&s='.$s.'&f='.$f.'&pernum='.$pernum.'&send=1');
				}
				cache_delete($_username.'_sendsms.php');
				dmsg('发送成功('.$s.'),发送失败('.$f.')', '?moduleid='.$moduleid.'&file='.$file);
			}
		} else {
			isset($mobile) or $mobile = '';
			include tpl('sms', $module);
		}
	break;
}
?>