<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">执行SQL</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;&nbsp;<textarea name="sql" id="sql" style="width:98%;height:300px;overflow:visible;font-family:Fixedsys,verdana;"></textarea></td>
</tr>
<tr>
<td>
&nbsp;&nbsp;<input type="submit" name="submit" value="执 行" class="btn"/> <span id="dsql" class="f_red"></span></td>
</tr>
</table>
</form>
<script type="text/javascript">
function check() {
	if($('sql').value == '') {
		Dmsg('SQL语句不能为空', 'sql');
		return false;
	}
	return confirm('确定要执行此语句吗？此操作将不可恢复');
}
</script>
<script type="text/javascript">Menuon(3);</script>
</body>
</html>