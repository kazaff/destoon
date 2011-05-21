<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt"><?php if($parentid) echo $AREA[$parentid]['areaname'];?>地区管理</div>
<form method="post">
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="100">排序</th>
<th width="100">ID</th>
<th>上级ID</th>
<th>地区名</th>
<th width="80">子地区</th>
<th width="120">操作</th>
</tr>
<?php foreach($DAREA as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="areaids[]" value="<?php echo $v['areaid'];?>"/></td>
<td><input name="area[<?php echo $v['areaid'];?>][listorder]" type="text" size="5" value="<?php echo $v['listorder'];?>"/></td>
<td>&nbsp;<?php echo $v['areaid'];?></td>
<td><input name="area[<?php echo $v['areaid'];?>][parentid]" type="text" size="10" value="<?php echo $v['parentid'];?>"/></td>
<td><input name="area[<?php echo $v['areaid'];?>][areaname]" type="text" size="20" value="<?php echo $v['areaname'];?>"/></td>
<td>&nbsp;<a href="?file=<?php echo $file;?>&parentid=<?php echo $v['areaid'];?>"><?php echo $v['childs'];?></a></td>
<td>
<a href="?file=<?php echo $file;?>&parentid=<?php echo $v['areaid'];?>"><img src="admin/image/child.png" width="16" height="16" title="管理子地区，当前有<?php echo $v['childs'];?>个子地区" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=add&parentid=<?php echo $v['areaid'];?>"><img src="admin/image/new.png" width="16" height="16" title="添加子地区" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=delete&areaid=<?php echo $v['areaid'];?>&parentid=<?php echo $parentid;?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="删除" alt=""/></a></td>
</tr>
<?php }?>
</table>
<div class="btns">
<span class="f_r">
地区总数:<strong class="f_red"><?php echo count($AREA);?></strong>&nbsp;&nbsp;
当前目录:<strong class="f_blue"><?php echo count($DAREA);?></strong>&nbsp;&nbsp;
</span>
<input type="submit" name="submit" value="更新地区" class="btn" onclick="this.form.action='?file=<?php echo $file;?>&parentid=<?php echo $parentid;?>&action=update'"/>&nbsp;&nbsp;
<input type="submit" value="删除选中" class="btn" onclick="if(confirm('确定要删除选中地区吗？此操作将不可撤销')){this.form.action='?file=<?php echo $file;?>&parentid=<?php echo $parentid;?>&action=delete'}else{return false;}"/>&nbsp;&nbsp;
<?php if($parentid) {?>
<input type="button" value="上级地区" class="btn" onclick="window.location='?file=<?php echo $file;?>&parentid=<?php echo $AREA[$parentid]['parentid'];?>';"/>
<?php }?>
</div>
</form>
<br/>
<script type="text/javascript">Menuon(1);</script>
</body>
</html>