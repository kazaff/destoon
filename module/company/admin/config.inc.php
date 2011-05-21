<?php
defined('IN_DESTOON') or exit('Access Denied');
$MCFG['module'] = 'company';
$MCFG['name'] = '公司';
$MCFG['author'] = 'Destoon.COM';
$MCFG['homepage'] = 'www.destoon.com';
$MCFG['copy'] = false;
$MCFG['uninstall'] = false;

$RT = array();
$RT['file']['index'] = '公司列表';
$RT['file']['vip'] = VIP.'管理';
$RT['file']['html'] = '更新网页';

$RT['action']['vip']['add'] = '添加'.VIP;
$RT['action']['vip']['edit'] = '修改'.VIP;
$RT['action']['vip']['delete'] = '撤销'.VIP;
$RT['action']['vip']['expire'] = '过期'.VIP;
$RT['action']['vip']['show'] = '查看申请';
$RT['action']['vip']['move'] = '删除申请';
$RT['action']['vip']['update'] = '更新指数';

$CT = false;
?>