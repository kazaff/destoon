<?php
define('DT_REWRITE', true);
require 'config.inc.php';	//确定模块id
require '../common.inc.php';	//初始化系统配置数据
require DT_ROOT.'/module/'.$module.'/index.inc.php';	//加载指定模块的配置代码
?>