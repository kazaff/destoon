<?php
defined('IN_DESTOON') or exit('Access Denied');
include IN_ROOT.'/header.tpl.php';
?>
<div class="head">
	<div>
		<strong>程序初始化设置</strong><br/>
		配置数据库连接参数、超级管理员账号及其他参数
	</div>
</div>
<div class="body">
<div>
<iframe id="db_tester" name="db_tester" style="display:none;"></iframe>
<form action="index.php" method="post" id="db_form" target="db_tester">
<input type="hidden" name="step" value="db_test"/>
<input type="hidden" name="tdb_host" id="tdb_host"/>
<input type="hidden" name="tdb_user" id="tdb_user"/>
<input type="hidden" name="tdb_pass" id="tdb_pass"/>
<input type="hidden" name="tdb_name" id="tdb_name"/>
<input type="hidden" name="ttb_pre" id="ttb_pre"/>
</form>
<script type="text/javascript">
function test() {
	if($('db_host').value == '') {
		alert('请填写数据库服务器');
		$('db_host').focus();
		return;
	}
	$('tdb_host').value = $('db_host').value;

	if($('db_user').value == '') {
		alert('请填写数据库用户名');
		$('db_user').focus();
		return;
	}
	$('tdb_user').value = $('db_user').value;
	$('tdb_pass').value = $('db_pass').value;

	if($('db_name').value == '') {
		alert('请填写数据库名');
		$('db_name').focus();
		return;
	}
	$('tdb_name').value = $('db_name').value;

	if($('tb_pre').value == '') {
		alert('请填写数据表前缀');
		$('tb_pre').focus();
		return;
	}
	$('ttb_pre').value = $('tb_pre').value;
	$('db_form').submit();
}
function check() {
	if($('db_host').value == '') {
		alert('请填写数据库服务器');
		$('db_host').focus();
		return false;
	}

	if($('db_user').value == '') {
		alert('请填写数据库用户名');
		$('db_user').focus();
		return false;
	}

	if($('db_name').value == '') {
		alert('请填写数据库名');
		$('db_name').focus();
		return false;
	}

	if($('tb_pre').value == '') {
		alert('请填写数据表前缀');
		$('tb_pre').focus();
		return false;
	}

	if($('username').value.length < 4) {
		alert('超级管理员户名最少4位');
		$('username').focus();
		return false;
	}

	if(!$('username').value.match(/^[a-z0-9]+$/)) {
		alert('超级管理员户名只能使用小写字母(a-z)、数字(0-9)');
		$('username').focus();
		return false;
	}

	if($('password').value.length < 6) {
		alert('超级管理员密码最少6位');
		$('password').focus();
		return false;
	}

	if($('email').value.length < 6) {
		alert('请填写超级管理员Email[重要]');
		$('email').focus();
		return false;
	}

	var dt_path = '<?php echo $DT_PATH;?>';
	if($('path').value == '') {
		alert('系统安装路径不能为空，如果安装在网站根目录，请填写/ ');
		$('path').focus();
		return false;
	}
	if(dt_path && $('path').value != dt_path) {
		if(!confirm('确定要改变系统安装路径?')) {
			$('path').value = dt_path;
		}
	}
	var dt_url = '<?php echo $DT_URL;?>';
	if($('url').value == '') {
		alert('网站访问地址不能为空，请填写当前网站访问地址');
		$('url').focus();
		return false;
	}
	if(dt_url && $('url').value != dt_url) {
		if(!confirm('确定要改变网站访问地址?')) {
			$('url').value = dt_url;
		}
	}

	if($('cookie_pre').value == '') {
		alert('Cookie前缀不能为空');
		$('cookie_pre').focus();
		return false;
	}
	$('tip').innerHTML = '<img src="load.gif" width="10" height="10" align="absmiddle"/> 安装正在进行，请稍候...';
	$('submit').disabled = true;
	return true;
}
</script>
<form action="index.php" method="post" id="dform" onsubmit="return check();">
<input type="hidden" name="step" value="5"/>
<table cellpadding="2" cellspacing="1" width="100%">
<tr>
<td>数据库服务器</td>
<td><input name="db_host" type="text" id="db_host" value="<?php echo $CFG['db_host'];?>" style="width:150px"/></td>
<td colspan="2">通常为localhost或服务器IP地址</td>
</tr>
<tr>
<td>数据库用户名</td>
<td><input name="db_user" type="text" id="db_user" value="<?php echo $CFG['db_user'];?>" style="width:150px"/></td>
<td>数据库密码</td>
<td><input name="db_pass" type="text" id="db_pass" value="<?php echo $CFG['db_pass'];?>" style="width:150px"/></td>
</tr>
<tr>
<td>数据库名</td>
<td><input name="db_name" type="text" id="db_name" value="<?php echo $CFG['db_name'];?>" style="width:150px"/></td>
<td>数据表前缀</td>
<td><input name="tb_pre" type="text" id="tb_pre" value="<?php echo $CFG['tb_pre'];?>" style="width:150px"/></td>
</tr>
<tr>
<td colspan="2" id="tip" style="color:blue;"> </td>
<td> </td>
<td><input type="button" value="测试数据库连接" onclick="test();void(0);"/></td>
</tr>

<tr>
<td>超级管理员户名</td>
<td><input name="username" type="text" id="username" value="destoon" style="width:150px"/></td>
<td colspan="2">只能使用小写字母(a-z)、数字(0-9)</td>
</tr>
<tr>
<td>超级管理员密码</td>
<td><input name="password" type="text" id="password" value="" style="width:150px"/></td>
<td colspan="2">建议使用6位以上数字、字母、特殊符号组合</td>
</tr>

<tr>
<td>超级管理员Email</td>
<td><input name="email" type="text" id="email" value="mail@destoon.com" style="width:150px"/></td>
<td>Cookie前缀</td>
<td title="如果同一域名下安装多个系统，请修改"><input name="cookie_pre" type="text" id="cookie_pre"  value="<?php echo $CFG['cookie_pre'];?>" style="width:150px"/></td>
</tr>
<tr title="系统自动识别，如无错误，请勿修改">
<td>系统安装路径</td>
<td><input name="path" type="text" id="path" value="<?php echo $DT_PATH;?>" style="width:150px"/></td>
<td>网站访问地址</td>
<td><input name="url" type="text" id="url" value="<?php echo $DT_URL;?>" style="width:150px"/></td>
</tr>

</table>

</div>
</div>
<div class="foot">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="215">
<div class="progress">
<div id="progress"></div>
</div>
</td>
<td id="percent"></td>
<td height="40" align="right">
<input type="button" value="上一步(P)" onclick="history.back(-1);"/>
<input type="submit" value="下一步(N)" id="submit"/>
&nbsp;&nbsp;
<input type="button" value="取消(C)" onclick="if(confirm('您确定要退出安装向导吗？')) window.close();"/>
</form>
<?php
include IN_ROOT.'/footer.tpl.php';
?>