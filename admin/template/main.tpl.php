<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div id="tips_update" style="display:none;">
<div class="tt">系统更新提示</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td><div style="padding:20px 30px 20px 20px;" title="当前版本V<?php echo DT_VERSION; ?> 更新时间<?php echo DT_RELEASE;?>"><img src="admin/image/tips_update.gif" width="32" height="32" align="absmiddle"/>&nbsp;&nbsp; <span class="f_red">您的当前软件版本有新的更新，请注意升级</span>&nbsp;&nbsp;最新版本：V<span id="last_v"><?php echo DT_VERSION; ?></span> 更新时间：<span id="last_r"><?php echo DT_RELEASE; ?></span>&nbsp;&nbsp;
<input type="button" value="检查更新" class="btn" onclick="window.location='?file=destoon&action=update';"/></div></td>
</tr>
</table>
</div>
<div class="tt"><span class="f_r px11">IP:<?php echo $user['loginip']; ?>&nbsp;&nbsp;</span>欢迎管理员，<?php echo $_username;?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">管理级别</td>
<td width="30%">&nbsp;<?php echo $_admin == 1 ? ($CFG['founderid'] == $_userid ? '网站创始人' : '超级管理员') : '普通管理员'; ?></td>
<td class="tl">登录次数</td>
<td width="30%">&nbsp;<?php echo $user['logintimes']; ?> 次</td>
</tr>
<tr>
<td class="tl">站内信件</td>
<td>&nbsp;<a href="<?php echo $MODULE[2]['linkurl'].'message.php';?>" target="_blank">收件箱[<?php echo $_message ? '<strong class="f_red">'.$_message.'</strong>' : $_message;?>]</a></td>
<td class="tl">登录时间</td>
<td>&nbsp;<?php echo timetodate($user['logintime'], 5); ?> </td>
</tr>
<tr>
<td class="tl">账户余额</td>
<td>&nbsp;<?php echo $_money; ?></td>
<td class="tl">会员<?php echo $DT['credit_name'];?></td>
<td>&nbsp;<?php echo $_credit; ?> </td>
</tr>
<?php if($_admin == 1) { ?>
<tr>
<td class="tl">后台搜索</td>
<td colspan="2">
<form action="?">
<input type="hidden" name="file" value="search"/>
<input type="text" style="width:98%;color:#444444;" name="kw" value="请输入关键词" onfocus="if(this.value=='请输入关键词')this.value='';"/></td>
<td>&nbsp;<input type="submit" name="submit" value="搜 索" class="btn"/>
</form></td>
</tr>
<?php } ?>
<tr>
<td class="tl">工作便笺</td>
<td colspan="2">
<form method="post" action="?">
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<textarea name="note" style="width:98%;height:50px;overflow:visible;color:#444444;"><?php echo $note;?></textarea></td>
<td>&nbsp;<input type="submit" name="submit" value="保 存" class="btn"/>
</form></td>
</tr>
</table>
<?php if($_founder) {?>
<div id="destoon"></div>
<div class="tt">系统信息</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">程序信息</td>
<td>&nbsp;<a href="?file=destoon&action=update" class="t">Destoon B2B Version <?php echo DT_VERSION;?> Release <?php echo DT_RELEASE;?> <?php echo strtoupper(DT_CHARSET);?> <?php echo strtoupper(DT_LANG);?> [检查更新]</a></td>
</tr>
<tr>
<td class="tl">软件版本</td>
<?php if($edition == '&#20010;&#20154;&#29256;') { ?>
<td>&nbsp;<span class="f_blue"><?php echo $edition;?></span> <span class="f_red">(未授权)</span>&nbsp;&nbsp;<a href="?file=destoon&action=authorization" target="_blank" class="t" title="域名授权查询">[查询]</a>&nbsp;&nbsp;<a href="?file=destoon&action=buy" target="_blank" class="t">[购买]</a></td>
<?php } else { ?>
<td>&nbsp;<span class="f_blue">商业<?php echo $edition;?></span>&nbsp;&nbsp;<a href="?file=destoon&action=authorization" target="_blank" class="t" title="域名授权查询">[查询]</a></td>
<?php } ?>
</tr>
<tr>
<td class="tl">安装时间</td>
<td>&nbsp;<?php echo $install;?></td>
</tr>
<tr>
<td class="tl">官方网站</td>
<td>&nbsp;<a href="http://www.destoon.com/?tracert=AdminMain" target="_blank">http://www.destoon.com</a></td>
</tr>
<tr>
<td class="tl">支持论坛</td>
<td>&nbsp;<a href="http://bbs.destoon.com/?tracert=AdminMain" target="_blank">http://bbs.destoon.com</a></td>
</tr>
<tr>
<td class="tl">使用帮助</td>
<td>&nbsp;<a href="http://help.destoon.com/?tracert=AdminMain" target="_blank">http://help.destoon.com</a></td>
</tr>
<tr>
<td class="tl">服务器时间</td>
<td>&nbsp;<?php echo timetodate($DT_TIME, 'Y-m-d H:i:s l');?></td>
</tr>
<tr>
<td class="tl">服务器信息</td>
<td>&nbsp;<?php echo PHP_OS.'&nbsp;'.$_SERVER["SERVER_SOFTWARE"];?> [<?php echo gethostbyname($_SERVER['SERVER_NAME']);?>:<?php echo $_SERVER["SERVER_PORT"];?>] <a href="?action=phpinfo" target="_blank">[详细信息]</a></td>
</tr>
<tr>
<td class="tl">数据库版本</td>
<td>&nbsp;MySQL <?php echo $db->version();?></td>
</tr>
<tr>
<td class="tl">上次备份</td>
<td>&nbsp;<a href="?file=database" title="点击备份数据库"><?php echo $backtime;?><?php if($backdays > 5) { ?> (<span class="f_red"><?php echo $backdays;?></span>天以前)<?php } ?></a></td>
</tr>
</table>
<div class="tt">使用协议</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td style="padding:10px;"><textarea style="width:100%;height:100px;"><?php echo file_get(DT_ROOT.'/license.txt');?></textarea></td>
</tr>
</table>
<script type="text/javascript" src="<?php echo $notice_url;?>"></script>
<script type="text/javascript">
var destoon_release = <?php echo DT_RELEASE;?>;
var destoon_version = <?php echo DT_VERSION;?>;
if(typeof destoon_lastrelease != 'undefined') {
	var lastrelease = parseInt(destoon_lastrelease.replace('-', '').replace('-', ''));
	if(destoon_lastversion == destoon_version && destoon_release < lastrelease) {
		$('tips_update').style.display = '';
		$('last_v').innerHTML = destoon_lastversion;
		$('last_r').innerHTML = destoon_lastrelease;
	}
}
</script>
<?php } ?>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>