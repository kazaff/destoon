<?php
define('KEKE_OFF', FALSE );
define('ENV_ERROR', 2);
define('CONFIG', './config/config.inc.php');
$func_items = array('mysql_connect', 'fsockopen', 'gethostbyname', 'file_get_contents', 'xml_parser_create','zip_open');
$env_items = array('os' => array('c' => 'PHP_OS', 'r' => 'notset', 'b' => 'unix'),'php' => array('c' => 'PHP_VERSION', 'r' => '4.0', 'b' => '5.0'),'attachmentupload' => array('r' => 'notset', 'b' => '2M'),'gdversion' => array('r' => '1.0', 'b' => '2.0'),'diskspace' => array('r' => '10M', 'b' => 'notset'),);
$dirfile_items = array('config' => array('type' => 'file', 'path' => CONFIG),'config_dir' => array('type' => 'dir', 'path' => './config'),'admin_tmp_dir' => array('type' => 'dir', 'path' => './control/admin/tpl'),'index_tmp_dir' => array('type' => 'dir', 'path' => './tpl'),'index_default_tmp_dir' => array('type' => 'dir', 'path' => './tpl/default'),'data_cache' => array('type' => 'dir', 'path' => './data/data_cache'),'tpl_c' => array('type' => 'dir', 'path' => './data/tpl_c'),'backup' => array('type' => 'dir', 'path' => './data/backup'),'uploads' => array('type' => 'dir', 'path' => './data/uploads'),'uploads_member' => array('type' => 'dir', 'path' => './data/uploads/member'),'uploads_time' => array('type' => 'dir', 'path' => './data/uploads/2010'),
);