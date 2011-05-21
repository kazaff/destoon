<?php Template_Class::subtplcheck('control/admin/tpl/admin_menu', '1303866357', 'control/admin/tpl/admin_menu');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_K['charset']?>" />
<title>top</title>
</head>
<link href="tpl/css/style.css" rel="stylesheet" type="text/css" />
<script src="tpl/js/jquery.js" type="text/javascript"></script>
<body>
<div class="top">
<div id="logo">
<a href="index.php" title="管理系统首页">管理系统首页</a>
</div>
<div id="admin">当前位置：<a href="javascript:void(0)"><span class="red"><?=$admin_info['username']?></span></a>　级别：<?php if($admin_info['uid']==ADMIN_UID) { ?>创始人<?php } else { ?><?=$grouplist_arr[$admin_info['group_id']]['groupname']?><?php } ?>　 | <a href="index.php?do=logout">安全退出</a> | <a href="<?=$_K['siteurl']?>" target="_blank">网站首页</a></div>
<div id="menu">
<ul>
<li class="nav_l"></li>
<li><a href="index.php?do=main" id="itemindex" target="main" class="active" onclick="Tabmenu(this,'index',0);">管理首页</a></li>
<?php if(is_array($menu_arr)) { foreach($menu_arr as $k => $v) { ?>
   <li><a href="index.php?do=<?=$k?>" id="item<?=$k?>" target="main" onclick="Tabmenu(this,'<?=$k?>',1);return false;"><?=$v?></a></li>
<?php } } ?>
<li class="nav_r"></li>
</ul>
</div><!--/ menu-->
</div>
<script type="text/javascript">
function Tabmenu(obj,k,o){
if($("#itemindex").hasClass("active")){
$("#itemindex").removeClass('active');
}
<?php if(is_array($menu_arr)) { foreach($menu_arr as $k => $v) { ?>
if($("#item<?=$k?>").hasClass("active")){
$("#item<?=$k?>").removeClass('active');
}
<?php } } ?>
$("#item"+k).addClass('active');

parent.document.getElementById("left").src = "index.php?do=side&menu="+k+"&opnew="+o;

};

</script>
</body>
</html><?php Template_Class::ob_out();?>