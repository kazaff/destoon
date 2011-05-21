<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">添加模块</div>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="add"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">模块类型</td>
<td><input type="radio" name="post[islink]" value="0" onclick="$('link0').style.display='';$('link1').style.display='none';" id="islink" checked/> 内置模型 <input type="radio" name="post[islink]" value="1" onclick="$('link0').style.display='none';$('link1').style.display='';"/> 外部链接</td>
</tr>
<tr>
<td class="tl">模块名称 <span class="f_red">*</span></td>
<td><input name="post[name]" type="text" id="name" size="10" /> <?php echo dstyle('post[style]');?> <span id="dname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">导航菜单</td>
<td><input type="radio" name="post[ismenu]" value="1" checked/> 是&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="post[ismenu]" value="0" /> 否</td>
</tr>
<tr>
<td class="tl">新窗口打开</td>
<td><input type="radio" name="post[isblank]" value="1"/> 是&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="post[isblank]" value="0" checked /> 否</td>
</tr>
<tbody id="link1" style="display:none;">
<tr>
<td class="tl">链接地址 <span class="f_red">*</span></td>
<td><input name="post[linkurl]" type="text" id="linkurl" size="40" /> <span id="dlinkurl" class="f_red"></span></td>
</tr>
</tbody>
<tbody id="link0" style="display:;">
<tr>
<td class="tl">所属模型 <span class="f_red">*</span></td>
<td><?php echo $module_select;?> <span id="dmodule" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">安装目录 <span class="f_red">*</span></td>
<td><input name="post[moduledir]" type="text" id="moduledir" size="30" /> <input type="button" class="btn" value="目录检测" onclick="ckDir();"><?php tips('限英文、数字、中划线、下划线');?> <span id="dmoduledir" class="f_red"></span> </td>
</tr>
<tr>
<td class="tl">绑定域名</td>
<td><input name="post[domain]" type="text" id="domain" size="30" /><?php tips('例如http://sell.destoon.com/,以 / 结尾<br/>如果不绑定请勿填写');?></td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value="确 定" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="重 置" class="btn"></div>
</form>
<script type="text/javascript">
function ckDir() {
	if($('moduledir').value == '') {
		Dalert('请填写安装目录');
		$('moduledir').focus();
		return false;
	}
	var url = '?file=module&action=ckdir&moduledir='+$('moduledir').value;
	Diframe(url, 0, 0, 1);
}
function check() {
	var l;
	var f;
	f = 'name';
	l = $(f).value;
	if(l == '') {
		Dmsg('请填写模块名称', f);
		return false;
	}
	if($('islink').checked) {
		f = 'module';
		l = $(f).value;
		if(l == 0) {
			Dmsg('请选择所属模型', f);
			return false;
		}
		f = 'moduledir';
		l = $(f).value;
		if(l == '') {
			Dmsg('请填写安装目录', f);
			return false;
		}
	} else {
		f = 'linkurl';
		l = $(f).value.length;
		if(l < 2) {
			Dmsg('请填写链接地址', f);
			return false;
		}
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>