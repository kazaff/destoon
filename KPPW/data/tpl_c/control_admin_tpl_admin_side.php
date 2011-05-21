<?php Template_Class::subtplcheck('control/admin/tpl/admin_side', '1303866360', 'control/admin/tpl/admin_side');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_K['charset']?>" />
<title>left</title>
</head>
<link href="tpl/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="tpl/js/jquery.js">
        </script>
<body bgcolor="#EBEBEB">
<div class="left">
<dl>

<?php $i = 0; ?>
<?php if(is_array($urlset_arr)) { foreach($urlset_arr as $key => $set) { ?>
<dt style="cursor:pointer;" <?php if($t_set_arr) { ?>class="nav_1"<?php } else { ?>class="nav_2"<?php } ?> id='dt'><strong><?=$set['name']?></strong></dt>
<dd id="submenu_id_<?=$set['submenu_id']?>" style="display:none;">
<?php if(is_array($set['items'])) { foreach($set['items'] as $item) { ?>
<?php if($admin_info['uid']==ADMIN_UID||in_array($item['resource_id'],$group_arr[$admin_info['group_id']]['group_roles'])) { ?><a href="<?=$item['resource_url']?>" id="a_item_<?=$i?>" onclick="selectitem(this,'<?=$set['name']?>')" target="main"><?=$item['resource_name']?></a>
<?php $i++;$t_set_arr = $t_set_arr?$t_set_arr:$set ?><?php } ?>
<?php } } ?>
</dd>
<?php } } ?>

</dl>
</div>
<script>
$(function(){
   var count = 0;
     $("dl>dt").click(function(){
 	  $(this).next().slideToggle("slow");
  if($(this).hasClass("nav_2")){
  	 $(this).removeClass("nav_2");
 $(this).addClass("nav_1");
  }else{
  	 $(this).removeClass("nav_1");
 $(this).addClass("nav_2");
  }
 })
 <?php if($opnew) { ?>
 var a_op_c = document.getElementById('a_item_0');
 parent.main.location.href = a_op_c.href;
 parent.document.getElementById("nav3").innerHTML=a_op_c.innerHTML;
 parent.document.getElementById("nav2").innerHTML='<?=$t_set_arr['name']?>';
 parent.document.getElementById("nav1").innerHTML='<?=$menu_arr[$menu]?>';
 //$('#submenu_id_<?=$t_set_arr['submenu_id']?>').last().removeClass("nav_1");
 //$('#submenu_id_<?=$t_set_arr['submenu_id']?>').last().addClass("nav_2");
 <?php } ?>
 $('#submenu_id_<?=$t_set_arr['submenu_id']?>').show("slow");
})
function selectitem(item,submenuname){
var ii=0;
for(ii=0;ii<<?=$i?>;ii++){

if(document.getElementById('a_item_'+ii).className =='isself')
{
document.getElementById('a_item_'+ii).className ='';
}
}
item.className="isself";
parent.document.getElementById("nav3").innerHTML=item.innerHTML;
parent.document.getElementById("nav2").innerHTML=submenuname;
parent.document.getElementById("nav1").innerHTML='<?=$menu_arr[$menu]?>';
}
</script>
</body>
</html><?php Template_Class::ob_out();?>