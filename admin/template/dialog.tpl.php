<?php 
defined('IN_DESTOON') or exit('Access Denied');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo DT_CHARSET; ?>" />
<title>提示信息 - Powered By Destoon <?php echo DT_VERSION; ?></title>
<link rel="stylesheet" href="admin/image/style.css" type="text/css" />
<script type="text/javascript" src="<?php echo DT_PATH;?>lang/<?php echo DT_LANG;?>/lang.js"></script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/config.js"></script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/common.js"></script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/admin.js"></script>
</head>
</body>
<div id="box">
<?php echo $dcontent; ?>
</div>
<script type="text/javascript">
try{parent.$('dload').style.display='none';parent.$('diframe').style.height = $('box').scrollHeight+'px';} catch(e){}
</script>
</body>
</html>