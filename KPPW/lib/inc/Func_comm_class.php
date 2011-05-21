<?php

class Func_comm_class {
	static public function k_addslashes($string) {
		if (is_array ( $string )) {
			foreach ( $string as $key => $val ) {
				$string [$key] = Func_comm_class::k_addslashes ( $val );
			}
		} else {
			$string = addslashes ( trim ( $string ) );
		}
		return $string;
	}

	static function adminshowmessage($title = "", $url = "", $time = 3, $content = "") {
		global $_K;
		$url ? $url : $_K ['refer'];
		require Template_Class::template ( 'control/admin/tpl/showmessage' );
		die ();
	}

	static function showmessage($title = "", $url = "", $time = 3, $content = "", $msgtype = 'info') {
		global $_K, $basic_config, $username, $uid,$nav_list;
		$url ? $url : $_K ['refer'];
		require Template_Class::template ( 'showmessage' );
		die ();
	}

	static function filter_xss($string, $allowedtags = '', $disabledattributes = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavaible', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragdrop', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterupdate', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmoveout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload')) {
		if (is_array ( $string )) {
			foreach ( $string as $key => $val )
			$string [$key] = filter_xss ( $val, ALLOWED_HTMLTAGS );
		} else {
			$string = preg_replace ( '/\s(' . implode ( '|', $disabledattributes ) . ').*?([\s\>])/', '\\2', preg_replace ( '/<(.*?)>/ie', "'<'.preg_replace(array('/javascript:[^\"\']*/i', '/(" . implode ( '|', $disabledattributes ) . ")[ \\t\\n]*=[ \\t\\n]*[\"\'][^\"\']*[\"\']/i', '/\s+/'), array('', '', ' '), stripslashes('\\1')) . '>'", strip_tags ( $string, $allowedtags ) ) );
		}
		return $string;
	}

	static function adminCheckRole($roleid) {
		global $_K, $admin_info;

		$grouplist_arr = Cache_ext_Class::getGroupList ();

		if ($_SESSION ['uid'] != ADMIN_UID && ! in_array ( $roleid, $grouplist_arr [$admin_info ['group_id']] ['group_roles'] )) {
			echo "<script>location.href='index.php?do=main'</script>";
			die ();
		}
	}

	static function adminSystemLog($msg) {
		global $_K, $admin_info;
		$system_log_obj = new Keke_witkey_system_log_class ( );
		$system_log_obj->setLog_content ( $msg );
		$system_log_obj->setLog_ip ( Func_comm_class::getIP () );
		$system_log_obj->setLog_time ( time ( 'now()' ) );
		$system_log_obj->setUser_type ( $admin_info ['group_id'] );
		$system_log_obj->setUid ( $admin_info ['uid'] ? $admin_info ['uid'] : $_SESSION ['uid'] );
		$system_log_obj->setUsername ( $admin_info ['username'] ? $admin_info ['username'] : $_SESSION ['username'] );
		$system_log_obj->create_keke_witkey_system_log ();
	}
	
	static function get_tree($array,&$temp_arr,$out='option',$index=null,$id='indus_id',$pid='indus_pid',$name='indus_name'){
		$tree = array();
		if( $array ){
			foreach ( $array as $v ){

				$pt = $v[$pid];

				$list = @$tree[$pt] ?$tree[$pt] : array();

				array_push( $list, $v );

				$tree[$pt] = $list;

			}

		}
		if ($tree){
			foreach($tree[0] as $k=>$v)
			{
				if($out=='option'){
					if($index==$v[$id]){
						$temp_arr[] = "<option value=$v[$id] selected=selected>$v[$name]</option>";
					}else{
						$temp_arr[] = "<option value=$v[$id]>$v[$name]</option>";
					}



				}else {
					$v['ext'] = $v[$name];
					$temp_arr[] = $v;
				}
				if($tree[$v[$id]]) self::draw_tree($tree[$v[$id]],$tree,0,$temp_arr,$out,$index,$id,$pid,$name);
			}
		}
	}


	static function draw_tree($arr,$tree,$level,&$temp_arr,$out,$index,$id,$pid,$name)
	{

		$level++;

		$prefix = str_pad(" |",$level+3,'---',STR_PAD_RIGHT);
		$n = str_pad('',$level+3,'---',STR_PAD_RIGHT);
		$n = str_replace("-","&nbsp;&nbsp;",$n);
		foreach($arr as $k2=>$v2){
		 	if($out=='option'){
		 		if($index==$v2[$id])
					{
						$temp_arr[]="<option value={$v2[$id]} selected=selected>$n$prefix$v2[$name]</option>";
					}else{
						$temp_arr[]="<option value={$v2[$id]}>$n$prefix$v2[$name]</option>";
					}
						
		 	}else {
		 		$v2['ext'] = $n.$prefix.$v2[$name];
		 		$temp_arr[] =  $v2;
		 	}
		 	if($tree[$v2[$id]]) self::draw_tree($tree[$v2[$id]],$tree,$level,&$temp_arr,$out,$index,$id,$pid,$name);

		}

	}

	static function getIP() {
		if (! empty ( $_SERVER ["HTTP_CLIENT_IP"] ))
		$cip = $_SERVER ["HTTP_CLIENT_IP"];
		else if (! empty ( $_SERVER ["HTTP_X_FORWARDED_FOR"] ))
		$cip = $_SERVER ["HTTP_X_FORWARDED_FOR"];
		else if (! empty ( $_SERVER ["REMOTE_ADDR"] ))
		$cip = $_SERVER ["REMOTE_ADDR"];
		else
		$cip = "无法获取！";
		return $cip;
	}

static function gbktoutf($string) {
		if (is_array ( $string )) {
			foreach ( $string as $key => $val ) {
				$string [$key] = self::gbktoutf ( $val );
			}
		} else {
			if(iconv ("gb2312", "UTF-8", "1" )){
				$string = iconv ( "gb2312", "UTF-8", $string );
			}
			else{
				$string = self::charset_encode("gb2312", "UTF-8", $string);
			}
		}
		return $string;
	}
	static function utftogbk($string) {
		if (is_array ( $string )) {
			foreach ( $string as $key => $val ) {
				$string [$key] = self::utftogbk ( $val );
			}
		} else {
			if(iconv ( "UTF-8", "gb2312", "1" )){
				$string = iconv ( "UTF-8", "gb2312", $string );
			}
			else{
				$string = self::charset_encode("UTF-8", "gb2312", $string);
			}
		}
		return $string;
	}
	

function charset_encode($_input_charset,$_output_charset,$input) {
    $output = "";
    if (is_array ( $input )) {
   		foreach ( $input as $key => $val ) {
			$input [$key] = self::charset_encode ( $_input_charset,$_output_charset,$val );
		}
		return $input;
    }
    else{
	    if(!isset($_output_charset) )$_output_charset  = $_input_charset;
	    if($_input_charset == $_output_charset || $input ==null ) {
	        $output = $input;
	    } elseif (function_exists("mb_convert_encoding")) {
	        $output = mb_convert_encoding($input,$_output_charset,$_input_charset);
	    } elseif(function_exists("iconv")) {
	        $output = iconv($_input_charset,$_output_charset,$input);
	    } else die("sorry, you have no libs support for charset change.");
		
	    return $output;
	}
}

	static function echojson($msg = '', $status = 0, $dataarr = array()) {
		global $_K;
		if ($_K ['charset'] != 'UTF-8') {
			$msg = self::gbktoutf ( $msg );
			$dataarr = self::gbktoutf ( $dataarr );
		}

		$arr = array ('msg' => $msg, 'status' => $status, 'data' => $dataarr );
		echo self::json_encode_k($arr);
		exit ();
	}
	static function json_encode_k($array){
		if(function_exists('json_encode')){
			return json_encode($array);
		}else{
			require_once 'json.class.php';
			$json_obj = new json ( );
			return $json_obj->encode($array);
		}
	}

	static function sstrtotime($time, $now = null) {
		date_default_timezone_set ( 'Etc/GMT' );
		$time = strtotime ( $time, $now );
		date_default_timezone_set ( 'Asia/Shanghai' );
		return $time;
	}

	
	static function randomkeys($length) {
		$pattern = '1234567890abcdefghijklmnopqrstuvwxyz
                   ABCDEFGHIJKLOMNOPQRSTUVWXYZ'; 
		for($i = 0; $i < $length; $i ++) {
			$key .= $pattern {mt_rand ( 0, 35 )};
		}
		return $key;

	}

	
	static function sendMail($address, $title, $body) {
		global $_K;
		$basicconfig = Cache_ext_Class::getConfig ( 'basic' );
		$mail = new Phpmailer_class ( );
		if ($basicconfig ['mail_server_cat'] == "smtp") {
			
			$mail->IsSMTP ();
			$mail->SMTPAuth = true;
			$mail->CharSet = strtolower($_K['charset']);
			//$mail->SMTPSecure = "tsl";
			$mail->Host = $basicconfig ['smtp_url'];
			$mail->Port = $basicconfig ['mail_server_port'];
			$mail->Username = $basicconfig ['post_account'];
			$mail->Password = $basicconfig ['account_pwd'];

		} else {
			$mail->IsMail ();
		}

		//$mail->CharSet = $mail_charset;


		$mail->SetFrom ( $basicconfig ['post_account'], $basicconfig ['website_name'] );

		if ($basicconfig ['mail_replay'])
		$mail->AddReplyTo ( $basicconfig ['mail_replay'], $basicconfig ['website_name'] );

		$mail->Subject = $title;

		$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test


		$mail->MsgHTML ( $body );

		$mail->AddAddress ( $address, $basicconfig ['website_name'] );

		return $mail->Send ();
	}

	

	static function time2Units($end_time) {
		$now = time (); 
		$res = $end_time - $now;
		$oneday = 24 * 60 * 60; 
		$onehour = 60 * 60; 
		if ($res <= 0)
		$res = '即将过期';
		else {
			if ($res / $oneday > 0) {
				$day = floor ( $res / $oneday ); //天
				$left_sec = $res % $oneday; //剩余的秒
				//echo $oneday.'    '.$left_sec.'<br />';
				if ($left_sec / $onehour > 0) {
					$hour = number_format ( ($left_sec / $oneday) * 24, 0 ); //小时
				} else
				$hour = 0; //小时
			} else {
				$day = 0; //天
				$left_sec = $res % $oneday; //剩余的秒
				if ($left_sec / $onehour > 0) {
					$hour = number_format ( ($left_sec / $oneday) * 24, 0 ); //小时
				} else
				$hour = 0; //小时
			}
			$res = $day . '天' . $hour . '小时';
		}
		return $res;
	}

	static function uploaduserpic($filename, $uid) {
		$iconurl = $_FILES [$filename] ["name"];
		$picture = basename ( $iconurl );
		$arr = explode ( ".", $picture );
		$ext = "";
		ini_set ( "display_errors", 0 );

		if (isset ( $arr [count ( $arr ) - 1] )) {
			$ext = $arr [count ( $arr ) - 1];
			$ext = strtolower ( $ext );
			if ($ext == "gif" or $ext == "jpg" or $ext == "jpeg" or $ext == "png") {
				
			} else {
				echo "图片格式不正确<a href=\"javascript:history.back(-1);\">重来</a>";
				exit ();
			}
		} else {
			echo "图片格式不正确,<a href=\"javascript:history.back(-1);\">重来</a>";
			exit ();
		}
		if (file_exists ( "../images/upload/small_" . $picture )) {
			echo "请另选一张图片!<a href=\"javascript:history.back(-1);\">重来</a>";
			exit ();
		}

		if (move_uploaded_file ( $_FILES [$filename] ["tmp_name"], "./" . $picture )) {

			$_SESSION ["uploaded_picture"] = $picture;
			if ($ext == "jpg" or $ext == "jpeg") {
				$im = imagecreatefromjpeg ( "./" . $picture );
			} elseif ($ext == "gif") {
				$im = imagecreatefromgif ( "./" . $picture );
			} else if ($ext == 'png') {
				$im = imagecreatefrompng ( "./" . $picture );
			} else {
				exit ();
			}

			$width = imagesx ( $im );
			$height = imagesy ( $im );
			if ($width > $height) {
				$small_width = 60;
				$small_height = (60 / $width) * $height;

				$medium_width = 124;
				$medium_height = (124 / $width) * $height;
			} else {
				$small_height = 60;
				$small_width = (60 / $height) * $width;

				$medium_height = 124;
				$medium_width = (124 / $height) * $width;
			}
			if ($width > 200 || $height > 200) {
				if ($width > $height) {
					$large_width = 200;
					$large_height = (200 / $width) * $height;

				} else {
					$large_height = 200;
					$large_width = (200 / $height) * $width;
				}
			} else {
				$large_width = $width;
				$large_height = $height;
			}

			
			$toDir = S_ROOT . "data/uploads/member";
			Func_comm_class::resizeToFile2 ( $picture, $small_width, $small_height, $toDir . "/small_" . $uid . '.jpg', 100 );
			Func_comm_class::resizeToFile2 ( $picture, $medium_width, $medium_height, $toDir . "/middle_" . $uid . '.jpg', 100 );
			Func_comm_class::resizeToFile2 ( $picture, $large_width, $large_height, $toDir . "/big_" . $uid . '.jpg', 100 );
			Func_comm_class::update_score_value ( $uid, 'update_pic', 1 );
			unlink ( $picture );
		}
	}

	static function resizeToFile($sourcefile, $dest_x, $dest_y, $targetfile, $jpegqual) {

		/* Get the dimensions of the source picture */
		$picsize = getimagesize ( "$sourcefile" );

		$source_x = $picsize [0];
		$source_y = $picsize [1];
		$source_id = imageCreateFromJPEG ( "$sourcefile" );

		/* Create a new image object (not neccessarily true colour) */

		$target_id = imagecreatetruecolor ( $dest_x, $dest_y );

		/* Resize the original picture and copy it into the just created image
		 object. Because of the lack of space I had to wrap the parameters to
		 several lines. I recommend putting them in one line in order keep your
		 code clean and readable */

		$target_pic = imagecopyresampled ( $target_id, $source_id, 0, 0, 0, 0, $dest_x, $dest_y, $source_x, $source_y );

		/* Create a jpeg with the quality of "$jpegqual" out of the
		 image object "$target_pic".
		 This will be saved as $targetfile */

		imagejpeg ( $target_id, "$targetfile", $jpegqual );

		return true;

	}

	static function resizeToFile2($sourcefile, $dest_x, $dest_y, $targetfile, $jpegqual) {

		$picsize = getimagesize ( "$sourcefile" );
		$source_x = $picsize [0];
		$source_y = $picsize [1];
		$arr = explode ( ".", $sourcefile );
		$ext = "";
		if (isset ( $arr [count ( $arr ) - 1] )) {
			$ext = $arr [count ( $arr ) - 1];
			$ext = strtolower ( $ext );
		}
		if ($ext == "jpg" or $ext == "jpeg") {
			$source_id = imageCreateFromJPEG ( "$sourcefile" );
		} elseif ($ext == "gif") {
			$source_id = imagecreatefromgif ( "$sourcefile" );
		} elseif ($ext == 'png') {
			$source_id = imagecreatefrompng ();
		}
		$target_id = imagecreatetruecolor ( $dest_x, $dest_y );
		$target_pic = imagecopyresampled ( $target_id, $source_id, 0, 0, 0, 0, $dest_x, $dest_y, $source_x, $source_y );

		imagejpeg ( $target_id, $targetfile, $jpegqual );

		return true;
	}

	
	static function getShowDay($cash = 0,$model_id='') {
		global $_K;
		
		$reward_day_rule = Cache_ext_Class::gettabledata("witkey_day_rule","model_id = '$model_id'",'rule_cash',NULL);
		for($i = 0; $i <= count ( $reward_day_rule ); $i ++) {

			if ($cash >= $reward_day_rule [$i] [rule_cash] && $cash < $reward_day_rule [$i + 1] [rule_cash]) {
				return $reward_day_rule [$i] [rule_day];
			} elseif ($cash < $reward_day_rule [0] [rule_cash]) {
				return $reward_day_rule [0] [rule_day];
			} elseif ($cash >= $reward_day_rule [count ( $reward_day_rule ) - 1] [rule_cash]) {
				return $reward_day_rule [count ( $reward_day_rule ) - 1] [rule_day];
			}
		}
	}

	static function getuserinfo($uid, $isusername = 0) {
		global $_K;
		$space_obj = new Keke_witkey_space_class ( );
		if ($isusername) {
			$space_obj->setWhere ( "username='{$uid}'" );
		} else {
			$space_obj->setWhere ( "uid={$uid}" );
		}
		$userinfo = $space_obj->query_keke_witkey_space ();;
		$userinfo = $userinfo [0];
		return $userinfo;
	}
	static function formatBytes($bytes) {
		if ($bytes >= 1073741824) {
			$bytes = round ( $bytes / 1073741824 * 100 ) / 100 . 'GB';
		} elseif ($bytes >= 1048576) {
			$bytes = round ( $bytes / 1048576 * 100 ) / 100 . 'MB';
		} elseif ($bytes >= 1024) {
			$bytes = round ( $bytes / 1024 * 100 ) / 100 . 'KB';
		} else {
			$bytes = $bytes . 'Bytes';
		}
		return $bytes;
	}

	static function feed_add($title, $uid, $username, $feedtype = "", $obj_id = 0, $obj_link = "", $icon = '') {
		$feed_obj = new Keke_witkey_feed_class ( );
		$feed_obj->setIcon ( $icon );
		$feed_obj->setFeed_time ( time () );
		$feed_obj->setFeedtype ( $feedtype );
		$feed_obj->setObj_link ( $obj_link );
		$feed_obj->setObj_id ( $obj_id );
		$feed_obj->setTitle ( $title );
		$feed_obj->setUid ( $uid );
		$feed_obj->setUsername ( $username );
		$feed_obj->create_keke_witkey_feed ();
	}
	
	static function notify_user($title, $content, $uid, $username = "") {
		if (! $username) {
			$userinfo = Func_comm_class::getuserinfo ( $uid );
			$username = $userinfo ['username'];
		}

		$message_obj = new Keke_witkey_message_class ( );
		$message_obj->setTitle ( $title );
		$message_obj->setContent ( $content );
		$message_obj->setOn_time ( time () );
		$message_obj->setRecive_uid ( $uid );
		$message_obj->setRecive_username ( $username );
		$message_obj->create_keke_witkey_message ();
	}
	static function prom_check() {
		if (isset ( $_COOKIE ['prom_cke'] )) {
			$prom_obj = new Keke_witkey_promotion_class ( );
			$prom_arr = unserialize ( $_COOKIE ['prom_cke'] );
			foreach ( $prom_arr as $k => $v ) {
				$c = db_factory::query ( "select count(*) as count from " . TABLEPRE . "witkey_promotion where task_id = $k and join_uid  = $_SESSION[uid]" );
				if ($c [0] [count] == 0) {
					$c2 = db_factory::query ( "select count(*) as count from " . TABLEPRE . "witkey_sign where task_id = $k and uid=$_SESSION[uid]" );
					if ($c2 [0] [count] == 0) {
						$prom_obj->setProm_id ( NULL );
						$prom_obj->setProm_uid ( $v [$k] );
						$prom_obj->setJoin_uid ( $_SESSION ['uid'] );
						$prom_obj->setTask_id ( $k );
						$prom_obj->setProm_time ( $v [time] );
						$prom_obj->create_keke_witkey_promotion ();
					}
				}
			}
			unset ( $_COOKIE ['prom_cke'] );
		}
	}

	static function cutstr($string, $length, $in_slashes = 0, $out_slashes = 0, $censor = '..', $html = 0) {
		global $_K;
		$string = trim ( $string );

		if ($in_slashes) {
			
			$string = stripslashes ( $string );
		}
		if ($html < 0) {
			
			$string = preg_replace ( "/(\<[^\<]*\>|\r|\n|\s|\[.+?\])/is", ' ', $string );
			$string = htmlspecialchars ( $string );
		} elseif ($html == 0) {
			
			$string = htmlspecialchars ( $string );
		}
		if ($length && strlen ( $string ) > $length) {
			
			$wordscut = '';
			if ($_K ['charset']  == 'UTF-8') {
				
				$n = 0;
				$tn = 0;
				$noc = 0;
				while ( $n < strlen ( $string ) ) {
					$t = ord ( $string [$n] );
					if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
						$tn = 1;
						$n ++;
						$noc ++;
					} elseif (194 <= $t && $t <= 223) {
						$tn = 2;
						$n += 2;
						$noc += 2;
					} elseif (224 <= $t && $t < 239) {
						$tn = 3;
						$n += 3;
						$noc += 2;
					} elseif (240 <= $t && $t <= 247) {
						$tn = 4;
						$n += 4;
						$noc += 2;
					} elseif (248 <= $t && $t <= 251) {
						$tn = 5;
						$n += 5;
						$noc += 2;
					} elseif ($t == 252 || $t == 253) {
						$tn = 6;
						$n += 6;
						$noc += 2;
					} else {
						$n ++;
					}
					if ($noc >= $length) {
						break;
					}
				}
				if ($noc > $length) {
					$n -= $tn;
				}
				$wordscut = substr ( $string, 0, $n );
			} else {
				for($i = 0; $i < $length - 1; $i ++) {
					if (ord ( $string [$i] ) > 127) {
						$wordscut .= $string [$i] . $string [$i + 1];
						$i ++;
					} else {
						$wordscut .= $string [$i];
					}
				}
			}
			$string = $wordscut.$censor;
		}

		if ($out_slashes) {
			$string = addslashes ( $string );
		}
		return trim ( $string );
	}
	
	static function str_filter($content = '') {
		if (is_array($content)) {
			foreach ($content as $k=>$v){
				$content[$k] = self::str_filter($v);
			}
			return $content;
		}
		else
		{
			$basic_info = Cache_ext_Class::getConfig ( 'basic' );
			$censor = $basic_info [ban_content];
			if(empty($censor)){
				return $content;
			}
			$censor_arr = explode ( '|', $censor );
			foreach ( $censor_arr as $v ) {
					$find [] = '/' . $v . '/i';
					$replase [] = '*';
				}
			
			return preg_replace ( $find, $replase, $content );
			
		}
	}
	
	static function k_strpos($k) {
		$basic_info = Cache_ext_Class::getConfig ( 'basic' );
		$user_arr = explode ( '|', $basic_info ['ban_users'] );
		$r = '';
		foreach ( $user_arr as $value ) {
			if (preg_match ( '/' . $value . '/', $k )) {
				$r = $value;
				break;
			}
		}
		return $r ? true : false;
	}
	
	function k_match($k_arr, $content) {
		$m = 0;
		foreach ( $k_arr as $value ) {
			if (preg_match ( '/' . $value . '/', $content )) {
				$m += 1;
			}
		}
		return $m;

	}
	
	static function check_login($jump_url = 'index.php') {
		if ($_SESSION [uid]) {
			return true;
		} else {
			die ( Func_comm_class::showmessage ( '访问拒绝', $jump_url, 3, '您访问的页面需要登录' ) );
		}
	}
	
	static function gmdate($timestamp) {
		global $_K;
		$time = $_K ['timestamp'] - $timestamp;
		if ($time > 24 * 3600) {
			$result = intval ( $time / (24 * 3600) ) . "天前";
		} elseif ($time > 3600) {
			$result = intval ( $time / 3600 ) . "小时前";
		} elseif ($time > 60) {
			$result = intval ( $time / 60 ) . "分钟前";
		} elseif ($time > 0) {
			$result = $time . "秒钟前";
		} else {
			$result = "现在";
		}
		return $result;
	}

	
	static function check_install() {
		$lock_file = S_ROOT . './data/keke_kppw_install.lck';
		if (! file_exists ( $lock_file )) {
			Func_comm_class::showmessage ( 'KPPW 专业威客程序，安装提示！', './install/index.php', 3, '您还没有正常安装KPPW 专业威客程序，请安装后再进行操作！' );
		}
	}

	
	static function update_score_value($uid, $action, $type) {
		global $_K;
		$uid = intval ( $uid );
		$type = intval ( $type );
		$score_config = Cache_ext_Class::getConfig ( 'score' );
		$space_obj = new Keke_witkey_space_class ( );
		$score_log_obj = new Keke_witkey_score_log_class ( );
		$user_info = Func_comm_class::getuserinfo ( $uid );
		$score = intval ( $score_config [$action] );
		$type = intval ( $type );
		$user_experience_value = intval ( $user_info [experience_value] );
		$add_score = intval ( $user_experience_value + $score );
		/*
		 return $add_score;
		 return $type;
		 return $uid;
		 return $add_score;
		 */
		if ($uid && $action && $type && $score && $add_score) {
			switch ($type) {
				case 1 :
					$score_log_obj->setWhere ( ' score_log_type ="' . $action . '" and uid = ' . $uid );
					$count = $score_log_obj->count_keke_witkey_score_log ();
					if ($count < 1) {
						$score_log_obj->setScore_log_type ( $action );
						$score_log_obj->setScore_num ( $score );
						$score_log_obj->setUid ( $uid );
						$score_log_obj->setOn_date ( time () );
						$score_log_obj->create_keke_witkey_score_log ();
						$space_obj->setUid ( $uid );
						$space_obj->setExperience_value ( $add_score );
						$res = $space_obj->edit_keke_witkey_space ();
					} else {
						$res = 0;
					}
					;
					break;
				case 2 :
					$score_log_obj->setScore_log_type ( $action );
					$score_log_obj->setScore_num ( $score );
					$score_log_obj->setUid ( $uid );
					$score_log_obj->setOn_date ( time () );
					$score_log_obj->create_keke_witkey_score_log ();
					$space_obj->setWhere ( 'uid =' . $uid );
					$space_obj->setExperience_value ( $add_score );
					$res = $space_obj->edit_keke_witkey_space ();
					;
					break;
				case 3 :
					$score_log_obj->setWhere ( ' score_log_type ="' . $action . '" and uid = ' . $uid . ' order by on_date desc limit 0,1 ' );
					$score_log_info = $score_log_obj->query_keke_witkey_score_log ();
					if (! $score_log_info || time () > intval ( $score_log_info [0] [on_date] + 24 * 3600 )) {
						$score_log_obj->setScore_log_type ( $action );
						$score_log_obj->setScore_num ( $score );
						$score_log_obj->setUid ( $uid );
						$score_log_obj->setOn_date ( time () );
						$score_log_obj->create_keke_witkey_score_log ();
						$space_obj->setWhere ( 'uid =' . $uid );
						$space_obj->setExperience_value ( $add_score );
						$res = $space_obj->edit_keke_witkey_space ();
					} else {
						$res = 0;
					}
					;
					break;
			}
		} else {
			$res = 0;
		}

		if ($res) {
			setcookie ( "score_log", $score . "-" . $action . '-' . $type, time () + 3600 );
		}
		return $res;
	}

	
	static function get_favorable_comment($uid, $type, $user_type = 1) {
		$uid = intval ( $uid );
		$type = intval ( $type );
		$user_type = intval ( $user_type );
		$mark_log_obj = new Keke_witkey_mark_log_class ( );
		$mark_log_obj->setWhere ( " mark_status = 1 and mark_type = " . $type . " and user_type =" . $user_type . " and uid = " . $uid );
		$mark_good = $mark_log_obj->count_keke_witkey_mark_log ();
		$mark_log_obj->setWhere ( " mark_status = 2 and mark_type = " . $type . " and user_type =" . $user_type . " and uid =" . $uid );
		$mark_middle = $mark_log_obj->count_keke_witkey_mark_log ();
		$mark_log_obj->setWhere ( " mark_status = 3 and mark_type = " . $type . " and user_type =" . $user_type . " and uid = " . $uid );
		$mark_bad = $mark_log_obj->count_keke_witkey_mark_log ();
		$mark_total = intval ( $mark_good + $mark_middle + $mark_bad );

		if ($mark_total == 0) {
			$favorable_comment_rate = 0;
		} else {
			$favorable_comment_rate = round ( $mark_good / $mark_total * 100, 2 ) . "％";
		}
		$favorable_comment [total] = intval ( $mark_total );
		$favorable_comment [good] = intval ( $mark_good );
		$favorable_comment [middle] = intval ( $mark_middle );
		$favorable_comment [bad] = intval ( $mark_bad );
		$favorable_comment [rate] = $favorable_comment_rate;
		return $favorable_comment;
	}

	

	static function get_experience_level($experience_value){
		$experience_value = intval($experience_value);
		$score_rule = Cache_ext_Class::gettabledata ( "witkey_score_rule", "", "max_score", "3600", "" );
		for($i = 0; $i < count ( $score_rule ); $i ++) {
			if ($experience_value < $score_rule [0] [max_score]) {
				$title = $score_rule [0] [unit_title];
				$pic = $score_rule [0] [unit_ico];
				$sc_id = $score_rule[0][score_rule_id];
			} elseif ($experience_value < $score_rule [$i + 1] [max_score] && $experience_value >= $score_rule [$i] [max_score]) {
				$title = $score_rule [$i+1] [unit_title];
				$pic = $score_rule [$i+1] [unit_ico];
				$sc_id = $score_rule[$i+1][score_rule_id];
			} elseif ($experience_value > $score_rule [count ( $score_rule ) - 1] [max_score]) {
				$title = $score_rule [count ( $score_rule ) - 1] [unit_title];
				$pic = $score_rule [count ( $score_rule ) - 1] [unit_ico];
				$sc_id = $score_rule[count ( $score_rule ) - 1][score_rule_id];
			}
		}
		$experience_level_arr[score_id] = $sc_id;
		$experience_level_arr[value] = $experience_value;
		$experience_level_arr[title] =  $title;
		$experience_level_arr[pic] = '<img src="' . $pic . '" align="absmiddle" title="头衔：'.$title.'&#13;&#10;经验值：'.$experience_value.'">';
		return $experience_level_arr;
	}


	static function get_mark_level($mark_value,$user_type){
		$mark_value = intval($mark_value);
		$user_type = intval($user_type);
		$mark_rule = Cache_ext_Class::gettabledata ( "witkey_mark_rule", "", "max_mark", "3600", "" );
		for($i = 0; $i < count ( $mark_rule ); $i ++) {
			if ($mark_value < $mark_rule [0] [max_mark]) {
					
				$g_pic = $mark_rule [0] [g_ico];
				$w_pic = $mark_rule [0] [m_ico];
			} elseif ($mark_value < $mark_rule [$i + 1] [max_mark] && $mark_value >= $mark_rule [$i] [max_mark]) {

				$g_pic = $mark_rule [$i+1] [g_ico];
				$w_pic = $mark_rule [$i+1] [m_ico];
			} elseif ($mark_value > $mark_rule [count ( $mark_rule ) - 1] [max_mark]) {

				$g_pic = $mark_value [count ( $mark_rule ) - 1] [g_ico];
				$w_pic = $mark_rule [count ( $mark_rule ) - 1] [m_ico];
			}
		}

		$mark_level_arr[value] = $mark_value;
		if($user_type==1){
			$mark_level_arr[pic] = '<img src="' . $g_pic . '" align="absmiddle" title="信誉值：'.$mark_value.'">';
		}else{
			$mark_level_arr[pic] = '<img src="' . $w_pic . '" align="absmiddle" title="信誉值：'.$mark_value.'">';
		}
		return $mark_level_arr;
	}


	static function get_comment_score($cash, $type = 2) {
		$type = intval ( $type );
		$score_rule = Cache_ext_Class::gettabledata ( "witkey_mark_config", "", "max_cash", null, "" );
		if ($type == 1) {
			$type = 'good';
		} elseif ($type == 2) {
			$type = 'normal';
		} elseif ($type == 3) {
			$type = 'bad';
		} else {
			$type = 'normal';
		}

		for($i = 0; $i < count ( $score_rule ); $i ++) {
			if ($cash < $score_rule [0] [max_cash]) {
				$score = $score_rule [0] [$type];
			} elseif ($cash <= $score_rule [$i + 1] [max_cash] && $cash > $score_rule [$i] [max_cash]) {
				$score = $score_rule [$i + 1] [$type];
			} elseif ($cash > $score_rule [count ( $score_rule ) - 1] [max_cash]) {
				$score = $score_rule [count ( $score_rule ) - 1] [$type];
			}
		}
		return intval ( $score );
	}
	
	static function formhash() {
		if (empty ( $_SESSION ['formhash'] )) {
			$_SESSION ['formhash'] = strtoupper ( substr ( sha1 ( sha1 ( time () ) . ENCODE_KEY ), 0, 10 ) );
		}
		return $_SESSION ['formhash'];

	}
	
	static function submitcheck($var) {
		if (! empty ( $_POST [$var] ) && $_SERVER ['REQUEST_METHOD'] == 'POST') {
			if ((empty ( $_SERVER ['HTTP_REFERER'] ) || preg_replace ( "/https?:\/\/([^\:\/]+).*/i", "\\1", $_SERVER ['HTTP_REFERER'] ) == preg_replace ( "/([^\:]+).*/", "\\1", $_SERVER ['HTTP_HOST'] )) && $_POST ['formhash'] == $_SESSION ['formhash']) {
				$_SESSION ['formhash'] = NULL;
				return true;
			} else {
				self::showmessage ( "操作错误", "index.php", 30, '非法或者重复的表单提交', 'error' );
			}
		} else {
			return false;
		}
	}
	static function curl_file_get_contents($durl) {

		$ch = curl_init ();

		curl_setopt ( $ch, CURLOPT_URL, $durl );

		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 5 );

		curl_setopt ( $ch, CURLOPT_USERAGENT, _USERAGENT_ );

		curl_setopt ( $ch, CURLOPT_REFERER, _REFERER_ );

		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		$r = curl_exec ( $ch );
		curl_close ( $ch );

		return $r;
	}
	static function get_real_ip() {
		$ip = false;
		if (! empty ( $_SERVER ["HTTP_CLIENT_IP"] )) {
			$ip = $_SERVER ["HTTP_CLIENT_IP"];
		}
		if (! empty ( $_SERVER ['HTTP_X_FORWARDED_FOR'] )) {
			$ips = explode ( ",", $_SERVER ['HTTP_X_FORWARDED_FOR'] );
			if ($ip) {
				array_unshift ( $ips, $ip );
				$ip = FALSE;
			}
			for($i = 0; $i < count ( $ips ); $i ++) {
				if (! eregi ( "^(10│172.16│192.168).", $ips [$i] )) {
					$ip = $ips [$i];
					break;
				}
			}
		}
		$ip = $ip ? $ip : $_SERVER ['REMOTE_ADDR'];
		list ( $ip1, $ip2, $ip3, $ip4 ) = explode ( ".", $ip );
		return $ip1 * pow ( 256, 3 ) + $ip2 * pow ( 256, 2 ) + $ip3 * 256 + $ip4;
	}
	
	static function get_shop_info($uid){
		$shop_obj = new Keke_witkey_shop_class();
		$shop_obj->setWhere(" uid = $uid");
		$shop_info = $shop_obj->query_keke_witkey_shop();
		if($shop_info){
			return $shop_info[0];
		}else {
			return FALSE;
		}
	}
	
	static  function del_att_file($fid=0){
		$file_obj = new Keke_witkey_file_class ( );
		if($fid>0){
			$file_obj->setWhere("file_id = $fid");
			$file_info = $file_obj->query_keke_witkey_file();
			$file_obj->setWhere("file_id = $fid");
			$file_obj->del_keke_witkey_file();
			if(file_exists($file_info[0]['file_save_name'])){
				return unlink($file_info[0]['file_save_name']);
			}
		}
	}

}
