<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">记录搜索</div>
<form action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="15" name="kw" value="<?php echo $kw;?>" title="关键词"/>&nbsp;
<?php echo dcalendar('fromdate', $fromdate);?> 至 <?php echo dcalendar('todate', $todate);?>&nbsp;
<select name="mid">
<option value="0">模块</option>
<?php foreach($MODULE as $m) { if(!$m['islink']) { ?>
<option value="<?php echo $m['moduleid'];?>"<?php echo $mid == $m['moduleid'] ? ' selected' : '';?>><?php echo $m['name'];?></option>
<?php } } ?>
</select>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="条/页"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?file=<?php echo $file;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<div class="tt">上传记录</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="20"></th>
<th>文件名</th>
<th>大小</th>
<th>宽度</th>
<th>高度</th>
<th>模块</th>
<th>信息ID</th>
<th>来源</th>
<th>会员名</th>
<th width="150">时间</th>
<th width="30">删除</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="itemid[]" type="checkbox" value="<?php echo $v['pid'];?>"/></td>
<td><img src="<?php echo DT_PATH.'file/ext/'.$v['ext'].'.gif';?>"/></td>
<td align="left" title="<?php echo $v['fileurl'];?>">&nbsp;<a href="<?php echo $v['fileurl'];?>" target="_blank"><?php echo basename($v['fileurl']);?></a><?php if($v['image']) { ?>&nbsp;<a href="javascript:_preview('<?php echo $v['fileurl'];?>');"><img src="admin/image/img.gif" width="10" height="10" title="点击预览" alt=""/><?php } ?></td>
<td><?php echo $v['size'];?></td>
<td><?php echo $v['width'] ? $v['width'] : '';?></td>
<td><?php echo $v['height'] ? $v['height'] : '';?></td>
<td><a href="?file=<?php echo $file;?>&mid=<?php echo $v['moduleid'];?>"><?php echo $MODULE[$v['moduleid']]['name'];?></a></td>
<td><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?mid=<?php echo $v['moduleid'];?>&itemid=<?php echo $v['itemid'];?>" target="_blank"><?php echo $v['itemid'];?></a></td>
<td><a href="?file=<?php echo $file;?>&upfrom=<?php echo $v['upfrom'];?>"><?php echo $v['upfrom'];?></a></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td class="px11"><?php echo $v['addtime'];?></td>
<td><a href="?file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['pid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="删除" alt=""/></a></td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value="批量删除" class="btn" onclick="if(confirm('确定要删除选中记录吗？此操作将不可撤销')){this.form.action='?file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>