<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">修改密码</div>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">新登录密码 <span class="f_red">*</span></td>
<td><input type="password" name="password" size="30" id="password"/> <span id="dpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">重复新密码 <span class="f_red">*</span></td>
<td><input type="password" name="cpassword" size="30" id="cpassword"/> <span id="dcpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">现有密码 <span class="f_red">*</span></td>
<td><input type="password" name="oldpassword" size="30" id="oldpassword"/> <span id="doldpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"> </td>
<td><input type="submit" name="submit" value="修 改" class="btn"/></td>
</tr>
</form>
</table>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'password';
	l = $(f).value.length;
	if(l < 6) {
		Dmsg('新登录密码最少6位，当前已输入'+l+'位', f);
		return false;
	}
	f = 'cpassword';
	l = $(f).value;
	if(l != $('password').value) {
		Dmsg('重复新密码与新登录密码不一致', f);
		return false;
	}
	f = 'oldpassword';
	l = $(f).value.length;
	if(l < 6) {
		Dmsg('现有密码最少6位，当前已输入'+l+'位', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(2);</script>
</body>
</html>