<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">生成充值卡</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">面额 <span class="f_red">*</span></td>
<td><input name="amount" id="amount" type="text" size="10" value="100"/> <span id="damount" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">卡号前缀 </td>
<td><input name="prefix" id="prefix" type="text" size="20" value="<?php echo $prefix;?>"/> <a href="javascript:" onclick="window.location.reload();" class="t">[刷新]</a> <span id="dprefix" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">卡号组成 <span class="f_red">*</span></td>
<td><input name="number_part" id="number_part" type="text" size="50" value="0123456789"/>
<select onchange="$('number_part').value=this.value">
<option value="0123456789">数字</option>
<option value="abcdefghijklmnopqrstuvwxyz">小写字母</option>
<option value="ABCDEFGHIJKLMNOPQRSTUVWXYZ">大写字母</option>
<option value="0123456789abcdefghijklmnopqrstuvwxyz">数字和小写字母</option>
<option value="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ">数字和大写字母</option>
</select>
<span id="dnumber_part" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">卡号长度 <span class="f_red">*</span></td>
<td><input name="number_length" id="number_length" type="text" size="20" value="10"/> 推荐8-15位之间 <span id="dnumber_length" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">密码长度 <span class="f_red">*</span></td>
<td><input name="password_length" id="password_length" type="text" size="20" value="8"/> 6位以上 <span id="dpassword_length" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">有效期至 <span class="f_red">*</span></td>
<td><?php echo dcalendar('totime', $totime);?>  <span id="dtotime" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">生成数量 <span class="f_red">*</span></td>
<td><input name="total" id="total" type="text" size="10" value="100"/> <span id="dtotal" class="f_red"></span></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	return confirm('确定要生成吗？');
}
</script>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>