<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">数据互转</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">转移类型 <span class="f_red">*</span></td>
<td class="c_p">
<table cellpadding="3" cellspacing="3" width="100%">
<tr onclick="$('t_1').checked=true;">
<td width="20"><input type="radio" name="type" value="1" id="t_1"/></td>
<td>供应 &rarr; 求购</td>
</tr>
<tr onclick="$('t_2').checked=true;">
<td><input type="radio" name="type" value="2" id="t_2"/></td>
<td>求购 &rarr; 供应</td>
</tr>
<tr onclick="$('t_3').checked=true;">
<td><input type="radio" name="type" value="3" id="t_3"/></td>
<td>
<select name="afid" id="afid">
<option value="0">文章</option>
<?php
foreach($MODULE as $m) {
	if($m['module'] == 'article') {
		echo '<option value="'.$m['moduleid'].'">'.$m['name'].'</option>';
	}
}
?>
</select>
&rarr;
<select name="atid" id="atid">
<option value="0">文章</option>
<?php
foreach($MODULE as $m) {
	if($m['module'] == 'article') {
		echo '<option value="'.$m['moduleid'].'">'.$m['name'].'</option>';
	}
}
?>
</select>
</td>
</tr>
<tr onclick="$('t_4').checked=true;">
<td><input type="radio" name="type" value="4" id="t_4"/></td>
<td>
<select name="ifid" id="ifid">
<option value="0">信息</option>
<?php
foreach($MODULE as $m) {
	if($m['module'] == 'info') {
		echo '<option value="'.$m['moduleid'].'">'.$m['name'].'</option>';
	}
}
?>
</select>
&rarr;
<select name="itid" id="itid">
<option value="0">信息</option>
<?php
foreach($MODULE as $m) {
	if($m['module'] == 'info') {
		echo '<option value="'.$m['moduleid'].'">'.$m['name'].'</option>';
	}
}
?>
</select>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="tl">转移条件 <span class="f_red">*</span></td>
<td class="f_gray">&nbsp;
<input type="text" name="condition" value="" size="80" id="condition"/>
<br/>
&nbsp;- 如果转移单条信息，则直接填写信息ID，例如 <span class="f_blue">123</span><br/>
&nbsp;- 如果转移多条信息，则填用,分割信息ID，例如 <span class="f_blue">123,124,125</span> (结尾和开头不需要,)<br/>
&nbsp;- 可直接写SQL调用条件，必须以and开头<br/>
&nbsp;&nbsp;例如 <span class="f_blue">and catid=123</span> 表示调用分类ID为123的信息<br/>
&nbsp;&nbsp;例如 <span class="f_blue">and itemid>0</span> 表示调用源模块所有信息<br/>
</td>
</tr>
<tr>
<td class="tl">新分类ID <span class="f_red">*</span></td>
<td>&nbsp;
<input type="text" name="catid" value="" size="5" id="catid"/>
<a href="javascript:getid();" class="t">查询</a><?php tips('数据将被转移到此分类下');?>
</td>
</tr>
<tr>
<td class="tl">删除源数据 <span class="f_red">*</span></td>
<td>&nbsp;
<input type="radio" name="delete" value="1" id="d_1" checked/> 是&nbsp;&nbsp;&nbsp;
<input type="radio" name="delete" value="0" id="d_0"/> 否
</td>
</tr>
<tr>
<td class="tl">注意事项</td>
<td class="f_gray">
&nbsp;- 转移成功后请进入目标模型管理，更新新转移的信息，如果模型内容设置生成HTML，需要生成一下<br/>
&nbsp;- 可能需要按信息ID降序搜索才可以看到新转移的信息<br/>
</td>
</tr>
<tr>
<td class="tl">&nbsp;</td>
<td>&nbsp;<input type="submit" name="submit" value="执 行" class="btn"/></td> 
</tr>
</table>
</form>
<script type="text/javascript">
function getid() {
	var mid;
	if($('t_1').checked) {
		mid = 6;
	} else if($('t_2').checked) {
		mid = 5;
	} else if($('t_3').checked) {
		mid = $('atid').value;
		if(mid == 0) {
			alert('请选择文章目标模型');
			$('atid').focus();
			return;
		}
	} else if($('t_4').checked) {
		mid = $('itid').value;
		if(mid == 0) {
			alert('请选择信息目标模型');
			$('itid').focus();
			return;
		}
	} else {
		alert('请选择转移类型');
		return;
	}
	window.open('?file=category&mid='+mid);
}
function check() {
	if($('t_1').checked) {
		//
	} else if($('t_2').checked) {
		//
	} else if($('t_3').checked) {
		if($('afid').value == 0) {
			alert('请选择文章来源模型');
			$('afid').focus();
			return false;
		}
		if($('atid').value == 0) {
			alert('请选择文章目标模型');
			$('atid').focus();
			return false;
		}
		if($('afid').value == $('atid').value) {
			alert('文章来源模型和目标模型不能相同');
			$('atid').focus();
			return false;
		}
	} else if($('t_4').checked) {
		if($('ifid').value == 0) {
			alert('请选择信息来源模型');
			$('ifid').focus();
			return false;
		}
		if($('itid').value == 0) {
			alert('请选择信息目标模型');
			$('itid').focus();
			return false;
		}
		if($('ifid').value == $('itid').value) {
			alert('信息来源模型和目标模型不能相同');
			$('itid').focus();
			return false;
		}
	} else {
		alert('请选择转移类型');
		return false;
	}
	if($('condition').value.length < 1) {		
		alert('请填写转移条件');
		$('condition').focus();
		return false;
	}
	if($('catid').value.length < 1) {		
		alert('请填写新分类ID');
		$('catid').focus();
		return false;
	}
	return confirm('确定要转移吗？此操作将不可恢复');
}
</script>
<script type="text/javascript">Menuon(4);</script>
</body>
</html>