<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">会员组修改</div>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="groupid" value="<?php echo $groupid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">会员组名称 <span class="f_red">*</span></td>
<td><input type="text" size="20" name="groupname" id="groupname" value="<?php echo $groupname;?>"/> <span id="dgroupname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><?php echo VIP;?>指数 <span class="f_red">*</span></td>
<td><input type="text" size="20" name="vip" id="vip" value="<?php echo $vip;?>"/> <span class="f_gray">免费会员请填0，收费会员请填1-9数字</span> <span id="dvip" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">收费模式 <span class="f_red">*</span></td>
<td>
<input type="radio" name="setting[fee_mode]" value="1" <?php if($fee_mode) echo 'checked';?> onclick="Ds('mode_1');Dh('mode_0');$('discount').value='';$('fee').value='3000';"/> 包年&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[fee_mode]" value="0" <?php if(!$fee_mode) echo 'checked';?> onclick="Ds('mode_0');Dh('mode_1');$('discount').value='100';$('fee').value='';"/> 扣费
</td>
</tr>

<tr id="mode_1" style="display:<?php echo $fee_mode ? '' : 'none';?>">
<td class="tl">收费设置 <span class="f_red">*</span></td>
<td><input type="text" size="20" name="setting[fee]" id="fee" value="<?php echo $fee;?>"/> <?php echo $DT['money_unit'];?>/年 <span class="f_gray">免费会员请填0</span> <span id="dfee" class="f_red"></span></td>
</tr>

<tr id="mode_0" style="display:<?php echo $fee_mode ? 'none' : '';?>">
<td class="tl">享受折扣 <span class="f_red">*</span></td>
<td><input type="text" size="20" name="setting[discount]" id="discount" value="<?php echo $discount;?>"/> % 折扣仅限系统收费</td>
</tr>
<tr>
<td class="tl">显示顺序</td>
<td><input type="text" size="5" name="listorder" id="listorder" value="<?php echo $listorder;?>"/>  <span class="f_gray">数字越小越靠前</span></td>
</tr>
</table>
<div class="tt c_p">会员权限</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">设置说明</td>
<td>数量限制填 <strong>0</strong> 则表示不限&nbsp;&nbsp;&nbsp;填 <strong>-1</strong> 表示禁止使用</td>
</tr>
<tr>
<td class="tl">编辑器工具按钮</td>
<td>
<select name="setting[editor]">
<option value="Default"<?php if($editor == 'Default') echo ' selected';?>>全部</option>
<option value="Destoon"<?php if($editor == 'Destoon') echo ' selected';?>>精简</option>
<option value="Simple"<?php if($editor == 'Simple') echo ' selected';?>>简洁</option>
<option value="Basic"<?php if($editor == 'Basic') echo ' selected';?>>基础</option>
</select>&nbsp;
<?php tips('全部按钮允许会员编辑源代码和插入FLASH和视频文件<br/>为了防止被恶意利用，建议仅对受信任的会员组开启');?>
</td>
</tr>
<tr>
<td class="tl">允许上传文件</td>
<td>
<input type="radio" name="setting[upload]" value="1" <?php if($upload) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[upload]" value="0" <?php if(!$upload) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">允许上传的文件类型</td>
<td><input name="setting[uploadtype]" type="text" value="<?php echo $uploadtype;?>" size="60"/> <?php tips('用|号隔开文件后缀，留空表示继承网站设置');?></td>
</tr>
<tr>
<td class="tl">允许上传大小限制</td>
<td><input name="setting[uploadsize]" type="text" value="<?php echo $uploadsize;?>" size="10"/> Kb (1024Kb=1M) 不填或填0表示继承网站设置</td>
</tr>
<tr>
<td class="tl">单条信息上传数量限制</td>
<td><input name="setting[uploadlimit]" type="text" value="<?php echo $uploadlimit;?>" size="5"/> <?php tips('一条信息内最多上传文件数量限制，0为不限制');?></td>
</tr>
<tr>
<td class="tl">24小时上传数量限制</td>
<td><input name="setting[uploadday]" type="text" value="<?php echo $uploadday;?>" size="5"/> <?php tips('24小时内最大文件上传数量限制，0为不限制<br/>此项会增加服务器压力，且在开启上传记录的情况下有效');?></td>
</tr>
<tr>
<td class="tl">发布信息需要审核</td>
<td>
<input type="radio" name="setting[check]" value="1" <?php if($check) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[check]" value="0" <?php if(!$check) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">发布信息启用验证码</td>
<td>
<input type="radio" name="setting[captcha]" value="1" <?php if($captcha) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha]" value="0" <?php if(!$captcha) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">发布信息启用验证问题</td>
<td>
<input type="radio" name="setting[question]" value="1" <?php if($question) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[question]" value="0" <?php if(!$question) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允许申请提现</td>
<td>
<input type="radio" name="setting[cash]" value="1" <?php if($cash) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[cash]" value="0" <?php if(!$cash) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允许使用客服中心</td>
<td>
<input type="radio" name="setting[ask]" value="1" <?php if($ask) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ask]" value="0" <?php if(!$ask) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允许使用商机订阅</td>
<td>
<input type="radio" name="setting[mail]" value="1" <?php if($mail) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[mail]" value="0" <?php if(!$mail) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允许使用手机短信</td>
<td>
<input type="radio" name="setting[sms]" value="1" <?php if($sms) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[sms]" value="0" <?php if(!$sms) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允许发送电子邮件</td>
<td>
<input type="radio" name="setting[sendmail]" value="1" <?php if($sendmail) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[sendmail]" value="0" <?php if(!$sendmail) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允许站内付款</td>
<td>
<input type="radio" name="setting[trade_pay]" value="1" <?php if($trade_pay) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[trade_pay]" value="0" <?php if(!$trade_pay) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允许下订单</td>
<td>
<input type="radio" name="setting[trade_buy]" value="1" <?php if($trade_buy) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[trade_buy]" value="0" <?php if(!$trade_buy) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允许查看订单</td>
<td>
<input type="radio" name="setting[trade_sell]" value="1" <?php if($trade_sell) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[trade_sell]" value="0" <?php if(!$trade_sell) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允许竞价排名</td>
<td>
<input type="radio" name="setting[spread]" value="1" <?php if($spread) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[spread]" value="0" <?php if(!$spread) echo 'checked';?>> 否
</td>
</tr>

<tr>
<td class="tl">允许广告预定</td>
<td>
<input type="radio" name="setting[ad]" value="1" <?php if($ad) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ad]" value="0" <?php if(!$ad) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">收件箱数量限制</td>
<td>
<input type="text" name="setting[inbox_limit]" size="5" value="<?php echo $inbox_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">商友数量限制</td>
<td>
<input type="text" name="setting[friend_limit]" size="5" value="<?php echo $friend_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">商机收藏数量限制</td>
<td>
<input type="text" name="setting[favorite_limit]" size="5" value="<?php echo $favorite_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">贸易提醒数量限制</td>
<td>
<input type="text" name="setting[alert_limit]" size="5" value="<?php echo $alert_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">每日可发站内信限制</td>
<td>
<input type="text" name="setting[message_limit]" size="5" value="<?php echo $message_limit;?>"/> <?php echo tips('询盘和报价为特殊的站内信，发送一次询盘或者报价会消耗一次站内信发送机会');?>
</td>
</tr>

<tr>
<td class="tl">每日询盘次数限制</td>
<td>
<input type="text" name="setting[inquiry_limit]" size="5" value="<?php echo $inquiry_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">每日报价次数限制</td>
<td>
<input type="text" name="setting[price_limit]" size="5" value="<?php echo $price_limit;?>"/>
</td>
</tr>


<tr>
<td class="tl">自定义分类限制</td>
<td>
<input type="text" name="setting[type_limit]" size="5" value="<?php echo $type_limit;?>"/>
</td>
</tr>

</table>

<div class="tt">公司主页</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">拥有公司主页</td>
<td>
<input type="radio" name="setting[homepage]" value="1" <?php if($homepage) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[homepage]" value="0" <?php if(!$homepage) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">默认公司模板</td>
<td>
<?php echo homepage_select('setting[styleid]', '请选择', $groupid, $styleid, 'id="styleid"');?>&nbsp;&nbsp;
<a href="javascript:" onclick="if($('styleid').value>0)window.open('?moduleid=2&file=style&action=show&itemid='+$('styleid').value);" class="t">[预览]</a>
</td>
</tr>
<tr>
<td class="tl">允许自定义主页设置</td>
<td>
<input type="radio" name="setting[home]" value="1" <?php if($home) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[home]" value="0" <?php if(!$home) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">允许自定义菜单</td>
<td>
<input type="radio" name="setting[home_menu]" value="1" <?php if($home_menu) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[home_menu]" value="0" <?php if(!$home_menu) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">可用菜单</td>
<td>
<ul class="mods">
<?php
	$_menu_c = ','.$menu_c.',';
	foreach($HMENU as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[menu_c][]" value="'.$k.'" '.(strpos($_menu_c, ','.$k.',') !== false ? 'checked' : '').' id="menu_c_'.$k.'"/><label for="menu_c_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">默认菜单</td>
<td>
<ul class="mods">
<?php
	$_menu_d = ','.$menu_d.',';
	foreach($HMENU as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[menu_d][]" value="'.$k.'" '.(strpos($_menu_d, ','.$k.',') !== false ? 'checked' : '').' id="menu_d_'.$k.'"/><label for="menu_d_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">允许自定义侧栏</td>
<td>
<input type="radio" name="setting[home_side]" value="1" <?php if($home_side) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[home_side]" value="0" <?php if(!$home_side) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">可用侧栏</td>
<td>
<ul class="mods">
<?php
	$_side_c = ','.$side_c.',';
	foreach($HSIDE as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[side_c][]" value="'.$k.'" '.(strpos($_side_c, ','.$k.',') !== false ? 'checked' : '').' id="side_c_'.$k.'"/><label for="side_c_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">默认侧栏</td>
<td>
<ul class="mods">
<?php
	$_side_d = ','.$side_d.',';
	foreach($HSIDE as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[side_d][]" value="'.$k.'" '.(strpos($_side_d, ','.$k.',') !== false ? 'checked' : '').' id="side_d_'.$k.'"/><label for="side_d_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">允许自定义首页</td>
<td>
<input type="radio" name="setting[home_main]" value="1" <?php if($home_main) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[home_main]" value="0" <?php if(!$home_main) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">可用首页</td>
<td>
<ul class="mods">
<?php
	$_main_c = ','.$main_c.',';
	foreach($HMAIN as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[main_c][]" value="'.$k.'" '.(strpos($_main_c, ','.$k.',') !== false ? 'checked' : '').' id="main_c_'.$k.'"/><label for="main_c_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">默认首页</td>
<td>
<ul class="mods">
<?php
	$_main_d = ','.$main_d.',';
	foreach($HMAIN as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[main_d][]" value="'.$k.'" '.(strpos($_main_d, ','.$k.',') !== false ? 'checked' : '').' id="main_d_'.$k.'"/><label for="main_d_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">允许选择模板</td>
<td>
<input type="radio" name="setting[style]" value="1" <?php if($style) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[style]" value="0" <?php if(!$style) echo 'checked';?>> 否
</td>
</tr>
<tr>
<td class="tl">公司新闻数量限制</td>
<td>
<input type="text" name="setting[news_limit]" size="5" value="<?php echo $news_limit;?>"/>
</td>
</tr>
<tr>
<td class="tl">荣誉资质数量限制</td>
<td>
<input type="text" name="setting[credit_limit]" size="5" value="<?php echo $credit_limit;?>"/>
</td>
</tr>
<tr>
<td class="tl">友情链接数量限制</td>
<td>
<input type="text" name="setting[link_limit]" size="5" value="<?php echo $link_limit;?>"/>
</td>
</tr>
</table>
<div class="tt">信息发布</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">允许发布信息的模块</td>
<td>
<ul class="mods">
<?php
	$moduleids = explode(',', $moduleids);
	foreach($MODULE as $m) {
		if($m['moduleid'] > 4 && is_file(DT_ROOT.'/module/'.$m['module'].'/my.inc.php')) {
			if($m['moduleid'] == 9) {
				echo '<li><input type="checkbox" name="setting[moduleids][]" value="9" '.(in_array(9, $moduleids) ? 'checked' : '').' id="mod_9"/><label for="mod_9"> 招聘</label></li>';
				echo '<li><input type="checkbox" name="setting[moduleids][]" value="-9" '.(in_array(-9, $moduleids) ? 'checked' : '').' id="mod__9"/><label for="mod__9"> 简历</label></li>';
			} else {
				echo '<li><input type="checkbox" name="setting[moduleids][]" value="'.$m['moduleid'].'" '.(in_array($m['moduleid'], $moduleids) ? 'checked' : '').' id="mod_'.$m['moduleid'].'"/><label for="mod_'.$m['moduleid'].'"> '.$m['name'].'</label></li>';
			}
		}
	}
?>
</ul>
</td>
</tr>

<tr>
<td class="tl">允许复制信息</td>
<td>
<input type="radio" name="setting[copy]" value="1" <?php if($copy) echo 'checked';?>> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[copy]" value="0" <?php if(!$copy) echo 'checked';?>> 否 

复制信息可显著提高发布信息效率
</td>
</tr>

<tr>
<td class="tl">发布信息时间间隔</td>
<td>
<input type="text" name="setting[add_limit]" size="5" value="<?php echo $add_limit;?>"/>
&nbsp;&nbsp;单位： 秒&nbsp;&nbsp;填 0 表示不限制&nbsp;&nbsp;填正数表示发布两次发布时间间隔
</td>
</tr>

<tr>
<td class="tl">24小时发布信息数量</td>
<td>
<input type="text" name="setting[day_limit]" size="5" value="<?php echo $day_limit;?>"/>
&nbsp;&nbsp;填 0 表示不限制&nbsp;&nbsp;填正数表示24小时内在单模块发布信息数量限制
</td>
</tr>

<tr>
<td class="tl">刷新信息时间间隔</td>
<td>
<input type="text" name="setting[refresh_limit]" size="5" value="<?php echo $refresh_limit;?>"/>
&nbsp;&nbsp;单位： 秒&nbsp;&nbsp;填 -1 表示不允许刷新&nbsp;&nbsp;填 0 表示不限制时间间隔&nbsp;&nbsp;填正数表示限制两次刷新时间
</td>
</tr>

<tr>
<td class="tl">允许修改信息时间</td>
<td>
<input type="text" name="setting[edit_limit]" size="5" value="<?php echo $edit_limit;?>"/>
&nbsp;&nbsp;单位： 天&nbsp;&nbsp;填 -1 表示不允许修改&nbsp;&nbsp;填 0 表示不限制时间修改&nbsp;&nbsp;填正数表示发布时间超出后不可修改
</td>
</tr>

<tr>
<td class="tl">发布供应总数限制</td>
<td>
<input type="text" name="setting[sell_limit]" size="5" value="<?php echo $sell_limit;?>"/>
&nbsp;&nbsp;填 -1 表示禁止发布 填 0 表示不限制数量 填正数表示限制数量，下同
</td>
</tr>

<tr>
<td class="tl">免费发布供应数量</td>
<td>
<input type="text" name="setting[sell_free_limit]" size="5" value="<?php echo $sell_free_limit;?>"/>
&nbsp;&nbsp;填 -1 表示不收费 请填 0 表示无免费 填正数表示可免费发布条数，下同
</td>
</tr>

<tr>
<td class="tl">发布求购总数限制</td>
<td>
<input type="text" name="setting[buy_limit]" size="5" value="<?php echo $buy_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免费发布求购数量</td>
<td>
<input type="text" name="setting[buy_free_limit]" size="5" value="<?php echo $buy_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">发布展会总数限制</td>
<td>
<input type="text" name="setting[exhibit_limit]" size="5" value="<?php echo $exhibit_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免费发布展会数量</td>
<td>
<input type="text" name="setting[exhibit_free_limit]" size="5" value="<?php echo $exhibit_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">发布行情总数限制</td>
<td>
<input type="text" name="setting[quote_limit]" size="5" value="<?php echo $quote_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免费发布行情数量</td>
<td>
<input type="text" name="setting[quote_free_limit]" size="5" value="<?php echo $quote_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">发布招聘总数限制</td>
<td>
<input type="text" name="setting[job_limit]" size="5" value="<?php echo $job_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免费发布招聘数量</td>
<td>
<input type="text" name="setting[job_free_limit]" size="5" value="<?php echo $job_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">发布简历总数限制</td>
<td>
<input type="text" name="setting[resume_limit]" size="5" value="<?php echo $resume_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免费发布简历数量</td>
<td>
<input type="text" name="setting[resume_free_limit]" size="5" value="<?php echo $resume_free_limit;?>"/>
</td>
</tr>


<tr>
<td class="tl">发布文章总数限制</td>
<td>
<input type="text" name="setting[article_limit]" size="5" value="<?php echo $article_limit;?>"/>
“文章”指用文章模型创建的模块，例如“资讯”模块
</td>
</tr>

<tr>
<td class="tl">免费发布文章数量</td>
<td>
<input type="text" name="setting[article_free_limit]" size="5" value="<?php echo $article_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">发布信息总数限制</td>
<td>
<input type="text" name="setting[info_limit]" size="5" value="<?php echo $info_limit;?>"/>
“信息”指用信息模型创建的模块，例如“招商”模块
</td>
</tr>

<tr>
<td class="tl">免费发布信息数量</td>
<td>
<input type="text" name="setting[info_free_limit]" size="5" value="<?php echo $info_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">发布知道总数限制</td>
<td>
<input type="text" name="setting[know_limit]" size="5" value="<?php echo $know_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免费发布知道数量</td>
<td>
<input type="text" name="setting[know_free_limit]" size="5" value="<?php echo $know_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">发布品牌总数限制</td>
<td>
<input type="text" name="setting[brand_limit]" size="5" value="<?php echo $brand_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免费发布品牌数量</td>
<td>
<input type="text" name="setting[brand_free_limit]" size="5" value="<?php echo $brand_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">发布图库总数限制</td>
<td>
<input type="text" name="setting[photo_limit]" size="5" value="<?php echo $photo_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免费发布图库数量</td>
<td>
<input type="text" name="setting[photo_free_limit]" size="5" value="<?php echo $photo_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">发布视频总数限制</td>
<td>
<input type="text" name="setting[video_limit]" size="5" value="<?php echo $video_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免费发布视频数量</td>
<td>
<input type="text" name="setting[video_free_limit]" size="5" value="<?php echo $video_free_limit;?>"/>
</td>
</tr>
<tr>
<td class="tl">发布下载总数限制</td>
<td>
<input type="text" name="setting[down_limit]" size="5" value="<?php echo $down_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">免费发布下载数量</td>
<td>
<input type="text" name="setting[down_free_limit]" size="5" value="<?php echo $down_free_limit;?>"/>
</td>
</tr>
</table>

<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;</div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'groupname';
	l = $(f).value.length;
	if(l < 2) {
		Dmsg('请填写会员组名称', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
</body>
</html>