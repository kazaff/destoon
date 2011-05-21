<?php Template_Class::subtplcheck('control/admin/tpl/template_tag_art_a', '1303866330', 'control/admin/tpl/template_tag_art_a');?><?php if(is_array($datalist)) { foreach($datalist as $key => $value) { ?>
<a href="<?=$value['url']?>"><?=$value['title']?></a>
<?php } } ?><?php Template_Class::ob_out();?>