<?php
defined('IN_DESTOON') or exit('Access Denied');
$MCFG['module'] = 'member';
$MCFG['name'] = '会员';
$MCFG['author'] = 'Destoon.COM';
$MCFG['homepage'] = 'www.destoon.com';
$MCFG['copy'] = false;
$MCFG['uninstall'] = false;

$RT = array();
$RT['file']['index'] = '会员管理';
$RT['file']['group'] = '会员组管理';
$RT['file']['grade'] = '会员升级';
$RT['file']['record'] = '资金流水';
$RT['file']['credits'] = '积分奖惩';
$RT['file']['charge'] = '充值记录';
$RT['file']['trade'] = '交易记录';
$RT['file']['cash'] = '提现记录';
$RT['file']['ask'] = '客服中心';
$RT['file']['card'] = '充值卡管理';
$RT['file']['promo'] = '优惠码管理';
$RT['file']['sendmail'] = '发送邮件';
$RT['file']['sms'] = '发送短信';
$RT['file']['mail'] = '邮件订阅';
$RT['file']['message'] = '站内信件';
$RT['file']['credit'] = '荣誉资质';
$RT['file']['news'] = '公司新闻';
$RT['file']['link'] = '友情链接';
$RT['file']['style'] = '公司模板';

$RT['action']['index']['add'] = '会员添加';
$RT['action']['index']['edit'] = '会员修改';
$RT['action']['index']['delete'] = '会员删除';
$RT['action']['index']['check'] = '会员审核';
$RT['action']['index']['move'] = '会员移动';
$RT['action']['index']['show'] = '会员查看';

$RT['action']['group']['add'] = '会员组添加';
$RT['action']['group']['edit'] = '会员组修改';
$RT['action']['group']['delete'] = '会员组删除';

$RT['action']['record']['add'] = '流水添加';
$RT['action']['record']['export'] = '流水导出';

$RT['action']['charge']['check'] = '审核记录';
$RT['action']['charge']['recycle'] = '作废记录';
$RT['action']['charge']['delete'] = '删除记录';
$RT['action']['charge']['export'] = '导出记录';

$RT['action']['trade']['show'] = '查看交易';
$RT['action']['trade']['refund'] = '退款受理';
$RT['action']['trade']['export'] = '导出记录';

$RT['action']['cash']['show'] = '查看申请';
$RT['action']['cash']['edit'] = '受理申请';
$RT['action']['cash']['export'] = '导出记录';

$RT['action']['ask']['edit'] = '受理问题';
$RT['action']['ask']['delete'] = '删除问题';

$RT['action']['sendmail']['list'] = '邮件列表';
$RT['action']['sendmail']['make'] = '获取列表';
$RT['action']['sendmail']['download'] = '下载列表';
$RT['action']['sendmail']['delete'] = '删除列表';

$RT['action']['sendsms']['list'] = '号码列表';
$RT['action']['sendsms']['make'] = '获取号码';
$RT['action']['sendsms']['download'] = '下载列表';
$RT['action']['sendsms']['delete'] = '删除列表';

$RT['action']['mail']['send'] = '发送邮件';
$RT['action']['mail']['add'] = '添加邮件';
$RT['action']['mail']['edit'] = '修改邮件';
$RT['action']['mail']['delete'] = '删除邮件';
$RT['action']['mail']['list'] = '查看列表';
$RT['action']['mail']['list_delete'] = '取消订阅';

$RT['action']['message']['send'] = '发送信件';
$RT['action']['message']['edit'] = '修改信件';
$RT['action']['message']['delete'] = '删除信件';
$RT['action']['message']['mail'] = '信件转发';
$RT['action']['message']['clear'] = '信件清理';

$RT['action']['credit']['add'] = '添加证书';
$RT['action']['credit']['edit'] = '修改证书';
$RT['action']['credit']['delete'] = '删除证书';
$RT['action']['credit']['check'] = '审核证书';
$RT['action']['credit']['expire'] = '过期证书';
$RT['action']['credit']['reject'] = '未通过证书';
$RT['action']['credit']['recycle'] = '回收站';
$RT['action']['credit']['clear'] = '清空回收站';
$RT['action']['credit']['update'] = '更新地址';

$RT['action']['news']['add'] = '添加新闻';
$RT['action']['news']['edit'] = '修改新闻';
$RT['action']['news']['delete'] = '删除新闻';
$RT['action']['news']['check'] = '审核新闻';
$RT['action']['news']['reject'] = '未通过新闻';
$RT['action']['news']['recycle'] = '回收站';
$RT['action']['news']['clear'] = '清空回收站';

$RT['action']['link']['add'] = '添加链接';
$RT['action']['link']['edit'] = '修改链接';
$RT['action']['link']['delete'] = '删除链接';
$RT['action']['link']['check'] = '审核链接';

$RT['action']['style']['add'] = '添加模板';
$RT['action']['style']['edit'] = '修改模板';
$RT['action']['style']['delete'] = '删除模板';
$RT['action']['style']['order'] = '更新排序';

$CT = false;
?>