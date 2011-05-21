<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
function tag($parameter, $expires = 0) {
	global $DT, $CFG, $MODULE, $CATEGORY, $db, $DCAT, $DT_TIME;
	$CATBAK = $CATEGORY ? $CATEGORY : array();
	if($expires > 0) {
		$tag_expires = $expires;
	} else if($expires == -2) {
		$tag_expires = $CFG['db_expires'];
	} else if($expires == -1) {
		$tag_expires = 0;
	} else {
		$tag_expires = $CFG['tag_expires'];
	}
	$tag_cache = false;
	$db_cache = ($expires == -2 || defined('TOHTML')) ? 'CACHE' : '';
	if($tag_expires && $db_cache != 'CACHE' && strpos($parameter, '&page=') === false) {
		$tag_cache = true;
		$TCF = DT_CACHE.'/tag/'.md5($parameter).'.htm';
		if(is_file($TCF) && ($DT_TIME - filemtime($TCF) < $tag_expires)) {
			echo substr(file_get($TCF), 17);
			return;
		}
	}
	$parameter = str_replace(array('&amp;', '%'), array('', '##'), $parameter);
	parse_str($parameter, $par);
	if(!is_array($par)) return '';
	$par = dstripslashes($par);
	extract($par);
	isset($prefix) or $prefix = $db->pre;
	isset($moduleid) or $moduleid = 1;
	if(!isset($MODULE[$moduleid])) return '';
	isset($fields) or $fields = '*';
	isset($catid) or $catid = 0;
	isset($child) or $child = 1;
	isset($areaid) or $areaid = 0;
	isset($areachild) or $areachild = 0;
	isset($dir) or $dir = 'tag';
	isset($template) or $template = 'list';
	isset($condition) or $condition = '1';
	isset($group) or $group = '';
	isset($page) or $page = 1;
	isset($pagesize) or $pagesize = 10;
	isset($update) or $update = 0;
	isset($order) or $order = '';
	isset($showpage) or $showpage = 0;
	isset($datetype) or $datetype = 0;
	isset($target) or $target = '';
	isset($class) or $class = '';
	isset($length) or $length = 0;
	isset($introduce) or $introduce = 0;
	isset($debug) or $debug = 0;
	isset($cols) && $cols or $cols = 1;
	isset($DCAT) or $DCAT = array();
	if(isset($DCAT[$moduleid])) {
		$CATEGORY = $DCAT[$moduleid];
	} else {
		$CATEGORY = $DCAT[$moduleid] = cache_read('category-'.$moduleid.'.php');
	}
	if($catid && $moduleid > 4) {
		if(is_numeric($catid)) {
			$condition .= ($child && $CATEGORY[$catid]['child']) ? " AND catid IN (".$CATEGORY[$catid]['arrchildid'].")" : " AND catid=$catid";
		} else {
			if($child) {
				$_catids = explode(',', $catid);
				$catids = '';
				foreach($_catids as $_c) {
					$catids .= ','.($CATEGORY[$_c]['child'] ? $CATEGORY[$_c]['arrchildid'] : $_c);
				}
				$catids = substr($catids, 1);
				$condition .= " AND catid IN ($catids)";
			} else {
				$condition .= " AND catid IN ($catid)";
			}
		}
	}
	if($areaid) {
		$AREA = cache_read('area.php');
		if(is_numeric($areaid)) {
			$condition .= ($areachild && $AREA[$areaid]['child']) ? " AND areaid IN (".$AREA[$areaid]['arrchildid'].")" : " AND areaid=$areaid";
		} else {
			if($areachild) {
				$_areaids = explode(',', $areaid);
				$areaids = '';
				foreach($_areaids as $_a) {
					$areaids .= ','.($AREA[$_a]['child'] ? $AREA[$_a]['arrchildid'] : $_a);
				}
				$areaids = substr($areaids, 1);
				$condition .= " AND areaid IN ($areaids)";
			} else {
				$condition .= " AND areaid IN ($areaid)";
			}
		}
	}
	$path = $MODULE[$moduleid]['linkurl'];
	$table = isset($table) ? $prefix.$table : get_table($moduleid);
	$offset = ($page-1)*$pagesize;
	$percent = dround(100/$cols).'%';
	$num = 0;
	$group = $group ? " GROUP BY $group" : '';
	$order = $order ? " ORDER BY $order" : '';
	$condition = stripslashes($condition);
	$condition = str_replace('##', '%', $condition);
	if($showpage) {
		$num = $db->count($table, $condition.$group, $tag_expires ? $tag_expires : $CFG['db_expires']);
		if($catid) {
			if($page < 3 && $update) update_item($catid, $num);
			$pages = listpages($moduleid, $catid, $num, $page, $pagesize, $CATEGORY);
		} else {
			$pages = pages($num, $page, $pagesize);
		}
	}
	if($template == 'null') $db_cache = 'CACHE';
	$query = "SELECT $fields FROM {$table} WHERE {$condition}{$group}{$order} LIMIT $offset,$pagesize";
	if($debug) echo $parameter.'<br/>'.$query.'<br/>';
	$tags = array();
	$result = $db->query($query, $db_cache, $tag_expires);
	while($r = $db->fetch_array($result)) {
		if(isset($r['title'])) {
			$r['title'] = str_replace('"', '&quot;', trim($r['title']));
			$r['alt'] = $r['title'];
			if($length) $r['title'] = dsubstr($r['title'], $length);
			if(isset($r['style']) && $r['style']) $r['title'] = set_style($r['title'], $r['style']);
		}
		if(isset($r['introduce']) && $introduce) $r['introduce'] = dsubstr($r['introduce'], $introduce);
		if(isset($r['linkurl']) && $r['linkurl'] && strpos($r['linkurl'], '://') === false) $r['linkurl'] = $path.$r['linkurl'];
		$tags[] = $r;
	}
	if($template == 'null') {
		$CATEGORY = $CATBAK;
		return $tags;
	}
	if($tag_cache) {
		ob_start();
		include template($template, $dir);
		$contents = ob_get_contents();
		ob_clean();
		file_put($TCF, '<!--'.($DT_TIME + $tag_expires).'-->'.$contents);
		$CATEGORY = $CATBAK;
		echo $contents;
	} else {
		include template($template, $dir);
		$CATEGORY = $CATBAK;
	}
}
?>