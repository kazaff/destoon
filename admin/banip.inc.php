<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('IP禁止', '?file='.$file),
    array('清空过期', '?file='.$file.'&action=clear'),
    array('登录锁定', '?file='.$file.'&action=ban'),
);
switch($action) {
	case 'add':
		if(!$ip) msg('请填写IP地址或IP段');
		$ip = trim($ip);
		if(!preg_match("/^[0-9]{1,3}\.[0-9\*]{1,3}\.[0-9\*]{1,3}\.[0-9\*]{1,3}$/", $ip)) msg('IP地址或IP段格式错误');
		$totime = $todate ? strtotime($todate.' 00:00:00') : 0;
		$db->query("INSERT INTO {$DT_PRE}banip (ip,editor,addtime,totime) VALUES ('$ip','$_username','$DT_TIME','$totime')");
		dmsg('添加成功', '?file='.$file);
	break;
	case 'delete':
		$itemid or msg();
		$db->query("DELETE FROM {$DT_PRE}banip WHERE itemid='$itemid'");
		dmsg('删除成功', '?file='.$file);
	break;
	case 'clear':
		$db->query("DELETE FROM {$DT_PRE}banip WHERE totime>0 and totime<$DT_TIME");
		dmsg('清空成功', '?file='.$file);
	break;
	case 'unban':
		$ip or msg('IP不能为空');
		if(is_array($ip)) {
			foreach($ip as $v) {
				file_del(DT_CACHE.'/ban/'.$v.'.php');
			}
		} else {
			file_del(DT_CACHE.'/ban/'.$ip.'.php');
		}
		dmsg('删除成功', '?file='.$file.'&action=ban');
	break;
	case 'ban':
		$ips = glob(DT_CACHE.'/ban/*.php');
		$lists = array();
		if($ips) {
			foreach($ips as $k=>$v) {
				$lists[$k]['ip'] = basename($v, '.php');
				$lists[$k]['addtime'] = timetodate(filemtime($v), 5);
			}
		}
		include tpl('banip_ban');
	break;
	default:	
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}banip");
		$pages = pages($r['num'], $page, $pagesize);		
		$lists = array();
		$result = $db->query("SELECT * FROM {$DT_PRE}banip ORDER BY itemid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$r['status'] = ($r['totime'] && $DT_TIME >  $r['totime']) ? '<span style="color:red;">过期</span>' : '<span style="color:blue;">有效</span>';
			$r['totime'] = $r['totime'] ? timetodate($r['totime'], 3) : '永久';
			$lists[] = $r;
		}
		cache_banip();
		include tpl('banip');
	break;
}
?>