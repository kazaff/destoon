<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">检测条件</div>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">模块 <span class="f_red">*</span></td>
<td>
<select name="mid">
<option value="0">请选择</option>
<?php foreach($MODULE as $m) { if(!$m['islink'] && $m['moduleid']>4) { ?>
<option value="<?php echo $m['moduleid'];?>"<?php echo $mid == $m['moduleid'] ? ' selected' : '';?>><?php echo $m['name'];?></option>
<?php } } ?>
</select>
</td>
</tr>
<tr>
<td class="tl">字段 <span class="f_red">*</span></td>
<td><input type="text" size="10" name="key" value="<?php echo $key;?>"/></td>
</tr>
<tr>
<td class="tl">数量 <span class="f_red">*</span></td>
<td><input type="text" size="10" name="num" value="<?php echo $num;?>"/></td>
</tr>
<tr>
<td class="tl">关键词</td>
<td><input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="关键词"/></td>
</tr>
<tr>
<td class="tl">状态</td>
<td>
<select name="status">
<option value="0"<?php echo $status==0 ? ' selected' : '';?>>回收站</option>
<option value="1"<?php echo $status==1 ? ' selected' : '';?>>已拒绝</option>
<option value="2"<?php echo $status==2 ? ' selected' : '';?>>待审核</option>
<option value="3"<?php echo $status==3 ? ' selected' : '';?>>已通过</option>
<option value="4"<?php echo $status==4 ? ' selected' : '';?>>已过期</option>
</select>
</td>
</tr>
<tr>
<td class="tl"></td>
<td height="30">&nbsp;<input type="submit" name="submit" value="开始检测" class="btn" onclick="this.value='检测中..';this.blur();this.className='btn f_gray';"/>&nbsp;
<input type="button" value="重新检测" class="btn" onclick="window.location='?file=<?php echo $file;?>';"/>
</td>
</tr>
</table>
</form>
<?php if($submit) { ?>
<div class="tt">检测结果</div>
<table cellpadding="2" cellspacing="1" class="tb">
<?php if($lists) { ?>
<tr>
<th>名称</th>
<th>重复次数</th>
<th width="60">查看</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td align="left">&nbsp;&nbsp;<img src="admin/image/htm.gif" align="absmiddle"/> <a href="?moduleid=<?php echo $mid;?>&action=<?php echo $act;?>&kw=<?php echo $v['kw'];?>" target="_blank"><?php echo $v[$key];?></a></td>
<td><?php echo $v['num'];?></td>
<td><a href="?moduleid=<?php echo $mid;?>&action=<?php echo $act;?>&kw=<?php echo $v['kw'];?>" target="_blank"><img src="admin/image/view.png" width="16" height="16"/></a></td>
</tr>
<?php }?>
<?php } else { ?>
<tr>
<td class="f_blue" height="40">&nbsp;- 指定范围没有检测到重复信息&nbsp;&nbsp;&nbsp;&nbsp;<a href="?file=<?php echo $file;?>" class="t">[重新检测]</a></td>
</tr>
<?php } ?>
</table>
<?php } ?>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>