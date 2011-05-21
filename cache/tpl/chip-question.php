<?php defined('IN_DESTOON') or exit('Access Denied');?><span onmouseover="if($('question').style.display=='none') $('question').style.display='';" onmouseout="checkanswer($('answer').value);"><span id="question" style="display:none;"><span id="questionstr"></span>&nbsp;&nbsp;<a href="javascript:reloadquestion();">[换个问题]</a><br/></span>
<input name="answer" id="answer" type="text" size="30" onblur="checkanswer(this.value);"/><span id="canswer"></span>
</span>
<script type="text/javascript" src="<?php echo DT_PATH;?>api/captcha.png.php?action=<?php echo crypt_action('question');?>" id="questionsrc"></script>
<script type="text/javascript">
function reloadquestion() {
	$('question').style.display = '';
	s = document.createElement("script");
	s.type = "text/javascript";
	s.src = "<?php echo DT_PATH;?>api/captcha.png.php?action=<?php echo crypt_action('question');?>&refresh="+Math.random()+".js";
	document.body.appendChild(s);
}
function checkanswer(s) {
	if(s.length < 1) {
		$('answer').focus; return;
	}
	makeRequest('action=<?php echo crypt_action('question');?>&answer='+s, AJPath, '_checkanswer');
}
function _checkanswer() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText == '0') {
			$('canswer').innerHTML = '&nbsp;&nbsp;<img src="<?php echo DT_SKIN;?>image/check_right.gif" align="absmiddle"/>';
		} else {
			$('answer').focus;
			$('canswer').innerHTML = '&nbsp;&nbsp;<img src="<?php echo DT_SKIN;?>image/check_error.gif" align="absmiddle"/>';
		}
	}
}
</script>