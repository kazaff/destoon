<?php Template_Class::subtplcheck('control/admin/tpl/admin_shop_order', '1303712552', 'control/admin/tpl/admin_shop_order');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
document.location.href='index.php?do=<?=$do?>&view=<?=$view?>&ac=del&order_id='+id;
}
}

</script>

<body>
<form method="get" action="index.php" id="frm_art_search">
<input type="hidden" name="do" value="<?=$do?>">
<input type="hidden" name="view" value="<?=$view?>">
<div class="main">

  <div id="change">
  		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab_list t_c">
          <tr>
            <th width="100" align="left">ID( <a href="index.php?do=<?=$do?>&view=<?=$view?>&ord=1"><img src="tpl/img/m_up.gif" /></a> / <a href="index.php?do=<?=$do?>&view=<?=$view?>&ord=2"><img src="tpl/img/m_down.gif" /></a> )</th>
            <th align="left">订单类型</th>
<th>标题</th>
<th>价格</th>
<th>状态</th>
<th>买方</th>
<th>卖方</th>
<th width="60">详细</th>
<th width="60">删除</th>
          </tr>
  <?php if(is_array($order_arr)) { foreach($order_arr as $key => $value) { ?>
<tr>
<td align="left">
<input type="checkbox" name="ckb[]" id="cbk_selected" value="<?=$value['order_id']?>"> <?=$value['shop_id']?>
</td>
<td align="left">
<?php if($value['service_type']==1) { ?>
作品
<?php } elseif($value['shop_type']==2) { ?>
服务
<?php } ?>
</td>
<td>
<?=$value['title']?>
</td>
<td>
<?=$value['count_cash']?>
</td>
<td>
<?php if(!$value['order_status']) { ?>待付款<?php } ?>
<?php if($value['order_status']==1) { ?>进行中<?php } ?>
<?php if($value['order_status']==2) { ?>已终止<?php } ?>
<?php if($value['order_status']==3) { ?>买方取消<?php } ?>
<?php if($value['order_status']==4) { ?>卖方取消<?php } ?>
<?php if($value['order_status']==5) { ?>仲裁中<?php } ?>
<?php if($value['order_status']==7) { ?>已结束<?php } ?>
</td>
<td>
<?=$value['sale_username']?>
</td>
<td>
<?=$value['buy_username']?>
</td>
<td>
<a href="shop.php?do=service_info&sid=<?=$value['service_id']?>"><img src="tpl/img/ico/search.png" align="absmiddle"/> 
相关商品
</a>
</td>
<td>
<a onclick="del(<?=$value['order_id']?>);"><img src="tpl/img/ico/delete.gif" align="absmiddle"/> 
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
<th colspan="6">
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