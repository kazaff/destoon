<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">添加证书</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">会员名 <span class="f_red">*</span></td>
<td><input name="post[username]" type="text"  size="20" value="<?php echo $_username;?>"/></td>
</tr>
<tr>
<td class="tl">证书标题 <span class="f_red">*</span></td>
<td><input name="post[title]" type="text" id="title" size="40" /> <?php echo dstyle('post[style]');?> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">发证机构 <span class="f_red">*</span></td>
<td><input type="text" size="40" id="authority" name="post[authority]"/> <span id="dauthority" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">发证日期 <span class="f_red">*</span></td>
<td><?php echo dcalendar('post[fromtime]');?> <span id="dpostfromtime" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">到期日期</td>
<td><?php echo dcalendar('post[totime]');?> <span id="dposttotime" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">证书图片 <span class="f_red">*</span></td>
<td>
	<input type="hidden" name="post[thumb]" id="thumb"/>
	<table width="120">
	<tr align="center" height="120" class="c_p">
	<td width="120"><img src="<?php echo DT_SKIN;?>image/waitpic.gif" id="showthumb" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview($('showthumb').src, 1);}else{Dalbum('',<?php echo $moduleid;?>,100, 100, $('thumb').value, true);}"/></td>
	</tr>
	<tr align="center" height="25">
	<td><span onclick="Dalbum('',<?php echo $moduleid;?>,100, 100, $('thumb').value, true);" class="jt">[上传]</span>&nbsp;<span onclick="delAlbum('','wait');" class="jt">[删除]</span></td>
	</tr>
	</table>
	<span id="dthumb" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl">证书介绍</td>
<td class="tr"><textarea name="post[content]" id="content" class="dsn"></textarea>
<?php echo deditor($moduleid, 'content', 'Default', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl">证书状态</td>
<td>
<input type="radio" name="post[status]" value="3" checked/> 通过
<input type="radio" name="post[status]" value="2" /> 待审
</td>
</tr>
<tr title="请保持时间格式">
<td class="tl">添加时间</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function check() {
	if($('title').value == '') {
		Dmsg('请填写证书名称', 'title');
		return false;
	}
	if($('authority').value == '') {
		Dmsg('请填写发证机构', 'authority');
		return false;
	}
	if($('postfromtime').value == '') {
		Dmsg('请选择发证日期', 'postfromtime');
		return false;
	}
	if($('thumb').value == '') {
		Dmsg('请上传证书图片', 'thumb', 1);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>