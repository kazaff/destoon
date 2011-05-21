<?php Template_Class::subtplcheck('control/admin/tpl/template_tag_shop_a', '1303712589', 'control/admin/tpl/template_tag_shop_a');?><?php if(is_array($datalist)) { foreach($datalist as $key => $value) { ?>
<li><a href="<?=$value['url']?>"><?=$value['title']?></a></li>
<?php } } ?><?php Template_Class::ob_out();?>