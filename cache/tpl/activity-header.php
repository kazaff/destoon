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
