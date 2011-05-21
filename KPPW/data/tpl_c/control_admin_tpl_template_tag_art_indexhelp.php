<?php Template_Class::subtplcheck('control/admin/tpl/template_tag_art_indexhelp', '1303866330', 'control/admin/tpl/template_tag_art_indexhelp');?><?php if(is_array($datalist)) { foreach($datalist as $key => $value) { ?>
<?php if($key == 2) { ?></ul><ul class="w50 fl_l linko"><?php } ?>
<li style="width:135px;height:20px;overflow:hidden;display:block;"><a href="<?=$value['url']?>"><?=$value['title']?></a></li>
<?php } } ?><?php Template_Class::ob_out();?>