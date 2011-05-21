<?php Template_Class::subtplcheck('control/admin/tpl/template_tag_art_a_dateflr', '1303866330', 'control/admin/tpl/template_tag_art_a_dateflr');?><?php if(is_array($datalist)) { foreach($datalist as $value) { ?>
<li><a href="<?=$value['url']?>"><?=$value['title']?></a><span class="c_999 fl_r"><?php echo date('Y-m-d',$value[time]); ?></span></li>
<?php } } ?><?php Template_Class::ob_out();?>