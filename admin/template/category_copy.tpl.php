<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<div class="tt">分类复制</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">源模块ID <span class="f_red">*</span></td>
<td><input name="fromid" type="text" id="fromid" size="10"/>&nbsp;
<span id="dfromid" class="f_red"></span>
<a href="?file=module" target="_blank">查询模块ID</a>
</td>
</tr>
<tr>
<td class="tl">当前模块分类数据 <span class="f_red">*</span></td>
<td>
<input type="radio" name="save" value="1" checked/> 保留
<input type="radio" name="save" value="0"/> 删除
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value="复 制" class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	if($('fromid').value == '') {
		Dmsg('请填写源模型ID', 'fromid');
		return false;
	}
	return confirm('此操作不可撤销，确定要执行吗？');
}
</script>
<script type="text/javascript">Menuon(2);</script>
</body>
</html>