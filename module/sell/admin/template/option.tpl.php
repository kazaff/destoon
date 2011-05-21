<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post">
<input type="hidden" name="forward" value="<?php echo $DT_URL;?>"/>
<div class="tt">属性参数</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">排序</th>
<th>属性名称</th>
<th>必填</th>
<th>商品类型</th>
<th>添加方式</th>
<th>默认(备选)值</th>
<th width="50">操作</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="text" size="2" name="listorder[<?php echo $v['oid'];?>]" value="<?php echo $v['listorder'];?>"/></td>
<td><?php echo $v['name'];?></td>
<td><?php echo $v['required'] ? '<span class="f_red">是</span>' : '否';?></td>
<td><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&pid=<?php echo $v['pid'];?>"><?php echo $PRODUCT[$v['pid']]['title'];?></a></td>
<td><?php echo $TYPE[$v['type']];?></td>
<td><?php echo $v['value'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&pid=<?php echo $v['pid'];?>&oid=<?php echo $v['oid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&pid=<?php echo $v['pid'];?>&oid=<?php echo $v['oid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="删除" alt=""/></a>
</td>
</tr>
<?php } ?>
</table>
<div class="btns">
<input type="submit" value=" 更新排序 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&pid=<?php echo $pid;?>&action=order';"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(2);</script>
</body>
</html>