<?php
defined('IN_DESTOON') or exit('Access Denied');
$MCFG = array();
$MCFG['module'] = 'photo';
$MCFG['name'] = '图库';
$MCFG['author'] = 'Destoon.COM';
$MCFG['homepage'] = 'www.destoon.com';
$MCFG['copy'] = false;
$MCFG['uninstall'] = true;
$MCFG['moduleid'] = 12;

$RT = array();
$RT['file']['index'] = '图库管理';
$RT['file']['html'] = '更新网页';

$RT['action']['index']['add'] = '添加图库';
$RT['action']['index']['edit'] = '修改图库';
$RT['action']['index']['delete'] = '删除图库';
$RT['action']['index']['check'] = '审核图库';
$RT['action']['index']['recycle'] = '回收站';
$RT['action']['index']['move'] = '图库移动';
$RT['action']['index']['level'] = '信息级别';

$CT = true;
?>