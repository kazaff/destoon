<?php Template_Class::subtplcheck('./control/admin/tpl/template_feed_user_talent', '1303700216', './control/admin/tpl/template_feed_user_talent');?><?php if(is_array($datalist)) { foreach($datalist as $value) { ?>
<li><span class="date"><?=$value['on_time']?></span><?=$value['title']?></li>
<?php } } ?><?php Template_Class::ob_out();?>