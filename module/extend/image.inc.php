<?php 
defined('IN_DESTOON') or exit('Access Denied');
check_referer() or exit;
if($auth) {
	$string = decrypt($auth);
	if(preg_match("/^[a-z0-9_@\-\s\/\.\(\)\+]+$/i", $string)) {
		header("content-type:image/png");
		$imageX = strlen($string)*9;
		$imageY = 20;
		$im = @imagecreate($imageX, $imageY) or exit();
		imagecolorallocate($im, 255, 255, 255);
		$color = imagecolorallocate($im, 0, 0, 0);
		imagestring($im, 5, 0, 5, $string, $color);
		imagepng($im);
		imagedestroy($im);
	}
}
?>