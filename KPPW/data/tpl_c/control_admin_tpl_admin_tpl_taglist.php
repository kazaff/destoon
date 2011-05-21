<?php Template_Class::subtplcheck('control/admin/tpl/admin_tpl_taglist', '1303866361', 'control/admin/tpl/admin_tpl_taglist');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_K['charset']?>" />
<title>main</title>
</head>
<link href="tpl/css/style.css" rel="stylesheet" type="text/css" />
<script src="tpl/js/jquery.js" type="text/javascript"></script>
<script src="tpl/js/common.js" type="text/javascript"></script>

<body>
<form method="post" action="index.php?do=<?=$do?>&view=<?=$view?>" id="frm_art_search">
<div class="main">
<div class="v_search" style="margin:auto;text-align:center;">
输入标签名
<input type="text" class="input_t" name='txt_tagname' value="<?=$txt_tagname?>">　
<input type="submit" name="sbt_search" value="查看" class="input_but"/>
    </div>
 	
  <div id="change">
  		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab_list t_c">
          <tr>
            <th width="60">ID</th>
            <th >标签名</th>
<th width="70">标签类型</th>
<th>内部调用代码</th>
<th>js调用代码</th>
<th width="60">预览</th>
<th width="60">编辑</th>
<th width="60">删除</th>
          </tr>
  <?php if(is_array($tag_list)) { foreach($tag_list as $key => $value) { ?>
<tr>
<td>
<input type="checkbox" name="ckb[]" id="cbk_selected" value="<?=$value['tag_id']?>"> <?=$value['tag_id']?>
</td>
<td >
<?=$value['tagname']?>
</td>
<td>
<?php if($value['tag_type']==1) { ?>任务<?php } ?>
<?php if($value['tag_type']==2) { ?>文章<?php } ?>
<?php if($value['tag_type']==3) { ?>分类<?php } ?>
<?php if($value['tag_type']==4) { ?>自定义sql<?php } ?>
<?php if($value['tag_type']==5) { ?>代码<?php } ?>
</td>
<td >
<input type="text" value="<?php echo '<!--{tag '.$value[tagname].'}-'; ?>->">
</td>
<td>
<input type="text" value="<script src='<?=$_K['siteurl']?>/js.php?op=tag&tag_id=<?=$value['tag_id']?>'></script>">
</td>
<td>
<a href="plu.php?do=previewtag&tagid=<?=$value['tag_id']?>" target="_blank"><img src="tpl/img/ico/search.png" align="absmiddle"/> 
预览
</a>
</td>
<td>
<a href="index.php?do=tpl&view=edit_tag&tagid=<?=$value['tag_id']?>"><img src="tpl/img/ico/edit.png" align="absmiddle"/> 
编辑
</a>
</td>
<td>
<a href="index.php?do=tpl&view=taglist&op=del&delid=<?=$value['tag_id']?>" onclick="return confirm('确认要删除么?')" ><img src="tpl/img/ico/delete.gif" align="absmiddle"/> 
删除
</a>
</td>
</tr>
<?php } } ?>
          <tr>
            <th colspan="4" align="left"><label for="checkbox"><input type="checkbox" id="checkbox" onclick="checkall();">  
全选　
<input type="submit" name="sbt_action" value="批量删除" class="input_but" />
&nbsp;&nbsp;&nbsp;<input type="button" name="sbt_add" value="创建标签" class="input_but"  onclick="document.location.href='index.php?do=<?=$do?>&view=edit_tag'"/>
</th>
<th colspan="4">
<?=$pages['page']?>
</th>
          </tr>
        </table>
</div>
  <script src="tpl/js/css.js" type="text/javascript"></script>
    </div>
</form>
</body>
</html><?php Template_Class::ob_out();?>