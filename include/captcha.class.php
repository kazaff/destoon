<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2010 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
class captcha {
	var $func;
	var $chars;
	var $length;
	var $soundtag;
	var $soundstr;
	var $cn;
	var $font;
	var $charset;
	var $ip;

	function captcha() {
		$this->func = true;
		$this->chars = 'abcdeghkmnpqstwxyz234789ABCEFGHJKLMNPRSTWXYZ';
		//$this->chars = '123456789';
		$this->length = 4;
		$this->ck_func();
	}

	function question($id) {
		global $db;
		$r = $db->get_one("SELECT * FROM {$db->pre}question ORDER BY rand()");
		$_SESSION['answerstr'] = md5(md5($r['answer'].DT_KEY.$this->ip));
		exit('document.getElementById("'.$id.'").innerHTML = "'.$r['question'].'";');
	}

	function image() {
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) {
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
		} else {
			header('Pragma: no-cache');
		}
		header('Expires: '.gmdate('D, d M Y H:i:s').' GMT');
		header("Content-type: image/png");
		if($this->func) {
			$string = $this->mk_str();
			$_SESSION['captchastr'] = md5(md5(strtoupper($string).DT_KEY.$this->ip));
			$imageX = $this->length*35;
			$imageY = 40;
			$im = imagecreatetruecolor($imageX, $imageY);  
			imagefill($im, 0, 0, imagecolorallocate($im, 250, 250, 250));
			$color = imagecolorallocate($im, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
			if($this->cn) {
				$string = convert($string, $this->charset, 'UTF-8');
				$angle = mt_rand(-10, 10);
				$size = mt_rand(13, 25);
				$font = $this->font;
				$X = $size + mt_rand(5, 10);
				$Y = $size + mt_rand(5, 10);
				imagettftext($im, $size, $angle, $X, $Y, $color, $font, $string);
				imagepng($im);
				imagedestroy($im);
			} else {
				$fonts = glob(DT_ROOT.'/file/font/*.ttf');
				$num = count($fonts) - 1;
				$font = $fonts[mt_rand(0, $num)];
				$C0 = mt_rand(225, 255);
				$C1 = mt_rand(225, 255);
				$C2 = mt_rand(225, 255);
				$BG = imagecolorallocate($im, $C0, $C1, $C2);
				imagefill($im, 0, 0, $BG);
				$X = mt_rand(5, 15);
				$S = mt_rand(3, 5);
				for($i = 0; $i < $this->length; $i++) {
					$size = mt_rand(25, 35);
					$angle = mt_rand(-5, 5);
					if($i > 0) $X += $size - $S - $i;
					$Y = $size + mt_rand(-2, 5);
					imagettftext($im, $size, $angle, $X, $Y, $color, $font, $string{$i});
				}
				$IM = imagecreatetruecolor($imageX, $imageY);
				imagefill($IM, 0, 0, $BG);				
				for($i = 0; $i < $imageX; $i++) {
					for($j = 0; $j < $imageY; $j++) {
						$C = imagecolorat($im, $i, $j);
						if((int)($i+20+sin($j/$imageY*2*M_PI)*10) <= imagesx($IM)&& (int)($i+20+sin($j/$imageY*2*M_PI)*10) >=0 ) {
							imagesetpixel($IM, (int)($i+10+sin($j/$imageY*2*M_PI-M_PI*0.1)*4), $j, $C);
						}
					}
				}				
				$R = mt_rand(5, 30);
				$X = mt_rand(10, 25);
				$Y = mt_rand(5, 10);
				$L = mt_rand(40, 80);
				for($yy = $R; $yy <= $R + 1; $yy++) {
					for($px = -$L; $px <= $L; $px = $px + 0.1) {
						$x = $px/$X;
						if($x != 0) $y = sin($x);
						$py = $y*$Y;
						imagesetpixel($IM, $px + $L, $py + $yy, $color);
					}
				}
				imagepng($IM);
				imagedestroy($IM);
				imagedestroy($im);
			}
		} else {
			$pngs = glob(DT_ROOT.'/file/captcha/*.png');
			if(!is_array($pngs)) return false;
			$captcha = $pngs[mt_rand(0, count($pngs)-1)];
			$string = substr(basename($captcha), 0, 4);
			$_SESSION['captchastr'] = md5(md5(strtoupper($string).DT_KEY.$DT_IP));
			include $captcha;
		}
		exit;
	}

	function mk_str() {
		$str = '';
		if($this->cn) {
			$step = $this->charset == 'utf-8' ? 3 : 2;
			$text = substr(file_get(DT_ROOT.'/api/captcha.inc.php'), 13);
			$max = strlen($text) - 1 - $step;
			while(1) {
				$i = mt_rand(0, $max);
				if($i%$step == 0) {
					$str .= substr($text, $i, $step);
					break;
				}
			}
			while(1) {
				$i = mt_rand(0, $max);
				if($i%$step == 0) {
					$str .= substr($text, $i, $step);
					break;
				}
			}
		} else {
			$max = strlen($this->chars) - 1;
			while(1) {
				if(strlen($str) == $this->length) break;
				$r = mt_rand(0, $max);
				if(strpos(strtolower($str), strtolower($this->chars{$r})) === false) $str .= $this->chars{$r};
			}
		}
		return $str;
	}

	function ck_func() {
		$gd_funcs = array('imagecreatefromjpeg', 'imagecreatetruecolor', 'imagefill', 'imagecolorallocate', 'imagecopy', 'imagestring', 'imagerectangle', 'imagepng', 'imagedestroy', 'imagettftext', 'imagesetpixel');
		foreach($gd_funcs as $gd_func) {
			if(!function_exists($gd_func)) { $this->func = false; break; }
		}
	}
}
?>