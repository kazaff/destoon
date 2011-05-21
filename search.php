<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
define('DT_NONUSER', true);
require 'common.inc.php';
$URL = DT_PATH;
if($_SERVER['QUERY_STRING'] && $moduleid > 3 && !$MODULE[$moduleid]['islink']) {
	$qstr = str_replace('moduleid='.$moduleid.'&', '', $_SERVER['QUERY_STRING']);
	$qstr = str_replace('moduleid='.$moduleid, '', $qstr);
	if($qstr) {
		if($DT['rewrite']) $DT['rewrite'] = $DT['search_rewrite'];
		$URL = $MOD['linkurl'].rewrite('search.php?'.$qstr);
	} else {
		$URL = $MOD['linkurl'].'search.php';
	}
}
dheader($URL);
?>