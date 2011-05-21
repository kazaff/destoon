<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<div class="tt">分类添加</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">上级分类</td>
<td><?php echo category_select('category[parentid]', '请选择', $parentid, $mid);?><?php tips('如果不选择，则为顶级分类');?></td>
</tr>
<tr>
<td class="tl">分类名称 <span class="f_red">*</span></td>
<td><textarea name="category[catname]"  id="catname" style="width:200px;height:100px;overflow:visible;" onblur="get_letter(this.value);"></textarea><?php tips('允许批量添加，一行一个，点回车换行');?><br/><span id="dcatname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">分类目录[英文名]</td>
<td><input name="category[catdir]" type="text" id="catdir" size="20" /> <input type="button" class="btn" value="目录检测" onclick="ckDir();"><?php tips('限[a-z]、[A-z]、[0-9]、_、- 、/<br/>该分类相关的html文件将保存在此目录<br/>如果需要生成多级目录，请用 / 分隔目录<br/>如果不填写则自动将分类id作为目录');?> <span id="dcatdir" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">字母索引</td>
<td><input name="category[letter]" type="text" id="letter" size="2" /><?php tips('填写分类名称后系统会自动获取 如果没有获取成功请填写<br/>例如 分类名称为 嘉客 则填写 j');?></td>
</tr>
<tr>
<td class="tl">级别</td>
<td><input name="category[level]" type="text" size="2" value="1"/><?php tips('0 - 不在首页显示 1 - 正常显示 2 - 首页和上级分类并列显示');?></td>
</tr>

<tr>
<td class="tl">分类模板</td>
<td><?php echo tpl_select('list', $MODULE[$mid]['module'], 'category[template]', '默认模板');?></td>
</tr>
<tr>
<td class="tl">内容模板</td>
<td><?php echo tpl_select('show', $MODULE[$mid]['module'], 'category[show_template]', '默认模板');?></td>
</tr>

<tr>
<td class="tl">Title(SEO标题)</td>
<td><input name="category[seo_title]" type="text" size="61"></td>
</tr>
<tr>
<td class="tl">Meta Keywords<br/>(网页关键词)</td>
<td><textarea name="category[seo_keywords]" cols="60" rows="3" id="seo_keywords"></textarea></td>
</tr>
<tr>
<td class="tl">Meta Description<br/>(网页描述)</td>
<td><textarea name="category[seo_description]" cols="60" rows="3" id="seo_description"></textarea></td>
</tr>
<tr>
<td class="tl">权限设置</td>
<td class="f_blue">如果没有特殊需要，以下选项不需要设置，全选或全不选均代表拥有对应权限</td>
</tr>
<tr>
<td class="tl">允许浏览分类</td>
<td><?php echo group_checkbox('category[group_list][]');?></td>
</tr>
<tr>
<td class="tl">允许浏览分类信息内容</td>
<td><?php echo group_checkbox('category[group_show][]');?></td>
</tr>
<tr>
<td class="tl">允许发布信息</td>
<td><?php echo group_checkbox('category[group_add][]');?></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value="确 定" class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="重 置" class="btn"/></div>
</form>
<script type="text/javascript">
function ckDir() {
	if($('catdir').value == '') {
		Dtip('请填写分类目录');
		$('catdir').focus();
		return false;
	}
	var url = '?file=category&action=ckdir&mid=<?php echo $mid;?>&catdir='+$('catdir').value;
	Diframe(url, 0, 0, 1);
}
function check() {
	if($('catname').value == '') {
		Dmsg('请填写分类名称', 'catname');
		return false;
	}
	return true;
}
function get_letter(catname) {
	makeRequest('file=<?php echo $file;?>&mid=<?php echo $mid;?>&action=letter&catname='+catname, '?', '_get_letter');
}
function _get_letter() {
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) {
			if($('catdir').value == '') $('catdir').value = xmlHttp.responseText;
			if($('letter').value == '') $('letter').value = xmlHttp.responseText.substr(0,1);
		}
	}
}
</script>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>