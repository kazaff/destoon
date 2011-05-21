<?php
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('充值记录', '?moduleid='.$moduleid.'&file=charge'),
    array('交易记录', '?moduleid='.$moduleid.'&file=trade'),
    array('提现记录', '?moduleid='.$moduleid.'&file=cash'),
    array('信息支付', '?moduleid='.$moduleid.'&file=pay'),
);
$_status = array(
	'<span style="color:#0000FF;">买家发起订单<br/>等待卖家确认</span>',
	'<span style="color:#FF6600;">卖家已确认订单<br/>等待买家付款</span>',
	'<span style="color:#008080;">买家已付款<br/>等待卖家发货</span>',
	'<span style="color:#FF0000;">卖家已发货<br/>等待买家确认</span>',
	'<span style="color:#008000;">交易成功</span>',
	'<span style="color:#FF0000;text-decoration:underline;">买家申请退款</span>',
	'<span style="color:#0000FF;text-decoration:underline;">已退款给买家</span>',
	'<span style="color:#FF6600;text-decoration:underline;">已付款给卖家</span>',
	'<span style="color:#888888;text-decoration:line-through;">买家关闭交易</span>',
	'<span style="color:#888888;text-decoration:line-through;">卖家关闭交易</span>',
);
$dstatus = array(
	'买家发起订单,等待卖家确认',
	'卖家已确认订单,等待买家付款',
	'买家已付款,等待卖家发货',
	'卖家已发货,等待买家确认',
	'交易成功',
	'买家申请退款',
	'已退款给买家',
	'已付款给卖家',
	'买家关闭交易',
	'卖家关闭交易',
);
$table = $DT_PRE.'finance_trade';
if($action == 'refund' || $action == 'show') {
	$itemid or msg('未指定记录');
	$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid ");
	$item or msg('记录不存在');
	$item['money'] = $item['amount'] + $item['fee'];
	$item['addtime'] = timetodate($item['addtime'], 5);
	$item['updatetime'] = timetodate($item['updatetime'], 5);
}
switch($action) {
	case 'refund':
		if($item['status'] != 5) msg('此交易无需受理');
		if($submit) {
			isset($status) or msg('请指定受理结果');
			$content or msg('请填写操作理由');
			if($status == 6) {//已退款，买家胜 退款
				$db->query("UPDATE {$DT_PRE}member SET money=money+$item[money],locking=locking-$item[money] WHERE username='$item[buyer]'");
				$msg = '受理成功，交易状态已经改变为 已退款给买家';
			} else if($status == 7) {//已退款，卖家胜 付款			
				locking($item['buyer'], -$item['money']);
				money_record($item['buyer'], -$item['money'], '站内', 'system', '订单货到付款', '订单号:'.$itemid);
				money_add($item['seller'], $item['money']);
				money_record($item['seller'], $item['money'], '站内', 'system', '订单货到付款', '订单号:'.$itemid);
				$msg = '受理成功，交易状态已经改变为 已付款给卖家';
			} else {
				msg();
			}
			$db->query("UPDATE {$table} SET status=$status,editor='$_username',updatetime=$DT_TIME,refund_reason='$content' WHERE itemid=$itemid");
			msg($msg, $forward, 5);
		} else {
			include tpl('trade_refund', $module);
		}
	break;
	case 'show':
		include tpl('trade_show', $module);
	break;
	case 'delete':
		$itemid or msg('未选择记录');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$table} WHERE itemid IN ($itemids)");
		dmsg('删除成功', $forward);
	break;
	default:
		$sfields = array('按条件', '商品/服务', '卖家', '买家', '订单金额', '附加金额', '附加名称', '买家名称', '买家地址', '买家邮编', '买家电话', '买家物流', '发货物流', '发货单号', '备注');
		$dfields = array('title', 'title', 'seller', 'buyer', 'amount', 'fee', 'fee_name', 'buyer_name', 'buyer_address', 'buyer_postcode', 'buyer_phone', 'buyer_receive', 'send_type', 'send_no', 'note');
		$sorder  = array('排序方式', '下单时间降序', '下单时间升序', '更新时间降序', '更新时间升序', '订单金额降序', '订单金额升序', '附加金额降序', '附加金额升序');
		$dorder  = array('itemid DESC', 'addtime DESC', 'addtime ASC', 'updatetime DESC', 'updatetime ASC', 'amount DESC', 'amount ASC', 'fee DESC', 'fee ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		$status = isset($status) && isset($dstatus[$status]) ? intval($status) : '';
		isset($seller) or $seller = '';
		isset($buyer) or $buyer = '';
		isset($amounts) or $amounts = '';
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($dfromtime) or $dfromtime = '';
		isset($dtotime) or $dtotime = '';
		isset($timetype) or $timetype = 'addtime';
		isset($mtype) or $mtype = 'money';
		isset($minamount) or $minamount = '';
		isset($maxamount) or $maxamount = '';
		isset($order) && isset($dorder[$order]) or $order = 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$status_select = dselect($dstatus, 'status', '状态', $status, 'style="width:165px;"', 1, '', 1);
		$order_select = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($fromtime) $condition .= " AND $timetype>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND $timetype<".(strtotime($totime.' 23:59:59'));
		if($status !== '') $condition .= " AND status='$status'";
		if($seller) $condition .= " AND seller='$seller'";
		if($buyer) $condition .= " AND buyer='$buyer'";
		if($itemid) $condition .= " AND itemid=$itemid";
		//if($amounts) $condition .= " AND `amount`+`fee`=$amounts";
		if($mtype == 'money') $mtype = "`amount`+`fee`";
		if($minamount != '') $condition .= " AND $mtype>=$minamount";
		if($maxamount != '') $condition .= " AND $mtype<=$maxamount";
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$trades = array();
		$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY $dorder[$order] LIMIT $offset,$pagesize");
		$amount = $fee = $money = 0;
		while($r = $db->fetch_array($result)) {
		$r['addtime'] = str_replace(' ', '<br/>', timetodate($r['addtime'], 5));
		$r['updatetime'] = str_replace(' ', '<br/>', timetodate($r['updatetime'], 5));
			$r['dstatus'] = $_status[$r['status']];
			$r['money'] = $r['amount'] + $r['fee'];
			$amount += $r['amount'];
			$fee += $r['fee'];
			$trades[] = $r;
		}
		$money = $amount + $fee;
		include tpl('trade', $module);
}
?>