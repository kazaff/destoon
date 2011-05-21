<?php
defined('IN_DESTOON') or exit('Access Denied');
$MCFG = array();
$MCFG['module'] = 'quote';
$MCFG['name'] = '行情';
$MCFG['author'] = 'Destoon.COM';
$MCFG['homepage'] = 'www.destoon.com';
$MCFG['copy'] = false;
$MCFG['uninstall'] = true;
$MCFG['moduleid'] = 7;

$RT = array();
$RT['file']['index'] = '行情管理';
$RT['file']['html'] = '更新网页';

$RT['action']['index']['add'] = '添加行情';
$RT['action']['index']['edit'] = '修改行情';
$RT['action']['index']['delete'] = '删除行情';
$RT['action']['index']['check'] = '审核行情';
$RT['action']['index']['recycle'] = '回收站';
$RT['action']['index']['move'] = '行情移动';
$RT['action']['index']['level'] = '信息级别';

$CT = true;
?>