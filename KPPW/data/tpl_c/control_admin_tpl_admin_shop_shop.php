<?php Template_Class::subtplcheck('control/admin/tpl/admin_shop_shop', '1303712547', 'control/admin/tpl/admin_shop_shop');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_K['charset']?>" />
<title>main</title>
</head>
<link href="tpl/css/style.css" rel="stylesheet" type="text/css" />
<script src="tpl/js/jquery.js" type="text/javascript"></script>
<script src="tpl/js/common.js" type="text/javascript"></script>
<script type="text/javascript">
function del(id){
var id = id;
if(confirm('确定要删除？')==true){
document.location.href='index.php?do=<?=$do?>&view=<?=$view?>&ac=del&shop_id='+id;
}
}

</script>

<body>
<form method="get" action="index.php" id="frm_art_search">
<input type="hidden" name="do" value="<?=$do?>">
<input type="hidden" name="view" value="<?=$view?>">
<div class="main">
<div class="v_search">	
条数：
<select name="slt_page_size">
<option value="10" <?php if($slt_page_size=='10') { ?>selected="selected"<?php } ?>>每页显示10</option>
<option value="20" <?php if($slt_page_size=='20') { ?>selected="selected"<?php } ?>>每页显示20</option>
<option value="30" <?php if($slt_page_size=='30') { ?>selected="selected"<?php } ?>>每页显示30</option>
</select>
类型：
<select name="slt_banner_type">
<option value="">选择类型</option>
<option value="1" <?php if($slt_banner_type=='1') { ?>selected="selected"<?php } ?>>个人店铺</option>
<option value="2" <?php if($slt_banner_type=='2') { ?>selected="selected"<?php } ?>>企业店铺</option>
</select>
分类：
<select name="slt_indus_id">
<option value="">选择分类</option>
<?php if(is_array($indus_arr)) { foreach($indus_arr as $key => $value) { ?>
<option value="<?=$value['indus_id']?>" <?php if($slt_indus_id==$value['indus_id']) { ?>selected="selected"<?php } ?>><?=$value['indus_name']?></option>
<?php } } ?>
</select>
编号：
<input type="text" class="input_t" size="12" name="txt_id" value="<?=$txt_id?>" onkeyup="clearstr(this);">
标题：
<input type="text" class="input_t" name='txt_title' value="<?=$txt_title?>">　
<input type="submit" name="sbt_search" value="查询" class="input_but"/>
    </div>
  <div id="change">
  		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab_list t_c">
          <tr>
            <th width="100" align="left">ID( <a href="index.php?do=<?=$do?>&view=<?=$view?>&slt_page_size=<?=$slt_page_size?>&ord=1&txt_id=<?=$txt_id?>&txt_title=<?=$txt_title?>&slt_banner_type=<?=$slt_banner_type?>&slt_indus_id=<?=$slt_indus_id?>"><img src="tpl/img/m_up.gif" /></a> / <a href="index.php?do=<?=$do?>&view=<?=$view?>&slt_page_size=<?=$slt_page_size?>&ord=2&txt_id=<?=$txt_id?>&txt_title=<?=$txt_title?>&slt_banner_type=<?=$slt_banner_type?>&slt_indus_id=<?=$slt_indus_id?>"><img src="tpl/img/m_down.gif" /></a> )</th>
            <th align="left">店铺类型</th>
<th>所属行业</th>
<th>店铺名称</th>
<th>店主</th>
<th width="60">详细</th>
<th width="60">删除</th>
          </tr>
  <?php if(is_array($shop_arr)) { foreach($shop_arr as $key => $value) { ?>
<tr>
<td align="left">
<input type="checkbox" name="ckb[]" id="cbk_selected" value="<?=$value['shop_id']?>"> <?=$value['shop_id']?>
</td>
<td align="left">
<?php if($value['shop_type']==1) { ?>
个人店铺
<?php } elseif($value['shop_type']==2) { ?>
企业店铺
<?php } ?>
</td>
<td>
<?php if($indus_arr[$value['indus_id']]['indus_name']) { ?><?=$indus_arr[$value['indus_id']]['indus_name']?><?php } else { ?>无<?php } ?>
</td>
<td>
<?=$value['shop_name']?>
</td>
<td>
<?=$value['username']?>
</td>

<td>
<a target="_blank" href="<?=$_K['siteurl']?>/shop.php?do=shop&shop_id=<?=$value['shop_id']?>"><img src="tpl/img/ico/search.png" align="absmiddle"/> 
详细
</a>
</td>
<td>
<a  onclick="del(<?=$value['shop_id']?>);"><img src="tpl/img/ico/delete.gif" align="absmiddle"/> 
删除
</a>
</td>
</tr>
<?php } } ?>
          <tr>
            <th colspan="3" align="left"><label for="checkbox"><input type="checkbox" id="checkbox" onclick="checkall();">  
全选　
<input type="submit" name="sbt_action" value="直接删除" class="input_but" />
&nbsp;&nbsp;&nbsp;
</th>
<th colspan="4">
<div class="page">
<?=$pages['page']?>
</div>
</th>
          </tr>
        </table>
</div>
  <script src="tpl/js/css.js" type="text/javascript"></script>
    </div>
</form>
</body>
</html><?php Template_Class::ob_out();?>