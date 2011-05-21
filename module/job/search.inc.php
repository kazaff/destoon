<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$group_search = $action == 'resume' ? $MOD['group_search_resume'] : $MOD['group_search'];
if(!check_group($_groupid, $group_search)) {
	$head_title = lang('message->without_permission');
	include template('noright', 'message');
	exit;
}
if($DT['rewrite'] && $DT['search_rewrite'] && $_SERVER["REQUEST_URI"] && $_SERVER['QUERY_STRING']) {
	$url = rewrite($_SERVER["REQUEST_URI"]);
	if($url != $_SERVER["REQUEST_URI"]) dheader($url);;
}
require DT_ROOT.'/include/post.func.php';
include load('search.lang');
$thumb = isset($thumb) ? intval($thumb) : 0;
$level = isset($level) ? intval($level) : 0;
$vip = isset($vip) ? intval($vip) : 0;
$gender = isset($gender) ? intval($gender) : 0;
$type = isset($type) ? intval($type) : 0;
$marriage = isset($marriage) ? intval($marriage) : 0;
$education = isset($education) ? intval($education) : 0;
$experience = isset($experience) ? intval($experience) : 0;
$areaid = isset($areaid) ? intval($areaid) : 0;
$minsalary = isset($minsalary) ? intval($minsalary) : 0;
$maxsalary = isset($maxsalary) ? intval($maxsalary) : 0;
$areaid = isset($areaid) ? intval($areaid) : 0;
$fromdate = isset($fromdate) && preg_match("/^([0-9]{8})$/", $fromdate) ? $fromdate : '';
$fromtime = $fromdate ? strtotime($fromdate.' 0:0:0') : 0;
$todate = isset($todate) && preg_match("/^([0-9]{8})$/", $todate) ? $todate : '';
$totime = $todate ? strtotime($todate.' 23:59:59') : 0;
$category_select = ajax_category_select('catid', $L['all_jobtype'], $catid, $moduleid);
$area_select = ajax_area_select('areaid', $L['all_area'], $areaid);
$tags = array();
if($DT_QST) {
	if($kw) {
		if(strlen($kw) < $DT['min_kw'] || strlen($kw) > $DT['max_kw']) message(lang($L['word_limit'], array($DT['min_kw'], $DT['max_kw'])), $MOD['linkurl'].'search.php');
		if($DT['search_limit'] && $page == 1) {
			if(($DT_TIME - $DT['search_limit']) < get_cookie('last_search')) message(lang($L['time_limit'], array($DT['search_limit'])), $MOD['linkurl'].'search.php');
			set_cookie('last_search', $DT_TIME);
		}
	}
	$condition = 'status=3';
	if($keyword) $condition .= " AND keyword LIKE '%$keyword%'";
	if($catid) $condition .= ($CATEGORY[$catid]['child']) ? " AND catid IN (".$CATEGORY[$catid]['arrchildid'].")" : " AND catid=$catid";
	if($areaid) $condition .= ($AREA[$areaid]['child']) ? " AND areaid IN (".$AREA[$areaid]['arrchildid'].")" : " AND areaid=$areaid";
	if($thumb) $condition .= " AND thumb!=''";
	if($vip) $condition .= " AND vip>0";
	if($minsalary)  $condition .= " AND minsalary>$minsalary";
	if($maxsalary)  $condition .= " AND maxsalary<$maxsalary";
	if($fromtime) $condition .= " AND edittime>=$fromtime";
	if($totime) $condition .= " AND edittime<=$totime";
	if($level) $condition .= " AND level=$level";
	if($gender) $condition .= " AND gender=$gender";
	if($type) $condition .= " AND type=$type";
	if($marriage) $condition .= " AND marriage=$marriage";
	if($education) $condition .= " AND education>=$education";
	if($experience) $condition .= " AND experience>=$experience";
	if($minsalary) $condition .= " AND minsalary>=$minsalary";
	if($maxsalary) $condition .= " AND maxsalary<=$maxsalary";
	$GENDER[0] = $L['all_gender'];
	$TYPE[0] = $L['all_work'];
	$MARRIAGE[0] = $L['all_marriage'];
	$EDUCATION[0] = $L['all_education'];
	$pagesize = $MOD['pagesize'];
	$offset = ($page-1)*$pagesize;
	if($action == 'resume') {
		$condition .= " AND open=3";
		require MD_ROOT.'/resume.class.php';
		$do = new resume($moduleid);
		$tags = $do->get_list($condition, 'edittime desc', $DT['cache_search'] ? 'CACHE' : '');
		if($page == 1 && $kw) keyword($kw, $items, -$moduleid);
	} else {
		require MD_ROOT.'/job.class.php';
		$do = new job($moduleid);
		$tags = $do->get_list($condition, $MOD['order'], $DT['cache_search'] ? 'CACHE' : '');
		if($tags && $kw) {
			foreach($tags as $k=>$v) {
				$tags[$k]['title'] = str_replace($kw, '<span class="highlight">'.$kw.'</span>', $v['title']);
			}
			if($page == 1) keyword($kw, $items, $moduleid);
		}
	}
}
$showpage = 1;
$path = $MOD['linkurl'];
if($catid) $CAT = get_cat($catid);
include DT_ROOT.'/include/seo.inc.php';
$seo_kw = $kw ? $kw.$seo_delimiter : '';
if($MOD['seo_search']) {
	eval("\$seo_title = \"$MOD[seo_search]\";");
} else {
	$seo_title = $seo_modulename.$L['search'].$seo_delimiter.$seo_page.$seo_sitename;
	if($catid) $seo_title = $seo_catname.$seo_title;
	if($areaid) $seo_title = $seo_areaname.$seo_title;
	if($kw) $seo_title = $kw.$seo_delimiter.$seo_title;
}
include template('search', $module);
?>