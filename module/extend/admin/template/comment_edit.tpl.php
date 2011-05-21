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
<div class="tt">修改评论 </div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">评论人</td>
<td><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?username=<?php echo $username;?>" target="_blank" class="t"><?php echo $username ? $username : 'Guest';?></a> IP - <?php echo $ip;?> <input type="checkbox" name="post[hidden]" value="1" <?php if($hidden) echo 'checked';?>/> 匿名评论</td>
</tr>
<tr>
<td class="tl">评论原文</td>
<td><a href="<?php echo $item_linkurl;?>" target="_blank" class="t"><?php echo $item_title;?></a></td>
</tr>
<tr>
<td class="tl">引用内容 <span class="f_red">*</span></td>
<td><textarea name="post[quotation]" id="quotation"  rows="8" cols="70"><?php echo $quotation;?></textarea><br/>请不要修改代码结构，仅可修改文字内容</td>
</tr>

<tr>
<td class="tl">评论内容 <span class="f_red">*</span></td>
<td><textarea name="post[content]" id="content"  rows="8" cols="70"><?php echo $content;?></textarea></td>
</tr>

<tr>
<td class="tl">回复评论</td>
<td>
<textarea name="post[reply]" id="reply" rows="8" cols="70"><?php echo $reply;?></textarea>
<?php 
if($reply) echo $editor ? '<br/>管理员 '.$editor.' 于 '.$replytime.' 回复' : '<br/>会员 '.$replyer.' 于 '.$replytime.' 回复';
?>
</td>
</tr>

<tr>
<td class="tl">评论状态</td>
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