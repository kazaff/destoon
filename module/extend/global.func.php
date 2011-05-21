<?php
defined('IN_DESTOON') or exit('Access Denied');
function ad_name($ad = array()) {
	if($ad['typeid'] > 5) {
		if($ad['key_word']) {
			return 'ad_t'.$ad['typeid'].'_m'.$ad['key_moduleid'].'_k'.urlencode($ad['key_word']).'.htm';
		} else if($ad['key_catid']) {
			return 'ad_t'.$ad['typeid'].'_m'.$ad['key_moduleid'].'_c'.$ad['key_catid'].'.htm';
		} else {
			return 'ad_t'.$ad['typeid'].'_m'.$ad['key_moduleid'].'.htm';
		}
	} else {
		return 'ad_'.$ad['pid'].'.htm';
	}
	return '';
}
?>