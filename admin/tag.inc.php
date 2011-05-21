<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$menus = array (
    array('标签向导', '?file='.$file),
    array('重建缓存', '?file='.$file.'&action=cache'),
    array('模板管理', '?file=template'),
    array('风格管理', '?file=template'),
);
switch($action) {
	case 'cache':
		cache_clear('htm', 'dir', 'tag');
		dmsg('更新成功', '?file='.$file);
	break;
	case 'preview':
		$db->halt = 0;
		$destoon_task = '';
		if($tag_css) $tag_css = stripslashes($tag_css); 
		if($tag_html_s) $tag_html_s = stripslashes($tag_html_s); 
		if($tag_html_e) $tag_html_e = stripslashes($tag_html_e); 
		if($tag_code) $tag_code = stripslashes($tag_code); 
		if($tag_js) $tag_js = stripslashes($tag_js); 
		$code_eval = $code_call = $code_html = '';
		if($tag_css) $code_eval .= '<style type="text/css">'."\n".''.$tag_css.''."\n".'</style>'."\n";
		if($tag_html_s) $code_eval .= $tag_html_s."\n";
		$code_call = $code_eval;
		$code_call .= $tag_code."\n";
		$tag_code = str_replace(array('<!--{', '}-->', $tag_expires ? ', '.$tag_expires.')' : ')'), array('', '', ', -1)'), $tag_code).';';//Do Not Cache
		ob_start();
		eval($tag_code);
		$contents = ob_get_contents();
		ob_clean();
		$code_eval .= $contents."\n";
		if($tag_html_e) {
			$code_eval .= $tag_html_e;
			$code_call .= $tag_html_e;
		}
		$head_title = '标签预览';
		include tpl('tag_preview');
	break;
	default:
		$table_select = $all_select = '';
		$out = array('ad', 'ad_place', 'admin', 'alert', 'area', 'ask' ,'category', 'favorite', 'finance_cash', 'finance_charge', 'finance_record', 'finance_trade', 'friend', 'group', 'guestbook', 'keylink', 'log', 'mail', 'mail_list', 'message', 'module', 'session', 'style', 'type', 'vip');
		$query = $db->query("SHOW TABLE STATUS FROM `".$CFG['db_name']."`");
		while($r = $db->fetch_row($query)) {
			$table = $r[0];
			$alltable = preg_match("/^".$DT_PRE."/i", $table) ? substr($table, strlen($DT_PRE)) : $table.'&prefix=';
			$all_select .= '<option value="'.$alltable.'">'.$table.'</option>';
			if(substr($table, -5) == '_data' || strpos($table, '_data_') !== false) continue;
			if(preg_match("/^".$DT_PRE."/i", $table)) {
				$table = substr($table, strlen($DT_PRE));
				if(in_array($table, $out)) continue;
				$s = $db->get_one("SHOW TABLE STATUS FROM `".$CFG['db_name']."` LIKE '".$r[0]."'");
				$table_select .= '<option value="'.$table.'">'.($s['Comment'] ? $s['Comment'] : $table).'</option>';         
			}
		}
		$mid = isset($mid) ? intval($mid) : '';
		include tpl('tag');
	break;
}
?>