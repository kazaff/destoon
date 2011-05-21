<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
function product_update($post_product, $itemid, $pid) {
	global $db;
	if(!$post_product || !$pid) return;
	if(!defined('DT_ADMIN')) $post_product = dhtmlspecialchars($post_product);	
	$db->query("DELETE FROM {$db->pre}sell_value WHERE itemid=$itemid");
	$ppt = array();
	$OP = cache_read('option-'.$pid.'.php');
	foreach($OP as $v) {
		if($v['type'] > 2 && $v['required']) $ppt[] = $v['oid'];
	}
	$pptword = '';
	foreach($post_product as $k=>$v) {
		if(is_array($v)) $v = implode(',', $v);
		if(in_array($k, $ppt)) $pptword .= 'O'.$k.$v.';';
		$db->query("INSERT INTO {$db->pre}sell_value (oid,itemid,value) VALUES ('$k','$itemid','$v')");
	}
	if($pptword) $db->query("UPDATE {$db->pre}sell SET pptword='$pptword' WHERE itemid=$itemid");
}

function product_check($post_product) {
	//
}

function product_html($var, $oid, $type, $value, $extend = '') {
	global $L;
	$str = '';
	if($type == 1) {
		$str = '<input type="text" size="50" name="post_product['.$oid.']" id="product-'.$oid.'" value="'.($var ? $var : $value).'" '.$extend.'/>';
	} else if($type == 2) {
		$str = '<textarea name="post_product['.$oid.']" id="product-'.$oid.'" rows="5" cols="80" '.$extend.'>'.($var ? $var : $value).'</textarea>';
	} else if($type == 3) {
		$str = '<select name="post_product['.$oid.']" id="product-'.$oid.'" '.$extend.'><option value="">'.$L['choose'].'</option>';
		$ops = explode('|', $value);
		foreach($ops as $o) {
			if($var) {
				$o = str_replace('(*)', '', $o);
				$selected = $o == $var ? ' selected' : '';
			} else {
				$selected = strpos($o, '(*)') !== false ? ' selected' : '';
				$o = str_replace('(*)', '', $o);
			}
			$str .= '<option value="'.$o.'"'.$selected.'>'.$o.'</option>';
		}
		$str .= '</select>';
	} else if($type == 4) {
		$str = '<span id="product-'.$oid.'" '.$extend.'>';
		$ops = explode('|', $value);
		foreach($ops as $o) {
			if($var) {
				$o = str_replace('(*)', '', $o);
				$tmp = explode(',', $var);
				$selected = in_array($o, $tmp) ? ' checked' : '';
			} else {
				$selected = strpos($o, '(*)') !== false ? ' checked' : '';
				$o = str_replace('(*)', '', $o);
			}
			$str .= '<input type="checkbox" name="post_product['.$oid.'][]" value="'.$o.'"'.$selected.'>'.$o.'&nbsp;&nbsp;';
		}
		$str .= '</span>';
	}
	return $str;
}

function get_product_select($title = '', $catid = 0, $pid = 0, $extend = '') {
	$have = false;
	$unit = '<select id="product_unit" style="display:none;"><option value="0"></option>';
	$select = '<select onchange="load_product_option(this.value, this.options[this.selectedIndex].innerHTML, this.selectedIndex);" '.$extend.'>';
	if($title) $select .= '<option value="0" style="background:#FF6600;">'.$title.'</option>';
	if($catid) {
		$PRODUCT = cache_read('product.php');
		foreach($PRODUCT as $v) {
			if($v['catid'] == $catid) {
				$have = true;
				$select .= '<option value="'.$v['pid'].'"'.($v['pid'] == $pid ? ' selected' : '').'>'.$v['title'].'</option>';
				$unit .= '<option value="'.$v['pid'].'">'.$v['unit'].'</option>';
			}
		}
	}
	$select .= '</select>';
	$unit .= '</select>';
	return $have ? $select.$unit : '';
}

function ajax_product_select($name = 'pid', $title = '', $catid = 0, $pid = 0, $itemid = 0, $extend = 'size="2" style="height:120px;width:180px;"') {
	$pid = intval($pid);
	$catid = intval($catid);
	return '<input name="'.$name.'" id="pid" type="hidden" value="'.$pid.'"/><span id="load_product">'.get_product_select($title, $catid, $pid, $extend).'</span><script type="text/javascript">var product_title = \''.$title.'\';var product_pid = '.$pid.';var product_catid = '.$catid.';var product_itemid = '.$itemid.';var product_extend = \''.$extend.'\';</script><script type="text/javascript" src="'.DT_PATH.'file/script/product.js"></script>'.($pid ? '<script type="text/javascript">load_product_option('.$pid.');</script>' : '');
}
?>