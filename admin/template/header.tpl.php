<?php
defined('IN_DESTOON') or exit('Access Denied');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo DT_CHARSET;?>"/>
<title>管理中心 - <?php echo $DT['sitename']; ?> - Powered By Destoon B2B V<?php echo DT_VERSION; ?> R<?php echo DT_RELEASE;?></title>
<meta name="robots" content="noindex,nofollow"/>
<meta name="generator" content="Destoon B2B,www.destoon.com"/>
<meta http-equiv="x-ua-compatible" content="ie=7"/>
<?php if(!DT_DEBUG) { ?><script type="text/javascript">window.onerror= function(){return true;}</script><?php } ?>
<link rel="stylesheet" href="admin/image/style.css" type="text/css"/>
<script type="text/javascript" src="lang/<?php echo DT_LANG;?>/lang.js"></script>
<script type="text/javascript" src="file/script/config.js"></script>
<script type="text/javascript" src="file/script/common.js"></script>
<script type="text/javascript" src="file/script/admin.js"></script>
</head>
<body>
<div id="msgbox" onmouseover="closemsg();" style="display:none;"></div>
<?php dmsg();?>