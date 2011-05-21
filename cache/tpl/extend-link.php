<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td valign="top" class="left_menu">
		<ul>
		<li><a href="<?php echo DT_PATH;?>">网站首页</a></li>
		<li id="type_0"><a href="./">友情链接</a></li>
		<?php if(is_array($TYPE)) { foreach($TYPE as $t) { ?>
		<li id="type_<?php echo $t['typeid'];?>"><a href="<?php echo rewrite('index.php?typeid='.$t['typeid']);?>"><?php echo $t['typename'];?></a></li>
		<?php } } ?>
		<li id="type_reg"><a href="<?php echo rewrite('index.php?action=reg');?>">申请链接</a></li>
		</ul>
	</td>
	<td width="8"> </td>
	<td valign="top">
		<div class="left_box">
		<?php if($action == 'reg') { ?>		
			<div class="pos">当前位置: <a href="<?php echo DT_PATH;?>">首页</a> &raquo; <a href="./">友情链接</a> &raquo; <a href="<?php echo rewrite('index.php?action=reg');?>">申请链接</a></div>
			<br/>
			<form method="post" action="index.php" id="dform" onsubmit="return check();">
			<input type="hidden" name="action" value="reg"/>
			<table cellpadding="6" cellspacing="1" width="96%" align="center" bgcolor="#E3EEF5">
			<?php if($MOD['link_request']) { ?>
			<tr bgcolor="#FFFFFF">
			<td bgcolor="#F1F7FC">链接说明</td>
			<td><?php echo $MOD['link_request'];?></td>
			</tr>
			<?php } ?>
			<tr bgcolor="#FFFFFF">
			<td bgcolor="#F1F7FC" width="100">网站分类 <span class="f_red">*</span></td>
			<td><?php echo $type_select;?> <span id="dtypeid" class="f_red"></span></td>
			</tr>
			<tr bgcolor="#FFFFFF">
			<td bgcolor="#F1F7FC">网站名称 <span class="f_red">*</span></td>
			<td><input name="post[title]" type="text" id="title" size="40" /> <span id="dtitle" class="f_red"></span></td>
			</tr>
			<tr bgcolor="#FFFFFF">
			<td bgcolor="#F1F7FC">网站地址 <span class="f_red">*</span></td>
			<td><input name="post[linkurl]" type="text" id="linkurl" size="40" value="http://"/> <span id="dlinkurl" class="f_red"></span></td>
			</tr>
			<tr bgcolor="#FFFFFF">
			<td bgcolor="#F1F7FC">网站LOGO</td>
			<td><input name="post[thumb]" type="text" id="thumb" size="40"/> <span id="dthumb" class="f_red"></span></td>
			</tr>
			<tr bgcolor="#FFFFFF">
			<td bgcolor="#F1F7FC">网站介绍</td>
			<td><textarea name="post[introduce]" style="width:300px;height:40px;"></textarea></td>
			</tr>
			<tr bgcolor="#FFFFFF">
			<td bgcolor="#F1F7FC">验证码 <span class="f_red">*</span></td>
			<td><?php include template('captcha', 'chip');?> <span id="dcaptcha" class="f_red"></span></td>
			</tr>
			<tr bgcolor="#FFFFFF">
			<td bgcolor="#F1F7FC"> </td>
			<td><input type="submit" name="submit" value=" 确定 " class="btn"/>&nbsp;&nbsp;<input type="reset" name="reset" value=" 重置 " class="btn"/></td>
			</tr>
			</table>
			</form>
			<br/>
			<script type="text/javascript">
			function check() {				
				var l;
				var f;
				f = 'typeid';
				l = $(f).value;
				if(l == 0) {
					Dmsg('请选择分类', f);
					return false;
				}
				f = 'title';
				l = $(f).value.length;
				if(l < 2) {
					Dmsg('请输入网站名称', f);
					return false;
				}
				f = 'linkurl';
				l = $(f).value.length;
				if(l < 12) {
					Dmsg('请输入网站地址', f);
					return false;
				}
				f = 'captcha';
				l = $(f).value;
				if(!is_captcha(l)) {
					Dmsg('请填写验证码', f);
					return false;
				}
			}
			try {$('type_reg').style.backgroundColor = '#CDDCE4';}catch (e){}
			</script>
		<?php } else { ?>
			<div class="pos"><span class="f_r f_b"><a href="<?php echo rewrite('index.php?action=reg');?>">申请链接</a>&nbsp;&nbsp;&nbsp;&nbsp;</span>当前位置: <a href="<?php echo DT_PATH;?>">首页</a> &raquo; <a href="./">友情链接</a></div>
			<div style="padding:10px;">
			<?php if($typeid) { ?>
			<?php echo tag("table=link&condition=thumb!='' and status=3 and username='' and typeid=$typeid&pagesize=1400&order=listorder desc,itemid desc&template=list-link&cols=7");?>
			<div class="b10"></div>
			<?php echo tag("table=link&condition=thumb='' and status=3 and username='' and typeid=$typeid&pagesize=1400&order=listorder desc,itemid desc&template=list-link&cols=7");?>
			<?php } else { ?>
			<?php echo tag("table=link&condition=status=3 and thumb!='' and username=''&pagesize=1400&order=listorder desc,itemid desc&template=list-link&cols=7");?>
			<div class="b10"></div>
			<?php echo tag("table=link&condition=status=3 and thumb='' and username=''&pagesize=1400&order=listorder desc,itemid desc&template=list-link&cols=7");?>
			<?php } ?>
			</div>
			<script type="text/javascript">
			try {$('type_<?php echo $typeid;?>').style.backgroundColor = '#CDDCE4';}catch (e){}
			</script>
		<?php } ?>
		</div>
	</td>
	</tr>
	</table>
</div>
<?php include template('footer');?>