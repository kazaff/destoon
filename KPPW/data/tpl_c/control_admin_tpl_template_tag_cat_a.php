<?php Template_Class::subtplcheck('control/admin/tpl/template_tag_cat_a', '1303866330', 'control/admin/tpl/template_tag_cat_a');?><?php if(is_array($datalist)) { foreach($datalist as $key => $value) { ?>
<a href="<?=$value['url']?>"><?=$value['name']?></a>
<?php } } ?><?php Template_Class::ob_out();?>