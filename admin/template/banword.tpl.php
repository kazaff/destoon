<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">词语搜索</div>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="关键词"/>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="条/页"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?file=<?php echo $file;?>';"/>
</td>
</tr>
</table>
</form>
<script type="text/javascript">
var _del = 0;
</script>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<div class="tt">词语管理</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="50"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>查找词语</th>
<th>替换为</th>
<th>拦截</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['bid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/></td>
<td><input name="post[<?php echo $v['bid'];?>][replacefrom]" type="text" size="50" value="<?php echo $v['replacefrom'];?>"/></td>
<td><input name="post[<?php echo $v['bid'];?>][replaceto]" type="text" size="50" value="<?php echo $v['replaceto'];?>"/></td>
<td>
<input name="post[<?php echo $v['bid'];?>][deny]" type="radio" value="1" <?php if($v['deny']) echo 'checked';?>/> 是
<input name="post[<?php echo $v['bid'];?>][deny]" type="radio" value="0" <?php if(!$v['deny']) echo 'checked';?>/> 否
</td>
</tr>
<?php } ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="f_red">新增</td>
<td><textarea name="post[0][replacefrom]" rows="10" cols="50"></textarea></td>
<td><textarea name="post[0][replaceto]" rows="10" cols="50"></textarea></td>
<td>
<input name="post[0][deny]" type="radio" value="1"/> 是
<input name="post[0][deny]" type="radio" value="0" checked/> 否
</td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="更 新" onclick="if(_del && !confirm('提示:您选择删除'+_del+'个词语？确定要删除吗？')) return false;" class="btn"/>&nbsp;&nbsp;<input type="submit" name="submit" value="删除选中" onclick="if(_del && !confirm('提示:您选择删除'+_del+'个词语？确定要删除吗？')) return false;" class="btn"/></td>
</tr>
<tr>
<td colspan="4"><div class="pages"><?php echo $pages;?></div></td>
</tr>
<tr>
<td> </td>
<td colspan="3">
&nbsp;&nbsp;1、批量添加时，查找和替换词语一行一个，互相对应<br/>
&nbsp;&nbsp;2、如果选择拦截，则匹配到查找词语时直接提示，拒绝提交<br/>
&nbsp;&nbsp;3、例如“您*好”格式，可替换“您好”之间的干扰字符<br/>
&nbsp;&nbsp;4、为不影响程序效率，请不要设置过多过滤内容<br/>
&nbsp;&nbsp;5、过滤仅对前台会员提交信息生效，后台不受限制<br/>
</td>
</tr>
</table>
</form>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>