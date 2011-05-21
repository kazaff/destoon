<?php
defined('IN_DESTOON') or exit('Access Denied');
$TYPE = get_type('ask', 1);
$TYPE or msg('启用客服中心，请先添加问题分类', '?file=type&item=ask');
$menus = array (
    array('客服中心', '?moduleid='.$moduleid.'&file='.$file),
    array('分类管理', '?file=type&item=ask'),
);
$stars = array('', '<span style="color:red;">不满意</span>', '基本满意', '<span style="color:green;">非常满意</span>');
switch($action) {
	case 'edit':
		$itemid or msg();
		if($submit) {
			if($status == 2 && !$reply) msg('回复内容不能为空');
			$db->query("UPDATE {$DT_PRE}ask SET status=$status,admin='$_username',admintime='$DT_TIME',reply='$reply' WHERE itemid=$itemid");
			dmsg('受理成功', $forward);
		} else {
			$r = $db->get_one("SELECT * FROM {$DT_PRE}ask WHERE itemid=$itemid");
			$r or msg();
			extract($r);
			$addtime = timetodate($addtime, 5);
			$admintime = timetodate($admintime, 5);
			include tpl('ask_edit', $module);
		}
	break;
	case 'delete':
		$itemid or msg();
		$db->query("DELETE FROM {$DT_PRE}ask WHERE itemid=$itemid ");
		dmsg('删除成功', '?moduleid='.$moduleid.'&file='.$file);
	break;
	default:
		$_status = array('待受理', '<span style="color:blue;">受理中</span>', '<span style="color:green;">已解决</span>', '<span style="color:red;">未解决</span>');
		$sfields = array('按条件', '标题', '内容', '会员名', '回复', '受理人');
		$dfields = array('title', 'title', 'content', 'username', 'reply', 'admin');
		$dstatus = array('待受理', '受理中', '已解决', '未解决');
		$sorder  = array('结果排序方式', '提交时间降序', '提交时间升序', '受理时间降序', '受理时间升序', '会员评分降序', '会员评分升序');
		$dorder  = array('itemid DESC', 'itemid DESC', 'itemid ASC', 'admintime DESC', 'admintime ASC', 'star DESC', 'star ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($typeid) or $typeid = 0;
		$status = isset($status) && isset($dstatus[$status]) ? intval($status) : '';
		isset($order) && isset($dorder[$order]) or $order = 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$type_select   = type_select('ask', 1, 'typeid', '请选择分类', $typeid);
		$status_select = dselect($dstatus, 'status', '受理状态', $status, '', 1, '', 1);
		$order_select  = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($typeid > 0) $condition .= " AND typeid=$typeid";
		if($status !== '') $condition .= " AND status=$status";
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}ask WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$asks = array();
		$result = $db->query("SELECT * FROM {$DT_PRE}ask WHERE $condition ORDER BY $dorder[$order] LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$r['dstatus'] = $_status[$r['status']];
			$r['type'] = $r['typeid'] && isset($TYPE[$r['typeid']]) ? set_style($TYPE[$r['typeid']]['typename'], $TYPE[$r['typeid']]['style']) : '默认';
			$asks[] = $r;
		}
		include tpl('ask', $module);
	break;
}
?>