<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">投票搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;<?php echo $type_select;?>&nbsp;
<input type="text" size="40" name="kw" value="<?php echo $kw;?>" title="关键词"/>&nbsp;
<?php echo $order_select;?>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="条/页"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">管理投票</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>ID</th>
<th>分类</th>
<th width="14"> </th>
<th>标 题</th>
<th>票数</th>
<th>浏览</th>
<th>有效期</th>
<th>添加时间</th>
<th width="80">操作</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="编辑:<?php echo $v['editor'];?>&#10;更新时间:<?php echo $v['editdate'];?>">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><?php echo $v['itemid'];?></td>
<td><a href="<?php echo $v['typeurl'];?>" target="_blank"><?php echo $v['typename'];?></td>
<td><?php if($v['level']) {?><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&level=<?php echo $v['level'];?>"><img src="admin/image/level_<?php echo $v['level'];?>.gif" title="<?php echo $v['level'];?>级" alt=""/></a><?php } ?></td>
<td align="left">&nbsp;<a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['title'];?></td>
<td class="px11"><?php echo $v['votes'];?></td>
<td class="px11"><?php echo $v['hits'];?></td>
<td class="px11"><?php echo $v['fromdate'];?>~<?php echo $v['todate'];?></td>
<td class="px11"><?php echo $v['editdate'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=record&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/child.png" width="16" height="16" title="投票记录" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="删除" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" 删 除 " class="btn" onclick="if(confirm('确定要删除选中投票吗？此操作将不可撤销')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<?php echo level_select('level', '设置级别为</option><option value="0">取消', 0, 'onchange="this.form.action=\'?moduleid='.$moduleid.'&file='.$file.'&action=level\';this.form.submit();"');?>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(1);</script>
</body>
</html>