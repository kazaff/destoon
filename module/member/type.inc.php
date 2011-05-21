<?php 
defined('IN_DESTOON') or exit('Access Denied');
login();
require DT_ROOT.'/module/'.$module.'/common.inc.php';
require DT_ROOT.'/include/post.func.php';
isset($item) or message();
$names = $L['type_names'];
isset($names[$item]) or message();
require DT_ROOT.'/include/type.class.php';
$do = new dtype;
$do->item = $item.'-'.$_userid;

if($submit) {
	if($MG['type_limit'] && $type[0]['typename'] && count($type) > $MG['type_limit']) dalert(lang($L['type_msg_limit'], array($MG['type_limit'])), 'goback');
	$do->update($type);
	dmsg($L['op_update_success'], '?item='.$item);
} else {
	$head_title = lang($L['type_title'], array($names[$item]));
	$types = $do->get_list();
	foreach($types as $k=>$v) {
		$types[$k]['style_select'] = dstyle('type['.$v['typeid'].'][style]', $v['style']);
	}
	$new_style = dstyle('type[0][style]');
	include template('type', $module);
}
?>