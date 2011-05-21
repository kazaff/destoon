<?php defined('IN_DESTOON') or exit('Access Denied');?><?php if($user_status == 3) { ?>
	<?php if($module == 'exhibit') { ?>
		<div class="pd10 lh18 px13">
		<?php echo $content;?><br/>
		<strong>联系方式</strong><br/>
		联系人：<?php echo $truename;?><br/>
		<?php if($addr) { ?>地址：<?php echo $addr;?><br/><?php } ?>
		<?php if($mobile) { ?>手机：<?php echo anti_spam($mobile);?><br/><?php } ?>
		电话：<?php echo anti_spam($telephone);?><br/>
		<?php if($fax) { ?>传真：<?php echo anti_spam($fax);?><br/><?php } ?>
		<?php if($email) { ?>Email：<?php echo anti_spam($email);?><br/><?php } ?>
		<?php if($msn) { ?>MSN：<a href="msnim:chat?contact=<?php echo $msn;?>"><?php echo $msn;?></a><br/><?php } ?>
		<?php if($qq) { ?>QQ：<a href="tencent://message/?uin=<?php echo $qq;?>&Site=<?php echo $title;?>&Menu=yes"><img src="http://wpa.qq.com/pa?p=1:<?php echo $qq;?>:17" width="25" height="17" title="点击QQ交谈/留言" alt=""/> <?php echo $qq;?></a><br/><?php } ?>
		</div>
	<?php } else if($module == 'job') { ?>
		<table cellpadding="6" cellspacing="0" width="100%">
		<tr>
		<td width="100" align="center">联系手机</td>
		<td><?php echo anti_spam($mobile);?></td>
		</tr>
		<tr>
		<td align="center">电子邮件</td>
		<td ><?php echo anti_spam($email);?></td>
		</tr>
		<tr>
		<td align="center">联系电话</td>
		<td><?php echo anti_spam($telephone);?></td>
		</tr>
		<tr>
		<td align="center">联系地址</td>
		<td><?php echo $address;?></td>
		</tr>
		<tr>
		<td align="center">即时通讯</td>
		<td>
		<?php if($qq && $DT['im_qq']) { ?><?php echo im_qq($qq);?>&nbsp;<?php } ?>
		<?php if($ali && $DT['im_ali']) { ?><?php echo im_ali($ali);?>&nbsp;<?php } ?>
		<?php if($msn && $DT['im_msn']) { ?><?php echo im_msn($msn);?>&nbsp;<?php } ?>
		<?php if($skype && $DT['im_skype']) { ?><?php echo im_skype($skype);?>&nbsp;<?php } ?>
		</td>
		</tr>
		</table>
	<?php } else if($module == 'know') { ?>
		<div class="best_answer_show">
		<?php echo nl2br($best['content']);?>
		<?php if($best['linkurl']) { ?><br/>
		<span class="px12"><strong>参考资料：</strong><a href="<?php echo fix_link($best['linkurl']);?>" target="_blank"><?php echo $best['linkurl'];?></a></span>
		<?php } ?>
		</div>
	<?php } else if($module == 'down') { ?>
		<div class="downurl">
		<ul>
			<li><a href="<?php echo $MOD['linkurl'];?>down.php?auth=<?php echo $auth;?>" class="t">主站下载</a></li>
			<?php if($MIRROR) { ?>
			<?php if(is_array($MIRROR)) { foreach($MIRROR as $k=>$v) { ?>
			<li><a href="<?php echo $MOD['linkurl'];?>down.php?mirror=<?php echo $k;?>&auth=<?php echo $auth;?>" class="t"><?php echo $v['name'];?>镜像</a></li>
			<?php } } ?>
			<?php } ?>
		</ul>
		<div class="c_b"></div>
		</div>
	<?php } else if($module == 'photo') { ?>
		<?php if($action == 'side') { ?>
		<?php if(is_array($S)) { foreach($S as $k => $v) { ?>
		<a href="<?php echo $v['linkurl'];?>#p"><img src="<?php echo $v['thumb'];?>" width="80" height="80" title="<?php echo $v['introduce'];?>" alt="" <?php if($page==$v['page']) { ?>class="thumb_b"<?php } else { ?>class="thumb_a" onmouseover="this.className='thumb_b';" onmouseout="this.className='thumb_a';"<?php } ?>/></a>
		<?php } } ?>
		<?php } else { ?>
		<div><img src="<?php echo DT_SKIN;?>image/spacer.gif" id="cursor_a" onclick="Go('<?php echo $prev_photo;?>#p');" title="上一张"/></a><img src="<?php echo DT_SKIN;?>image/spacer.gif" id="cursor_b" onclick="Go('<?php echo $next_photo;?>#p');" title="下一张"/></div>
		<div class="t_c"><img src="<?php echo $P['src'];?>" id="destoon_photo" oncontextmenu="return false;" onload="if(this.width><?php echo $MOD['max_width'];?>)this.width=<?php echo $MOD['max_width'];?>;if(this.src.indexOf('spacer.gif')!=-1){this.width=<?php echo $MOD['max_width'];?>;this.height=1;}"/></div>
		<?php } ?>
	<?php } else if($module == 'video') { ?>
		<div class="player"><?php include template('player', 'chip');?></div>
	<?php } else if($module == 'article') { ?>
	<div class="content" id="article"><?php echo $content;?></div>
	<?php } else { ?>
	<?php echo $content;?>
	<?php } ?>
<?php } else if($user_status == 2) { ?>
	<?php if($description) { ?>
		<?php if($module == 'exhibit') { ?>
		<div class="pd10 lh18 px13"><?php echo $description;?></div>
		<?php } else if($module == 'article') { ?>
		<div class="content"><?php echo $description;?></div>
		<?php } else { ?>
		<?php echo $description;?>
		<?php } ?>
	<?php } ?>
<br/><br/>
<div class="px13 t_c" style="margin:auto;width:300px;background:#FFFFFF;">
<table cellpadding="5" cellspacing="5" width="100%">
<tr>
<td class="f_b">
<div style="padding:3px;border:#40B3FF 1px solid;background:#E5F5FF;">
查看详情需要支付<?php echo $name;?> <strong class="f_red"><?php echo $fee;?></strong> <?php echo $unit;?>
</div>
</td>
</tr>
<tr>
<td>我的<?php echo $name;?>余额 <strong class="f_blue"><?php if($currency=='money') { ?><?php echo $_money;?><?php } else { ?><?php echo $_credit;?><?php } ?></strong> <?php echo $unit;?></td>
</tr>
<tr>
<td>请点击支付按钮支付后查看</td>
</tr>
<?php if($MOD['fee_period']) { ?>
<tr>
<td>支付后可查看<strong class="f_red"><?php echo $MOD['fee_period'];?></strong>分钟，过期重新计费</td>
</tr>
<?php } ?>
<tr>
<td>
<a href="<?php echo $pay_url;?>"><img src="<?php echo DT_SKIN;?>image/btn_pay.gif" width="100" height="30" alt="立即支付"/></a>
&nbsp;
<a href="<?php echo $MODULE['2']['linkurl'];?><?php if($currency=='money') { ?>charge.php?action=pay<?php } else { ?>credits.php?action=buy<?php } ?>"><img src="<?php echo DT_SKIN;?>image/btn_charge.gif" width="100" height="30" alt="帐户充值"/></a>
</td>
</tr>
</table>
</div>
<br/><br/>
<?php } else if($user_status == 1) { ?>
<br/><br/>
<div class="px13 t_c" style="margin:auto;width:300px;">
<table cellpadding="5" cellspacing="5" width="100%">
<tr>
<td class="f_b">
<div style="padding:3px;border:#FFC600 1px solid;background:#FFFEBF;">
您的会员级别没有查看详情的权限
</div></td>
</tr>
<tr>
<td>获得更多商业机会，建议<span class="f_red">升级</span>会员级别</td>
</tr>
<?php if($DT['telephone']) { ?>
<tr>
<td>咨询电话：<?php echo $DT['telephone'];?></td>
</tr>
<?php } ?>
<tr>
<td>
<a href="<?php echo $MODULE['2']['linkurl'];?>grade.php"><img src="<?php echo DT_SKIN;?>image/btn_upgrade.gif" width="100" height="30" alt="现在升级"/></a>&nbsp;&nbsp;
<a href="<?php echo $MODULE['2']['linkurl'];?>grade.php"><img src="<?php echo DT_SKIN;?>image/btn_detail.gif" width="100" height="30" alt="了解详情"/></a>
</td>
</tr>
</table>
</div>
<br/><br/>
<?php } else if($user_status == 0) { ?>
<?php echo load('user.css');?>
<br/><br/>
<div class="user" style="margin:auto;width:300px;">
<br/>
<div class="user_warn"><img src="<?php echo DT_SKIN;?>image/no.gif" align="absmiddle"/> 您还没有登录，请登录后查看详情</div>
<div class="user_login">
	<form action="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_login'];?>" method="post" onsubmit="return user_login();">
	<input type="hidden" name="submit" value="1"/>
	<input name="username" id="user_name" type="text" value="会员名/Email" onfocus="if(this.value=='会员名/Email')this.value='';" class="user_input"/>&nbsp; 
	<input name="password" id="user_pass" type="password" value="password" onfocus="if(this.value=='password')this.value='';" class="user_input"/>&nbsp; 
	<input type="image" src="<?php echo DT_SKIN;?>image/user_login.gif" align="absmiddle"/>
	</form>
</div>
<div class="user_tip">免费注册为会员后，您可以...</div>
<div class="user_can">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td><img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_edit.gif" align="absmiddle"/> 发布供求信息</td>
<td><img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_product.gif" align="absmiddle"/> 推广企业产品</td>
</tr>
<tr>
<td><img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_homepage.gif" align="absmiddle"/> 建立企业商铺</td>
<td><img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_message.gif" align="absmiddle"/> 在线洽谈生意</td>
</tr>
</table>
</div>
<div class="user_reg"><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_register'];?>"><img src="<?php echo DT_SKIN;?>image/user_reg.gif" width="260" height="26" alt="还不是会员，立即免费注册"/></a></div>
<div class="user_foot">&nbsp;</div>
</div>
<br/><br/>
<?php } else { ?>
	<?php if($description) { ?>
		<div class="content"><?php echo $description;?></div>
	<?php } else { ?>
		<br/><br/><br/><br/><br/><br/>
		<center><img src="<?php echo DT_SKIN;?>image/load.gif"/></center>
		<br/><br/><br/><br/><br/><br/>
	<?php } ?>
<?php } ?>