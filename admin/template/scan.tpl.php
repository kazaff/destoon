<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<?php if($submit) { ?>

<div class="tt">扫描结果</div>
<table cellpadding="2" cellspacing="1" class="tb">
<?php if($lists) { ?>
<tr>
<th>文件</th>
<th>特征码</th>
<th>匹配次数</th>
<th>大小</th>
<th>修改时间</th>
</tr>
	<?php foreach($lists as $v) { ?>
	<tr align="center">
	<td align="left">&nbsp;<img src="admin/image/notice.gif" alt="" align="absmiddle"/> <a href="<?php echo $v['file'];?>" target="_blank" class="f_fd">./<?php echo $v['file'];?></a></td>
	<td><input type="text" size="30" value="<?php echo $v['code'];?>" class="f_fd f_red"/></td>
	<td class="px11<?php echo $v['num'] > 2 ? ' f_red' : '';?>"><?php echo $v['num'];?></td>
	<td class="px11"><?php echo dround(filesize(DT_ROOT.'/'.$v['file'])/1024);?> Kb</td>
	<td class="px11"><?php echo timetodate(filemtime(DT_ROOT.'/'.$v['file']), 6);?></td>
	</tr>
	<?php } ?>
	<tr>
	<td colspan="5" height="30" class="f_blue">&nbsp;&nbsp;&nbsp;&nbsp;- 共发现<strong><?php echo $find;?></strong>个可疑文件，为了安全，系统不对以上文件在线修改或删除，请通过FTP处理&nbsp;&nbsp;&nbsp;&nbsp;<a href="?file=<?php echo $file;?>" class="t">[重新扫描]</a></td>
	</tr>
<?php } else { ?>
<tr>
<td class="f_green" height="40">&nbsp;- 指定范围没有扫描到可疑文件&nbsp;&nbsp;&nbsp;&nbsp;<a href="?file=<?php echo $file;?>" class="t">[重新扫描]</a></td>
</tr>
<?php } ?>
</table>

<?php } else { ?>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<div class="tt">木马扫描</div>
<table cellpadding="6" cellspacing="1" class="tb">
<tr>
<td width="80">&nbsp;选择目录</td>
<td>
<table cellpadding="2" cellspacing="2" width="600">
<?php foreach($dirs as $k=>$d) { ?>
<?php if($k%4==0) {?><tr><?php } ?>
<td width="150"><input type="checkbox" name="filedir[]" value="<?php echo $d;?>"<?php echo in_array($d, $sys) ? ' checked' : '';?><?php echo in_array($d, $fbs) ? ' disabled' : '';?> id="dir_<?php echo $d;?>"/><label for="dir_<?php echo $d;?>">&nbsp;<img src="admin/image/folder.gif" width="16" height="16" alt="" align="absmiddle"/> <?php echo $d;?></label></td>
<?php if($k%4==3) {?></tr><?php } ?>
<?php } ?>
</table>
</td>
</tr>
<tr>
<td>&nbsp;文件类型</td>
<td>&nbsp;<input type="text" size="60" name="fileext" value="<?php echo $fileext;?>" class="f_fd"/></td>
</tr>
<tr>
<td>&nbsp;文件编码</td>
<td>
&nbsp;<input type="radio" name="charset" value="gbk" checked/> GBK&nbsp;&nbsp;
<input type="radio" name="charset" value="utf-8"/> UTF-8
</td>
</tr>
<tr>
<td>&nbsp;特征代码</td>
<td>&nbsp;<textarea name="code" id="code" style="width:600px;height:50px;overflow:visible;font-family:Fixedsys,verdana;"><?php echo $code;?></textarea></td>
</tr>
<tr>
<td>&nbsp;匹配次数</td>
<td>&nbsp;<input type="text" size="2" name="codenum" value="2" class="f_fd"/> 次以上</td>
</tr>
<tr>
<td></td>
<td height="30">&nbsp;<input type="submit" name="submit" value="开始扫描" class="btn" onclick="this.value='扫描中..';this.blur();this.className='btn f_gray';"/>
</td>
</tr>
</table>
</form>
<?php } ?>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>