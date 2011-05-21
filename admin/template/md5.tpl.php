<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<?php if($submit) { ?>

<div class="tt">校验结果</div>
<table cellpadding="2" cellspacing="1" class="tb">
<?php if($lists) { ?>
<tr>
<th>文件</th>
<th>大小</th>
<th>修改时间</th>
</tr>
	<?php foreach($lists as $f) { ?>
	<tr align="center">
	<td align="left">&nbsp;<img src="admin/image/notice.gif" alt="" align="absmiddle"/> <a href="<?php echo $f;?>" target="_blank" class="f_fd">./<?php echo $f;?></a></td>
	<td class="px11"><?php echo dround(filesize(DT_ROOT.'/'.$f)/1024);?> Kb</td>
	<td class="px11"><?php echo timetodate(filemtime(DT_ROOT.'/'.$f), 6);?></td>
	</tr>
	<?php } ?>
	<tr>
	<td colspan="3" height="30" class="f_blue">&nbsp;&nbsp;&nbsp;&nbsp;- 以上文件曾被修改或创建，为了安全，系统不对以上文件在线修改或删除，请通过FTP处理</td>
	</tr>
<?php } else { ?>
<tr>
<td class="f_green" height="40">&nbsp;- 没有文件被修改或创建&nbsp;&nbsp;<a href="?file=<?php echo $file;?>" class="t">[重新校验]</a></td>
</tr>
<?php } ?>
</table>

<?php } else { ?>
<form method="post">
<div class="tt">文件校验</div>
<table cellpadding="6" cellspacing="1" class="tb">
<tr>
<td width="80">&nbsp;选择目录</td>
<td>
<table cellpadding="2" cellspacing="2" width="600">
<?php foreach($dirs as $k=>$d) { ?>
<?php if($k%4==0) {?><tr><?php } ?>
<td width="150"><input type="checkbox" name="filedir[]" value="<?php echo $d;?>"<?php echo in_array($d, $sys) ? ' checked' : '';?><?php echo in_array($d, $fbs) ? ' disabled' : '';?> id="cdir_<?php echo $d;?>"/><label for="cdir_<?php echo $d;?>">&nbsp;<img src="admin/image/folder.gif" width="16" height="16" alt="" align="absmiddle"/> <?php echo $d;?></label></td>
<?php if($k%4==3) {?></tr><?php } ?>
<?php } ?>
</table>
</td>
</tr>
<tr>
<td>&nbsp;文件类型</td>
<td>&nbsp;<input type="text" size="40" name="fileext" value="php|js|htm" class="f_fd"/></td>
</tr>
<tr>
<td>&nbsp;镜像文件</td>
<td>&nbsp;<select name="mirror" id="mirror">
<option value="">系统默认</option>
<?php foreach($mfiles as $f) { ?>
<option value="<?php echo basename($f);?>"><?php echo basename($f, '.dat').' '.dround(filesize($f)/1024, 2);?> K</option>
<?php } ?>
</select>
&nbsp;<input type="submit" name="submit" value="开始校验" class="btn" onclick="this.form.action='?file=<?php echo $file;?>';this.value='校验中..';this.blur();this.className='btn f_gray';"/>
&nbsp;<input type="submit" name="submit" value="删除镜像" class="btn" onclick="if($('mirror').value==''){alert('请选择需要删除的镜像文件');$('mirror').focus();return false;}if(confirm('确定要删除吗？此操作将不可恢复')){this.form.action='?file=<?php echo $file;?>&action=delete';}else{return false;}"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="add"/>
<div class="tt">创建镜像</div>
<table cellpadding="6" cellspacing="1" class="tb">
<tr>
<td width="80">&nbsp;选择目录</td>
<td>
<table cellpadding="2" cellspacing="2" width="600">
<?php foreach($dirs as $k=>$d) { ?>
<?php if($k%4==0) {?><tr><?php } ?>
<td width="150"><input type="checkbox" name="filedir[]" value="<?php echo $d;?>"<?php echo in_array($d, $sys) ? ' checked' : '';?><?php echo in_array($d, $fbs) ? ' disabled' : '';?> id="adir_<?php echo $d;?>"/><label for="adir_<?php echo $d;?>">&nbsp;<img src="admin/image/folder.gif" width="16" height="16" alt="" align="absmiddle"/> <?php echo $d;?></label></td>
<?php if($k%4==3) {?></tr><?php } ?>
<?php } ?>
</table>
</td>
</tr>
<tr>
<td>&nbsp;文件类型</td>
<td>&nbsp;<input type="text" size="40" name="fileext" value="php|js|htm" class="f_fd"/></td>
</tr>
<tr>
<td></td>
<td height="30">&nbsp;<input type="submit" name="submit" value="创建镜像" class="btn" onclick="this.value='创建中..';this.blur();this.className='btn f_gray';"/></td>
</tr>
</table>
</form>
<?php } ?>
<script type="text/javascript">Menuon(1);</script>
</body>
</html>