<?php defined('IN_DESTOON') or exit('Access Denied');?><?php if($tags) { ?><ul>
<?php if(is_array($tags)) { foreach($tags as $k => $t) { ?>
<li><span class="f_r">[<?php echo area_pos($t['areaid'], '/', 1);?>]</span><?php if($datetype) { ?><span class="px11">[<?php echo timetodate($t[$time], $datetype);?>]</span>&nbsp;<?php } ?><a href="<?php echo $t['linkurl'];?>" target="_blank" title="<?php echo $t['alt'];?>"><?php echo $t['title'];?></a></li>
<?php } } ?>
</ul><?php } ?>