<?php
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array($DT['credit_name'].'奖惩', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array($DT['credit_name'].'记录', '?moduleid='.$moduleid.'&file='.$file),
);
$BANKS = explode('|', trim($MOD['pay_banks']));
$table = $DT_PRE.'finance_credit';
switch($action) {
	case 'add':
		if($submit) {
			$username or msg('请填写会员名');
			$amount or msg('请填写分值');
			$reason or msg('请填写事由');
			$amount = intval($amount);
			if($amount <= 0) msg('分值格式错误');
			$username = trim($username);
			$r = $db->get_one("SELECT username,credit FROM {$DT_PRE}member WHERE username='$username'");
			if(!$r) msg('会员不存在');
			if(!$type) {
				if($r['credit'] < $amount) msg('会员'.$DT['credit_name'].'不足，当前'.$DT['credit_name'].'为:'.$r['credit']);
				$amount = -$amount;
			}
			$reason or $reason = '奖励';
			$note or $note = '手工';
			credit_add($username, $amount);
			credit_record($username, $amount, $_username, $reason, $note);
			dmsg('添加成功', '?moduleid='.$moduleid.'&file='.$file);
		} else {
			include tpl('credits_add', $module);
		}
	break;
	case 'delete':
		$itemid or msg('未选择记录');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$table} WHERE itemid IN ($itemids)");
		dmsg('删除成功', $forward);
	break;
	default:
		$sfields = array('按条件', '会员名', '金额', '事由', '备注', '操作人');
		$dfields = array('username', 'username', 'amount', 'reason', 'note', 'editor');
		$sorder  = array('排序方式', '金额降序', '金额升序', '时间降序', '时间升序');
		$dorder  = array('itemid DESC', 'amount DESC', 'amount ASC', 'addtime DESC', 'addtime ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($username) or $username = '';
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($dfromtime) or $dfromtime = '';
		isset($dtotime) or $dtotime = '';
		isset($type) or $type = 0;
		isset($mtype) or $mtype = 'amount';
		isset($minamount) or $minamount = '';
		isset($maxamount) or $maxamount = '';

		isset($order) && isset($dorder[$order]) or $order = 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$order_select = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
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
		include tpl('credits', $module);
	break;
}
?>