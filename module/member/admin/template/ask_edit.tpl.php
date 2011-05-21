<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">问题受理</div>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">问题分类</td>
<td><?php echo $TYPE[$typeid]['typename'];?></td>
</tr>
<tr>
<td class="tl">问题标题</td>
<td><?php echo $title;?></td>
</tr>
<tr class="on">
<td class="tl">问题内容</td>
<td><?php echo $content;?></td>
</tr>
<tr>
<td class="tl">会员名</td>
<td><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?username=<?php echo $username;?>" target="_blank"><?php echo $username;?></a></td>
</tr>
<tr>
<td class="tl">提交时间</td>
<td><?php echo $addtime;?></td>
</tr>
<tr>
<td class="tl">问题回复</td>
<td><textarea name="reply" id="reply" class="dsn"><?php echo $reply;?></textarea><?php echo deditor($moduleid, 'reply', 'Destoon', '98%', 300);?></td>
</tr>
<tr>
<td class="tl">受理状态</td>
<td>
<input type="radio" name="status" value="0"<?php echo $status == 0 ? ' checked' : '';?>/> 待受理
<input type="radio" name="status" value="1"<?php echo $status == 1 ? ' checked' : '';?>/> 受理中
<input type="radio" name="status" value="2"<?php echo $status == 2 ? ' checked' : '';?>/> 已解决
<input type="radio" name="status" value="3"<?php echo $status == 3 ? ' checked' : '';?>/> 未解决
</td>
</tr>
<tr>
<td class="tl">受理人</td>
<td><?php echo $admin;?></td>
</tr>
<tr>
<td class="tl">受理时间</td>
<td><?php echo $admintime;?></td>
</tr>
<tr>
<td class="tl">会员评分</td>
<td><?php echo $stars[$star];?></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>