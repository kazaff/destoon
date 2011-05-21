<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">备份系列 <?php echo $dir;?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>文件名称</th>
<th width="150">文件大小(M)</th>
<th width="200">修改时间</th>
<th width="100">分卷</th>
<th width="100">操作</th>
</tr>
<?php foreach($sqls as $k=>$v) {?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td align="left">&nbsp;<img src="admin/image/sql.gif" width="16" height="16" alt="" align="absmiddle"/> <a href="<?php DT_PATH;?>file/backup/<?php echo $dir;?>/<?php echo $v['filename'];?>" title="点鼠标右键另存为保存此文件" target="_blank"><?php echo $v['filename'];?></a></td>
<td><?php echo $v['filesize'];?></td>
<td title="备份时间:<?php echo $v['btime'];?>"><?php echo $v['mtime'];?></td>
<td><?php echo $v['number'];?></td>
<td>
<a href="?file=<?php echo $file;?>&action=import&filepre=<?php echo $v['pre'];?>&import=1" onclick="return confirm('确定要导入此系列文件吗？现有数据将被覆盖，此操作将不可恢复');"><img src="admin/image/import.png" width="16" height="16" title="导入本系列备份文件" alt=""/></a>&nbsp;&nbsp;<a href="?file=<?php echo $file;?>&action=download&dir=<?php echo $dir;?>&filename=<?php echo $v['filename'];?>"><img src="admin/image/save.png" width="16" height="16" title="下载" alt=""/></a></td>
</tr>
<?php }?>
</table>
<script type="text/javascript">Menuon(1);</script>
</body>
</html>