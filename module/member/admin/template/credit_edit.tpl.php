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
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt">修改证书 </div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">会员名 <span class="f_red">*</span></td>
<td><input name="post[username]" type="text"  size="10" value="<?php echo $username;?>"/>&nbsp;<a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?username=<?php echo $username;?>" target="_blank" class="t">[主页]</a></td>
</tr>
<tr>
<td class="tl">证书名称 <span class="f_red">*</span></td>
<td><input name="post[title]" type="text" id="title" size="40" value="<?php echo $title;?>"/> <?php echo dstyle('post[style]', $style);?> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">发证机构 <span class="f_red">*</span></td>
<td><input type="text" size="40" name="post[authority]" id="authority" value="<?php echo $authority;?>"/> <span id="dauthority" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">发证日期 <span class="f_red">*</span></td>
<td><?php echo dcalendar('post[fromtime]', $fromtime);?> <span id="dpostfromtime" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">到期日期</td>
<td><?php echo dcalendar('post[totime]', $totime);?> <span id="dposttotime" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">证书图片 <span class="f_red">*</span></td>
<td>
	<input type="hidden" name="post[thumb]" id="thumb" value="<?php echo $thumb;?>"/>
	<table width="120">
	<tr align="center" height="120" class="c_p">
	<td width="120"><img src="<?php echo $thumb ? $thumb : DT_SKIN.'image/waitpic.gif';?>" id="showthumb" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview($('showthumb').src, 1);}else{Dalbum('',<?php echo $moduleid;?>,120, 90, $('thumb').value, true);}"/></td>
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
<td class="tr"><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', 'Default', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>

<tr>
<td class="tl">证书状态</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?> id="status_3"/><label for="status_3"> 通过</label>
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?> id="status_2"/><label for="status_2">  待审</label>
<input type="radio" name="post[status]" value="1" <?php if($status == 1) echo 'checked';?> onclick="if(this.checked) $('note').style.display='';" id="status_1"/><label for="status_1">  拒绝</label>
<input type="radio" name="post[status]" value="0" <?php if($status == 0) echo 'checked';?> id="status_0"/><label for="status_0">  删除</label>
</td>
</tr>
<tr id="note" style="display:<?php echo $status==1 ? '' : 'none';?>">
<td class="tl">拒绝理由 <span class="f_red">*</span></td>
<td><input name="post[note]" type="text"  size="40" value="<?php echo $note;?>"/></td>
</tr>
<tr>
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
<script type="text/javascript">Menuon(<?php echo $menuon[$status];?>);</script>
</body>
</html>