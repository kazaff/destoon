<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
$menus = array (
    array('基本设置'),
    array('公司相关'),
    array('财务相关'),
    array('支付接口'),
    array($DT['credit_name'].'规则'),
    array('会员整合'),
    array('定义字段', '?file=fields&tb='.$table),
);
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="tab" id="tab" value="<?php echo $tab;?>"/>
<div id="Tabs0" style="display:">
<div class="tt">注册设置</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">新用户注册</td>
<td>
<input type="radio" name="setting[enable_register]" value="1"  <?php if($enable_register) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[enable_register]" value="0"  <?php if(!$enable_register) echo 'checked';?>/> 关闭
</td>
</tr>
<tr>
<td class="tl">禁止代理服务器注册</td>
<td>
<input type="radio" name="setting[defend_proxy]" value="1"  <?php if($defend_proxy) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[defend_proxy]" value="0"  <?php if(!$defend_proxy) echo 'checked';?>/> 关闭
</td>
</tr>
<tr>
<td class="tl">IP注册间隔限制(小时)</td>
<td>
<input type="text" size="3" name="setting[iptimeout]" value="<?php echo $iptimeout;?>"/><?php tips('同一IP在本时间间隔内将只能注册一个帐号，填0为不限制');?>
</td>
</tr>
<tr>
<td class="tl">用户名长度</td>
<td>
<input type="text" size="3" name="setting[minusername]" value="<?php echo $minusername;?>"/>
至
<input type="text" size="3" name="setting[maxusername]" value="<?php echo $maxusername;?>"/>
字符<?php tips('建议设置为4-20个字符之间');?>
</td>
</tr>
<tr>
<td class="tl">用户密码长度</td>
<td>
<input type="text" size="3" name="setting[minpassword]" value="<?php echo $minpassword;?>"/>
至
<input type="text" size="3" name="setting[maxpassword]" value="<?php echo $maxpassword;?>"/>
字符<?php tips('过短的密码不利于用户的帐户安全<br/>建议设置为6-20个字符之间，不要超过31位');?>
</td>
</tr>
<tr>
<td class="tl">用户名保留关键字</td>
<td><textarea name="setting[banusername]" style="width:96%;height:50px;overflow:visible;"><?php echo $banusername;?></textarea><?php tips('含有保留的关键字的用户名将被禁止使用，以免引起歧义<br/>多个保留关键字请用|隔开');?>
</td>
</tr>
<tr>
<td class="tl">新用户注册验证</td>
<td>
<input type="radio" name="setting[checkuser]" value="0"  <?php if(!$checkuser) echo 'checked';?>> 无需验证
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[checkuser]" value="1"  <?php if($checkuser==1) echo 'checked';?>> 人工审核&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[checkuser]" value="2"  <?php if($checkuser==2) echo 'checked';?>> 邮件验证
</td>
</tr>
<tr>
<td class="tl">注册发送欢迎信息</td>
<td>
<input type="radio" name="setting[welcome]" value="0"  <?php if(!$welcome) echo 'checked';?>/> 不发送
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[welcome]" value="1"  <?php if($welcome==1) echo 'checked';?>/> 站内短信&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[welcome]" value="2"  <?php if($welcome==2) echo 'checked';?>/> 电子邮件&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[welcome]" value="3"  <?php if($welcome==3) echo 'checked';?>/> 站内短信和电子邮件
</td>
</tr>

<tr>
<td class="tl">注册赠送<?php echo $DT['money_name'];?></td>
<td>
<input type="text" size="3" name="setting[money_register]" value="<?php echo $money_register;?>"/> <?php echo $DT['money_unit'];?>
</td>
</tr>

<tr>
<td class="tl">客户端屏蔽</td>
<td><textarea name="setting[banagent]" style="width:96%;height:50px;overflow:visible;"><?php echo $banagent;?></textarea><?php tips('群发软件可以伪造IP，但是部分软件发送的客户端信息相同<br/>例如某群发软件的客户端信息全部包含 .NET CLR 1.0.3705<br/>可在此直接屏蔽含有此类特征码的客户端注册<br/>多个特征码请用 | 分割<br/>用户注册的客户端信息已记录，请在会员资料里查看和分析<br/>用户登录日志里也记录了客户端信息，请注意分析');?>
</td>
</tr>
<tr>
<td class="tl">站内短信同时最多发送至</td>
<td>
<input type="text" size="3" name="setting[maxtouser]" value="<?php echo $maxtouser;?>"/> 位会员<?php tips('最小填1，例如填5则表示，同一信件一次最多可以同时发送给5位会员');?>
</td>
</tr>
<tr>
<td class="tl">发送站内短信启用验证码</td>
<td>
<input type="radio" name="setting[captcha_sendmessage]" value="2"  <?php if($captcha_sendmessage == 2) echo 'checked';?>> 继承会员组设置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_sendmessage]" value="1"  <?php if($captcha_sendmessage == 1) echo 'checked';?>> 全部启用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_sendmessage]" value="0"  <?php if($captcha_sendmessage == 0) echo 'checked';?>> 全部关闭
</td>
</tr>
<tr>
<td class="tl">登录失败次数限制</td>
<td><input type="text" size="3" name="setting[login_times]" value="<?php echo $login_times;?>"/> 次登录失败后锁定登录 <input type="text" size="3" name="setting[lock_hour]" value="<?php echo $lock_hour;?>"/> 小时
</td>
</tr>
<tr>
<td class="tl">验证邮件有效期</td>
<td>
<input type="text" size="3" name="setting[auth_days]" value="<?php echo $auth_days;?>"/> 天<?php tips('验证信链接超过有效期天数将失效 填0为不限制');?>
</td>
</tr>

<tr>
<td class="tl">贸易提醒模块ID</td>
<td>
<input type="text" size="20" name="setting[alertid]" value="<?php echo $alertid;?>"/> <?php tips('例如5|6代表 供应|求购，模块ID至少为5');?>
</td>
</tr>
<tr>
<td class="tl">贸易提醒需审核</td>
<td>
<input type="radio" name="setting[alert_check]" value="2"  <?php if($alert_check == 2) echo 'checked';?>> 继承会员组设置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[alert_check]" value="1"  <?php if($alert_check == 1) echo 'checked';?>> 全部启用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[alert_check]" value="0"  <?php if($alert_check == 0) echo 'checked';?>> 全部关闭
</td>
</tr>
<tr>
<td class="tl">会员资料认证</td>
<td>
<input type="radio" name="setting[vmember]" value="1"  <?php if($vmember){ ?>checked <?php } ?> onclick="Ds('dvm');"/> 开启&nbsp;&nbsp;
<input type="radio" name="setting[vmember]" value="0"  <?php if(!$vmember){ ?>checked <?php } ?> onclick="Dh('dvm');"/> 关闭
</td>
</tr>
<tbody id="dvm" style="display:<?php if(!$vmember) echo 'none';?>">
<tr>
<td class="tl">邮件认证</td>
<td>
<input type="radio" name="setting[vemail]" value="1"  <?php if($vemail){ ?>checked <?php } ?>/> 开启&nbsp;&nbsp;
<input type="radio" name="setting[vemail]" value="0"  <?php if(!$vemail){ ?>checked <?php } ?>/> 关闭
</td>
</tr>
<tr>
<td class="tl">手机认证</td>
<td>
<input type="radio" name="setting[vmobile]" value="1"  <?php if($vmobile){ ?>checked <?php } ?>/> 开启&nbsp;&nbsp;
<input type="radio" name="setting[vmobile]" value="0"  <?php if(!$vmobile){ ?>checked <?php } ?>/> 关闭
</td>
</tr>
<tr>
<td class="tl">姓名认证</td>
<td>
<input type="radio" name="setting[vtruename]" value="1"  <?php if($vtruename){ ?>checked <?php } ?>/> 开启&nbsp;&nbsp;
<input type="radio" name="setting[vtruename]" value="0"  <?php if(!$vtruename){ ?>checked <?php } ?>/> 关闭
</td>
</tr>
<tr>
<td class="tl">银行帐号认证</td>
<td>
<input type="radio" name="setting[vbank]" value="1"  <?php if($vbank){ ?>checked <?php } ?>/> 开启&nbsp;&nbsp;
<input type="radio" name="setting[vbank]" value="0"  <?php if(!$vbank){ ?>checked <?php } ?>/> 关闭
</td>
</tr>
<tr>
<td class="tl">公司认证</td>
<td>
<input type="radio" name="setting[vcompany]" value="1"  <?php if($vcompany){ ?>checked <?php } ?>/> 开启&nbsp;&nbsp;
<input type="radio" name="setting[vcompany]" value="0"  <?php if(!$vcompany){ ?>checked <?php } ?>/> 关闭
</td>
</tr>
<tr>
<td class="tl">认证专用传真号码</td>
<td>
<input type="text" size="30" name="setting[vfax]" value="<?php echo $vfax;?>"/> <?php tips('如果设置传真，将提示用户可以选择传真证件进行认证');?>
</td>
</tr>
</tbody>
<tr>
<td class="tl">编辑器工具按钮</td>
<td>
<select name="setting[editor]">
<option value="Default"<?php if($editor == 'Default') echo ' selected';?>>全部</option>
<option value="Destoon"<?php if($editor == 'Destoon') echo ' selected';?>>精简</option>
<option value="Simple"<?php if($editor == 'Simple') echo ' selected';?>>简洁</option>
<option value="Basic"<?php if($editor == 'Basic') echo ' selected';?>>基础</option>
</select>
</td>
</tr>
<tr>
<td class="tl">商务中心显示所有菜单</td>
<td>
<input type="radio" name="setting[show_menu]" value="1"  <?php if($show_menu) echo 'checked';?>/> 开启&nbsp;&nbsp;
<input type="radio" name="setting[show_menu]" value="0"  <?php if(!$show_menu) echo 'checked';?>/> 关闭<?php tips('选择关闭 则隐藏无权限访问的菜单');?>
</td>
</tr>
<tr>
<td class="tl">用户注册邮件验证码</td>
<td>
<input type="radio" name="setting[emailcode_register]" value="1"  <?php if($emailcode_register) echo 'checked';?>/> 开启&nbsp;&nbsp;
<input type="radio" name="setting[emailcode_register]" value="0"  <?php if(!$emailcode_register) echo 'checked';?>/> 关闭
</td>
</tr>
<tr>
<td class="tl">用户注册验证码</td>
<td>
<input type="radio" name="setting[captcha_register]" value="1"  <?php if($captcha_register) echo 'checked';?>/> 开启&nbsp;&nbsp;
<input type="radio" name="setting[captcha_register]" value="0"  <?php if(!$captcha_register) echo 'checked';?>/> 关闭
</td>
</tr>
<tr>
<td class="tl">用户注册验证问题</td>
<td>
<input type="radio" name="setting[question_register]" value="1"  <?php if($question_register) echo 'checked';?>/> 开启&nbsp;&nbsp;
<input type="radio" name="setting[question_register]" value="0"  <?php if(!$question_register) echo 'checked';?>/> 关闭
</td>
</tr>
<!--
<tr>
<td class="tl">用户注册邀请码</td>
<td>
<input type="radio" name="setting[promo_register]" value="1"  <?php if($promo_register) echo 'checked';?>/> 开启&nbsp;&nbsp;
<input type="radio" name="setting[promo_register]" value="0"  <?php if(!$promo_register) echo 'checked';?>/> 关闭
</td>
</tr>
-->
<tr>
<td class="tl">用户登录启用验证码</td>
<td>
<input type="radio" name="setting[captcha_login]" value="1"  <?php if($captcha_login) echo 'checked';?>/> 开启&nbsp;&nbsp;
<input type="radio" name="setting[captcha_login]" value="0"  <?php if(!$captcha_login) echo 'checked';?>/> 关闭
</td>
</tr>
<tr>
<td class="tl">用户登录默认记住会员</td>
<td>
<input type="radio" name="setting[login_remember]" value="1"  <?php if($login_remember) echo 'checked';?>/> 开启&nbsp;&nbsp;
<input type="radio" name="setting[login_remember]" value="0"  <?php if(!$login_remember) echo 'checked';?>/> 关闭
</td>
</tr>
<tr>
<td class="tl">用户登录默认进入商务室</td>
<td>
<input type="radio" name="setting[login_goto]" value="1"  <?php if($login_goto) echo 'checked';?>/> 开启&nbsp;&nbsp;
<input type="radio" name="setting[login_goto]" value="0"  <?php if(!$login_goto) echo 'checked';?>/> 关闭
</td>
</tr>
</table>
</div>

<div id="Tabs1" style="display:none;">
<div class="tt">公司相关</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">公司类型</td>
<td><input type="text" name="setting[com_type]" style="width:98%;" value="<?php echo $com_type;?>"/></td>
</tr>
<tr>
<td class="tl">公司规模</td>
<td><input type="text" name="setting[com_size]" style="width:98%;" value="<?php echo $com_size;?>"/></td>
</tr>
<tr>
<td class="tl">经营模式</td>
<td><input type="text" name="setting[com_mode]" style="width:98%;" value="<?php echo $com_mode;?>"/></td>
</tr>
<tr>
<td class="tl">公司注册资本货币类型</td>
<td><input type="text" name="setting[money_unit]" style="width:98%;" value="<?php echo $money_unit;?>"/></td>
</tr>
<tr>
<td class="tl"></td>
<td class="f_red">以上设置请用 | 分隔类型，结尾不需要 |</td>
</tr>
<tr>
<td class="tl">经营模式最多可选</td>
<td>
<input type="text" size="3" name="setting[mode_max]" value="<?php echo $mode_max;?>"/>
</td>
</tr>
<tr>
<td class="tl">主营行业最多可选</td>
<td>
<input type="text" size="3" name="setting[cate_max]" value="<?php echo $cate_max;?>"/>
</td>
</tr>
<tr>
<td class="tl">默认形象图[宽X高]</td>
<td>
<input type="text" size="3" name="setting[thumb_width]" value="<?php echo $thumb_width;?>"/>
X
<input type="text" size="3" name="setting[thumb_height]" value="<?php echo $thumb_height;?>"/> px
</td>
</tr>
<tr>
<td class="tl">截取公司介绍至简介</td>
<td>默认截取 <input type="text" size="3" name="setting[introduce_length]" value="<?php echo $introduce_length;?>"/> 字符
</td>
</tr>
<tr>
<td class="tl">下载公司介绍远程图片</td>
<td>
<input type="radio" name="setting[introduce_save]" value="1"  <?php if($introduce_save) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[introduce_save]" value="0"  <?php if(!$introduce_save) echo 'checked';?>/> 关闭
</td>
</tr>

<tr>
<td class="tl">清除公司介绍内容链接</td>
<td>
<input type="radio" name="setting[introduce_clear]" value="1"  <?php if($introduce_clear) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[introduce_clear]" value="0"  <?php if(!$introduce_clear) echo 'checked';?>/> 关闭
</td>
</tr>

<tr>
<td class="tl">公司新闻需审核</td>
<td>
<input type="radio" name="setting[news_check]" value="2"  <?php if($news_check == 2) echo 'checked';?>> 继承会员组设置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[news_check]" value="1"  <?php if($news_check == 1) echo 'checked';?>> 全部启用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[news_check]" value="0"  <?php if($news_check == 0) echo 'checked';?>> 全部关闭

</td>
</tr>

<tr>
<td class="tl">下载新闻内容远程图片</td>
<td>
<input type="radio" name="setting[news_save]" value="1"  <?php if($news_save) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[news_save]" value="0"  <?php if(!$news_save) echo 'checked';?>/> 关闭
</td>
</tr>

<tr>
<td class="tl">清除新闻内容内容链接</td>
<td>
<input type="radio" name="setting[news_clear]" value="1"  <?php if($news_clear) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[news_clear]" value="0"  <?php if(!$news_clear) echo 'checked';?>/> 关闭
</td>
</tr>

<tr>
<td class="tl">荣誉资质需审核</td>
<td>
<input type="radio" name="setting[credit_check]" value="2"  <?php if($credit_check == 2) echo 'checked';?>> 继承会员组设置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[credit_check]" value="1"  <?php if($credit_check == 1) echo 'checked';?>> 全部启用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[credit_check]" value="0"  <?php if($credit_check == 0) echo 'checked';?>> 全部关闭
</td>
</tr>

<tr>
<td class="tl">下载证书介绍远程图片</td>
<td>
<input type="radio" name="setting[credit_save]" value="1"  <?php if($credit_save) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[credit_save]" value="0"  <?php if(!$credit_save) echo 'checked';?>/> 关闭
</td>
</tr>

<tr>
<td class="tl">清除证书介绍链接</td>
<td>
<input type="radio" name="setting[credit_clear]" value="1"  <?php if($credit_clear) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[credit_clear]" value="0"  <?php if(!$credit_clear) echo 'checked';?>/> 关闭
</td>
</tr>

<tr>
<td class="tl">友情链接需审核</td>
<td>
<input type="radio" name="setting[link_check]" value="2"  <?php if($link_check == 2) echo 'checked';?>> 继承会员组设置&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[link_check]" value="1"  <?php if($link_check == 1) echo 'checked';?>> 全部启用&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[link_check]" value="0"  <?php if($link_check == 0) echo 'checked';?>> 全部关闭
</td>
</tr>
</table>
</div>
<div id="Tabs2" style="display:none">
<div class="tt">财务相关</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">会员在线充值</td>
<td>
<input type="radio" name="setting[pay_online]" value="1"  <?php if($pay_online) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[pay_online]" value="0"  <?php if(!$pay_online) echo 'checked';?>/> 关闭
</td>
</tr>
<tr>
<td class="tl">最小充值额度</td>
<td><input type="text" size="20" name="setting[mincharge]" value="<?php echo $mincharge;?>"/> 0表示不限，填数字表示最小额度，填多个数字用|分割表示选择额度</td>
<tr>
<td class="tl">线下付款方式网页地址</td>
<td><input type="text" size="60" name="setting[pay_url]" value="<?php echo $pay_url;?>"/><?php tips('如果未启用会员在线充值，则系统自动调转至此地址查看普通付款方式。建议用插件的单网页功能建立');?></td>
</tr>
<tr>
<td class="tl">会员提现</td>
<td>
<input type="radio" name="setting[cash_enable]" value="1"  <?php if($cash_enable) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[cash_enable]" value="0"  <?php if(!$cash_enable) echo 'checked';?>/> 关闭
</td>
</tr>
<tr>
<td class="tl">提现方式</td>
<td><input type="text" name="setting[cash_banks]" style="width:95%;" value="<?php echo $cash_banks;?>"/><?php tips('不同方式请用 | 分隔');?></td>
</tr>
<tr>
<td class="tl">24小时提现次数</td>
<td><input type="text" size="5" name="setting[cash_times]" value="<?php echo $cash_times;?>"/> 0为不限</td>
</tr>
<tr>
<td class="tl">单次提现最小金额</td>
<td><input type="text" size="5" name="setting[cash_min]" value="<?php echo $cash_min;?>"/> 0为不限</td>
</tr>
<tr>
<td class="tl">单次提现最大金额</td>
<td><input type="text" size="5" name="setting[cash_max]" value="<?php echo $cash_max;?>"/> 0为不限</td>
</tr>
<tr>
<td class="tl">提现费率</td>
<td><input type="text" size="2" name="setting[cash_fee]" value="<?php echo $cash_fee;?>"/> %</td>
</tr>
<tr>
<td class="tl">费率最小值</td>
<td><input type="text" size="5" name="setting[cash_fee_min]" value="<?php echo $cash_fee_min;?>"/> 0为不限</td>
</tr>
<tr>
<td class="tl">费率封顶值</td>
<td><input type="text" size="5" name="setting[cash_fee_max]" value="<?php echo $cash_fee_max;?>"/> 0为不限</td>
</tr>
<tr>
<td class="tl">买家默认确认收货时间</td>
<td><input type="text" size="2" name="setting[trade_day]" value="<?php echo $trade_day;?>"/> 天<?php tips('买家在此时间内未确认收货或申请仲裁，则系统自动付款给卖家，交易成功');?></td>
</tr>
<tr>
<td class="tl">常用支付方式</td>
<td><input type="text" name="setting[pay_banks]" style="width:95%;" value="<?php echo $pay_banks;?>"/><?php tips('手动添加'.$DT['money_name'].'流水时需选择');?></td>
</tr>
<tr>
<td class="tl">常用物流方式</td>
<td><input type="text" name="setting[send_types]" style="width:95%;" value="<?php echo $send_types;?>"/></td>
</tr>
</table>
</div>
<div id="Tabs3" style="display:none">
<div class="tt">支付接口</div>
<?php include DT_ROOT.'/api/pay.inc.php';?>
</div>
<div id="Tabs4" style="display:none;">
<div class="tt"><?php echo $DT['credit_name'];?>规则</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">新用户注册奖励</td>
<td>
<input type="text" size="5" name="setting[credit_register]" value="<?php echo $credit_register;?>"/>
</td>
</tr>
<tr>
<td class="tl">完善个人资料奖励</td>
<td>
<input type="text" size="5" name="setting[credit_edit]" value="<?php echo $credit_edit;?>"/>
</td>
</tr>
<tr>
<td class="tl">24小时登录一次奖励</td>
<td>
<input type="text" size="5" name="setting[credit_login]" value="<?php echo $credit_login;?>"/>
</td>
</tr>
<tr>
<td class="tl">引导一位会员注册奖励</td>
<td>
<input type="text" size="5" name="setting[credit_user]" value="<?php echo $credit_user;?>"/>
</td>
</tr>
<tr>
<td class="tl">引导一个IP访问奖励</td>
<td>
<input type="text" size="5" name="setting[credit_ip]" value="<?php echo $credit_ip;?>"/>
</td>
</tr>
<tr>
<td class="tl">24小时引导<?php echo $DT['credit_name'];?>上限</td>
<td>
<input type="text" size="5" name="setting[credit_maxip]" value="<?php echo $credit_maxip;?>"/>
<?php tips('为了防止作弊，超过'.$DT['credit_name'].'上限将不再计算');?>
</td>
</tr>
<tr>
<td class="tl">在线充值1<?php echo $DT['money_unit'];?>奖励</td>
<td>
<input type="text" size="5" name="setting[credit_charge]" value="<?php echo $credit_charge;?>"/> <?php tips('每充值1'.$DT['money_unit'].' 奖励对应倍数的'.$DT['credit_name']);?>
</td>
</tr>
<tr>
<td class="tl">上传资质证书奖励</td>
<td>
<input type="text" size="5" name="setting[credit_add_credit]" value="<?php echo $credit_add_credit;?>"/>
</td>
</tr>
<tr>
<td class="tl">资质证书被删除扣除</td>
<td>
<input type="text" size="5" name="setting[credit_del_credit]" value="<?php echo $credit_del_credit;?>"/>
</td>
</tr>
<tr>
<td class="tl">发布企业新闻奖励</td>
<td>
<input type="text" size="5" name="setting[credit_add_news]" value="<?php echo $credit_add_news;?>"/>
</td>
</tr>
<tr>
<td class="tl">企业新闻被删除扣除</td>
<td>
<input type="text" size="5" name="setting[credit_del_news]" value="<?php echo $credit_del_news;?>"/>
</td>
</tr>
</table>
<div class="tt"><?php echo $DT['credit_name'];?>购买</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><?php echo $DT['credit_name'];?>购买额度</td>
<td>
<input type="text" size="50" name="setting[credit_buy]" value="<?php echo $credit_buy;?>"/>
</td>
</tr>
<tr>
<td class="tl"><?php echo $DT['credit_name'];?>对应价格</td>
<td>
<input type="text" size="50" name="setting[credit_price]" value="<?php echo $credit_price;?>"/><br/>
<span class="f_gray"><?php echo $DT['credit_name'];?>和价格用|分割，二者必须一一对应</span>
</td>
</tr>
</table>
</div>
<div id="Tabs5" style="display:none">
<div class="tt">会员整合</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">启用会员整合</td>
<td>
<input type="radio" name="setting[passport]" value="0"  <?php if(!$passport) echo 'checked';?> onclick="Dh('p_s');Dh('u_c');"/> 关闭&nbsp;&nbsp;
<input type="radio" name="setting[passport]" value="phpwind" <?php if($passport == 'phpwind') echo 'checked';?> onclick="Ds('p_s');Dh('u_c');"/> PHPWind&nbsp;&nbsp;
<input type="radio" name="setting[passport]" value="discuz" <?php if($passport == 'discuz') echo 'checked';?> onclick="Ds('p_s');Dh('u_c');"/> Discuz!(5.x,6.x)&nbsp;&nbsp;
<input type="radio" name="setting[passport]" value="uc" <?php if($passport == 'uc') echo 'checked';?> onclick="Dh('p_s');Ds('u_c');"/> Ucenter(Discuz!7.x,Discuz! X)
</td>
</tr>
<tbody id="p_s" style="display:<?php echo $passport && $passport != 'uc' ? '' : 'none';?>">
<tr>
<td class="tl">整合程序字符编码</td>
<td>
<select name="setting[passport_charset]">
<option value="gbk"<?php if($passport_charset == 'gbk') echo ' selected';?>>GBK/GB2312</option>
<option value="utf-8"<?php if($passport_charset == 'utf-8') echo ' selected';?>>UTF-8</option>
</select>
</td>
</tr>
<tr>
<td class="tl">整合程序地址</td>
<td><input name="setting[passport_url]" type="text" size="50" value="<?php echo $passport_url;?>"/><?php tips('整合程序接口地址 例如:http://bbs.destoon.com 结尾不要带斜线');?></td>
</tr>
<tr>
<td class="tl">整合密钥</td>
<td><input name="setting[passport_key]" id="passport_key" type="text" size="30" value="<?php echo $passport_key;?>"/> <a href="javascript:$('passport_key').value=RandStr();void(0);" class="t">[随机]</a> </td>
</tr>
</tbody>
<tbody id="u_c" style="display:<?php echo $passport && $passport == 'uc' ? '' : 'none';?>">
<tr>
<td class="tl">API 地址</td>
<td><input name="setting[uc_api]" type="text" size="50" value="<?php echo $uc_api;?>"/><?php tips('整合程序接口地址 例如:http://bbs.destoon.com 结尾不要带斜线');?></td>
</tr>
<tr>
<td class="tl">主机IP</td>
<td><input name="setting[uc_ip]" type="text" size="50" value="<?php echo $uc_ip;?>"/><?php tips('一般不用填写,遇到无法同步时,请填写Ucenter主机的IP地址');?></td>
</tr>
<tr>
<td class="tl">整合方式</td>
<td>
<input type="radio" name="setting[uc_mysql]" value="1" <?php if($uc_mysql) echo 'checked';?> onclick="Ds('u_c_m');"/> MySQL
<input type="radio" name="setting[uc_mysql]" value="0" <?php if(!$uc_mysql) echo 'checked';?> onclick="Dh('u_c_m');"/> 远程连接
</td>
</tr>
<tr id="u_c_m" style="display:<?php echo $uc_mysql ? '' : 'none';?>">
<td colspan="2" style="padding:10px;">
	<table cellpadding="2" cellspacing="1" class="tb">
	<tr>
	<td class="tl">数据库主机名</td>
	<td><input name="setting[uc_dbhost]" type="text" size="30" value="<?php echo $uc_dbhost;?>"/></td>
	</tr>
	<tr>
	<td class="tl">数据库用户名</td>
	<td><input name="setting[uc_dbuser]" type="text" size="30" value="<?php echo $uc_dbuser;?>"/></td>
	</tr>
	<tr>
	<td class="tl">数据库密码</td>
	<td><input name="setting[uc_dbpwd]" type="text" size="30" value="<?php echo $uc_dbpwd;?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
	</tr>
	<tr>
	<td class="tl">数据库名</td>
	<td><input name="setting[uc_dbname]" type="text" size="30" value="<?php echo $uc_dbname;?>"/></td>
	</tr>
	<tr>
	<td class="tl">数据表前缀</td>
	<td><input name="setting[uc_dbpre]" type="text" size="30" value="<?php echo $uc_dbpre;?>"/></td>
	</tr>
	<tr>
	<td class="tl">数据库字符集</td>
	<td>
	<select name="setting[uc_charset]">
	<option value="gbk"<?php if($uc_charset == 'gbk') echo ' selected';?>>GBK/GB2312</option>
	<option value="utf8"<?php if($uc_charset == 'utf8') echo ' selected';?>>UTF-8</option>
	</select>
	</td>
	</tr>
	</table>
</td>
</tr>
<tr>
<td class="tl">应用ID(APP ID)</td>
<td><input name="setting[uc_appid]" type="text" size="30" value="<?php echo $uc_appid;?>"/></td>
</tr>
<tr>
<td class="tl">通信密钥</td>
<td><input name="setting[uc_key]" id="uc_key" type="text" size="30" value="<?php echo $uc_key;?>"/> <a href="javascript:$('uc_key').value=RandStr();void(0);" class="t">[随机]</a></td>
</tr>
</tbody>
<tr>
<td class="tl">会员积分兑换</td>
<td>
<input type="radio" name="setting[credit_exchange]" value="0"  <?php if(!$credit_exchange) echo 'checked';?> onclick="Dh('e_x');"/> 关闭&nbsp;&nbsp;
<input type="radio" name="setting[credit_exchange]" value="1"  <?php if($credit_exchange) echo 'checked';?> onclick="Ds('e_x');"/> 开启
</td>
</tr>
<tbody id="e_x" style="display:<?php echo $credit_exchange ? '' : 'none';?>">
<tr>
<td class="tl">论坛类型</td>
<td>
<select name="setting[ex_type]">
<option value="DZX"<?php if($ex_type == 'DZX') echo ' selected';?>>Discuz!X</option>
<option value="DZ"<?php if($ex_type == 'DZ') echo ' selected';?>>Discuz!</option>
<option value="PW"<?php if($ex_type == 'PW') echo ' selected';?>>PHPWind</option>
</select>
</td>
</tr>
<tr>
<td class="tl">数据库务器</td>
<td><input name="setting[ex_host]" type="text" size="30" value="<?php echo $ex_host;?>"/></td>
</tr>
<tr>
<td class="tl">数据库户名</td>
<td><input name="setting[ex_user]" type="text" size="15" value="<?php echo $ex_user;?>"/></td>
</tr>
<tr>
<td class="tl">数据库密码</td>
<td><input name="setting[ex_pass]" type="text" size="15" value="<?php echo $ex_pass;?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">数据库名称</td>
<td><input name="setting[ex_data]" type="text" size="15" value="<?php echo $ex_data;?>"/></td>
</tr>
<tr>
<td class="tl">数据表前缀</td>
<td><input name="setting[ex_prex]" type="text" size="15" value="<?php echo $ex_prex;?>"/></td>
</tr>
<tr>
<td class="tl">数据表字段</td>
<td><input name="setting[ex_fdnm]" type="text" size="15" value="<?php echo $ex_fdnm;?>"/><?php tips('DZ论坛一般为extcredits1、extcredits2...<br/>PW论坛一般为credit');?></td>
</tr>
<tr>
<td class="tl">兑换比率</td>
<td><input name="setting[ex_rate]" type="text" size="15" value="<?php echo $ex_rate;?>"/><?php tips('例如填5表示1个论坛积分可兑换5个'.$DT['credit_name']);?></td>
</tr>
<tr>
<td class="tl">论坛积分名称</td>
<td><input name="setting[ex_name]" type="text" size="15" value="<?php echo $ex_name;?>"/></td>
</tr>
</tbody>
</table>
</div>
<div class="sbt">
<input type="submit" name="submit" value="确 定" class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="展 开" id="ShowAll" class="btn" onclick="TabAll();" title="展开/合并所有选项"/>
</div>
</form>
<script type="text/javascript">
var tab = <?php echo $tab;?>;
var all = <?php echo $all;?>;
function TabAll() {
	var i = 0;
	while(1) {
		if($('Tabs'+i) == null) break;
		$('Tabs'+i).style.display = all ? (i == tab ? '' : 'none') : '';
		i++;
	}
	$('ShowAll').value = all ? '展 开' : '合 并';
	all = all ? 0 : 1;
}
window.onload=function() {
	if(tab) Tab(tab);
	if(all) {all = 0; TabAll();}
}
</script>
</body>
</html>