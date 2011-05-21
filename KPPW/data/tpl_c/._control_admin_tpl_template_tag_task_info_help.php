<?php Template_Class::subtplcheck('./control/admin/tpl/template_tag_task_info_help', '1303811244', './control/admin/tpl/template_tag_task_info_help');?><?php if(is_array($datalist)) { foreach($datalist as $value) { ?>
<li class="mt_10"><p><strong><a href="<?=$value['url']?>"><?=$value['title']?> </a></strong></p>
<?=$value['content']?>
</li>
<?php } } ?><?php Template_Class::ob_out();?>