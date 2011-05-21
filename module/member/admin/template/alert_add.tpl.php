<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt">添加提醒</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">会员名 <span class="f_red">*</span></td>
<td><textarea name="post[username]" id="username" style="width:200px;height:100px;overflow:visible;"><?php echo $username;?></textarea><?php tips('允许批量添加，一行一个，点回车换行');?><br/><span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">商机类型</td>
<td>
<select name="post[mid]">
<?php foreach($mids as $v) { ?>
<option value="<?php echo $v;?>"<?php echo $mid == $v ? ' selected' : '';?>><?php echo $MODULE[$v]['name'];?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td class="tl">关键词</td>
<td><input type="text" name="post[word]" id="word" size="30" value="<?php echo $word;?>" maxlength="30"/><span id="dword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">行业分类</td>
<td><div id="catesch"></div><?php echo ajax_category_select('post[catid]', '请选择', $catid, $mid, 'size="2" style="height:120px;width:180px;"');?><span id="dcatid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">所在地区</td>
<td><?php echo ajax_area_select('post[areaid]', '请选择', $areaid);?> <span id="dareaid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">发送频率</td>
<td>
<select name="post[rate]">
<option value="0"<?php if($rate==0) { ?> selected<?php } ?>>不限</option>
<option value="1"<?php if($rate==1) { ?> selected<?php } ?>>1天</option>
<option value="3"<?php if($rate==3) { ?> selected<?php } ?>>3天</option>
<option value="7"<?php if($rate==7) { ?> selected<?php } ?>>7天</option>
<option value="15"<?php if($rate==15) { ?> selected<?php } ?>>15天</option>
<option value="30"<?php if($rate==30) { ?> selected<?php } ?>>30天</option>
</select>
</td>
</tr>

<tr>
<td class="tl">提醒状态</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?> id="status_3"/><label for="status_3"> 通过</label>
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?> id="status_2"/><label for="status_2"> 待审</label>
</td>
</tr>

</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'username';
	if($(f).value == '') {
		Dmsg('请填写会员名', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
</body>
</html>