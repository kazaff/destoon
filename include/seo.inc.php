<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$seo_modulename = $MOD['name'];
$seo_sitename = $DT['sitename'];
$seo_sitetitle = $DT['seo_title'];
$seo_delimiter = $DT['seo_delimiter'];
$seo_page = $page > 1 ? lang($L['seo_page'], array($page)).$seo_delimiter : '';
$seo_catname = $seo_cattitle = $seo_parentname = '';
if($catid && isset($CATEGORY[$catid])) {
	isset($CAT) or $CAT = get_cat($catid);
	if($CATEGORY[$catid]['parentid']) {
		$seo_catname = '';
		$tmp = strip_tags(cat_pos($catid, 'DESTOON'));
		$tmp = explode('DESTOON', $tmp);
		$tmp = array_reverse($tmp);
		foreach($tmp as $k=>$v) {
			$seo_catname .= $v.$seo_delimiter;
		}
	} else {
		$seo_catname = $CAT['catname'].$seo_delimiter;
	}
	$seo_cattitle = $CAT['seo_title'] ? $CAT['seo_title'].$seo_delimiter : $seo_catname;
}
$seo_areaname = (isset($areaid) && $areaid) ? area_pos($areaid, $seo_delimiter).$seo_delimiter : '';
$seo_showtitle = isset($title) ? $title : '';
?>