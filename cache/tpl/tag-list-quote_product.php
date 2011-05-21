<?php defined('IN_DESTOON') or exit('Access Denied');?><table width="100%" cellpadding="3">
<?php if(is_array($tags)) { foreach($tags as $i => $t) { ?>
<?php if($i%$cols==0) { ?><tr><?php } ?>
<td><a href="<?php echo $path;?><?php echo rewrite('search.php?pid='.$t['pid']);?>"<?php if($target) { ?> target="<?php echo $target;?>"<?php } ?> title="<?php echo $t['alt'];?>"><?php echo $t['title'];?></a></td>
<?php if($i%$cols==($cols-1)) { ?></tr><?php } ?>
<?php } } ?>
</table>
<?php if($showpage && $pages) { ?><div class="pages"><?php echo $pages;?></div><?php } ?>