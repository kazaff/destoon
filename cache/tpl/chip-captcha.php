<?php defined('IN_DESTOON') or exit('Access Denied');?><input name="captcha" id="captcha" type="text" size="6" onfocus="showcaptcha();" value="点击显示" onkeyup="checkcaptcha(this.value);" onblur="checkcaptcha(this.value);" class="f_gray" style="margin:10px 0 10px 0;"/>&nbsp;<img src="<?php echo DT_SKIN;?>image/loading.gif" title="验证码,看不清楚?请点击刷新&#10;字母不区分大小写" alt="" align="absmiddle" id="captchapng" onclick="reloadcaptcha();" style="display:none;cursor:pointer;"/><span id="ccaptcha"></span>
<script type="text/javascript">
function showcaptcha() {
	if($('captchapng').style.display=='none') {
		$('captchapng').style.display='';
	}
	if($('captchapng').src.indexOf('loading.gif') != -1) {
		$('captchapng').src='<?php echo DT_PATH;?>api/captcha.png.php?action=<?php echo crypt_action('image');?>';
	}
	if($('captcha').value=='点击显示') {
		$('captcha').value='';
	}
	$('captcha').className = '';
}
function reloadcaptcha() {
	$('captchapng').src = '<?php echo DT_PATH;?>api/captcha.png.php?action=<?php echo crypt_action('image');?>&refresh='+Math.random();
}
function checkcaptcha(s) {
	if(!is_captcha(s)) return;
	makeRequest('action=<?php echo crypt_action('captcha');?>&captcha='+s, AJPath, '_checkcaptcha');
}
function _checkcaptcha() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText == '0') {
			$('ccaptcha').innerHTML = '&nbsp;&nbsp;<img src="<?php echo DT_SKIN;?>image/check_right.gif" align="absmiddle"/>';
		} else {
			$('captcha').focus;
			$('ccaptcha').innerHTML = '&nbsp;&nbsp;<img src="<?php echo DT_SKIN;?>image/check_error.gif" align="absmiddle"/>';
		}
	}
}
</script>