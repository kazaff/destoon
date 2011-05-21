<?php Template_Class::subtplcheck('./control/admin/tpl/template_tag_task_index', '1303866330', './control/admin/tpl/template_tag_task_index');?><?php if(is_array($datalist)) { foreach($datalist as $key => $value) { ?>
<li><span class="f60" style="width:120px; float:left;display:block;">￥ <?=$value['cash']?>元</span> <a href="<?=$value['url']?>"><?=$value['title']?></a><span style="float:right;margin-right:15px;">周期：<?php echo date('Y-m-d',$value['starttime']); ?> —— <?php echo date('Y-m-d',$value['endtime']); ?></span></li>
<?php } } ?>
<?=$where?><?php Template_Class::ob_out();?>