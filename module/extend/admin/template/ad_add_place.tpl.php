<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="runcode_form" target="_blank">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="runcode"/>
<input type="hidden" name="codes" value=""/>
</form>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt">添加广告位</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">广告位名称 <span class="f_red">*</span></td>
<td><input name="place[name]" id="name" type="text" size="30" /> <?php echo dstyle('place[style]');?> <span id="dname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">广告位介绍</td>
<td><input name="place[introduce]" type="text" size="60" /></td>
</tr>
<tr>
<td class="tl">广告位类型 <span class="f_red">*</span></td>
<td>
<?php foreach($TYPE as $k=>$v) {
	if($k) echo '<input name="place[typeid]" type="radio" value="'.$k.'" '.($k == 1 ? 'checked' : '').' id="p'.$k.'" onclick="sh('.$k.');"/> <label for="p'.$k.'">'.$v.'&nbsp;</label>';
}
?>
</td>
</tr>
<tr id="wh" style="display:none">
<td class="tl">广告位大小 <span class="f_red">*</span></td>
<td class="f_gray"><input name="place[width]" id="width" type="text" size="5" /> X <input name="place[height]" id="height" type="text" size="5" /> [宽 X 高 px] <span id="dsize" class="f_red"></span>
</td>
</tr>
<tr id="md" style="display:none">
<td class="tl">所属模块 <span class="f_red">*</span></td>
<td><?php echo module_select('place[moduleid]', '请选择', 0, 'id="mid"');?> <span id="dmid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">广告位价格</td>
<td><input name="place[price]" type="text" size="5" /> <?php echo $unit;?>/月 <span class="f_gray">[0或不填表示待议]</span></td>
</tr>
<tr>
<td class="tl">默认广告代码</td>
<td><textarea name="place[code]" id="code" style="width:98%;height:50px;overflow:visible;font-family:Fixedsys,verdana;"></textarea><br/>
<input type="button" value=" 运行代码 " class="btn" onclick="runcode();"/><span class="f_gray">&nbsp;当广告位下无广告时，显示此代码，支持html、css、js 如果广告位采用js调用，此处不建议使用js代码</span><span id="dcode" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">网站前台显示</td>
<td>
<input type="radio" name="place[open]" value="1" checked/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="place[open]" value="0"/> 否
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">
function sh(id) {
	if(id == 6 || id == 7) {
		Ds('md');Dh('wh');
	} else if(id == 3 || id == 4 || id == 5) {
		Dh('md');Ds('wh');
	} else {
		Dh('md');Dh('wh');
	}
}
function check() {
	var l;
	var f;
	f = 'name';
	l = $(f).value.length;
	if(l < 1) {
		Dmsg('请填写广告位名称', f);
		return false;
	}
	if($('p3').checked || $('p4').checked || $('p5').checked) {
		if($('width').value.length < 2 || $('height').value.length < 2) {
			Dmsg('请填写广告位大小', 'size');
			return false;
		}
	}
	if($('p6').checked || $('p7').checked) {
		if($('mid').value == 0) {
			Dmsg('请选择所属模块', 'mid');
			return false;
		}
	}
	return true;
}
function runcode() {
	if($('code').value.length < 3) {
		Dmsg('请填写代码', 'code');
		return false;
	}
	$('codes').value = $('code').value;
	$('runcode_form').submit();
}
</script>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>