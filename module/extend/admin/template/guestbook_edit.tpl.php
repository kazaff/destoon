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
<div class="tt">修改留言 </div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">留言人</td>
<td><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?username=<?php echo $username;?>" target="_blank" class="t"><?php echo $username ? $username : 'Guest';?></a> IP:<?php echo $ip;?> 来自 <?php echo ip2area($ip);?></td>
</tr>
<tr>
<td class="tl">留言标题 <span class="f_red">*</span></td>
<td><input name="post[title]" type="text" id="title" size="50" value="<?php echo $title;?>"/> <input type="checkbox" name="post[hidden]" value="1" <?php if($hidden) echo 'checked';?>/> 匿名留言</td>
</tr>

<tr>
<td class="tl">留言内容 <span class="f_red">*</span></td>
<td><textarea name="post[content]" id="content"  rows="8" cols="70"><?php echo $content;?></textarea></td>
</tr>
<tr>
<td class="tl">联系人</td>
<td><?php echo $truename;?></td>
</tr>
<tr>
<td class="tl">联系电话</td>
<td><?php echo $telephone;?></td>
</tr>
<tr>
<td class="tl">电子邮件</td>
<td><?php echo $email;?></td>
</tr>
<tr>
<td class="tl">QQ</td>
<td><?php echo $qq ? im_qq($qq).' '.$qq : '';?></td>
</tr>
<tr>
<td class="tl">阿里旺旺</td>
<td><?php echo $ali ? im_ali($ali).' '.$ali : '';?></td>
</tr>
<tr>
<td class="tl">MSN</td>
<td><?php echo $msn ? im_msn($msn).' '.$msn : '';?></td>
</tr>
<tr>
<td class="tl">Skype</td>
<td><?php echo $skype ? im_skype($skype).' '.$skype : '';?></td>
</tr>
<tr>
<td class="tl">回复留言</td>
<td><textarea name="post[reply]" id="reply" rows="8" cols="70"><?php echo $reply;?></textarea></td>
</tr>

<tr>
<td class="tl">前台显示</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?>/> 是
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?>/> 否
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>