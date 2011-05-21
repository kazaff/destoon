<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">发送短信</div>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="send" value="1"/>
<input type="hidden" name="preview" id="preview" value="0"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">收信人 <span class="f_red">*</span></td>
<td>
	<input type="radio" name="sendtype" value="1" id="s1" onclick="ck(1);" checked/> <label for="s1">单收信人</label>
	<input type="radio" name="sendtype" value="2" id="s2" onclick="ck(2);"/> <label for="s2">多收信人</label>
	<input type="radio" name="sendtype" value="3" id="s3" onclick="ck(3);"/> <label for="s3">列表群发</label>
</td>
</tr>
<tbody id="t1" style="display:;">
<tr>
<td class="tl">接收号码 <span class="f_red">*</span></td>
<td><input type="text" size="35" name="mobile" value="<?php echo $mobile;?>"/></td>
</tr>
</tbody>
<tbody id="t2" style="display:none;">
<tr>
<td class="tl">接收号码 <span class="f_red">*</span></td>
<td class="f_gray"><textarea name="mobiles" rows="4" cols="35"></textarea><br/>[一行一个接收号码]</td>
</tr>
</tbody>
<tbody id="t3" style="display:none;">
<tr>
<td class="tl">号码列表 <span class="f_red">*</span></td>
<td class="f_red">
<?php
	echo '<select name="mobilelist" id="mobilelist"><option value="0">请选择号码列表</option>';
	$mails = glob(DT_ROOT.'/file/mobile/*.txt');
	if($mails) {
		foreach($mails as $m) {
			$tmp = basename($m);
			echo '<option value="'.$tmp.'">'.$tmp.'</option>';
		}
	} else {
		echo '<option value="">无号码列表</option>';
	}
	echo '</select>';
?>
&nbsp;&nbsp;<a href="javascript:" onclick="if($('mobilelist').value != 0){window.open('file/mobile/'+$('mobilelist').value);}else{alert('请先选择号码列表');$('mobilelist').focus();}" class="t">[查看选中]</a>&nbsp;&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=make" class="t">[获取列表]</a>
</td>
</tr>
<tr>
<td class="tl">每轮发送短信数 <span class="f_red">*</span></td>
<td><input type="text" size="5" name="pernum" id="pernum" value="5"/></td>
</tr>
</tbody>
<tr>
<td class="tl">短信内容 <span class="f_red">*</span></td>
<td>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td valign="top" width="250"><textarea name="content" id="content" rows="15" cols="35" onkeyup="S();" onblur="S();"></textarea></td>
<td valign="top" class="f_gray"><br/>
- 当前已输入 <strong id="chars" class="f_red">0</strong> 字(<?php echo $DT['sms_len'];?>字/条)<br/>
- 内容支持变量，会员资料保存于$user数组<br/>
- 例 {$user[username]} 表示会员名<br/>
- 例 {$user[company]} 表示公司名<br/>
- 如果是给非会员发送短信，请不要使用变量<br/>
<?php if(!$DT['sms'] || !$DT['sms_uid'] || !$DT['sms_key']) { ?>
<span class="f_red">- 注意：无法发送，未设置发送参数</span> <a href="?file=setting" class="t">点此设置</a><br/>
<?php } ?>
<span id="dcontent" class="f_red"></span>
</td>
</tr>
</table>
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn" onclick="$('preview').value=0;this.form.target='';"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value=" 预 览 " class="btn" onclick="$('preview').value=1;this.form.target='_blank';"/></div>
</form>
<script type="text/javascript">
function S() {
	$('chars').innerHTML = $('content').value.length;
}
var i = 1;
function ck(id) {
	$('t'+i).style.display='none';
	$('t'+id).style.display='';
	i = id;
}
function check() {
	var l;
	var f;
	f = 'content';
	l = $(f).value.length;
	if(l < 2) {
		Dmsg('内容不能为空', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>