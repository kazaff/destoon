<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('上传记录', '?file='.$file),
);
switch($action) {
	case 'delete':
		$itemid or msg('请选择记录');
		$ids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$result = $db->query("SELECT fileurl FROM {$DT_PRE}upload WHERE pid IN ($ids)");
		while($r = $db->fetch_array($result)) {
			 delete_upload($r['fileurl'], 0);
		}
		dmsg('删除成功', $forward);
	break;
	default:
		$sfields = array('按条件', '文件名', '会员', '来源', '后缀', '信息ID');
		$dfields = array('fileurl', 'fileurl', 'username', 'upfrom', 'fileext', 'itemid');
		$sorder  = array('排序方式', '文件大小降序', '文件大小升序', '上传时间降序', '上传时间升序', '图片宽度降序', '图片宽度升序', '图片高度降序', '图片高度升序');
		$dorder  = array('pid DESC', 'filesize DESC', 'filesize ASC', 'addtime DESC', 'addtime ASC', 'width DESC', 'width ASC', 'height DESC', 'height ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($order) && isset($dorder[$order]) or $order = 0;
		$username = isset($username) ? $username : '';
		$mid = isset($mid) ? intval($mid) : 0;
		$upfrom = isset($upfrom) ? $upfrom : '';
		$fromdate = isset($fromdate) ? $fromdate : '';
		$fromtime = is_date($fromdate) ? strtotime($fromdate.' 0:0:0') : 0;
		$todate = isset($todate) ? $todate : '';
		$totime = is_date($todate) ? strtotime($todate.' 23:59:59') : 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$order_select = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= $fields < 2 ? " AND $dfields[$fields] LIKE '%$keyword%'" : " AND $dfields[$fields]='$keyword'";
		if($fromtime) $condition .= " AND addtime>$fromtime";
		if($totime) $condition .= " AND addtime<$totime";
		if($mid) $condition .= " AND moduleid='$mid'";	
		if($itemid) $condition .= " AND itemid='$itemid'";	
		if($username) $condition .= " AND username='$username'";
		if($upfrom) $condition .= " AND upfrom='$upfrom'";
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$DT_PRE}upload WHERE $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$lists = array();
		$result = $db->query("SELECT * FROM {$DT_PRE}upload WHERE $condition ORDER BY $dorder[$order] LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['ext'] = file_ext($r['fileurl']);
			is_file(DT_ROOT.'/file/ext/'.$r['ext'].'.gif') or $r['ext'] = 'oth';
			if($r['filesize'] > 1024*1024*1024) {
				$r['size'] = dround($r['filesize']/1024/1024/1024, 2).'G';
			} else if($r['filesize'] > 1024*1024) {
				$r['size'] = dround($r['filesize']/1024/1024, 2).'M';
			} else {
				$r['size'] = dround($r['filesize']/1024, 2).'K';
			}
			$r['addtime'] = timetodate($r['addtime'], 6);
			$r['image'] = is_image($r['fileurl']) ? 1 : 0;
			$r['fileurl'] = str_replace('.thumb.'.$r['ext'], '', $r['fileurl']);
			$r['img_w'] = $r['width'] > 100 ? 100 : $r['width'];
			$lists[] = $r;
		}
		include tpl('upload');
	break;
}
?>