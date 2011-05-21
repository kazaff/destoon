<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt">修改答案 </div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">回答者</td>
<td><a href="javascript:_user('<?php echo $username;?>');"><?php echo $username ? $username : 'Guest';?></a></td>
</tr>
<tr>
<td class="tl">IP</td>
<td><?php echo $ip;?> 来自 <?php echo ip2area($ip);?></td>
</tr>
<tr>
<td class="tl">答案内容 <span class="f_red">*</span></td>
<td><textarea name="post[content]" id="content"  rows="8" cols="70"><?php echo $content;?></textarea></td>
</tr>
<tr>
<td class="tl">参考资料</td>
<td><input type="text" name="post[linkurl]" value="<?php echo $linkurl;?>" size="40"/></td>
</tr>
<tr>
<td class="tl">匿名设定</td>
<td>
<input type="radio" name="post[hidden]" value="1" <?php if($hidden == 1) echo 'checked';?> id="hidden_1"/><label for="hidden_1">  是</label>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="post[hidden]" value="0" <?php if($hidden == 0) echo 'checked';?> id="hidden_0"/><label for="hidden_0"> 否</label>
</td>
</tr>
<tr>
<td class="tl">答案状态</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?>/> 通过
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?>/> 待审
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">Menuon(<?php echo $status == 3 ? 0 : 1;?>);</script>
</body>
</html>