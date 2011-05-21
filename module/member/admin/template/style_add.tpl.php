<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">安装模板</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">模板分类</td>
<td><?php echo type_select('style', 1, 'post[typeid]', '请选择分类', 0, 'id="typeid"');?> <span id="dtypeid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">模板名称 <span class="f_red">*</span></td>
<td><input name="post[title]" type="text" id="title" size="30" /> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">风格目录 <span class="f_red">*</span></td>
<td><input name="post[skin]" id="skin" type="text" size="30" /><?php tips('请上传目录至 ./'.$MODULE[4]['moduledir'].'/skin/ 名称为数字、字母组合');?> <span id="dskin" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">模板目录 <span class="f_red">*</span></td>
<td><input name="post[template]" id="template" type="text" size="30" /><?php tips('请上传目录至 ./template/'.$CFG['template'].'/ 名称为数字、字母组合');?> <span id="dtemplate" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">模板作者</td>
<td><input name="post[author]" type="text" size="20" /></td>
</tr>
<tr>
<td class="tl">会员组 <span class="f_red">*</span></td>
<td><?php echo group_checkbox('post[groupid][]', '6,7', '1,2,3,4');?></td>
</tr>
<tr>
<td class="tl">价格(/月)</td>
<td>
<input name="post[fee]" type="text" size="5" value="0"/>&nbsp;&nbsp;
<input type="radio" name="post[currency]" value="money" checked/> <?php echo $DT['money_name'];?>&nbsp;&nbsp;
<input type="radio" name="post[currency]" value="credit"/> <?php echo $DT['credit_name'];?> 
</td>
</tr>
<tr title="请保持时间格式">
<td class="tl">添加时间</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	var f;
	f = 'title';
	if($(f).value == '') {
		Dmsg('请填写模板名称', f);
		return false;
	}
	f = 'skin';
	if($(f).value == '') {
		Dmsg('请填写风格目录', f);
		return false;
	}
	f = 'template';
	if($(f).value == '') {
		Dmsg('请填写模板目录', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>