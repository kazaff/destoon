<?php
defined('IN_DESTOON') or exit('Access Denied');
$menu = array(
	array('添加会员', '?moduleid=2&action=add'),
	array('会员列表', '?moduleid=2'),
	array('审核会员', '?moduleid=2&action=check'),
	array('联系会员', '?moduleid=2&file=contact'),
	array(VIP.'管理', '?moduleid=4&file=vip'),
	array('会员升级', '?moduleid=2&file=grade&action=check'),
	array('会员组管理', '?moduleid=2&file=group'),
	array('模块设置', '?moduleid=2&file=setting'),
);
$menu_finance = array(
	array($DT['money_name'].'管理', '?moduleid=2&file=record'),
	array($DT['credit_name'].'管理', '?moduleid=2&file=credits'),
	array('充值记录', '?moduleid=2&file=charge'),
	array('交易记录', '?moduleid=2&file=trade'),
	array('提现记录', '?moduleid=2&file=cash'),
	array('信息支付', '?moduleid=2&file=pay'),
	array('充值卡管理', '?moduleid=2&file=card'),
	array('优惠码管理', '?moduleid=2&file=promo'),
);
$menu_relate = array(
	array('客服中心', '?moduleid=2&file=ask'),
	array('资料认证', '?moduleid=2&file=validate'),
	array('电子邮件', '?moduleid=2&file=sendmail'),
	array('手机短信', '?moduleid=2&file=sms'),
	array('贸易提醒', '?moduleid=2&file=alert'),
	array('邮件订阅', '?moduleid=2&file=mail'),
	array('站内信件', '?moduleid=2&file=message'),
	array('商机收藏', '?moduleid=2&file=favorite'),
	array('会员商友', '?moduleid=2&file=friend'),
	array('登录日志', '?moduleid=2&file=loginlog'),
);
if(!$_founder) unset($menu_relate[7]);
?>