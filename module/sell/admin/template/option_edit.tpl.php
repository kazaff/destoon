<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="oid" value="<?php echo $oid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt"><?php echo $action=='add' ? '添加' : '修改';?>属性</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">产品类型 <span class="f_red">*</span></td>
<td><?php echo $product_select;?> <span id="dpid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">属性名称 <span class="f_red">*</span></td>
<td><input name="post[name]" type="text"  size="30" id="name" value="<?php echo $name;?>"/> <span id="dname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">添加方式 <span class="f_red">*</span></td>
<td>
<?php
foreach($TYPE as $k=>$v) { 
?>
<input type="radio" name="post[type]" value="<?php echo $k;?>" id="t_<?php echo $k;?>" onclick="c(<?php echo $k;?>)" <?php echo $k == $type ? 'checked' : '';?>/><label for="t_<?php echo $k;?>"> <?php echo $v;?></label>
<?php }?>
</td>
</tr>
<tr id="v" style="display:">
<td class="tl" id="v_l">默认值</td>
<td><textarea name="post[value]" style="width:98%;height:50px;overflow:visible;" id="value"><?php echo $value;?></textarea><br/><span id="v_r"></span></td>
</tr>
<tr>
<td class="tl">是否必填 <span class="f_red">*</span></td>
<td>
<input type="radio" name="post[required]" value="1" id="r_1" <?php echo $required == 1 ? 'checked' : '';?>/><label for="r_1"/> 是</label>&nbsp;&nbsp;
<input type="radio" name="post[required]" value="0" id="r_0" <?php echo $required == 0 ? 'checked' : '';?>/><label for="r_0"/> 否</label>
</td>
</tr>
<tr>
<td class="tl">扩展代码</td>
<td><textarea name="post[extend]" style="width:98%;height:50px;overflow:visible;"><?php echo $extend;?></textarea></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">
function c(id) {
	$('v').style.display = id == 0 ? 'none' : '';
	if(id == 0) {
		$('value').value = '';
	} else if(id == 3 || id == 4) {
		$('v_l').innerHTML = '备选值 <span class="f_red">*</span>';
		$('v_r').innerHTML = '多个选项用 | 分隔，例如 红色|绿色(*)|蓝色 (*)表示默认选中';
	} else if(id == 1 || id == 2) {
		$('v_l').innerHTML = '默认值';
		$('v_r').innerHTML = '';
	}
}
c(<?php echo $type;?>);
function check() {
	var l;
	var f;
	f = 'pid';
	l = $(f).value;
	if(l == 0) {
		Dmsg('请选择商品类型', f);
		return false;
	}
	f = 'name';
	l = $(f).value.length;
	if(l < 1) {
		Dmsg('请填写属性名称', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $action=='add' ? 1 : 2;?>);</script>
</body>
</html>