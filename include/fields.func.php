<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
function fields_update($post_fields, $table, $itemid, $keyname = 'itemid', $fd = array()) {
	global $FD, $db;
	if(!$table || !$itemid) return '';
	if($fd) $FD = $fd;
	$sql = '';
	foreach($FD as $k=>$v) {
		if(isset($post_fields[$v['name']]) || $v['html'] == 'checkbox') {
			$mk = $v['name'];
			$mv = $post_fields[$v['name']];
			if($v['html'] == 'checkbox') $mv = implode(',', $post_fields[$v['name']]);
			$sql .= ",$mk='$mv'";
		}
	}
	$sql = substr($sql, 1);
	if($sql) $db->query("UPDATE {$table} SET $sql WHERE `$keyname`=$itemid");
}

function fields_check($post_fields, $fd = array()) {
	global $FD, $session;
	include load('include.lang');
	if($fd) $FD = $fd;
	if(!is_object($session)) $session = new dsession();
	$uploads = isset($_SESSION['uploads']) ? $_SESSION['uploads'] : array();
	foreach($FD as $k=>$v) {
		$value = isset($post_fields[$v['name']]) ? $post_fields[$v['name']] : '';
		if(in_array($v['html'], array('thumb', 'file', 'editor','flv')) && $uploads) {
			foreach($uploads as $sk=>$sv) {
				if($v['html'] == 'editor') {
					if(strpos($value, $sv) !== false) unset($_SESSION['uploads'][$sk]);
				} else {
					if($sv == $value) unset($_SESSION['uploads'][$sk]);
				}
			}
		}
		if(!$v['input_limit']) continue;
		if(!defined('DT_ADMIN') && !$v['front']) continue;
		if($v['input_limit'] == 'is_date') {
			if(!is_date($value)) message(lang($L['fields_input'], array($v['title'])));
		} else if($v['input_limit'] == 'is_email') {
			if(!is_email($value)) message(lang($L['fields_valid'], array($v['title'])));
		} else if(is_numeric($v['input_limit'])) {
			$length = word_count($value);
			if($length < $v['input_limit']) message(lang($L['fields_less'], array($v['title'], $v['input_limit'])));
		} else {
			if(preg_match("/^([0-9]{1,})\-([0-9]{1,})$/", $v['input_limit'], $m)) {			
				$length = word_count($value);
				if($m[1] && $length < $m[1]) message(lang($L['fields_less'], array($v['title'], $m[1])));
				if($m[2] && $length > $m[2]) message(lang($L['fields_more'], array($v['title'], $m[2])));
			} else {
				if(!preg_match("/^".$v['input_limit']."$/", $value)) message(lang($L['fields_match'], array($v['title'])));
			}
		}
	}
}

function fields_js($fd = array()) {
	global $FD;
	if($fd) $FD = $fd;
	$js = '';
	include load('include.lang');
	foreach($FD as $k=>$v) {
		if(!$v['input_limit']) continue;
		if(!defined('DT_ADMIN') && !$v['front']) continue;
		if($v['input_limit'] == 'is_date') {
			$js .= 'f = "post_fields'.$v['name'].'";l = $(f).value.length;';
			$js .= 'if(l != 10) {Dmsg("'.lang($L['fields_input'], array($v['title'])).'", f, 1);return false;}';
		} else if($v['input_limit'] == 'is_email') {
			$js .= 'f = "'.$v['name'].'";l = $(f).value.length;';
			$js .= 'if(l < 8) {Dmsg("'.lang($L['fields_input'], array($v['title'])).'", f);return false;}';
		} else if(is_numeric($v['input_limit'])) {
			$js .= 'f = "'.$v['name'].'";l = $(f).value.length;';
			$js .= 'if(l < '.$v['input_limit'].') {Dmsg("'.lang($L['fields_less'], array($v['title'], $v['input_limit'])).'", f);return false;}';
		} else {
			if(preg_match("/^([0-9]{1,})\-([0-9]{1,})$/", $v['input_limit'], $m)) {			
				$js .= 'f = "'.$v['name'].'";l = $(f).value.length;';
				if($m[1]) $js .= 'if(l < '.$m[1].') {Dmsg("'.lang($L['fields_less'], array($v['title'], $m[1])).'", f);return false;}';
				if($m[2]) $js .= 'if(l > '.$m[2].') {Dmsg("'.lang($L['fields_more'], array($v['title'], $m[2])).'", f);return false;}';
			} else {
				$js .= 'f = "'.$v['name'].'";l = $(f).value;';
				$js .= 'if(l.match(/^'.$v['input_limit'].'$/) == null) {Dmsg("'.lang($L['fields_match'], array($v['title'])).'", f);return false;}';
			}
		}
	}
	return $js;
}

function fields_html($left = '<td class="tl">', $right = '<td>', $values = array(), $fd = array()) {
	extract($GLOBALS, EXTR_SKIP);
	if($fd) $FD = $fd;
	$html = '';
	foreach($FD as $k=>$v) {
		if(!$v['display']) continue;
		if(!defined('DT_ADMIN') && !$v['front']) continue;
		$html .= fields_show($k, $left, $right, $values, $fd);
	}
	return $html;
}

function fields_show($itemid, $left = '<td class="tl">', $right = '<td>', $values = array(), $fd = array()) {
	extract($GLOBALS, EXTR_SKIP);
	if($fd) $FD = $fd;
	if(!$values) {
		if(isset($item)) $values = $item;
		if(isset($user)) $values = $user;
	}
	$html = '';
	$v = $FD[$itemid];
	$value = '';
	if(isset($values[$v['name']])) {
		$value = $values[$v['name']];
	} else if($v['default_value']) {
		eval('$value = "'.$v['default_value'].'";');
	}
	if($v['html'] == 'hidden') {
		$html .= '<input type="hidden" name="post_fields['.$v['name'].']" id="'.$v['name'].'" value="'.$value.'" '.$v['addition'].'/>';
	} else {
		$html .= '<tr>'.$left;
		if($v['input_limit'] && !defined('DT_ADMIN')) $html .= '<span class="f_red">*</span> ';
		$html .= $v['title'];
		if($v['input_limit'] && defined('DT_ADMIN')) $html .= ' <span class="f_red">*</span>';
		$html .= '</td>';
		$html .= $right;
		switch($v['html']) {
			case 'text':
				$html .= '<input type="text" name="post_fields['.$v['name'].']" id="'.$v['name'].'" value="'.$value.'" '.$v['addition'].'/> <span class="f_red" id="d'.$v['name'].'"></span>';
			break;
			case 'textarea':
				$html .= '<textarea name="post_fields['.$v['name'].']" id="'.$v['name'].'" '.$v['addition'].'>'.$value.'</textarea> <span class="f_red" id="d'.$v['name'].'"></span>';
			break;
			case 'select':
				if($v['option_value']) {
					$html .= '<select name="post_fields['.$v['name'].']" id="'.$v['name'].'" '.$v['addition'].'><option value="">'.$L['choose'].'</option>';
					$rows = explode("*", $v['option_value']);
					foreach($rows as $row) {
						if($row) {
							$cols = explode("|", trim($row));
							$html .= '<option value="'.$cols[0].'"'.($cols[0] == $value ? ' selected' : '').'>'.$cols[1].'</option>';
						}
					}
					$html .= '</select> <span class="f_red" id="d'.$v['name'].'"></span>';
				}
			break;
			case 'radio':
				if($v['option_value']) {
					$html .= '<span id="'.$v['name'].'">';
					$rows = explode("*", $v['option_value']);
					foreach($rows as $rw => $row) {
						if($row) {
							$cols = explode("|", trim($row));
							$html .= '<input type="radio" name="post_fields['.$v['name'].']" value="'.$cols[0].'" id="'.$v['name'].'_'.$rw.'"'.($cols[0] == $value ? ' checked' : '').'> '.$cols[1].'&nbsp;&nbsp;&nbsp;';
						}
					}
					$html .= '</span> <span class="f_red" id="d'.$v['name'].'"></span>';
				}
			break;
			case 'checkbox':
				if($v['option_value']) {
					$html .= '<span id="'.$v['name'].'">';
					$value = explode(',', $value);
					$rows = explode("*", $v['option_value']);
					foreach($rows as $rw => $row) {
						if($row) {
							$cols = explode("|", trim($row));
							$html .= '<input type="checkbox" name="post_fields['.$v['name'].'][]" value="'.$cols[0].'" id="'.$v['name'].'_'.$rw.'"'.(in_array($cols[0], $value) ? ' checked' : '').'> '.$cols[1].'&nbsp;&nbsp;&nbsp;';
						}
					}
					$html .= '</span> <span class="f_red" id="d'.$v['name'].'"></span>';
				}
			break;
			case 'date':
				$html .= dcalendar('post_fields['.$v['name'].']', $value);
				$html .= ' <span class="f_red" id="post_dfields'.$v['name'].'"></span>';
			break;
			case 'thumb':
				$html .= '<input name="post_fields['.$v['name'].']" type="text" size="60" id="'.$v['name'].'" value="'.$value.'" '.$v['addition'].'/>&nbsp;&nbsp;<span onclick="Dthumb('.$moduleid.','.$v['width'].','.$v['height'].', $(\''.$v['name'].'\').value,\''.(defined('DT_ADMIN') ? '' : '1').'\',\''.$v['name'].'\');" class="jt">['.$L['upload'].']</span>&nbsp;&nbsp;<span onclick="_preview($(\''.$v['name'].'\').value);" class="jt">['.$L['preview'].']</span>&nbsp;&nbsp;<span onclick="$(\''.$v['name'].'\').value=\'\';" class="jt">['.$L['delete'].']</span>';
				$html .= ' <span class="f_red" id="d'.$v['name'].'"></span>';
			break;
			case 'file':
				$html .= '<input name="post_fields['.$v['name'].']" type="text" size="60" id="'.$v['name'].'" value="'.$value.'" '.$v['addition'].'/>&nbsp;&nbsp;<span onclick="Dfile('.$moduleid.', $(\''.$v['name'].'\').value, \''.$v['name'].'\');" class="jt">['.$L['upload'].']</span>&nbsp;&nbsp;<span onclick="if($(\''.$v['name'].'\').value) window.open($(\''.$v['name'].'\').value);" class="jt">['.$L['preview'].']</span>';
				$html .= ' <span class="f_red" id="d'.$v['name'].'"></span>&nbsp;&nbsp;<span onclick="$(\''.$v['name'].'\').value=\'\';" class="jt">['.$L['delete'].']</span>';
				//$html .= ' <span class="f_red" id="d'.$v['name'].'"></span>';
			break;
			case 'editor':
				$toolbar = isset($GLOBALS['group_editor']) ? $GLOBALS['group_editor'] : 'Default';
				$html .= '<textarea name="post_fields['.$v['name'].']" id="'.$v['name'].'" style="display:none">'.$value.'</textarea><input type="hidden" id="content___Config" value="FullPage=false"/><iframe id="content___Frame" src="'.$MODULE[2]['linkurl'].'fckeditor/editor/fckeditor.html?InstanceName='.$v['name'].'&Toolbar='.$toolbar.'" width="'.$v['width'].'" height="'.$v['height'].'" frameborder="no" scrolling="no"></iframe>';
				$html .= '<br/><span class="f_red" id="d'.$v['name'].'"></span>';
			break;
			case 'flv':
				$html .= '<input name="post_fields['.$v['name'].']" type="text" size="60" id="'.$v['name'].'" value="'.$value.'" '.$v['addition'].'/>&nbsp;&nbsp;<span onclick="Dfile('.$moduleid.', $(\''.$v['name'].'\').value, \''.$v['name'].'\');" class="jt">['.$L['upload'].']</span>&nbsp;&nbsp;<span onclick="vs();" class="jt">['.$L['preview'].']</span>';
				$html .= ' <span class="f_red" id="d'.$v['name'].'"></span>&nbsp;&nbsp;<span onclick="$(\''.$v['name'].'\').value=\'\';" class="jt">['.$L['delete'].']</span>';
				$html .= '<div id="v_player"></div>';
				$html .= <<<EOT
<script type="text/javascript">
				function vs() {
	if($('video').value.length > 5) {
		
		Ds('v_player');
		Inner('v_player', player($('video').value,'480','400',10,1)+'<br/><a href="javascript:" onclick="vh();" class="t">[关闭预览]</a>');
	} else {
		vh();
	}
}
function vh() {Inner('v_player', '');Dh('v_player');}
function player(u, w, h, p, a) {

    var w = w ? w : 480;

    var h = h ? h : 400;

    var e = t = c = '';

    if(p == 0) {

        e = 'swf';

    } else if(p == 1) {

        e = 'wma';

    } else if(p == 2) {

        e = 'rm';

    } else {

        e = ext(u);

    }

    if(e == 'rm' || e == 'rmvb' || e == 'ram') {

        t = 'audio/x-pn-realaudio-extend';

    } else if(e == 'wma' || e == 'wmv') {

        t = 'application/x-mplayer2';

        c = 'controls="imagewindow,controlpanel,statusbar"';

    } else {

        if(u.indexOf('.flv')>0 && u.indexOf('?')==-1) u = DTPath+'file/flash/flvplayer.swf?vcastr_file='+u+'&BufferTime=3&IsAutoPlay='+(a ? '1' : '0');

        t = 'application/x-shockwave-flash';

        c = 'quality="high" extendspage="http://get.adobe.com/flashplayer/" allowfullscreen="true"';//wmode="transparent"

    }

    return '<embed src="'+u+'" width="'+w+'" height="'+h+'" type="'+t+'" autostart="'+(a ? 'true' : 'false')+'" '+c+'></embed>';

}
</script>
EOT;
				//$html .= ' <span class="f_red" id="d'.$v['name'].'"></span>';
			break;
		}
		$html .= $v['note'];
		$html .= '</td></tr>';
	}
	return $html;
}
?>