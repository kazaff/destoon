<?php 
defined('IN_DESTOON') or exit('Access Denied');
if(!$aid) return false;
$a or $a = $db->get_one("SELECT * FROM {$DT_PRE}ad WHERE aid=$aid");
$p = $db->get_one("SELECT * FROM {$DT_PRE}ad_place WHERE pid=$a[pid]");
if(!$p) return false;
$ad_moduleid = $p['moduleid']; 
$pid = $p['pid'];
$typeid = $p['typeid'];
$width = $p['width'];
$height = $p['height'];
$fileroot = DT_CACHE.'/htm/';
$filename = $fileroot.ad_name($a);
if($p['code']) file_put($filename.'.htm', '<!--'.($DT_TIME+86400*365*10).'-->'.$p['code']);
if($typeid == 7) {
	$totime = 0;
	$code = '';
	$ad = $db->query("SELECT * FROM {$DT_PRE}ad WHERE pid=$p[pid] AND status=3 AND key_moduleid=$a[key_moduleid] AND key_catid=$a[key_catid] AND key_word='$a[key_word]' AND fromtime<$DT_TIME AND totime>$DT_TIME ORDER BY listorder ASC,addtime ASC");
	while($t = $db->fetch_array($ad)) {
		if($t['totime'] > $totime) $totime = $t['totime'];
		$code .= $t['code'];
	}
	if($code) {
		file_put($filename, '<!--'.$totime.'-->'.$code.'<div class="b10">&nbsp;</div>');
	} else {
		file_del($filename);
	}
} else if($typeid == 6) {
	$totime = 0;
	$tags = array();
	$ad_module = $MODULE[$ad_moduleid]['module'];
	$path = $MODULE[$ad_moduleid]['linkurl'];
	$id = $ad_moduleid == 4 ? 'userid' : 'itemid';
	$pages = '';
	$ad = $db->query("SELECT * FROM {$DT_PRE}ad WHERE pid=$p[pid] AND status=3 AND key_moduleid=$a[key_moduleid] AND key_catid=$a[key_catid] AND key_word='$a[key_word]' AND fromtime<$DT_TIME AND totime>$DT_TIME ORDER BY listorder ASC,addtime ASC");
	while($t = $db->fetch_array($ad)) {
		if($t['totime'] > $totime) $totime = $t['totime'];
		$d = $db->get_one("SELECT * FROM ".get_table($ad_moduleid)." WHERE `{$id}`=$t[key_id]");
		if($d) {
			if($t['stat']) {
				$d['linkurl'] = $MODULE[3]['linkurl'].rewrite('redirect.php?aid='.$t['aid']);
			} else {
				if(strpos($d['linkurl'], '://') === false) $d['linkurl'] = $path.$d['linkurl'];
			}
			$d['alt'] = $d['title'];
			$d['title'] = set_style($d['title'], $d['style']);
			$tags[] = $d;
		}
	}
	if($tags) {
		ob_start();
		include template('ad_code', $module);
		$data = ob_get_contents();
		ob_clean();
		file_put($filename, '<!--'.$totime.'-->'.$data);
	} else {
		file_del($filename);
	}
} else if($typeid == 5) {
	$totime = 0;
	$tags = array();
	$ad = $db->query("SELECT * FROM {$DT_PRE}ad WHERE pid=$p[pid] AND status=3 AND fromtime<$DT_TIME AND totime>$DT_TIME ORDER BY listorder ASC,addtime ASC");
	while($t = $db->fetch_array($ad)) {
		$t['title'] = $t['image_alt'];
		$t['thumb'] = $t['image_src'];
		$t['linkurl'] = $t['stat'] ? $MODULE[3]['linkurl'].rewrite('redirect.php?aid='.$t['aid']) : $t['url'];
		if($t['totime'] > $totime) $totime = $t['totime'];
		$tags[] = $t;
	}
	if($tags) {
		ob_start();
		include template('ad_code', $module);
		$data = ob_get_contents();
		ob_clean();
		file_put($filename, '<!--'.$totime.'-->'.$data);
		$data = trim(str_replace(array('<script type="text/javascript">', '</script>'), array('', ''), $data));
		file_put(DT_ROOT.'/file/script/A'.$p['pid'].'.js', $data);
	} else {
		file_del($filename);
		if($p['code']) {
			file_put(DT_ROOT.'/file/script/A'.$p['pid'].'.js', $p['code']);
		} else {
			file_del(DT_ROOT.'/file/script/A'.$p['pid'].'.js');
		}
	}
} else {
	$ad = $db->get_one("SELECT * FROM {$DT_PRE}ad WHERE pid=$p[pid] AND status=3 AND fromtime<$DT_TIME AND totime>$DT_TIME ORDER BY fromtime DESC");
	if($ad) {
		extract($ad);
		if($url && $stat) $url = $MODULE[3]['linkurl'].rewrite('redirect.php?aid='.$aid);
		if($typeid == 3) {
			if(strtolower(file_ext($image_src)) == 'swf') {
				$typeid = 4;
				$flash_src = $image_src;
			}
		} else if($typeid == 4) {
			if(in_array(strtolower(file_ext($flash_src)), array('jpg', 'jpeg', 'png', 'gif', 'bmp'))) {
				$typeid = 3;
				$image_src = $flash_src;
			}
		}
		ob_start();
		include template('ad_code', $module);
		$data = ob_get_contents();
		ob_clean();
		file_put($filename, '<!--'.$totime.'-->'.$data);
		if($typeid > 1) {
			$data = 'document.write(\''.dtrim($data, true).'\');';
			file_put(DT_ROOT.'/file/script/A'.$p['pid'].'.js', $data);
		}
	} else {
		file_del($filename);
		if($typeid > 1) {
			if($p['code']) {
				file_put(DT_ROOT.'/file/script/A'.$p['pid'].'.js', $p['code']);
			} else {
				file_del(DT_ROOT.'/file/script/A'.$p['pid'].'.js');
			}
		}
	}
}
return true;
?>