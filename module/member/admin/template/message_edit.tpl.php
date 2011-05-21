<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">站内信件修改</div>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="message[type]" value="1"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">会员组</td>
<td><?php echo group_checkbox('message[groupids][]', $groupids, '2,3,4');?></td>
</tr>

<tr>
<td class="tl">标题</td>
<td><input type="text" size="50" name="message[title]" id="title" value="<?php echo $title;?>"/> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">内容</td>
<td><textarea name="message[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', 'Default', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
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
	f = 'content';
	l = FCKLen();
	if(l < 5 ) {
		Dmsg('内容最少5字，当前已输入'+l+'字', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(1);</script>
</body>
</html>