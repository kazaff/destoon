<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt"><?php echo $DT['money_name'];?>增减</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">会员名 <span class="f_red">*</span></td>
<td><input name="username" id="username" type="text" size="20" value="<?php echo $username;?>"/> <span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">类型 <span class="f_red">*</span></td>
<td>
<input name="type" type="radio" value="1" checked/> 收入&nbsp;&nbsp;&nbsp;&nbsp;
<input name="type" type="radio" value="0"/> 支出
</td>
</tr>
<tr>
<td class="tl">金额 <span class="f_red">*</span></td>
<td><input name="amount" id="amount" type="text" size="10"/> <span id="damount" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">支付方式 <span class="f_red">*</span></td>
<td>
<select name="bank" id="bank">
<option value="">请选择</option>
<?php
foreach($BANKS as $v) {
	echo '<option value="'.$v.'">'.$v.'</option>';
}
?>
<option value="其他">其他</option>
</select> <span id="dbank" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl">事由 <span class="f_red">*</span></td>
<td><input name="reason" id="reason" type="text" size="40" value="现金"/> <span id="dreason" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">备注</td>
<td><input name="note" type="text" size="40" value="手工"/></td>
</tr>
<tr>
<td class="tl">注意</td>
<td class="f_red">此表单一经提交，将不可再修改或删除，请务必谨慎操作</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'username';
	l = $(f).value.length;
	if(l < 3) {
		Dmsg('请填写会员名', f);
		return false;
	}
	f = 'amount';
	l = $(f).value;
	if(l == '') {
		Dmsg('请填写金额', f);
		return false;
	}
	f = 'bank';
	l = $(f).value;
	if(l == '') {
		Dmsg('请选择支付方式', f);
		return false;
	}
	f = 'reason';
	l = $(f).value.length;
	if(l < 2) {
		Dmsg('请填写事由', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>