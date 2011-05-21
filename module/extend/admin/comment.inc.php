<?php
defined('IN_DESTOON') or exit('Access Denied');
require MD_ROOT.'/comment.class.php';
$do = new comment();
$menus = array (
    array('评论列表', '?moduleid='.$moduleid.'&file='.$file),
    array('评论审核', '?moduleid='.$moduleid.'&file='.$file.'&action=check'),
    array('评论禁止', '?moduleid='.$moduleid.'&file='.$file.'&action=ban'),
    array('评论设置', '?moduleid='.$moduleid.'&file=setting#comment'),
);
$this_forward = '?moduleid='.$moduleid.'&file='.$file;
if(in_array($action, array('', 'check'))) {
	$sfields = array('内容', '原文标题', '原文链接', '会员名', 'IP', '原文ID', '评论ID');
	$dfields = array('content', 'item_title', 'item_linkurl', 'username', 'ip', 'item_id', 'itemid');
	$sorder  = array('结果排序方式', '添加时间降序', '添加时间升序', '回复时间降序', '回复时间升序', '引用次数降序', '引用次数升序', '支持次数降序', '支持次数升序', '反对次数降序', '反对次数升序', '评分高低降序', '评分高低升序');
	$dorder  = array('itemid desc', 'addtime DESC', 'addtime ASC', 'replytime DESC', 'replytime ASC', 'quote DESC', 'quote ASC', 'agree DESC', 'agree ASC', 'against DESC', 'against ASC', 'star DESC', 'star ASC');

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;
	isset($ip) or $ip = '';
	$mid = isset($mid) ? intval($mid) : 0;

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$module_select = module_select('mid', '模块', $mid);
	$order_select  = dselect($sorder, 'order', '', $order);

	$condition = '';
	if($keyword) $condition .= in_array($dfields[$fields], array('item_id', 'itemid', 'ip')) ? " AND $dfields[$fields]='$kw'" : " AND $dfields[$fields] LIKE '%$keyword%'";
	if($mid) $condition .= " AND item_mid='$mid'";
	if($ip) $condition .= " AND ip='$ip'";
}
switch($action) {
	case 'edit':
		$itemid or msg();
		$do->itemid = $itemid;
		if($submit) {
			if($do->pass($post)) {
				$do->edit($post);
				dmsg('修改成功', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			extract($do->get_one());
			$addtime = timetodate($addtime);
			$replytime = $replytime ? timetodate($replytime, 6) : '';
			include tpl('comment_edit', $module);
		}
	break;
	case 'ban':
		if($submit) {
			$do->ban_update($post);
			dmsg('更新成功', '?moduleid='.$moduleid.'&file='.$file.'&action=ban&page='.$page);
		} else {
			$condition = 1;
			$mid = isset($mid) ? intval($mid) : 0;
			if($mid) $condition = "moduleid=$mid";
			$lists = $do->get_ban_list($condition);
			include tpl('comment_ban', $module);
		}
	break;
	case 'delete':
		$itemid or msg('请选择评论');
		$do->delete($itemid);
		dmsg('删除成功', $this_forward);
	break;
	case 'check':
		if($itemid) {
			$status = $status == 3 ? 3 : 2;
			$do->check($itemid, $status);
			dmsg($status == 3 ? '审核成功' : '取消成功', $forward);
		} else {
			$lists = $do->get_list('status=2'.$condition, $dorder[$order]);
			$menuid = 1;
			include tpl('comment', $module);
		}
	break;
	default:
		$lists = $do->get_list('status=3'.$condition, $dorder[$order]);
		$menuid = 0;
		include tpl('comment', $module);
	break;
}
?>