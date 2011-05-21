<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
<div class="m_l f_l">
	<div class="left_box">		
		<div class="pos">当前位置: <a href="<?php echo DT_PATH;?>">首页</a> &raquo; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a> &raquo; <?php echo $member['company'];?></div>
		<div class="content c_b" id="content"><img src="<?php echo $member['thumb'];?>" align="right" style="margin:5px 0 5px 10px;padding:5px;border:#C0C0C0 1px solid;"/><?php echo $content;?></div>
		<br class="c_b"/>
		<br/>
	</div>
</div>
<div class="m_n f_l">&nbsp;</div>
<div class="m_r f_l">
	<div class="contact_head">公司资料</div>
	<div class="contact_body">
		<ul>
			<li class="f_b t_c" style="padding:3px 0 5px 0;font-size:16px;"><a href="<?php echo $member['linkurl'];?>" target="_blank"><?php echo $member['company'];?></a></li>
			<?php if($member['vip']) { ?>
			<li class="f_orange" style="padding:5px 0 0 12px;"><img src="<?php echo DT_SKIN;?>image/vip.gif"/> <img src="<?php echo DT_SKIN;?>image/vip_<?php echo $member['vip'];?>.gif"/> [第<?php echo vip_year($member['fromtime']);?>年] 指数:<?php echo $member['vip'];?></li>
			<?php } ?>
			<?php if($member['validated'] || $member['vcompany'] || $member['vtruename'] || $member['vbank'] || $member['vmobile'] || $member['vemail']) { ?>
			<li class="f_green" style="padding-top:6px;padding-bottom:6px;">
			<?php if($member['vcompany']) { ?>&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/v_company.gif" width="16" height="16" align="absmiddle" title="通过工商认证"/><?php } ?>
			<?php if($member['vtruename']) { ?>&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/v_truename.gif" width="16" height="16" align="absmiddle" title="通过实名认证"/><?php } ?>
			<?php if($member['vbank']) { ?>&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/v_bank.gif" width="16" height="16" align="absmiddle" title="通过银行帐号认证"/><?php } ?>
			<?php if($member['vmobile']) { ?>&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/v_mobile.gif" width="16" height="16" align="absmiddle" title="通过手机认证"/><?php } ?>
			<?php if($member['vemail']) { ?>&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/v_email.gif" width="16" height="16" align="absmiddle" title="通过邮件认证"/><?php } ?>
			<?php if($member['validated']) { ?>&nbsp;<img src="<?php echo DT_SKIN;?>image/check_right.gif" align="absmiddle"/> 企业资料通过<?php echo $member['validator'];?>认证<?php } ?>
			</li>
			<?php } ?>
			<li style="padding-top:6px;padding-bottom:6px;">
			<span>联系人</span><?php echo $member['truename'];?>(<?php echo gender($member['gender']);?>)&nbsp;<?php echo $member['career'];?>&nbsp;
			<?php if($member['qq'] && $DT['im_qq']) { ?><?php echo im_qq($member['qq']);?>&nbsp;<?php } ?>
			<?php if($member['ali'] && $DT['im_ali']) { ?><?php echo im_ali($member['ali']);?>&nbsp;<?php } ?>
			<?php if($member['msn'] && $DT['im_msn']) { ?><?php echo im_msn($member['msn']);?>&nbsp;<?php } ?>
			<?php if($member['skype'] && $DT['im_skype']) { ?><?php echo im_skype($member['skype']);?>&nbsp;<?php } ?>
			</li>
			<li><span>会员</span> <a href="<?php echo $MODULE['2']['linkurl'];?>friend.php?action=add&username=<?php echo $username;?>">[加为商友]</a> <a href="<?php echo $MODULE['2']['linkurl'];?>message.php?action=send&touser=<?php echo $username;?>">[发送信件]</a></li>
			<?php if($member['mail']) { ?><li><span>邮件</span><?php echo anti_spam($member['mail']);?></li><?php } ?>
			<?php if($member['telephone']) { ?><li><span>电话</span><?php echo anti_spam($member['telephone']);?></li><?php } ?>
			<?php if($member['fax']) { ?><li><span>传真</span><?php echo anti_spam($member['fax']);?></li><?php } ?>
			<li><span>所在地</span><?php echo area_pos($member['areaid'], '&nbsp;');?></li>
			<?php if($member['address']) { ?><li><span>地址</span><?php echo $member['address'];?></li><?php } ?>
			<?php if($member['postcode']) { ?><li><span>邮编</span><?php echo $member['postcode'];?></li><?php } ?>
			<?php if($member['business']) { ?><li title="<?php echo $member['business'];?>"><span>主营行业</span><?php echo $member['business'];?></li><?php } ?>
			<?php if($member['type']) { ?><li><span>公司类型</span><?php echo $member['type'];?></li><?php } ?>
			<?php if($member['mode']) { ?><li><span>经营模式</span><?php echo $member['mode'];?></li><?php } ?>
			<?php if($member['size']) { ?><li><span>公司规模</span><?php echo $member['size'];?></li><?php } ?>
			<?php if($member['capital']) { ?><li><span>注册资本</span><?php echo $member['capital'];?>万<?php echo $member['regunit'];?></li><?php } ?>
			<?php if($member['regyear']) { ?><li><span>注册年份</span><?php echo $member['regyear'];?></li><?php } ?>
			<?php if($member['sell']) { ?><li title="<?php echo $member['sell'];?>"><span>销售产品</span><?php echo $member['sell'];?></li><?php } ?>
			<?php if($member['buy']) { ?><li title="<?php echo $member['buy'];?>"><span>采购产品</span><?php echo $member['buy'];?></li><?php } ?>
		</ul>
	</div>
</div>
</div>
<?php include template('footer');?>