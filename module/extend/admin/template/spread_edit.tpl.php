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
<div class="tt"><?php echo $action == 'add' ? '添加' : '修改';?>排名</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">排名模块 <span class="f_red">*</span></td>
<td>
<input type="radio" name="post[mid]" value="5" id="m_5"<?php if($mid == 5) echo ' checked';?>/><label for="m_5"> 供应</label>
<input type="radio" name="post[mid]" value="6" id="m_6"<?php if($mid == 6) echo ' checked';?>/><label for="m_6"> 求购</label>
<input type="radio" name="post[mid]" value="4" id="m_4"<?php if($mid == 4) echo ' checked';?>/><label for="m_4"> 公司</label>
</td>
</tr>
<tr>
<td class="tl">关键词 <span class="f_red">*</span></td>
<td><input type="text" size="20" name="post[word]" id="word" value="<?php echo $word;?>"/> <span id="dword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">出价 <span class="f_red">*</span></td>
<td><input type="text" size="20" name="post[price]" id="price" value="<?php echo $price;?>"/> <span id="dprice" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">单位 <span class="f_red">*</span></td>
<td>
<input type="radio" name="post[currency]" value="money" <?php if($currency == 'money') echo 'checked';?>/> <?php echo $DT['money_name'];?>&nbsp;
<input type="radio" name="post[currency]" value="credit" <?php if($currency == 'credit') echo 'checked';?>/> <?php echo $DT['credit_name'];?>
</td>
</tr>
<tr>
<td class="tl">信息ID <span class="f_red">*</span></td>
<td><input type="text" size="10" name="post[tid]" id="key_id" value="<?php echo $tid;?>" onfocus="Sid();"/> <a href="javascript:Sid();" class="t">选择..</a> <span id="dkey_id" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">投放时段 <span class="f_red">*</span></td>
<td><?php echo dcalendar('post[fromtime]', $fromtime);?> 至 <?php echo dcalendar('post[totime]', $totime);?> <span id="dtime" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">会员名称 <span class="f_red">*</span></td>
<td><input type="text" size="20" name="post[username]" id="username" value="<?php echo $username;?>"/> <span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">排名状态 <span class="f_red">*</span></td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?>/> 通过&nbsp;
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?>/> 待审
</td>
</tr>
<tr>
<td class="tl">备注事项</td>
<td><input type="text" size="60" name="post[note]" value="<?php echo $note;?>"/></td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function Sid() {
	if($('m_4').checked) {
		select_item(4);
	} else if($('m_5').checked) {
		select_item(5);
	} else if($('m_6').checked) {
		select_item(6);
	}
}
function check() {
	var l;
	var f;
	f = 'word';
	l = $(f).value.length;
	if(l < 2) {
		Dmsg('请输入关键词', f);
		return false;
	}
	f = 'price';
	l = $(f).value.length;
	if(l < 1) {
		Dmsg('请填写出价', f);
		return false;
	}
	f = 'key_id';
	l = $(f).value.length;
	if(l < 1) {
		Dmsg('请填写信息ID', f);
		return false;
	}	
	if($('postfromtime').value.length != 10 || $('posttotime').value.length != 10) {
		Dmsg('请选择投放时段', 'time');
		return false;
	}
	f = 'username';
	l = $(f).value.length;
	if(l < 3) {
		Dmsg('请填写会员名称', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
</body>
</html>