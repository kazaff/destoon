<?php Template_Class::subtplcheck('control/admin/tpl/admin_index', '1303866356', 'control/admin/tpl/admin_index');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_K['charset']?>" />
<title>客客-后台管理</title>
<meta name="keywords" content="" />
<meta name="description"  content="" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<link href="tpl/css/base.css" rel="stylesheet" type="text/css" />
<style type="text/css">
html,body{overflow:hidden; height:100%;}
table,td,th, body,dt,dd,dl{margin:0;padding:0;border:none;}
.position{ height:32px; line-height:32px; background:url(tpl/img/position_bg.gif) repeat-x; text-align:left; padding-left:10px;}
.position a{ color:#999;}
</style>
</head>
<body scroll="no" onLoad="init()">
<table cellpadding="0" cellspacing="0" width="100%" height="100%">
    <tr>
        <td colspan="2" height="72">
        	<iframe src="index.php?do=menu" name="top" target="left" width="100%" height="72" scrolling="no" frameborder="0"></iframe>
</td>
    </tr>
    <tr>
        <td valign="top" rowspan="2" width="160" style=" border-right:1px solid #479C01;">
<iframe src="index.php?do=side" name="left" id="left" target="main" width="160" height="100%" scrolling="no" frameborder="0"></iframe>
</td>
        <td valign="top" width="100%">
        
        
        	<table  cellpadding="0" cellspacing="0" width="100%" height="100%">
              <tr>
                    <td valign="top" height="32">
                        <div id="nav" class="position">
                        	当前位置：
<img src="tpl/img/position_dot.gif" align="absmiddle"/><a id="nav1" href="#">管理员后台</a>
<img src="tpl/img/position_dot.gif" align="absmiddle"/><a id="nav2" href="#">系统主页</a>
<img src="tpl/img/position_dot.gif" align="absmiddle"/><a id="nav3" href="javascript:void(0);"> </a></div>
                    </td>
                </tr>
                <tr>
                    <td td valign="top" width="100%" height="100%"> <iframe src="index.php?do=main" id="main" name="main" width="100%" height="100%" frameborder="0" scrolling="yes" style="overflow:visible;"></iframe> </td>
                </tr>
            </table>
        
        </td>
    </tr>
</table>
<script type="text/javascript">
var init = function(){
var main = document.getElementById("main");
var left = document.getElementById("left");

main.style.height=document.body.clientHeight-104;
left.style.height=document.body.clientHeight;
}
</script>
</body>
</html><?php Template_Class::ob_out();?>