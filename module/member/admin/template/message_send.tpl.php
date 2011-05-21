<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">发送信件</div>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">发送类型 <span class="f_red">*</span></td>
<td>
<input type="radio" name="message[type]" value="1" onclick="$('group').style.display='';$('member').style.display='none';" checked id="type_1"/><label for="type_1"> 系统群发</label>
<input type="radio" name="message[type]" value="0" onclick="$('group').style.display='none';$('member').style.display='';" id="type_0"/><label for="type_0"> 指定收件人</label>
</td>
</tr>
<tr id="group" style="display:;">
<td class="tl">会员组 <span class="f_red">*</span></td>
<td><?php echo group_checkbox('message[groupids][]', '', '2,3,4');?></td>
</tr>
<tr id="member" style="display:none;">
<td class="tl">收件人 <span class="f_red">*</span></td>
<td><input type="text" size="50" name="message[touser]" id="touser" value="<?php echo $touser;?>"/>&nbsp;多个收件人请用空格分隔</td>
</tr>
<tr>
<td class="tl">标题 <span class="f_red">*</span></td>
<td><input type="text" size="50" name="message[title]" id="title"/> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">内容 <span class="f_red">*</span></td>
<td><textarea name="message[content]" id="content" class="dsn"></textarea>
<?php echo deditor($moduleid, 'content', 'Destoon', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
<?php if($touser) { ?>
$('type_0').checked = true;
$('group').style.display='none';
$('member').style.display='';
<?php } ?>
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
	if(l < 5) {
		Dmsg('内容最少5字，当前已输入'+l+'字', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>