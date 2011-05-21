<?php
defined('IN_DESTOON') or exit('Access Denied');
$MCFG = array();
$MCFG['module'] = 'special';
$MCFG['name'] = '专题';
$MCFG['author'] = 'Destoon.COM';
$MCFG['homepage'] = 'www.destoon.com';
$MCFG['copy'] = false;
$MCFG['uninstall'] = true;
$MCFG['moduleid'] = 11;

$RT = array();
$RT['file']['index'] = '专题管理';
$RT['file']['item'] = '信息管理';
$RT['file']['html'] = '更新网页';

$RT['action']['index']['add'] = '添加专题';
$RT['action']['index']['edit'] = '修改专题';
$RT['action']['index']['delete'] = '删除专题';
$RT['action']['index']['check'] = '审核专题';
$RT['action']['index']['recycle'] = '回收站';
$RT['action']['index']['move'] = '专题移动';
$RT['action']['index']['level'] = '信息级别';

$CT = true;
?>