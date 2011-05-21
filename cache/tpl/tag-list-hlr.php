<?php defined('IN_DESTOON') or exit('Access Denied');?><table width="100%">
<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?>
<?php if($i%$cols==0) { ?><tr><?php } ?>
<td><div><?php if($datetype) { ?><span class="f_r"><?php echo timetodate($t['addtime'], $datetype);?></span><?php } ?><a href="<?php echo $t['linkurl'];?>"<?php if($target) { ?> target="<?php echo $target;?>"<?php } ?> title="<?php echo $t['alt'];?>">&raquo;<?php echo $t['title'];?></a></div></td>
<?php if($i%$cols==($cols-1)) { ?></tr><?php } ?>
<?php } } ?>
</table>