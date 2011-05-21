<?php
/*
	[Destoon B2C System] Copyright (c) 2009 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$pid = isset($pid) ? intval($pid) : 0;
$menus = array (
    array('产品管理', '?moduleid='.$moduleid.'&file='.$file.'&pid='.$pid),
    array('添加属性', '?moduleid='.$moduleid.'&file='.$file.'&pid='.$pid.'&action=add'),
    array('属性参数', '?moduleid='.$moduleid.'&file='.$file.'&pid='.$pid.'&action=manage'),
    array('更新缓存', '?moduleid='.$moduleid.'&file='.$file.'&pid='.$pid.'&action=cache'),
);
$TYPE = array('分隔符', '单行文本(text)', '多行文本(textarea)', '列表选择(select)', '复选框(checkbox)');
require MD_ROOT.'/product.class.php';
$do = new product;
switch($action) {
	case 'add':
		if($submit) {
			if($do->pass($post)) {
				$do->add($post);
				dmsg('添加成功', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&pid='.$post['pid']);
			} else {
				msg($do->errmsg);
			}
		} else {
			$product_select = product_select('post[pid]', '产品类型', $pid, 'id="pid"');
			$type = 1;
			$required = 0;
			$name = $value = $extend = '';
			include tpl('option_edit', $module);
		}
	break;
	case 'edit':
		$oid or msg();
		$do->oid = $oid;
		if($submit) {
			if($do->pass($post)) {
				$do->edit($post);
				dmsg('修改成功', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			extract($do->get_one($oid));
			$product_select = product_select('post[pid]', '产品类型', $pid, 'id="pid"');
			include tpl('option_edit', $module);
		}
	break;
	case 'order':
		$do->order($listorder, $pid);
		dmsg('排序成功', $forward);
	break;
	case 'delete':
		$oid or msg();
		$do->oid = $oid;
		$do->delete($pid);
		dmsg('删除成功', '?moduleid='.$moduleid.'&file='.$file.'&action=manage&pid='.$pid);
	break;
	case 'manage':
		$PRODUCT = cache_read('product.php');
		$lists = $do->get_list($pid);
		include tpl('option', $module);
	break;
	case 'cache':
		cache_product();
		cache_option();
		dmsg('更新成功', $forward);
	break;
	case 'copy':
		$fpid or msg('请填写源产品ID');
		$tpid or msg('请填写目标产品ID');
		$F = cache_read('option-'.$fpid.'.php');
		count($F) > 0 or msg('请设置源产品属性');
		$tpid = explode(',', $tpid);
		foreach($tpid as $pid) {
			$pid = intval($pid);
			if(!$pid) continue;
			foreach($F as $f) {
				$r = $db->get_one("SELECT * FROM {$DT_PRE}sell_option WHERE pid='$pid' AND name='$f[name]'");
				$f = daddslashes($f);
				if($r) {
					$db->query("UPDATE {$DT_PRE}sell_option SET type='$f[type]',required='$f[required]',value='$f[value]',extend='$f[extend]',listorder='$f[listorder]' WHERE oid=$r[oid]");
				} else {
					$db->query("INSERT INTO {$DT_PRE}sell_option (pid,type,required,name,value,extend,listorder) VALUES ('$pid','$f[type]','$f[required]','$f[name]','$f[value]','$f[extend]','$f[listorder]')");
				}
			}
			cache_option($pid);
		}
		dmsg('同步成功', $forward);
	break;
	default:
		if($submit) {
			$do->update($post);
			dmsg('更新成功', '?moduleid='.$moduleid.'&file='.$file);
		} else {
			$condition = "1";
			if($keyword) $condition = "title LIKE '%$keyword%'";
			$lists = $do->_get_list($condition);
			include tpl('product', $module);
		}
	break;
}
?>