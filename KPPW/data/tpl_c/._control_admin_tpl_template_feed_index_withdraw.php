<?php Template_Class::subtplcheck('./control/admin/tpl/template_feed_index_withdraw', '1303866330', './control/admin/tpl/template_feed_index_withdraw');?><?php if(is_array($datalist)) { foreach($datalist as $value) { ?>
<li><?=$value['title']?></li>
<?php } } ?><?php Template_Class::ob_out();?>