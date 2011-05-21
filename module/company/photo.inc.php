<?php 
defined('IN_DESTOON') or exit('Access Denied');
$module = 'photo';
$moduleid = 12;
include DT_ROOT.'/lang/'.DT_LANG.'/'.$module.'.inc.php';
$MOD = cache_read('module-'.$moduleid.'.php');
$table = $DT_PRE.$module;
$table_data = $DT_PRE.$module.'_data';
$table_item = $DT_PRE.$module.'_item';
if($itemid) {
	$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid AND status>2 AND items>0 AND username='$username'");
	if(!$item) dheader($MENU[$menuid]['linkurl']);
	unset($item['template']);
	extract($item);
	$CAT = get_cat($catid);
	$adddate = timetodate($addtime, 3);
	$editdate = timetodate($edittime, 3);
	$linkurl = userurl($username, "file=$file&itemid=$itemid", $domain);
	if($open < 3) {
		$_key = $open == 2 ? $password : $answer;
		$str = get_cookie('photo_'.$itemid);
		$pass = $str == md5(md5($DT_IP.$open.$_key.DT_KEY));	
		if($_username && $_username == $username) $pass = true;
	} else {
		$pass = true;
	}
	if($pass) {
		if($page > $items) $page = 1;
		require DT_ROOT.'/module/'.$module.'/global.func.php';
		$T = array();
		$result = $db->query("SELECT itemid,thumb,introduce FROM {$table_item} WHERE item=$itemid ORDER BY listorder ASC,itemid ASC");
		while($r = $db->fetch_array($result)) {
			$T[] = $r;
		}
		$demo_url = userurl($username, "file=$file&itemid=$itemid&page=".'{destoon_page}', $domain);
		$next_photo = $items > 1 ? next_photo($page, $items, $demo_url) : $linkurl;
		$prev_photo = $items > 1 ? prev_photo($page, $items, $demo_url) : $linkurl;
		if($T) {
			$S = side_photo($T, $page, $demo_url);
		} else {
			$S = array();
			$T[0]['thumb'] = DT_SKIN.'image/spacer.gif';
			$T[0]['introduce'] = $L['no_picture'];
		}
		$P = $T[$page-1];
		$P['src'] = str_replace('.thumb.'.file_ext($P['thumb']), '', $P['thumb']);
		$content_table = content_table($moduleid, $itemid, $MOD['split'], $table_data);
		$content = $db->get_one("SELECT content FROM {$content_table} WHERE itemid=$itemid");
		$content = $content['content'];
	} else {
		$error = '';
		if($submit) {
			if($key && $key == $_key) {
				$pass = true;
				set_cookie('photo_'.$itemid, md5(md5($DT_IP.$open.$_key.DT_KEY)), $DT_TIME + 86400);
				dheader($linkurl);
			} else {
				$error = $open == 2 ? $L['error_password'] : $L['error_answer'];
			}
		}
	}
	$update = '';
	include DT_ROOT.'/include/update.inc.php';
	$head_title = $title.$DT['seo_delimiter'].$head_title;
	$head_keywords = $keyword;
	$head_description = $introduce ? $introduce : $title;
} else {
	$url = "file=$file";
	$condition = "username='$username' AND status=3 AND items>0";
	if($kw) {
		$condition .= " AND keyword LIKE '%$keyword%'";
		$url .= "&kw=$kw";
		$head_title = $kw.$DT['seo_delimiter'].$head_title;
	}
	$demo_url = userurl($username, $url.'&page={destoon_page}', $domain);
	$pagesize =intval($menu_num[$menuid]);
	if(!$pagesize || $pagesize > 100) $pagesize = 16;
	$offset = ($page-1)*$pagesize;
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition", 'CACHE', $DT['cache_home']);
	$pages = home_pages($r['num'], $pagesize, $demo_url, $page);
	$lists = array();
	$result = $db->query("SELECT ".$MOD['fields']." FROM {$table} WHERE $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
	while($r = $db->fetch_array($result)) {
		$r['alt'] = $r['title'];
		$r['title'] = set_style($r['title'], $r['style']);
		$r['linkurl'] = $homeurl ? $MOD['linkurl'].$r['linkurl'] : userurl($username, "file=$file&itemid=$r[itemid]", $domain);
		if($kw) {
			$r['title'] = str_replace($kw, '<span class="highlight">'.$kw.'</span>', $r['title']);
			$r['introduce'] = str_replace($kw, '<span class="highlight">'.$kw.'</span>', $r['introduce']);
		}
		$lists[] = $r;
	}
}
include template('photo', $template);
?>