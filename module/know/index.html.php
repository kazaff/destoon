<?php 
defined('IN_DESTOON') or exit('Access Denied');
$fileroot = DT_ROOT.'/'.$MOD['moduledir'].'/';
$filename = $fileroot.$DT['index'].'.'.$DT['file_ext'];
if(!$MOD['index_html']) {
	if(is_file($filename)) unlink($filename);
	return false;
}
include DT_ROOT.'/include/seo.inc.php';
if($MOD['seo_index']) {
	eval("\$seo_title = \"$MOD[seo_index]\";");
} else {
	$seo_title = $seo_modulename.$seo_delimiter.$seo_sitename;
}
$destoon_task = "moduleid=$moduleid&html=index";
ob_start();
include template('index', $module);
$data = ob_get_contents();
ob_clean();
file_put($filename, $data);
return true;
?>