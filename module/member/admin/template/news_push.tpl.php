<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?">
<div class="tt">新闻推送</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="aid" value="<?php echo $aid;?>"/>
<input type="hidden" name="ids" value="<?php echo $ids;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">推送模块 <span class="f_red">*</span></td>
<td class="f_b">&nbsp;<?php echo $MODULE[$aid]['name'];?></td>
</tr>
<tr>
<td class="tl">选择分类 <span class="f_red">*</span></td>
<td>&nbsp;<?php echo category_select('post[catid]', '请选择分类', 0, $aid);?></td>
</tr>
<tr>
<td class="tl">提示信息</td>
<td>&nbsp;系统会自动丢弃已经推送过的新闻</td>
</tr>
<tr>
<td class="tl">&nbsp;</td>
<td>&nbsp;<input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;<input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"/></td>
</tr>
</table>
</form>
<script type="text/javascript">Menuon(1);</script>
</body>
</html>