<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">站内信件转发</div>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="send" value="1"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">提示</td>
<td>可以通过此功能将会员的未读站内信发送至其注册邮箱</td>
</tr>
<tr>
<td class="tl">时间范围 <span class="f_red">*</span></td>
<td>
<input type="text" size="5" name="hour" id="hour" value="48"/> 小时<?php tips('发送超过此时间未读的站内信 建议设置24小时以上<br/>每封站内信只发送一次，已经发送过的不会重复发送');?>
</td>
</tr>
<tr>
<td class="tl">每轮发送邮件数 <span class="f_red">*</span></td>
<td><input type="text" size="5" name="pernum" id="pernum" value="5"/></td>
</tr>
<?php if($lasttime) { ?>
<tr>
<td class="tl">上次发送</td>
<td><?php echo $lasttime;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 开始发送 " class="btn" onclick="if(!confirm('确定发送超过 '+$('hour').value+' 小时未读的站内信至会员信箱吗？')) return false;"></div>
</form>
<script type="text/javascript">Menuon(3);</script>
</body>
</html>