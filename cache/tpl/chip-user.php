<?php defined('IN_DESTOON') or exit('Access Denied');?><script type="text/javascript">
var user_auth = get_cookie('auth');
</script>
<div class="user">
	<script type="text/javascript">document.write(user_auth ? '<div>' : '<div style="display:none;">');</script>
		<div class="user_wel">您好，欢迎回来</div>
		<div class="user_do">
		<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
		<td><img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_edit.gif" align="absmiddle"/> <a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>">发布供求信息</a></td>
		<td><img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_product.gif" align="absmiddle"/> <a href="<?php echo extendurl('spread');?>">推广企业产品</a></td>
		</tr>
		<tr>
		<td><img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_homepage.gif" align="absmiddle"/> <a href="<?php echo $MODULE['2']['linkurl'];?>home.php">管理企业商铺</a></td>
		<td><img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_message.gif" align="absmiddle"/> <a href="<?php echo $MODULE['2']['linkurl'];?>message.php">查看站内留言</a></td>
		</tr>
		<tr>
		<td><img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_trade.gif" align="absmiddle"/> <a href="<?php echo $MODULE['2']['linkurl'];?>trade.php">管理买卖交易</a></td>
		<td><img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_record.gif" align="absmiddle"/> <a href="<?php echo $MODULE['2']['linkurl'];?>record.php">查看<?php echo $DT['money_name'];?>流水</a></td>
		</tr>
		<tr>
		<td><img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_profile.gif" align="absmiddle"/> <a href="<?php echo $MODULE['2']['linkurl'];?>edit.php?tab=2">完善企业资料</a></td>
		<td><img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_home.gif" align="absmiddle"/> <a href="<?php echo $MODULE['2']['linkurl'];?>">进入商务中心</a></td>
		</tr>
		</table>
		</div>
	</div>
	<script type="text/javascript">document.write(user_auth ? '<div style="display:none;">' : '<div>');</script>
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
	</div>
	<div class="user_foot">&nbsp;</div>
</div>