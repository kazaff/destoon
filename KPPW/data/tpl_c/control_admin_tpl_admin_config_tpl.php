<?php Template_Class::subtplcheck('control/admin/tpl/admin_config_tpl', '1303866360', 'control/admin/tpl/admin_config_tpl');?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_K['charset']?>">
<link href="tpl/css/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="tpl/js/jquery.js"></script>
<script type="text/javascript" src="tpl/js/Css.js"></script>
<script type="text/javascript" src="tpl/js/form_and_validation.js"></script>
<title>模板配置表</title>
</head>
<body>
<div class="main">
<div class="v_info">&nbsp;模板　<input type="button" value="管理" class="input_but" />　</div>
    <div class="S_info2">技巧提示：如果把导出的风格文件放置在模板目录下，则可以通过模板管理直接安装</div>
    <div class="v_show">
    	
<form action="index.php?do=<?=$do?>&view=<?=$view?>" method="post" enctype="multipart/form-data">
<?php if(is_array($tpl_arr)) { foreach($tpl_arr as $key => $value) { ?>
        <table cellspacing="0" cellpadding="0" class="v_show_style_tab">
          <tr>
            <td style="width: 120px; text-align: center; border-top: none;"><p style="margin-bottom: 2px;">&nbsp;<?=$value['temp_title']?></p>
              <img src="<?=$_K['siteurl']?>/tpl/<?=$value['temp_path']?>/demo.jpg" alt="预览" width="110px;" height="120px;" /></a>
              
              <p class="lightfont"><?=$value['temp_desc']?></p></td>
            <td style="padding-top: 17px; width: 80px; border-top: none; vertical-align: top;"><p style="margin: 2px 0">
                <label>可用
                  <input type="checkbox" name="availablenew[1]" value="1" checked>
                </label>
              </p>
              <p style="margin: 2px 0">
                <label>默认
                  <input  type="radio" value="<?=$value['temp_id']?>" id="rdo_temp_<?=$value['temp_id']?>" name="rdo_is_selected" <?php if($value['is_selected']==1) { ?>checked="checked"<?php } ?>/>
                </label>
              </p>
              <p style="margin: 8px 0 2px">
              <input type="button" class="input_but" value="预览" onclick="window.open('<?=$_K['siteurl']?>/tpl/<?=$value['temp_path']?>/demo.jpg')">
              </p>
              <p style="margin: 8px 0 2px">
              <input type="button" class="input_but" value="编辑" onclick="location.href='index.php?do=tpl&view=tpllist&tplname=<?=$value['temp_path']?>'">
              </p>
              <p style="margin: 8px 0 2px">
              <input type="button" class="input_but" value="导出" onclick="location.href='index.php?do=tpl&view=export&tplname=<?=$value['temp_path']?>'">
              </p>
              <?php if($value['temp_path']!='default') { ?>
              <p style="margin: 8px 0 2px">
              <input type="button" class="input_but" value="卸载" onclick="deltpl(<?=$value['temp_id']?>)">
              </p>
              <?php } ?>
  <!--
              <p style="margin: 2px 0"><a href="index.php?do=<?=$do?>&view=<?=$view?>&ac=export&temp_id=<?=$value['temp_id']?>">导出</a></p>
              <p style="margin: 2px 0">&nbsp;</p>-->
  </td>
          </tr>
        </table>
<?php } } ?>

        <div class="clear"></div>
       <div class="v_info"> 
        <div class="S_info2">
        <table width="100%"><tr>
 <td width="20%"><input type="submit" class="input_but" id="sbt_edit" name="sbt_edit" title="按 Enter 键可随时提交您的修改" value="更新" /></td>
 <td width="40%" align="right"">请输入目录名:<input name="txt_newtplpath" type="text" value=""><input type="submit" name="sbt_edit" class="input_but" value="从目录安装"></td>
 <td width="40%" align="right""><input type="file" name="uploadtplfile" > <input   type="submit" value="从本地上传" name="sbt_edit" class="input_but"> </td>
</tr></table>
 
</form>
  </div>
    <script>
    function deltpl(delid){
    	if(confirm('确认要删除么'))
    	{
        	location.href='index.php?do=config&view=tpl&delid='+delid;
        }
    }
    
    </script>
    <div class="clear"></div>
</div>
</body>
</html>
<?php Template_Class::ob_out();?>