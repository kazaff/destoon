<?php Template_Class::subtplcheck('control/admin/tpl/admin_tpl_edit_tagtpl', '1303866365', 'control/admin/tpl/admin_tpl_edit_tagtpl');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_K['charset']?>" />
<title>main</title>
</head>
<link href="tpl/css/style.css" rel="stylesheet" type="text/css" />
<script src="tpl/js/jquery.js" type="text/javascript"></script>
<script src="tpl/js/common.js" type="text/javascript"></script>
<script type="text/javascript" src="tpl/js/Css.js"></script>
<script type="text/javascript" src="tpl/js/form_and_validation.js"></script>
<body>
<form method="post" action="plu.php?do=edittagtpl&tplname=<?=$tplname?>" >

<div class="main">
<div class="m_tit">
<ul><li class="m_tit_l"></li>
<li class="font14">编辑模板</li><li class="m_tit_r"></li>
</ul>
</div>
    <table width="96%" height="200" border="0" cellspacing="0" cellpadding="0" class="tab_m t_l">
      <tr>
        <td class="bg1 t_r">模板存放地址：</td>
        <td>
        	control/admin/tpl/template_tag_<?=$tplname?>.htm
</td>
      </tr>
   <tr>
        <td width="30%" class="bg1 t_r">模板代码：</td>
        <td>
        	<textarea name="code_content" cols="80" rows="20"><?=$code_content?></textarea>
</td>
      </tr>
   <tr>
         <td align="left" colspan="2">
        <div style="padding-left:300px;">
<input type="submit" name="sbt_edit" class="input_but"  value="保存编辑"/>
       	<input type="reset" name="rst_edit" class="input_but"  value="返回上一页" onclick="history.go(-1);"/>
</div>
        </td>
      </tr>
    </table>
    </div>
</form>
<script src="tpl/js/form_validation_.js" type="text/javascript"></script>
</body>
</html><?php Template_Class::ob_out();?>