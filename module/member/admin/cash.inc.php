<?php
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('充值记录', '?moduleid='.$moduleid.'&file=charge'),
    array('交易记录', '?moduleid='.$moduleid.'&file=trade'),
    array('提现记录', '?moduleid='.$moduleid.'&file=cash'),
    array('信息支付', '?moduleid='.$moduleid.'&file=pay'),
);
$BANKS = explode('|', trim($MOD['cash_banks']));
$dstatus = array('等待受理', '拒绝申请', '支付失败', '付款成功');
$_status = array('<span style="color:blue;">等待受理</span>', '<span style="color:#666666;">拒绝申请</span>', '<span style="color:red;">支付失败</span>', '<span style="color:green;">付款成功</span>');
$table = $DT_PRE.'finance_cash';
if($action == 'edit' || $action == 'show') {
	$itemid or msg('未指定记录');
	$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid ");
	$item or msg('记录不存在');
	$item['addtime'] = timetodate($item['addtime'], 5);
	$item['edittime'] = timetodate($item['edittime'], 5);
	$member = $db->get_one("SELECT * FROM {$DT_PRE}member WHERE username='$item[username]'");
}
switch($action) {
	case 'edit':
		if($item['status'] > 0) msg('此申请已受理');
		if($submit) {
			isset($status) or msg('请指定受理结果');
			$money = $item['amount'] + $item['fee'];
			if($status == 3) {
				money_lock($member['username'], -$money);
				money_record($member['username'], -$item['amount'], $item['bank'], $_username, '提现成功');
				money_record($member['username'], -$item['fee'], $item['bank'], $_username, '提现手续费');
			} else if($status == 2 || $status == 1) {
				$note or msg('请填写原因备注');
				money_lock($member['username'], -$money);
				money_add($member['username'], $money);
			} else {
				msg();
			}
			$db->query("UPDATE {$table} SET status=$status,editor='$_username',edittime=$DT_TIME,note='$note' WHERE itemid=$itemid");
			dmsg('受理成功', $forward);
		} else {
			include tpl('cash_edit', $module);
		}
	break;
	case 'show':
		if($item['status'] == 0) msg('申请尚未受理');
		include tpl('cash_show', $module);
	break;
	case 'delete':
		$itemid or msg('未选择记录');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$table} WHERE itemid IN ($itemids)");
		dmsg('删除成功', $forward);
	break;
	default:
		$sfields = array('按条件', '会员名', '金额', '手续费', '收款方式', '收款帐号', '收款人', '备注', '受理人');
		$dfields = array('username', 'username', 'bank', 'amount', 'fee', 'note', 'editor');
		$sorder  = array('排序方式', '金额降序', '金额升序', '手续费降序', '手续费升序', '时间降序', '时间升序');
		$dorder  = array('itemid DESC', 'amount DESC', 'amount ASC', 'fee DESC', 'fee ASC', 'addtime DESC', 'addtime ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		$status = isset($status) && isset($dstatus[$status]) ? intval($status) : '';
		isset($username) or $username = '';
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($dfromtime) or $dfromtime = '';
		isset($dtotime) or $dtotime = '';
		isset($bank) or $bank = '';
		isset($order) && isset($dorder[$order]) or $order = 0;
		isset($timetype) or $timetype = 'addtime';
		isset($mtype) or $mtype = 'amount';
		isset($minamount) or $minamount = '';
		isset($maxamount) or $maxamount = '';
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$status_select = dselect($dstatus, 'status', '状态', $status, '', 1, '', 1);
		$order_select = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($bank) $condition .= " AND bank='$bank'";
		if($fromtime) $condition .= " AND $timetype>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND $timetype<".(strtotime($totime.' 23:59:59'));
		if($status !== '') $condition .= " AND status='$status'";
		if($username) $condition .= " AND username='$username'";
		if($itemid) $condition .= " AND itemid=$itemid";
		if($minamount != '') $condition .= " AND $mtype>=$minamount";
		if($maxamount != '') $condition .= " AND $mtype<=$maxamount";
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$cashs = array();
		$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY $dorder[$order] LIMIT $offset,$pagesize");
		$amount = $fee = 0;
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$r['edittime'] = $r['edittime'] ? timetodate($r['edittime'], 5) : '--';
			$r['dstatus'] = $_status[$r['status']];
			$amount += $r['amount'];
			$fee += $r['fee'];
			$cashs[] = $r;
		}
		include tpl('cash', $module);
	break;
}
?>