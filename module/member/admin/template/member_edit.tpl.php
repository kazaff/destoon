<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
load('profile.js');
?>
<div class="tt">会员资料修改</div>
<form method="post" action="?" onsubmit="return Dcheck();" id="dform">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="userid" value="<?php echo $userid;?>"/>
<input type="hidden" name="username" value="<?php echo $username;?>"/>
<input type="hidden" name="gid" value="<?php echo $groupid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<input type="hidden" name="member[regid]" value="<?php echo $regid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">会员登录名</td>
<td><strong><?php echo $username;?></strong></td>
</tr>

<tr>
<td class="tl">通行证户名 <span class="f_red">*</span></td>
<td><input type="text" size="30" name="member[passport]" id="passport" value="<?php echo $passport;?>"/>&nbsp;<span id="dpassport" class="f_red"></span></td>
</tr>

<tr>
<td class="tl">会员组 <span class="f_red">*</span></td>
<td><?php echo group_select('member[groupid]', '会员组', $groupid, 'id="groupid"');?>&nbsp;<span id="dgroupid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">登录密码</td>
<td><input type="password" size="20" name="member[password]" id="password" onblur="validator('password');"/>&nbsp;<span id="dpassword" class="f_red"></span> <span class="f_gray">如不更改,请留空</span></td>
</tr>
<tr>
<td class="tl">重复输入密码</td>
<td><input type="password" size="20" name="member[cpassword]" id="cpassword"/>&nbsp;<span id="cpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">支付密码</td>
<td><input type="password" size="20" name="member[payword]" id="payword" onblur="validator('payword');"/>&nbsp;<span id="dpayword" class="f_red"></span> <span class="f_gray">如不更改,请留空</span></td>
</tr>
<tr>
<td class="tl">重复支付密码</td>
<td><input type="password" size="20" name="member[cpayword]" id="cpassword"/>&nbsp;<span id="cpayword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">Email <span class="f_red">*</span></td>
<td><input type="text" size="30" name="member[email]" id="email" value="<?php echo $email;?>" onblur="validator('email');"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vemail ? 'v' : 'u';?>_email.gif" width="16" height="16" title="<?php echo $vemail ? '已通过' : '未通过';?>邮件认证" align="absmiddle"/></a>&nbsp;<span id="demail" class="f_red"></span> <span class="f_gray">[不公开]</span></td>
</tr>
<tr>
<td class="tl">真实姓名 <span class="f_red">*</span></td>
<td><input type="text" size="10" name="member[truename]" id="truename" value="<?php echo $truename;?>"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vtruename ? 'v' : 'u';?>_truename.gif" width="16" height="16" title="<?php echo $vtruename ? '已通过' : '未通过';?>实名认证" align="absmiddle"/></a></td>
</tr>
<tr>
<td class="tl">所在地区 <span class="f_red">*</span></td>
<td><?php echo ajax_area_select('member[areaid]', '请选择', $areaid);?>&nbsp;<span id="dareaid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">性别 <span class="f_red">*</span></td>
<td>
<input type="radio" name="member[gender]" value="1" <?php if($gender == 1) echo 'checked="checked"';?>/> 先生
<input type="radio" name="member[gender]" value="2" <?php if($gender == 2) echo 'checked="checked"';?>/> 女士
</td>
</tr>
<tr>
<td class="tl">部门</td>
<td><input type="text" size="20" name="member[department]" id="department" value="<?php echo $department;?>"/></td>
</tr>
<tr>
<td class="tl">职位</td>
<td><input type="text" size="20" name="member[career]" id="career" value="<?php echo $career;?>"/></td>
</tr>
<tr>
<td class="tl">手机号码</td>
<td><input type="text" size="20" name="member[mobile]" id="mobile" value="<?php echo $mobile;?>"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vmobile ? 'v' : 'u';?>_mobile.gif" width="16" height="16" title="<?php echo $vmobile ? '已通过' : '未通过';?>手机认证" align="absmiddle"/></a></td>
</tr>
<tr>
<td class="tl">QQ</td>
<td><input type="text" size="20" name="member[qq]" id="qq" value="<?php echo $qq;?>"/></td>
</tr>
<tr>
<td class="tl">阿里旺旺</td>
<td><input type="text" size="20" name="member[ali]" id="ali" value="<?php echo $ali;?>"/></td>
</tr>
<tr>
<td class="tl">MSN</td>
<td><input type="text" size="30" name="member[msn]" id="msn" value="<?php echo $msn;?>"/></td>
</tr>
<tr>
<td class="tl">Skype</td>
<td><input type="text" size="20" name="member[skype]" id="skype" value="<?php echo $skype;?>"/></td>
</tr>
<tr>
<td class="tl">收款银行</td>
<td>
<select name="bank">
<option value="">收款方式</option>
<?php foreach($BANKS as $v) { ?>
<option value="<?php echo $v;?>" <?php if($bank == $v) { ?>selected<?php } ?>><?php echo $v;?></option>;
<?php } ?>
</select>
</td>
</tr>
<tr>
<td class="tl">收款帐号</td>
<td><input type="text" size="30" name="member[account]" id="account" value="<?php echo $account;?>"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vbank ? 'v' : 'u';?>_bank.gif" width="16" height="16" title="<?php echo $vbank ? '已通过' : '未通过';?>银行帐号认证" align="absmiddle"/></a></td>
</tr>
<?php echo $MFD ? fields_html('<td class="tl">', '<td>', $user, $MFD) : '';?>
</table>
<div class="tt">公司资料</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">公司名称 <span class="f_red">*</span></td>
<td><input type="text" size="60" name="member[company]" id="company" value="<?php echo $company;?>" onblur="validator('company');"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vcompany ? 'v' : 'u';?>_company.gif" width="16" height="16" title="<?php echo $vcompany ? '已通过' : '未通过';?>工商认证" align="absmiddle"/></a></td>
</tr>
<tr>
<td class="tl">公司类型 <span class="f_red">*</span></td>
<td><?php echo dselect($COM_TYPE, 'member[type]', '请选择', $type, 'id="type"', 0);?>&nbsp;<span id="dtype" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">形象图片</td>
<td><input name="member[thumb]" type="text" size="60" id="thumb" value="<?php echo $thumb;?>"/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, $('thumb').value);" class="jt">[上传]</span>&nbsp;&nbsp;<span onclick="_preview($('thumb').value);" class="jt">[预览]</span>&nbsp;&nbsp;<span onclick="$('thumb').value='';" class="jt">[删除]</span><br/>
<span class="f_gray">建议使用LOGO、办公环境等标志性图片，最佳大小为<?php echo $MOD['thumb_width'];?>px*<?php echo $MOD['thumb_height'];?>px</span></td>
</tr>
<tr>
<td class="tl">主营行业 <span class="f_red">*</span></td>
<td>
<div id="catesch"></div><div id="cate"><?php echo ajax_category_select('', '', 0, 4, 'size="2" style="height:80px;width:160px;"');?></div>
<input type="button" value=" 添加↓ " class="btn" onclick="addcate(<?php echo $MOD['cate_max'];?>);"/>
<input type="button" value=" ×删除 " class="btn" onclick="delcate();"/>
<?php if($DT['schcate_limit']) { ?><input type="button" class="btn" value=" 搜索 " onclick="schcate(4);"/><?php } ?>
&nbsp;最多可添加 <strong class="f_red"><?php echo $MOD['cate_max'];?></strong> 个主营行业
<br/><select name="cates" id="cates" size="2" style="height:100px;width:380px;margin-top:5px;">
<?php if(is_array($cates)) { foreach($cates as $c) { ?>
<option value="<?php echo $c;?>"><?php echo strip_tags(cat_pos($c, '/'));?></option>
<?php } } ?>
</select>
<input type="hidden" name="member[catid]" value="<?php echo $catid;?>" id="catid"/><br/>
<span id="dcatid" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl">主要经营范围 <span class="f_red">*</span></td>
<td><input type="text" size="80" name="member[business]" id="business" value="<?php echo $business;?>"/>&nbsp;<span id="dbusiness" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">经营模式</td>
<td>
<span id="com_mode"><?php echo dcheckbox($COM_MODE, 'member[mode][]', $mode, 'onclick="check_mode(this,'.$MOD['mode_max'].');"', 0);?></span> <span class="f_gray">(最多可选<?php echo $MOD['mode_max'];?>种)</span></td>
</tr>
<tr>
<td class="tl">公司规模</td>
<td><?php echo dselect($COM_SIZE, 'member[size]', '请选择规模', $size, '', 0);?></td>
</tr>
<tr>
<td class="tl">注册资本</td>
<td><?php echo dselect($MONEY_UNIT, 'member[regunit]', '', $regunit, '', 0);?> <input type="text" size="6" name="member[capital]" id="capital" value="<?php echo $capital;?>"/> 万</td>
</tr>
<tr>
<td class="tl">公司成立年份 <span class="f_red">*</span></td>
<td><input type="text" size="15" name="member[regyear]" id="regyear" value="<?php echo $regyear;?>"/>&nbsp;<span id="dregyear" class="f_red"></span> <span class="f_gray">(年份，如：2004)</span></td>
</tr>
<tr>
<td class="tl">主要经营地点 <span class="f_red">*</span></td>
<td><input type="text" size="60" name="member[address]" id="address" value="<?php echo $address;?>"/>&nbsp;<span id="daddress" class="f_red"></span></td>
</tr>

<tr>
<td class="tl">邮政编码</td>
<td><input type="text" size="8" name="member[postcode]" id="postcode" value="<?php echo $postcode;?>"/></td>
</tr>

<tr>
<td class="tl">公司电话 <span class="f_red">*</span></td>
<td><input type="text" size="20" name="member[telephone]" id="telephone" value="<?php echo $telephone;?>"/>&nbsp;<span id="dtelephone" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">公司传真</td>
<td><input type="text" size="20" name="member[fax]" id="fax" value="<?php echo $fax;?>"/></td>
</tr><tr>
<td class="tl">公司Email</td>
<td><input type="text" size="30" name="member[mail]" id="mail" value="<?php echo $mail;?>"/> <span class="f_gray">[公开]</span></td>
</tr>
<tr>
<td class="tl">公司网址</td>
<td><input type="text" size="30" name="member[homepage]" id="homepage" value="<?php echo $homepage;?>"/></td>
</tr>
<tr>
<td class="tl">销售的产品(提供的服务)</td>
<td><input type="text" size="50" name="member[sell]" id="sell" value="<?php echo $sell;?>"/> <span class="f_gray">多个产品或服务请用'|'号隔开</span></td>
</tr>
<tr>
<td class="tl">采购的产品(需要的服务)</td>
<td><input type="text" size="50" name="member[buy]" id="buy" value="<?php echo $buy;?>"/> <span class="f_gray">多个产品或服务请用'|'号隔开</span></td>
</tr>
<tr>
<td class="tl">公司介绍 <span class="f_red">*</span></td>
<td><textarea name="member[introduce]" id="introduce" class="dsn"><?php echo $introduce;?></textarea>
<?php echo deditor($moduleid, 'introduce', $MOD['editor'], '95%', 300);?><br/><span id="dintroduce" class="f_red"></span></td>
</tr>
<?php echo $CFD ? fields_html('<td class="tl">', '<td>', $user, $CFD) : '';?>
</table>
<div class="tt">资料认证</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">企业资料是否通过认证</td>
<td>
<input type="radio" name="member[validated]" value="1" <?php if($validated) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[validated]" value="0" <?php if(!$validated) echo 'checked';?>/> 否
<?php tips('一般由第三方认证机构或网站对会员总体资料的认证');?><a name="vv"></a>
</td>
</tr>
<tr>
<td class="tl">认证名称或机构</td>
<td><input type="text" name="member[validator]" size="30" value="<?php echo $validator;?>"/></td>
</tr>
<tr>
<td class="tl">认证日期</td>
<td><?php echo dcalendar('member[validtime]', $validtime);?></td>
</tr>
<tr>
<td class="tl">邮件认证</td>
<td>
<input type="radio" name="member[vemail]" value="1" <?php if($vemail) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vemail]" value="0" <?php if(!$vemail) echo 'checked';?>/> 否
<?php tips('开启邮件发送后，此项由会员自行认证');?>
</td>
</tr>
<tr>
<td class="tl">手机认证</td>
<td>
<input type="radio" name="member[vmobile]" value="1" <?php if($vmobile) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vmobile]" value="0" <?php if(!$vmobile) echo 'checked';?>/> 否
<?php tips('开启短信发送后，此项由会员自行认证');?>
</td>
</tr>
<tr>
<td class="tl">银行认证</td>
<td>
<input type="radio" name="member[vbank]" value="1" <?php if($vbank) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vbank]" value="0" <?php if(!$vbank) echo 'checked';?>/> 否
<?php tips('一般在会员提现之后，由网站进行付款认证，认证之后会员的收款信息将不可修改');?>
</td>
</tr>
<tr>
<td class="tl">实名认证</td>
<td>
<input type="radio" name="member[vtruename]" value="1" <?php if($vtruename) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vtruename]" value="0" <?php if(!$vtruename) echo 'checked';?>/> 否
<?php tips('一般由会员在线提交身份证或其他证件电子文档或传真件，由网站进行认证');?>
</td>
</tr>
<tr>
<td class="tl">公司认证</td>
<td>
<input type="radio" name="member[vcompany]" value="1" <?php if($vcompany) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vcompany]" value="0" <?php if(!$vcompany) echo 'checked';?>/> 否
<?php tips('一般由会员在线提交营业执照、组织机构代码证等电子文档或传真件，由网站进行认证');?>
</td>
</tr>
</table>
<div class="tt">高级设置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">主页风格目录 </td>
<td><input type="text" size="20" name="member[skin]" value="<?php echo $skin;?>"/></td>
</tr>
<tr>
<td class="tl">主页模板目录 </td>
<td><input type="text" size="20" name="member[template]" value="<?php echo $template;?>"/></td>
</tr>
<tr>
<td class="tl">绑定域名 </td>
<td><input type="text" size="30" name="member[domain]" id="domain" value="<?php echo $domain;?>"/><?php tips('例如 www.destoon.com 不带http<br/>同时需要会员将此域名IP指向本站服务器');?></td>
</tr>
<tr>
<td class="tl">域名ICP备案号 </td>
<td><input type="text" size="30" name="member[icp]" id="icp" value="<?php echo $icp;?>"/></td>
</tr>
<tr>
<td class="tl">Flash横幅 </td>
<td class="f_gray"><input type="text" size="60" name="member[banner]" id="flash" value="<?php echo $banner;?>"/>&nbsp;&nbsp;<span onclick="Dfile(<?php echo $moduleid;?>, $('flash').value, 'flash');" class="jt">[上传]</span>&nbsp;&nbsp;<span onclick="if($('flash').value) window.open($('flash').value);" class="jt">[预览]</span>&nbsp;&nbsp;<span onclick="$('flash').value='';" class="jt">[删除]</span> <span id="dflash" class="f_red"></span><?php tips('出于安全原因，系统禁止会员直接上传Flash横幅<br/>管理员可以从这里替会员上传<br/>上传后将显示在会员主页横幅图片位置');?></td>
</tr>
<tr>
<td class="tl">站内信黑名单 </td>
<td><input type="text" size="60" name="member[black]" id="black" value="<?php echo $black;?>"/></td>
</tr>
<tr>
<td class="tl">会员资料是否完整</td>
<td>
<input type="radio" name="member[edittime]" value="1"<?php if($edittime) echo ' checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[edittime]" value="0"<?php if(!$edittime) echo ' checked';?>/> 否&nbsp;&nbsp;
<span class="f_gray">如果选择是，系统将不再提示会员完善资料</span>
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn">&nbsp;&nbsp;<input type="button" value=" 前 台 " class="btn" onclick="window.open('?moduleid=<?php echo $moduleid;?>&action=login&userid=<?php echo $userid;?>');"/>&nbsp;&nbsp;<input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
var vid = '';
function validator(id) {
	if(!$(id).value) return false;
	vid = id;
	makeRequest('moduleid=<?php echo $moduleid;?>&action=member&job='+id+'&value='+$(id).value+'&userid=<?php echo $userid;?>', AJPath, 'dvalidator')
}
function dvalidator() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		$('d'+vid).innerHTML = xmlHttp.responseText ? xmlHttp.responseText : '';
	}
}
function Dcheck() {
	if($('groupid').value == 0) {
		Dmsg('请选择会员组', 'groupid');
		return false;
	}
	if($('password').value != '') {
		if($('cpassword').value == '') {
			Dmsg('请重复输入密码', 'cpassword');
			return false;
		}
		if($('password').value != $('cpassword').value) {
			Dmsg('两次输入的密码不一致', 'password');
			return false;
		}
	}
	if($('passport').value == '') {
		Dmsg('请填写通行证', 'passport');
		return false;
	}
	if($('email').value == '') {
		Dmsg('请填写电子邮箱', 'email');
		return false;
	}
	if($('truename').value == '') {
		Dmsg('请填写真实姓名', 'truename');
		return false;
	}
	if($('areaid_1').value == 0) {
		Dmsg('请选择所在地', 'areaid');
		return false;
	}
	<?php echo $MFD ? fields_js($MFD) : '';?>
	<?php if($groupid > 5) { ?>
	<?php echo $CFD ? fields_js($CFD) : '';?>
	if($('company').value == '') {
		Dmsg('请填写公司名称', 'company');
		return false;
	}
	if($('type').value == '') {
		Dmsg('请选择公司类型', 'type');
		return false;
	}
	if($('catid').value.length < 2) {
		Dmsg('请选择公司主营行业', 'catid');
		return false;
	}
	if($('business').value.length < 2) {
		Dmsg('请填写主要经营范围', 'business');
		return false;
	}
	if($('regyear').value.length < 4) {
		Dmsg('请填写公司成立年份', 'regyear');
		return false;
	}
	if($('address').value.length < 2) {
		Dmsg('请填写业务部门工作地点', 'address');
		return false;
	}
	if($('telephone').value.length < 6) {
		Dmsg('请填写公司电话', 'telephone');
		return false;
	}
	if(FCKLen('introduce') < 5) {
		Dmsg('公司介绍不能少于5字，当前已经输入'+FCKLen('introduce')+'字', 'introduce');
		return false;
	}
	<?php } ?>
	return true;
}
</script>
<script type="text/javascript">Menuon(1);</script>
</body>
</html>