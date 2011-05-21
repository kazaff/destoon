<?php
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array($DT['money_name'].'增减', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array($DT['money_name'].'流水', '?moduleid='.$moduleid.'&file='.$file),
);
$BANKS = explode('|', trim($MOD['pay_banks']));
$table = $DT_PRE.'finance_record';
switch($action) {
	case 'add':
		if($submit) {
			$username or msg('请填写会员名');
			$amount or msg('请填写金额');
			$bank or msg('请选择支付方式');
			$reason or msg('请填写事由');
			$amount = dround($amount);
			if($amount <= 0) msg('金额格式错误');
			$username = trim($username);
			$bank = trim($bank);
			$r = $db->get_one("SELECT username,money FROM {$DT_PRE}member WHERE username='$username'");
			if(!$r) msg('会员不存在');
			if(!$type) {
				if($r['money'] < $amount) msg('会员余额不足，当前余额为:'.$r['money']);
				$amount = -$amount;
			}
			$reason or $reason = '现金';
			$note or $note = '手工';
			money_add($username, $amount);
			money_record($username, $amount, $bank, $_username, $reason, $note);
			dmsg('添加成功', '?moduleid='.$moduleid.'&file='.$file);
		} else {
			isset($username) or $username = '';
			include tpl('record_add', $module);
		}
	break;
	case 'delete':
		$itemid or msg('未选择记录');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$table} WHERE itemid IN ($itemids)");
		dmsg('删除成功', $forward);
	break;
	default:
		$sfields = array('按条件', '会员名', '金额', '银行', '事由', '备注', '操作人');
		$dfields = array('username', 'username', 'amount', 'bank', 'reason', 'note', 'editor');
		$sorder  = array('排序方式', '金额降序', '金额升序', '时间降序', '时间升序');
		$dorder  = array('itemid DESC', 'amount DESC', 'amount ASC', 'addtime DESC', 'addtime ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($username) or $username = '';
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($dfromtime) or $dfromtime = '';
		isset($dtotime) or $dtotime = '';
		isset($bank) or $bank = '';
		isset($type) or $type = 0;
		isset($mtype) or $mtype = 'amount';
		isset($minamount) or $minamount = '';
		isset($maxamount) or $maxamount = '';
		isset($order) && isset($dorder[$order]) or $order = 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$order_select = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($bank) $condition .= " AND bank='$bank'";
		if($fromtime) $condition .= " AND addtime>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND addtime<".(strtotime($totime.' 23:59:59'));
		if($type) $condition .= $type == 1 ? " AND amount>0" : " AND amount<0";
		if($username) $condition .= " AND username='$username'";
		if($itemid) $condition .= " AND itemid=$itemid";
		if($minamount != '') $condition .= " AND $mtype>=$minamount";
		if($maxamount != '') $condition .= " AND $mtype<=$maxamount";
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
		include tpl('record', $module);
	break;
}
?>