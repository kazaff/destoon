<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<script type="text/javascript">
var _del = 0;
</script>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<div class="tt">产品管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">删除</th>
<th>排序</th>
<th>产品名称</th>
<th>分类ID</th>
<th>所属分类</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['pid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/></td>
<td><input name="post[<?php echo $v['pid'];?>][listorder]" type="text" size="3" value="<?php echo $v['listorder'];?>"/></td>
<td><input name="post[<?php echo $v['pid'];?>][title]" type="text" size="20" value="<?php echo $v['title'];?>"/></td>
<td><input name="post[<?php echo $v['pid'];?>][catid]" type="text" size="5" value="<?php echo $v['catid'];?>"/></td>
<td><?php echo cat_pos($v['catid']);?></td>
</tr>
<?php } ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="f_red">新增</td>
<td><input name="post[0][listorder]" type="text" size="3" value=""/></td>
<td><input name="post[0][title]" type="text" size="20" value=""/></td>
<td colspan="4" align="left">&nbsp;&nbsp;<?php echo category_select('post[0][catid]', '选择分类', $catid, $moduleid);?></td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value=" 更 新 " onclick="if(_del && !confirm('提示:您选择删除'+_del+'个产品类型？确定要删除吗？')) return false;" class="btn"/></td>
</tr>
</table>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>