<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="item" value="<?php echo $item;?>"/>
<div class="tt">修改单页</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">单页标题 <span class="f_red">*</span></td>
<td><input name="post[title]" type="text" id="title" size="50" value="<?php echo $title;?>"/> <?php echo dstyle('post[style]', $style);?>&nbsp; <?php echo level_select('post[level]', '级别', $level);?> &nbsp;<input type="checkbox" name="post[islink]" value="1" id="islink" onclick="_islink();"  <?php if($islink) echo 'checked';?>/> 外部链接 <br/><span id="dtitle" class="f_red"></span></td>
</tr>
<tr id="link" style="display:<?php echo $islink ? '' : 'none';?>;">
<td class="tl">链接地址 <span class="f_red">*</span></td>
<td><input name="post[linkurl]" type="text" id="linkurl" size="50" value="<?php echo $linkurl;?>"/> <span id="dlinkurl" class="f_red"></span></td>
</tr>
<tbody id="basic" style="display:<?php echo $islink ? 'none' : '';?>;">
<tr>
<td class="tl">单页内容</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', 'Default', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl" height="30">内容选项</td>
<td><input type="checkbox" name="post[save_remotepic]" value="1"/> 下载内容远程图片
<input type="checkbox" name="post[clear_link]" value="1"/> 清除内容链接
</td>
</tr>
<tr>
<td class="tl">保存路径</td>
<td><input name="post[filepath]" type="text" size="20" value="<?php echo $filepath;?>"/> <span class="f_gray">如不填写则生成在网站根目录，否则请以‘/’结尾，例如‘about/’</span></td>
</tr>
<tr>
<td class="tl">文件名称</td>
<td><input name="post[filename]" type="text" size="20" value="<?php echo $filename;?>"/> <span class="f_gray">如不填写则自动按ID生成文件名，例如‘page-1.html’</span></td>
</tr>
<tr>
<td class="tl">绑定域名</td>
<td><input name="post[domain]" type="text" size="60" value="<?php echo $domain;?>"/><?php tips('例如设置的生成路径为machine/index.html<br/>那么可以绑定machine.xxx.com至machine目录<br/>此处填写http://machine.xxx.com/');?></td>
</tr>
<tr>
<td class="tl">SEO标题</td>
<td><input name="post[seo_title]" type="text" size="60" value="<?php echo $seo_title;?>"/></td>
</tr>
<tr>
<td class="tl">SEO关键词</td>
<td><input name="post[seo_keywords]" type="text" size="60" value="<?php echo $seo_keywords;?>"/></td>
</tr>
<tr>
<td class="tl">SEO描述</td>
<td><input name="post[seo_description]" type="text" size="60" value="<?php echo $seo_description;?>"/></td>
</tr>
<tr>
<td class="tl">内容模板</td>
<td><?php echo tpl_select('webpage', $module, 'post[template]', '默认模板', $template);?></td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'title';
	l = $(f).value.length;
	if(l < 2) {
		Dmsg('标题最少2字，当前已输入'+l+'字', f);
		return false;
	}
	if($('islink').checked) {
		f = 'linkurl';
		l = $(f).value.length;
		if(l < 12) {
			Dmsg('请输入正确的链接地址', f);
			return false;
		}
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
</body>
</html>