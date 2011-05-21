<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
@set_time_limit(0);
define('DT_ADMIN', true);
define('DT_MEMBER', true);
require 'common.inc.php';
$db->halt = 1;

$session = new dsession();

require DT_ROOT.'/admin/global.func.php';
require DT_ROOT.'/include/post.func.php';
require_once DT_ROOT.'/include/cache.func.php';

isset($file) or $file = 'index';

$_destoon_admin = isset($_SESSION['destoon_admin']) ? intval($_SESSION['destoon_admin']) : 0;
if($action != 'import') admin_log();

$_founder = $CFG['founderid'] == $_userid ? $_userid : 0;
$_catids = $_childs = '';
$_catid = $_child = array();
if($file != 'login') {
	if($_groupid != 1 || $_admin < 1 || !$_destoon_admin) msg('', '?file=login&forward='.urlencode($DT_URL));
	if(!admin_check()) {
		admin_log(1);
		$db->query("DELETE FROM {$db->pre}admin WHERE userid=$_userid AND url='?".$DT_QST."'");
		msg('警告！您无权进行此操作');
	}
}
if(isset($post['catid'])) $catid = $post['catid'];
$psize = isset($psize) ? intval($psize) : 0;
if($psize > 0 && $psize != $pagesize) {
	$pagesize = $psize;
	$offset = ($page-1)*$pagesize;
}
if($module == 'destoon') {
	(include DT_ROOT.'/admin/'.$file.'.inc.php') or msg();
} else {
	require DT_ROOT.'/module/'.$module.'/common.inc.php';
	(include MD_ROOT.'/admin/'.$file.'.inc.php') or msg();
}
?>