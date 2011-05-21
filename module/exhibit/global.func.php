<?php
defined('IN_DESTOON') or exit('Access Denied');
function get_process($fromtime, $totime) {
	global $DT_TIME;
	if($DT_TIME < $fromtime) {
		return 1;
	} else if($DT_TIME <= $totime) {
		return 2;
	} else {
		return 3;
	}
}
?>