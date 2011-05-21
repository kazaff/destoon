<?php defined('IN_DESTOON') or exit('Access Denied');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo DT_CHARSET;?>"/>
<title><?php if($head_title) { ?><?php echo $head_title;?><?php echo $DT['seo_delimiter'];?><?php } ?>商务中心<?php echo $DT['seo_delimiter'];?><?php echo $DT['sitename'];?><?php echo $DT['seo_delimiter'];?>Powered By Destoon</title>
<meta name="generator" content="Destoon B2B,www.destoon.com"/>
<meta http-equiv="x-ua-compatible" content="ie=7"/>
<link rel="shortcut icon" href="<?php echo DT_PATH;?>favicon.ico"/>
<link rel="bookmark" href="<?php echo DT_PATH;?>favicon.ico"/>
<link rel="stylesheet" type="text/css" href="image/style.css"/>
<?php if(!DT_DEBUG) { ?><script type="text/javascript">window.onerror= function(){return true;}</script><?php } ?>
<script type="text/javascript" src="<?php echo DT_PATH;?>lang/<?php echo DT_LANG;?>/lang.js"></script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/config.js"></script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/common.js"></script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/admin.js"></script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/member.js"></script>
</head>
<body>
<div id="msgbox" style="display:none;"></div>
<?php echo dmsg();?>
<div class="head">
	<div id="top">
	<span class="f_r">
	<?php if($_userid) { ?>
	<a href="<?php echo userurl($_username);?>" target="_blank"><?php echo $_company;?></a> | 
	<a href="<?php echo $MODULE['2']['linkurl'];?>record.php"><?php echo $DT['money_name'];?>( <?php echo $_money;?> )</a> | 
	<a href="<?php echo $MODULE['2']['linkurl'];?>credits.php"><?php echo $DT['credit_name'];?>( <?php echo $_credit;?> )</a> | 
	<a href="<?php echo $MODULE['2']['linkurl'];?>edit.php">资料管理</a> | 
	<a href="<?php echo $MODULE['2']['linkurl'];?>edit.php?tab=1">修改密码</a> | 
	<a href="<?php echo $MODULE['2']['linkurl'];?>logout.php?forward=">退出</a><?php if($admin_user) { ?> | <a href="<?php echo $MODULE['2']['linkurl'];?>index.php?action=logout" style="color:#FF0000;">注销授权</a><?php } ?>
	<?php } else { ?>
	<a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_login'];?>">立即登录</a> | 
	<a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_register'];?>">注册会员</a>
	<?php } ?>
	</span>
	<a href="<?php echo $MODULE['2']['linkurl'];?>ask.php">客服中心</a> | 
	<a href="<?php echo $MODULE['2']['linkurl'];?>grade.php" target="destoon">会员等级</a> | 
	<a href="<?php echo DT_PATH;?>" target="destoon">网站首页</a> | 
	<a href="javascript:void(0);" onmouseover="Ds('m_menu');">更多<img src="image/top_more.gif" width="16" height="16" align="absmiddle"/></a>
	</div>
	<div id="m_menu" style="display:none;" onmouseout="Dh(this.id);" onmouseover="Ds(this.id);">
	<?php if(is_array($MODULE)) { foreach($MODULE as $v) { ?><?php if($v['ismenu']) { ?><a href="<?php echo $v['linkurl'];?>" target="destoon"><?php echo $v['name'];?></a>
	<?php } ?><?php } } ?>
	</div>
	<div>
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td width="195" height="55"><a href="<?php echo $MODULE['2']['linkurl'];?>"><img src="image/logo.jpg" alt="商务中心首页"/></a></td>
	<td>
		<div class="head_user">
		<?php if($_userid) { ?>
			<strong class="px14" style="color:#555555;">欢迎，<?php echo $_truename;?> </strong>
			(<?php echo $MG['groupname'];?>)
			<?php if($MG['inbox_limit']>-1) { ?>
			&nbsp;&nbsp;&nbsp;[ 
			<?php if($_message) { ?><img src="image/ico_newmessage.gif" width="16" height="12" align="absmiddle" alt=""/> <?php } ?><a href="<?php echo $MODULE['2']['linkurl'];?>message.php" class="b">站内信</a>(<?php if($_message) { ?><a href="<?php echo $MODULE['2']['linkurl'];?>message.php?action=last"><strong class="f_red"><?php echo $_message;?></strong></a><?php } else { ?>0<?php } ?>) | 
			 <a href="<?php echo $MODULE['2']['linkurl'];?>" class="b">我的商务室</a>
			]
			<?php } ?>
		<?php } ?>
		</div>
	</td>
	<td class="head_sch">
	<form action="<?php echo DT_PATH;?>search.php" id="head_sh" target="_blank" onsubmit="return sh(0);">
	<select id="head_md" name="moduleid">
	<?php if(is_array($MODULE)) { foreach($MODULE as $v) { ?><?php if($v['ismenu'] && !$v['islink']) { ?><option value="<?php echo $v['moduleid'];?>"><?php echo $v['name'];?></option><?php } ?><?php } } ?>
	</select>
	<input type="text" size="30" name="kw" id="head_kw" value="输入关键词" onfocus="if(this.value=='输入关键词')this.value='';" maxlength="10"/><img src="<?php echo DT_SKIN;?>image/spacer.gif" id="head_bt" onclick="sh(1);"/>
	</form>
	</td>
	</tr>
	</table>
	</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td valign="top" class="side" id="side">

<?php if($MYMODS || $show_menu) { ?>
	<div class="side_head" onclick="c(0);"><div><img src="image/arrow_c.gif" width="16" height="16" align="right" alt="" id="I_0"/>信息管理</div></div>
	<div class="side_body" id="D_0">
		<ul>
		<?php if(is_array($MENUMODS)) { foreach($MENUMODS as $k => $v) { ?>
			<?php if($v==9) { ?>
			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="mid_job"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?mid=9&action=add" class="m">发布</a></span><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?mid=9" class="n">招聘管理</a></li>
			<?php } else if($v==-9) { ?>
			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="mid_resume"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?mid=9&action=add&resume=1" class="m">创建</a></span><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?mid=9&resume=1" class="n">简历管理</a></li>
			<?php } else { ?>
				<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);"  id="mid_<?php echo $v;?>"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?mid=<?php echo $v;?>&action=add" class="m">发布</a></span><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?mid=<?php echo $v;?>" class="n"><?php echo $MODULE[$v]['name'];?>管理</a></li>
			<?php } ?>
		<?php } } ?>
		</ul>
	</div>
<?php } ?>


<?php if($_userid || $show_menu) { ?>
	<div class="side_head" onclick="c(1);"><div><img src="image/arrow_o.gif" width="16" height="16" align="right" alt="" id="I_1"/>商机管理</div></div>
	<div class="side_body" id="D_1" style="display:none;">
		<ul>
			<?php if($MG['inbox_limit']>-1 || $show_menu) { ?>
			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="message"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>message.php?action=send" class="m">发信</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>message.php" class="<?php if($MG['inbox_limit']>-1) { ?>n<?php } else { ?>f<?php } ?>">站 内 信</a></li>
			<?php } ?>
	
			<?php if($MG['friend_limit']>-1 || $show_menu) { ?>
			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="friend"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>friend.php?action=add" class="m">添加</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>friend.php" class="<?php if($MG['friend_limit']>-1) { ?>n<?php } else { ?>f<?php } ?>">我的商友</a></li>
			<?php } ?>

			<?php if($MG['favorite_limit']>-1 || $show_menu) { ?>
			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="favorite"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>favorite.php?action=add" class="m">添加</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>favorite.php" class="<?php if($MG['favorite_limit']>-1) { ?>n<?php } else { ?>f<?php } ?>">商机收藏</a></li>
			<?php } ?>

			<?php if($MG['alert_limit']>-1 || $show_menu) { ?>
			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="alert"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>alert.php?action=add" class="m">添加</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>alert.php" class="<?php if($MG['alert_limit']>-1) { ?>n<?php } else { ?>f<?php } ?>">贸易提醒</a></li>
			<?php } ?>

			<?php if($MG['sms'] || $show_menu) { ?>
			<?php if($DT['sms']) { ?><li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="sms"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>sms.php?action=add" class="m">发送</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>sms.php" class="<?php if($MG['sms']) { ?>n<?php } else { ?>f<?php } ?>">手机短信</a></li><?php } ?>
			<?php } ?>

			<?php if($MG['mail'] || $show_menu) { ?>
			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="mail"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>sendmail.php" class="m">电邮</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>mail.php" class="<?php if($MG['mail']) { ?>n<?php } else { ?>f<?php } ?>">邮件订阅</a></li>
			<?php } ?>
			<?php if($MG['spread'] || $show_menu) { ?>
			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="spread"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>spread.php?action=add" class="m">购买</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>spread.php" class="<?php if($MG['spread']) { ?>n<?php } else { ?>f<?php } ?>">排名推广</a></li>
			<?php } ?>
			<?php if($MG['ad'] || $show_menu) { ?>
			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="ad"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>ad.php?action=add" class="m">购买</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>ad.php" class="<?php if($MG['ad']) { ?>n<?php } else { ?>f<?php } ?>">广告预定</a></li>
			<?php } ?>
		</ul>
	</div>
<?php } ?>


<?php if($_userid || $show_menu) { ?>
	<div class="side_head" onclick="c(2);"><div><img src="image/arrow_o.gif" width="16" height="16" align="right" alt="" id="I_2"/>交易管理</div></div>
	<div class="side_body" id="D_2" style="display:none;">
		<ul>
			<?php if($MG['trade_sell'] || $show_menu) { ?>
			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="trade"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>trade.php?action=pay" class="m">付款</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>trade.php" class="<?php if($MG['trade_sell']) { ?>n<?php } else { ?>f<?php } ?>">我的订单</a></li>
			<?php } ?>

			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="record"><a href="<?php echo $MODULE['2']['linkurl'];?>record.php" class="<?php if($_userid) { ?>n<?php } else { ?>f<?php } ?>"><?php echo $DT['money_name'];?>流水</a></li>

			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="charge"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>charge.php?action=pay" class="m">充值</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>charge.php?action=record" class="<?php if($_userid) { ?>n<?php } else { ?>f<?php } ?>">充值记录</a></li>

			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="cash"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>cash.php" class="m">提现</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>cash.php?action=record" class="<?php if($_userid) { ?>n<?php } else { ?>f<?php } ?>"><?php echo $DT['money_name'];?>提现</a></li>

			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="credits"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>credits.php?action=buy" class="m">购买</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>credits.php" class="<?php if($_userid) { ?>n<?php } else { ?>f<?php } ?>"><?php echo $DT['credit_name'];?>管理</a></li>		
		</ul>
	</div>
<?php } ?>

<?php if($MG['homepage'] || $show_menu) { ?>
	<div class="side_head" onclick="c(3);"><div><img src="image/arrow_o.gif" width="16" height="16" align="right" alt="" id="I_3"/>商铺管理</div></div>
	<div class="side_body" id="D_3" style="display:none;">
		<ul>
			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="homepage"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>style.php" class="m">模板</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>home.php" class="<?php if($MG['homepage']) { ?>n<?php } else { ?>f<?php } ?>">商铺设置</a></li>

			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="news"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>news.php?action=add" class="m">发布</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>news.php" class="<?php if($MG['homepage']) { ?>n<?php } else { ?>f<?php } ?>">公司新闻</a></li>

			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="credit"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>credit.php?action=add" class="m">添加</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>credit.php" class="<?php if($MG['homepage']) { ?>n<?php } else { ?>f<?php } ?>">荣誉资质</a></li>

			<li class="side_a" onmouseover="v(this.id);" onmouseout="t(this.id);" id="link"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?>link.php?action=add" class="m">添加</a></span><a href="<?php echo $MODULE['2']['linkurl'];?>link.php" class="<?php if($MG['homepage']) { ?>n<?php } else { ?>f<?php } ?>">友情链接</a></li>
		</ul>
	</div>
<?php } ?>
	<div id="powered">
	<div><a href="http://www.destoon.com" target="_blank">Powered by Destoon B2B System</a></div>
	<a href="http://www.destoon.com" target="_blank">&copy; 2008-2010 Destoon.com<br/>
	All rights reserved</a>
	</div>

</td>
<td class="side_h" onclick="oh(this);" title="点击展开/隐藏侧栏">&nbsp;</td>
<td valign="top" class="main" id="main">