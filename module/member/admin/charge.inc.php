<?php
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('充值记录', '?moduleid='.$moduleid.'&file=charge'),
    array('交易记录', '?moduleid='.$moduleid.'&file=trade'),
    array('提现记录', '?moduleid='.$moduleid.'&file=cash'),
    array('信息支付', '?moduleid='.$moduleid.'&file=pay'),
);
$PAY = cache_read('pay.php');
$PAY['card']['name'] = '充值卡';
$dstatus = array('未知', '失败', '作废', '成功', '人工');
$table = $DT_PRE.'finance_charge';
switch($action) {
	case 'check':	
		$itemid or msg('请选择记录');
		$itemid = implode(',', $itemid);
		$result = $db->query("SELECT * FROM {$table} WHERE itemid IN ($itemid) AND status<2");
		$i = 0;
		while($r = $db->fetch_array($result)) {
			$money = $r['amount'] + $r['fee'];
			money_add($r['username'], $r['amount']);
			money_record($r['username'], $r['amount'], $PAY[$r['bank']]['name'], $_username, '在线充值', '人工');
			$db->query("UPDATE {$table} SET money='$money',status=4,editor='$_username',receivetime=$DT_TIME WHERE itemid=$r[itemid]");
			$i++;
		}
		dmsg('审核成功'.$i.'条记录', $forward);
	break;
	case 'recycle':
		$itemid or msg('请选择记录');
		$itemid = implode(',', $itemid);
		$db->query("UPDATE {$table} SET status=2,editor='$_username',receivetime=$DT_TIME WHERE itemid IN ($itemid) AND status=0");
		dmsg('作废成功'.$db->affected_rows().'条记录', $forward);
	break;
	case 'delete':
		$itemid or msg('请选择记录');
		$itemid = implode(',', $itemid);
		$db->query("DELETE FROM {$table} WHERE itemid IN ($itemid) AND status=0");
		dmsg('删除成功'.$db->affected_rows().'条记录', $forward);
	break;
	default:
		$_status = array('<span style="color:blue;">未知</span>', '<span style="color:red;">失败</span>', '<span style="color:#FF00FF;">作废</span>', '<span style="color:green;">成功</span>', '<span style="color:green;">人工</span>');
		$sfields = array('按条件', '会员名', '充值金额', '手续费', '实收金额', '备注', '操作人');
		$dfields = array('username', 'username', 'amount', 'fee', 'money', 'note', 'editor');
		$sorder  = array('结果排序方式', '充值金额降序', '充值金额升序', '手续费降序', '手续费升序', '实收金额降序', '实收金额升序', '下单时间降序', '下单时间升序', '支付时间降序', '支付时间升序');
		$dorder  = array('itemid DESC', 'amount DESC', 'amount ASC', 'fee DESC', 'fee ASC', 'money DESC', 'money ASC', 'sendtime DESC', 'sendtime ASC', 'reveicetime DESC', 'reveicetime ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($username) or $username = '';
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($dfromtime) or $dfromtime = '';
		isset($dtotime) or $dtotime = '';
		isset($bank) or $bank = '';
		isset($timetype) or $timetype = 'sendtime';
		isset($mtype) or $mtype = 'amount';
		isset($minamount) or $minamount = '';
		isset($maxamount) or $maxamount = '';

		$status = isset($status) && isset($dstatus[$status]) ? intval($status) : '';
		isset($order) && isset($dorder[$order]) or $order = 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$status_select = dselect($dstatus, 'status', '状态', $status, '', 1, '', 1);
		$order_select  = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($bank) $condition .= " AND bank='$bank'";
		if($fromtime) $condition .= " AND $timetype>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND $timetype<".(strtotime($totime.' 23:59:59'));
		if($status !== '') $condition .= " AND status=$status";
		if($username) $condition .= " AND username='$username'";
		if($itemid) $condition .= " AND itemid=$itemid";
		if($minamount != '') $condition .= " AND $mtype>=$minamount";
		if($maxamount != '') $condition .= " AND $mtype<=$maxamount";
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$charges = array();
		$amount = $fee = $money = 0;
		$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY $dorder[$order] LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['sendtime'] = timetodate($r['sendtime'], 5);
			$r['receivetime'] = $r['receivetime'] ? timetodate($r['receivetime'], 5) : '--';
			$r['editor'] or $r['editor'] = 'system';
			$r['dstatus'] = $_status[$r['status']];
			$amount += $r['amount'];
			$fee += $r['fee'];
			$money += $r['money'];
			$charges[] = $r;
		}
		include tpl('charge', $module);
	break;
}
?>