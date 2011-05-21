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
<div class="tt"><?php echo $action == 'add' ? '添加' : '修改';?>投票</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">投票分类 <span class="f_red">*</span></td>
<td><?php echo type_select('vote', 1, 'post[typeid]', '请选择分类', $typeid, 'id="typeid"');?> <span id="dtypeid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">投票有效期</td>
<td><?php echo dcalendar('post[fromtime]', $fromtime);?> 至 <?php echo dcalendar('post[totime]', $totime);?></td>
</tr>
<tr>
<td class="tl">投票标题 <span class="f_red">*</span></td>
<td><input name="post[title]" type="text" id="title" size="50" value="<?php echo $title;?>"/> <?php echo dstyle('post[style]', $style);?>&nbsp; <?php echo level_select('post[level]', '级别', $level);?> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">链接至</td>
<td><input name="post[linkto]" type="text" id="linkto" size="50" value="<?php echo $linkto;?>"/></td>
</tr>
<tr>
<td class="tl">
投票说明 <span class="f_red">*</span>
</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', 'Destoon', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl">投票类别 <span class="f_red">*</span></td>
<td>
<input type="radio" name="post[choose]" value="0" id="choose_0"<?php if(!$choose) echo ' checked';?> onclick="Dh('vote_num');"/><label for="choose_0"> 单选</label>
<input type="radio" name="post[choose]" value="1" id="choose_1"<?php if($choose) echo ' checked';?> onclick="Ds('vote_num');"/><label for="choose_1"> 多选</label>
</td>
</tr>

<tr id="vote_num" style="display:<?php echo $choose ? '' : 'none';?>">
<td class="tl">必选数量 <span class="f_red">*</span></td>
<td>
<input name="post[vote_min]" type="text" id="vote_min" size="5" value="<?php echo $vote_min;?>"/>
至
<input name="post[vote_max]" type="text" id="vote_max" size="5" value="<?php echo $vote_max;?>"/>
</td>
</tr>
<?php for($i=1;$i<11;$i++) { $s = 's'.$i; ?>
<tr>
<td class="tl">投票主题<?php echo $i;?></td>
<td><input name="post[s<?php echo $i;?>]" type="text" id="s<?php echo $i;?>" size="50" value="<?php echo $$s;?>"/></td>
</tr>
<?php } ?>
<tr title="请保持时间格式">
<td class="tl">添加时间</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
<tr>
<td class="tl">投票模板</td>
<td><?php echo tpl_select('vote', 'chip', 'post[template_vote]', '默认模板', $template_vote);?></td>
</tr>
<tr>
<td class="tl">结果模板</td>
<td><?php echo tpl_select('vote', $module, 'post[template]', '默认模板', $template);?></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'typeid';
	l = $(f).value;
	if(l == 0) {
		Dmsg('请选择投票分类', f);
		return false;
	}
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
	} else {
		f = 'content';
		l = FCKLen();
		if(l < 5) {
			Dmsg('内容最少5字，当前已输入'+l+'字', f);
			return false;
		}
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
</body>
</html>