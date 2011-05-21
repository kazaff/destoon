<?php
defined('IN_DESTOON') or exit('Access Denied');
function ext_select($name, $value, $extend = '') {
	include DT_ROOT.'/api/filetype.inc.php';
	$value or $value = 'oth';
	$select = '<select name="'.$name.'" '.$extend.'>';
	foreach($FILETYPE as $k=>$v) {
		$select .= '<option value="'.$k.'"'.($k == $value ? ' selected' : '').'>'.$v.'</option>';
	}
	$select .= '</select>';
	return $select;
}

function unit_select($name, $value, $extend = '') {
	$UNIT = array('K', 'M', 'G', 'T');
	$value or $value = 'M';
	$select = '<select name="'.$name.'" '.$extend.'>';
	foreach($UNIT as $k=>$v) {
		$select .= '<option value="'.$v.'"'.($v == $value ? ' selected' : '').'>'.$v.'</option>';
	}
	$select .= '</select>';
	return $select;
}
?>