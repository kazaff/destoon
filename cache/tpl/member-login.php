<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
<br/>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="20">&nbsp;</td>
<td width="300"><img src="<?php echo DT_SKIN;?>image/login_h.gif" alt="" width="300" height="35"/></td>
<td>&nbsp;</td>
</tr>
</table>


<table width="100%" cellpadding="0" cellspacing="0">
<tr bgcolor="#2D92DA">
<td width="20"> </td>
<td width="300" bgcolor="#FFFFFF" background="<?php echo DT_SKIN;?>image/login_b.gif">

	<form method="post" action="<?php echo $MOD['linkurl'];?><?php echo $DT['file_login'];?>"  onsubmit="return Dcheck();">
	<input name="forward" type="hidden" id="forward" value="<?php echo $forward;?>">
	<table width="290" cellpadding="3" cellspacing="4" align="center">
	<tr>
	<td colspan="2" class="f_gray">您尚未登录，或者访问了一个需要登录的页面..</td>
	</tr>
	<tr>
	<td align="right">
	<select name="option">
		<option value="username">用户名</option>
		<?php if($MOD['passport']) { ?><option value="passport">通行证</option><?php } ?>
		<option value="email">Email</option>
		<option value="userid">会员ID</option>
	</select>
	</td>
	<td><input name="username" type="text" id="username" value="<?php echo $username;?>" style="width:140px"/></td>
	</tr>
	<tr>
	<td align="right">密 码：</td>
	<td><?php include template('password', 'chip');?></td>
	</tr>
	<?php if($MOD['captcha_login']) { ?>
	<tr>
	<td align="right">验证码：</td>
	<td><?php include template('captcha', 'chip');?></td>
	</tr>
	<?php } ?>
	<tr>
	<td></td>
	<td><span title="选中后 24小时内不用再次登录 公共计算机请勿选"><input type="checkbox" name="cookietime" value="86400" id="cookietime"<?php if($MOD['login_remember']) { ?> checked<?php } ?>/><label for="cookietime">记住我</label></span>&nbsp;&nbsp;
	<span title="选中后 将直接进入商务室 不返回登录前的页面"><input type="checkbox" name="goto" value="1" id="goto"<?php if($MOD['login_goto']) { ?> checked<?php } ?>/><label for="goto">进入商务室</label></span>
	</td>
	</tr>
	<tr>
	<td></td>
	<td><input type="submit" name="submit" value=" 登 录 "/>&nbsp;&nbsp;<a href="<?php echo $MOD['linkurl'];?>send.php">忘记了密码？</a>
	</td>
	</tr>
	</form>
	</table>
</td>
<td width="20">&nbsp;</td>
<td bgcolor="#FFFFFF" width="350" valign="top"><a href="<?php echo $MOD['linkurl'];?><?php echo $DT['file_register'];?>"><img src="<?php echo DT_SKIN;?>image/login_say.gif" alt="" width="350" height="140"/></a></td>
<td width="30">&nbsp;</td>
<td class="f_white" style="line-height:180%;">
还没有会员账号?<br/>立即免费注册一个(仅需要大约1分钟)...<br/><br/>
<input type="button" value=" 立即免费注册 " class="pd3 px14 f_b ls1" style="background:#F8B003;" onclick="window.location='<?php echo $MOD['linkurl'];?><?php echo $DT['file_register'];?>';"/>
</td>
</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="20">&nbsp;</td>
<td width="300"><img src="<?php echo DT_SKIN;?>image/login_f.gif" alt="" width="300" height="25"/></td>
<td>&nbsp;</td>
</tr>
</table>
<br/>
<br/>
</div>
<script type="text/javascript">
if($('username').value == '') {
	$('username').focus();
} else {
	$('password').focus();
}
function Dcheck() {
	if($('username').value == '') {
		confirm('请输入登录名称');
		$('username').focus();
		return false;
	}
	if($('password').value == '') {
		confirm('请输入密码');
		$('password').focus();
		return false;
	}
<?php if($MOD['captcha_login']) { ?>
	if(!is_captcha($('captcha').value)) {
		confirm('请填写验证码');
		$('captcha').focus();
		return false;
	}
<?php } ?>
}
</script>
<?php include template('footer');?>